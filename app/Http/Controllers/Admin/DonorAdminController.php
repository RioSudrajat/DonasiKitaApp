<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonorAdminController extends Controller
{
    /**
     * Display a listing of donors
     */
    public function index(Request $request)
    {
        $query = Donation::where('payment_status', 'paid')
            ->selectRaw('MAX(donor_name) as donor_name, donor_email, MAX(donor_phone) as donor_phone, COUNT(*) as donation_count, SUM(amount) as total_amount')
            ->groupBy('donor_email')
            ->orderByDesc('total_amount');

        // Search by donor name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%");
            });
        }

        $donors = $query->paginate(20);

        // Get statistics
        $totalDonors = Donation::where('payment_status', 'paid')
            ->distinct('donor_email')
            ->count();
        
        $totalDonations = Donation::where('payment_status', 'paid')->sum('amount');
        $averageDonation = Donation::where('payment_status', 'paid')->avg('amount');

        return view('admin.donors.index', compact(
            'donors',
            'totalDonors',
            'totalDonations',
            'averageDonation'
        ));
    }

    /**
     * Show donor details and their donations
     */
    public function show(Request $request, $email)
    {
        // Get donor info
        $donor = Donation::where('donor_email', $email)
            ->where('payment_status', 'paid')
            ->first();

        if (!$donor) {
            abort(404, 'Donatur tidak ditemukan');
        }

        // Get all donations from this donor
        $donations = Donation::where('donor_email', $email)
            ->with('campaign')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get donor statistics
        $totalDonations = Donation::where('donor_email', $email)
            ->where('payment_status', 'paid')
            ->sum('amount');

        $donationCount = Donation::where('donor_email', $email)
            ->where('payment_status', 'paid')
            ->count();

        $lastDonation = Donation::where('donor_email', $email)
            ->where('payment_status', 'paid')
            ->latest()
            ->first();

        return view('admin.donors.show', compact(
            'donor',
            'donations',
            'totalDonations',
            'donationCount',
            'lastDonation'
        ));
    }

    /**
     * Export donors to CSV
     */
    public function export()
    {
        $donors = Donation::where('payment_status', 'paid')
            ->selectRaw('MAX(donor_name) as donor_name, donor_email, MAX(donor_phone) as donor_phone, COUNT(*) as donation_count, SUM(amount) as total_amount, MAX(created_at) as last_donation')
            ->groupBy('donor_email')
            ->orderByDesc('total_amount')
            ->get();

        $filename = 'donatur_' . date('Y-m-d_H-i-s') . '.csv';
        $handle = fopen('php://memory', 'w');

        // Add header
        fputcsv($handle, ['Nama', 'Email', 'Telepon', 'Jumlah Donasi', 'Total', 'Donasi Terakhir']);

        // Add data
        foreach ($donors as $donor) {
            fputcsv($handle, [
                $donor->donor_name,
                $donor->donor_email,
                $donor->donor_phone,
                $donor->donation_count,
                $donor->total_amount,
                $donor->last_donation,
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
