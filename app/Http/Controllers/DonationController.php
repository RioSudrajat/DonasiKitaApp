<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $campaigns = Campaign::where('status', 'active')->orderBy('created_at', 'desc')->get();
        return view('landing', compact('campaigns'));
    }

    public function form(Campaign $campaign)
    {
        return view('donation.form', compact('campaign'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'donor_name' => 'required|string|min:3',
            'donor_email' => 'required|email',
            'donor_phone' => 'required|string|min:10',
            'amount' => 'required|numeric|min:1000',
            'hide_name' => 'boolean',
        ]);

        $orderId = 'DONASI-' . time() . '-' . rand(1000, 9999);

        $donation = Donation::create([
            'campaign_id' => $validated['campaign_id'],
            'donor_name' => $validated['hide_name'] ? 'Hamba Allah' : $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'donor_phone' => $validated['donor_phone'],
            'amount' => $validated['amount'],
            'order_id' => $orderId,
            'payment_status' => 'pending',
        ]);

        $campaign = Campaign::find($validated['campaign_id']);

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => (int) $validated['amount'],
            ),
            'customer_details' => array(
                'first_name' => $validated['donor_name'],
                'email' => $validated['donor_email'],
                'phone' => $validated['donor_phone'],
            ),
            'item_details' => array(
                array(
                    'id' => $campaign->id,
                    'price' => (int) $validated['amount'],
                    'quantity' => 1,
                    'name' => 'Donasi - ' . $campaign->title,
                ),
            ),
        );

        try {
            $snapToken = Snap::getSnapToken($params);

            $donation->snap_token = $snapToken;
            $donation->save();

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            $donation->delete();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed != $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $donation = Donation::where('order_id', $request->order_id)->first();

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
            $donation->payment_status = 'paid';
            $donation->payment_type = $request->payment_type;
            $donation->paid_at = now();

            DB::transaction(function () use ($donation) {
                $donation->save();

                $campaign = $donation->campaign;
                $campaign->current_amount += $donation->amount;
                $campaign->donors_count += 1;
                $campaign->save();
            });

        } elseif ($request->transaction_status == 'pending') {
            $donation->payment_status = 'pending';
            $donation->save();
        } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
            $donation->payment_status = 'failed';
            $donation->save();
        }

        return response()->json(['message' => 'OK']);
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $donation = Donation::where('order_id', $orderId)->first();

        if (!$donation) {
            return redirect('/')->with('error', 'Donasi tidak ditemukan');
        }

        // Auto-verify status dari Midtrans ketika user masuk ke success page
        if ($donation->payment_status === 'pending') {
            try {
                $statusFromMidtrans = Transaction::status($orderId);

                if ($statusFromMidtrans && in_array($statusFromMidtrans->transaction_status, ['settlement', 'capture'])) {
                    // Auto-update status ke paid
                    DB::transaction(function () use ($donation, $statusFromMidtrans) {
                        $donation->payment_status = 'paid';
                        $donation->payment_type = $statusFromMidtrans->payment_type ?? $donation->payment_type;
                        $donation->paid_at = now();
                        $donation->save();

                        // Update campaign
                        $campaign = $donation->campaign;
                        $campaign->current_amount += $donation->amount;
                        $campaign->donors_count += 1;
                        $campaign->save();
                    });

                    // Refresh donation data
                    $donation->refresh();
                }
            } catch (\Exception $e) {
                \Log::warning("Error auto-verifying payment for $orderId: " . $e->getMessage());
            }
        }

        return view('donation.success', compact('donation'));
    }

    public function campaignsRealtime()
    {
        $campaigns = Campaign::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($campaign) {
                return [
                    'id' => $campaign->id,
                    'current_amount' => $campaign->current_amount,
                    'target_amount' => $campaign->target_amount,
                    'progress' => $campaign->progress,
                ];
            });

        return response()->json(['campaigns' => $campaigns]);
    }

    /**
     * Check payment status dari Midtrans dan auto-update jika sudah terbayar
     */
    public function checkPaymentStatus($orderId)
    {
        $donation = Donation::where('order_id', $orderId)->first();

        if (!$donation) {
            return response()->json(['error' => 'Donation not found'], 404);
        }

        // Jika status sudah paid, return langsung
        if ($donation->payment_status === 'paid') {
            return response()->json([
                'order_id' => $donation->order_id,
                'payment_status' => $donation->payment_status,
                'amount' => $donation->amount,
                'donor_name' => $donation->donor_name,
                'donor_email' => $donation->donor_email,
                'campaign_title' => $donation->campaign->title,
                'paid_at' => $donation->paid_at,
            ]);
        }

        // Jika status masih pending, check ke Midtrans
        try {
            $statusFromMidtrans = Transaction::status($orderId);

            if ($statusFromMidtrans) {
                // Jika Midtrans return settlement/capture, update status
                if (in_array($statusFromMidtrans->transaction_status, ['settlement', 'capture'])) {
                    // Update donation status ke paid
                    DB::transaction(function () use ($donation, $statusFromMidtrans) {
                        $donation->payment_status = 'paid';
                        $donation->payment_type = $statusFromMidtrans->payment_type ?? $donation->payment_type;
                        $donation->paid_at = now();
                        $donation->save();

                        // Update campaign
                        $campaign = $donation->campaign;
                        $campaign->current_amount += $donation->amount;
                        $campaign->donors_count += 1;
                        $campaign->save();
                    });

                    return response()->json([
                        'order_id' => $donation->order_id,
                        'payment_status' => 'paid',
                        'amount' => $donation->amount,
                        'donor_name' => $donation->donor_name,
                        'donor_email' => $donation->donor_email,
                        'campaign_title' => $donation->campaign->title,
                        'paid_at' => $donation->paid_at,
                        'auto_updated' => true,
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Jika error check Midtrans, return current status
            \Log::warning("Error checking Midtrans status for $orderId: " . $e->getMessage());
        }

        return response()->json([
            'order_id' => $donation->order_id,
            'payment_status' => $donation->payment_status,
            'amount' => $donation->amount,
            'donor_name' => $donation->donor_name,
            'donor_email' => $donation->donor_email,
            'campaign_title' => $donation->campaign->title,
            'paid_at' => $donation->paid_at,
        ]);
    }

    /**
     * Verify dan auto-update payment status dari Midtrans (untuk admin)
     */
    public function verifyAndUpdatePayment($orderId)
    {
        $donation = Donation::where('order_id', $orderId)->first();

        if (!$donation) {
            return response()->json(['error' => 'Donation not found'], 404);
        }

        // Jika sudah paid, tidak perlu verify lagi
        if ($donation->payment_status === 'paid') {
            return response()->json([
                'message' => 'Donation already paid',
                'status' => 'paid',
            ]);
        }

        try {
            // Check status dari Midtrans
            $statusFromMidtrans = Transaction::status($orderId);

            if (!$statusFromMidtrans) {
                return response()->json([
                    'error' => 'Could not retrieve status from Midtrans',
                    'current_status' => $donation->payment_status,
                ], 400);
            }

            $transactionStatus = $statusFromMidtrans->transaction_status;

            // Update based on Midtrans status
            if (in_array($transactionStatus, ['settlement', 'capture'])) {
                // Payment successful - update status
                DB::transaction(function () use ($donation, $statusFromMidtrans) {
                    $donation->payment_status = 'paid';
                    $donation->payment_type = $statusFromMidtrans->payment_type ?? $donation->payment_type;
                    $donation->paid_at = now();
                    $donation->save();

                    // Update campaign
                    $campaign = $donation->campaign;
                    $campaign->current_amount += $donation->amount;
                    $campaign->donors_count += 1;
                    $campaign->save();
                });

                return response()->json([
                    'message' => 'Payment verified and status updated to paid',
                    'status' => 'paid',
                    'updated' => true,
                ]);
            } elseif ($transactionStatus === 'pending') {
                return response()->json([
                    'message' => 'Payment still pending',
                    'status' => 'pending',
                    'updated' => false,
                ]);
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                // Payment failed
                $donation->payment_status = 'failed';
                $donation->save();

                return response()->json([
                    'message' => 'Payment failed on Midtrans',
                    'status' => 'failed',
                    'updated' => true,
                ]);
            } else {
                return response()->json([
                    'message' => 'Unknown transaction status from Midtrans',
                    'status' => $transactionStatus,
                ], 400);
            }
        } catch (\Exception $e) {
            \Log::error("Error verifying payment for $orderId: " . $e->getMessage());
            return response()->json([
                'error' => 'Error verifying payment: ' . $e->getMessage(),
            ], 500);
        }
    }
}