<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Campaign $campaign)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment();
        $comment->campaign_id = $campaign->id;
        $comment->user_id = Auth::id();
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        
        // Admin comments are automatically published, others may require moderation
        if (Auth::user()->role === 'admin') {
            $comment->status = 'published';
        } else {
            // Check if moderation is required (can be configured in settings)
            $requireModeration = false; // Default value, could be from settings
            $comment->status = $requireModeration ? 'pending' : 'published';
        }
        
        $comment->save();

        return redirect()->back()->with('success', 'Komentar Anda telah berhasil ditambahkan.');
    }

    /**
     * Display a listing of the comments for dashboard management.
     * Only accessible by admin.
     */
    public function index(Request $request)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $query = Comment::with(['user', 'campaign'])
            ->orderBy('created_at', 'desc');
            
        // Filter by status if provided
        if ($request->has('status') && in_array($request->status, ['published', 'pending', 'spam', 'deleted'])) {
            $query->where('status', $request->status);
        }
        
        // Filter by campaign if provided
        if ($request->has('campaign_id')) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        $comments = $query->paginate(15);
        
        // Count comments by status for dashboard overview
        $counts = [
            'all' => Comment::count(),
            'published' => Comment::published()->count(),
            'pending' => Comment::pending()->count(),
            'spam' => Comment::where('status', 'spam')->count(),
            'deleted' => Comment::where('status', 'deleted')->count(),
        ];
        
        return view('dashboard.comment.index', compact('comments', 'counts'));
    }

    /**
     * Update the specified comment status (moderate).
     * Only accessible by admin.
     */
    public function updateStatus(Request $request, Comment $comment)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:published,pending,spam,deleted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $comment->status = $request->status;
        $comment->moderated_at = now();
        $comment->moderated_by = Auth::id();
        $comment->save();
        
        return redirect()->back()->with('success', 'Status komentar telah berhasil diperbarui.');
    }

    /**
     * Pin/unpin the specified comment.
     * Only accessible by admin.
     */
    public function togglePin(Comment $comment)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $comment->is_pinned = !$comment->is_pinned;
        $comment->save();
        
        $message = $comment->is_pinned ? 'Komentar berhasil dipin.' : 'Komentar berhasil diunpin.';
        
        return redirect()->back()->with('success', $message);
    }

    /**
     * Delete the specified comment.
     * Only accessible by admin or the comment owner.
     */
    public function destroy(Comment $comment)
    {
        // Check if user is authorized (admin or comment owner)
        if (Auth::user()->role !== 'admin' && Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        // For admin, permanently delete the comment
        if (Auth::user()->role === 'admin') {
            $comment->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
        }
        
        // For regular users, mark as deleted
        $comment->status = 'deleted';
        $comment->save();
        
        return redirect()->back()->with('success', 'Komentar Anda telah berhasil dihapus.');
    }
}
