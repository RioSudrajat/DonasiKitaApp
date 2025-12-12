<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_campaigns' => Campaign::count(),
            'active_campaigns' => Campaign::where('status', 'active')->count(),
            'total_donations' => Donation::where('payment_status', 'paid')->count(),
            'total_collected' => Donation::where('payment_status', 'paid')->sum('amount'),
            'pending_donations' => Donation::where('payment_status', 'pending')->sum('amount'),
        ];

        $recent_donations = Donation::where('payment_status', 'paid')
            ->with('campaign')
            ->latest()
            ->limit(5)
            ->get();

        $campaigns = Campaign::orderBy('current_amount', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_donations', 'campaigns'));
    }
}
