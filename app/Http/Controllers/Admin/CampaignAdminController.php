<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignAdminController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'target_amount' => 'required|numeric|min:10000',
            'end_date' => 'required|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive,completed',
        ], [
            'title.required' => 'Judul kampanye harus diisi',
            'title.min' => 'Judul minimal 5 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'target_amount.required' => 'Target dana harus diisi',
            'target_amount.min' => 'Target dana minimal Rp 10.000',
            'end_date.required' => 'Tanggal akhir harus diisi',
            'end_date.after' => 'Tanggal akhir harus lebih dari hari ini',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar hanya jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'image_url.url' => 'URL gambar tidak valid',
        ]);

        // Handle image upload - prioritas: file upload > URL
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaigns', 'public');
            $validated['image'] = $imagePath;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->input('image_url');
        }

        $validated['current_amount'] = 0;
        $validated['donors_count'] = 0;

        Campaign::create($validated);

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dibuat');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'target_amount' => 'required|numeric|min:10000',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive,completed',
            'delete_image' => 'nullable|in:0,1',
        ]);

        // Handle delete image flag
        if ($request->filled('delete_image') && $request->input('delete_image') == '1') {
            // Delete old image if exists and is from storage
            if ($campaign->image && !str_starts_with($campaign->image, 'http')) {
                \Storage::disk('public')->delete($campaign->image);
            }
            $validated['image'] = null;
        }
        // Handle image upload - prioritas: file upload > URL
        elseif ($request->hasFile('image')) {
            // Delete old image if exists and is from storage
            if ($campaign->image && !str_starts_with($campaign->image, 'http')) {
                \Storage::disk('public')->delete($campaign->image);
            }
            $imagePath = $request->file('image')->store('campaigns', 'public');
            $validated['image'] = $imagePath;
        } elseif ($request->filled('image_url')) {
            // Delete old image if exists and is from storage
            if ($campaign->image && !str_starts_with($campaign->image, 'http')) {
                \Storage::disk('public')->delete($campaign->image);
            }
            $validated['image'] = $request->input('image_url');
        }

        $campaign->update($validated);

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil diperbarui');
    }

    public function destroy(Campaign $campaign)
    {
        // Delete image if exists
        if ($campaign->image) {
            \Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dihapus');
    }

    public function show(Campaign $campaign)
    {
        $donations = $campaign->donations()->with('campaign')->latest()->paginate(10);
        return view('admin.campaigns.show', compact('campaign', 'donations'));
    }
}
