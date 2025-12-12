<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::query();

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'progress_asc':
                $query->orderByRaw('(current_amount / target_amount) ASC');
                break;
            case 'progress_desc':
                $query->orderByRaw('(current_amount / target_amount) DESC');
                break;
            case 'target_asc':
                $query->orderBy('target_amount', 'asc');
                break;
            case 'target_desc':
                $query->orderBy('target_amount', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $campaigns = $query->paginate(12);

        return view('campaigns', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load(['donations' => function ($query) {
            $query->where('payment_status', 'paid')->orderBy('created_at', 'desc');
        }, 'updates' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('campaign.detail', compact('campaign'));
    }

    public function realTimeData(Campaign $campaign)
    {
        $campaign->load(['donations' => function ($query) {
            $query->where('payment_status', 'paid')->orderBy('created_at', 'desc')->limit(10);
        }]);

        return response()->json([
            'current_amount' => $campaign->current_amount,
            'target_amount' => $campaign->target_amount,
            'progress' => $campaign->progress,
            'donors_count' => $campaign->donors_count,
            'donations' => $campaign->donations->map(function ($donation) {
                return [
                    'id' => $donation->id,
                    'donor_name' => $donation->donor_name,
                    'amount' => $donation->amount,
                    'created_at' => $donation->created_at->diffForHumans(),
                    'avatar' => strtoupper(substr($donation->donor_name, 0, 1)),
                ];
            }),
        ]);
    }
}
