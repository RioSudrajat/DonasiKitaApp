<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationAdminController extends Controller
{
    /**
     * Display a listing of donations
     */
    public function index(Request $request)
    {
        $query = Donation::with('campaign')
            ->orderBy('created_at', 'desc');

        // Filter by campaign
        if ($request->has('campaign_id') && $request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }

        // Filter by payment status
        if ($request->has('status') && $request->status) {
            $query->where('payment_status', $request->status);
        }

        // Search by donor name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('donor_phone', 'like', "%{$search}%");
            });
        }

        $donations = $query->paginate(20);

        // Get statistics
        $totalDonations = Donation::sum('amount');
        $totalPaidDonations = Donation::where('payment_status', 'paid')->sum('amount');
        $donationCount = Donation::where('payment_status', 'paid')->count();
        $pendingDonations = Donation::where('payment_status', 'pending')->count();

        return view('admin.donations.index', compact(
            'donations',
            'totalDonations',
            'totalPaidDonations',
            'donationCount',
            'pendingDonations'
        ));
    }

    /**
     * Show donation details
     */
    public function show(Donation $donation)
    {
        $donation->load('campaign');
        return view('admin.donations.show', compact('donation'));
    }

    /**
     * Update donation status
     */
    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed',
        ]);

        $donation->payment_status = $request->status;
        $donation->save();

        return redirect()->back()->with('success', 'Status donasi berhasil diperbarui');
    }

    /**
     * Export donations to CSV
     */
    public function export()
    {
        $donations = Donation::with('campaign')
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'donasi_' . date('Y-m-d_H-i-s') . '.csv';
        $handle = fopen('php://memory', 'w');

        // Add header
        fputcsv($handle, ['Tanggal', 'Donatur', 'Email', 'Nominal', 'Kampanye', 'Status']);

        // Add data
        foreach ($donations as $donation) {
            fputcsv($handle, [
                $donation->created_at->format('Y-m-d H:i:s'),
                $donation->donor_name,
                $donation->donor_email,
                $donation->amount,
                $donation->campaign->title,
                $donation->payment_status,
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
}
