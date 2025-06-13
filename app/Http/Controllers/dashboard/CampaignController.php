<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CampaignController extends Controller
{
    /**
     * Display a listing of the campaigns.
     */
    public function index(Request $request)
    {
        // Admin can see all campaigns, creators can only see their own
        $query = Campaign::with(['user', 'category']);

        if (!auth()->user()->isAdmin()) {
            // Non-admin users can only see their own campaigns
            $query->where('user_id', auth()->id());
        }

        // Apply filters if provided
        if ($request->has('category')) {
            $query->byCategory($request->category);
        }

        if ($request->has('search')) {
            $query->search($request->search);
        }

        if ($request->has('status') && in_array($request->status, ['draft', 'active', 'completed', 'rejected'])) {
            $query->where('status', $request->status);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $campaigns = $query->with(['category', 'user'])
            ->latest()
            ->get();
        $categories = Category::all(); // For filter dropdown

        return view('dashboard.campaign.index', compact('campaigns', 'categories'));
    }

    /**
     * Show the form for creating a new campaign.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.campaign.create', compact('categories'));
    }

    /**
     * Store a newly created campaign in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'short_description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'target_amount' => 'required|integer|min:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required|string|min:100',
            'cover_image' => 'nullable|image|max:2048', // 2MB max
            'status' => 'nullable|in:draft,active,completed,rejected',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['slug'] = Str::slug($request->title) . '-' . Str::random(6);

        // Si el usuario es admin, la campaña se verifica automáticamente
        if (auth()->user()->role === 'admin') {
            $validatedData['verification_status'] = 'verified';
        }

        if ($request->hasFile('cover_image')) {
            // Pastikan direktori ada
            $storagePath = public_path('storage/campaigns');
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0775, true);
            }

            // Simpan file dengan nama unik
            $imageName = time() . '_' . $request->file('cover_image')->getClientOriginalName();
            $request->file('cover_image')->storeAs('campaigns', $imageName, 'public');
            $validatedData['cover_image'] = 'campaigns/' . $imageName;
        }

        $campaign = Campaign::create($validatedData);

         return redirect()->route('dashboard.campaigns.show', $campaign->slug)
            ->with('success', 'Campaign created successfully!');
    }

    /**
     * Display the specified campaign.
     */
    public function show($slug)
    {
        $campaign = Campaign::where('slug', $slug)
            ->with(['user', 'category', 'comments.user', 'updates', 'donations.user', 'feedbacks.user'])
            ->firstOrFail();

        return view('dashboard.campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified campaign.
     */
    public function edit($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // Check if user is authorized to edit
        $this->authorize('update', $campaign);

        $categories = Category::all();

        return view('dashboard.campaign.edit', compact('campaign', 'categories'));
    }

    /**
     * Update the specified campaign in storage.
     */
    public function update(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // Check if user is authorized to update
        $this->authorize('update', $campaign);

        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'short_description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'target_amount' => 'required|integer|min:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required|string|min:100',
            'cover_image' => 'nullable|image|max:2048', // 2MB max
            'status' => 'nullable|in:draft,active,completed,rejected',
        ]);

        // Only allow changing slug if campaign is in draft status
        if ($campaign->status === 'draft') {
            $validatedData['slug'] = Str::slug($request->title) . '-' . Str::random(6);
        }

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($campaign->cover_image && Storage::disk('public')->exists($campaign->cover_image)) {
                Storage::disk('public')->delete($campaign->cover_image);
            }

            // Pastikan direktori ada
            $storagePath = public_path('storage/campaigns');
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0775, true);
            }

            // Simpan file dengan nama unik
            $imageName = time() . '_' . $request->file('cover_image')->getClientOriginalName();
            $request->file('cover_image')->storeAs('campaigns', $imageName, 'public');
            $validatedData['cover_image'] = 'campaigns/' . $imageName;
        }

        $campaign->update($validatedData);

        return redirect()->route('dashboard.campaigns.show', $campaign->slug)
            ->with('success', 'Campaign updated successfully!');
    }

    /**
     * Remove the specified campaign from storage.
     */
    public function destroy($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // Check if user is authorized to delete
        $this->authorize('delete', $campaign);

        // Delete cover image if exists
        if ($campaign->cover_image && Storage::disk('public')->exists($campaign->cover_image)) {
            Storage::disk('public')->delete($campaign->cover_image);
        }

        $campaign->delete();

        return redirect()->route('dashboard.campaigns.index')
            ->with('success', 'Campaign deleted successfully!');
    }

    /**
     * Display user's campaigns.
     */
    public function myCampaigns()
    {
        $campaigns = Campaign::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->paginate(10);

        $categories = Category::all(); // For filter dropdown

        return view('dashboard.campaign.my-campaigns', compact('campaigns', 'categories'));
    }

    /**
     * Change campaign status.
     */
    public function changeStatus(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // Check if user is authorized to update
        $this->authorize('update', $campaign);

        $validatedData = $request->validate([
            'status' => 'required|in:draft,active,completed,rejected',
        ]);

        $campaign->update(['status' => $validatedData['status']]);

        return redirect()->back()
            ->with('success', 'Campaign status updated successfully!');
    }

    /**
     * Verify a campaign.
     */
    public function verify(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // Only admin can verify campaigns
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'verification_status' => 'required|in:pending,verified,rejected',
            'rejection_reason' => 'nullable|required_if:verification_status,rejected|string',
        ]);

        $campaign->update([
            'verification_status' => $validatedData['verification_status'],
            'rejection_reason' => $validatedData['rejection_reason'] ?? null,
        ]);

        return redirect()->back()
            ->with('success', 'Campaign verification status updated successfully!');
    }

    /**
     * Toggle featured status of a campaign.
     */
    public function toggleFeatured($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // Only admin can feature campaigns
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $campaign->update(['featured' => !$campaign->featured]);

        $message = $campaign->featured ? 'Campaign featured successfully!' : 'Campaign unfeatured successfully!';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Increment view count for a campaign.
     */
    public function incrementViewCount($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        $campaign->increment('view_count');

        return response()->json(['success' => true]);
    }

    /**
     * Increment share count for a campaign.
     */
    public function incrementShareCount($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        $campaign->increment('share_count');

        return response()->json(['success' => true]);
    }
}
