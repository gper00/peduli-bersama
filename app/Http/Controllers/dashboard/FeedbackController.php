<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedbacks.
     */
    public function index(Request $request)
    {
        // Pastikan user adalah admin atau creator
        if (!(auth()->user()->role === 'admin' || auth()->user()->role === 'creator')) {
            abort(403, 'Unauthorized action.');
        }
        
        // Filter berdasarkan status
        $status = $request->input('status');
        $query = Feedback::query();
        
        if ($status) {
            $query->where('status', $status);
        }
        
        // Untuk creator, hanya tampilkan feedback yang terkait dengan mereka
        if (auth()->user()->role === 'creator') {
            $query->where(function($q) {
                $q->where('user_id', Auth::id())
                  ->orWhereHas('user', function($query) {
                      $query->where('created_by', Auth::id());
                  });
            });
        }
        
        // Urut berdasarkan tanggal terbaru
        $query->orderBy('created_at', 'desc');
        
        $feedbacks = $query->paginate(10);
        
        // Hitung jumlah feedback berdasarkan status
        $counts = [
            'all' => Feedback::count(),
            'unread' => Feedback::where('status', 'unread')->count(),
            'in_progress' => Feedback::where('status', 'in_progress')->count(),
            'responded' => Feedback::where('status', 'responded')->count(),
            'closed' => Feedback::where('status', 'closed')->count(),
        ];
        
        // Jika role creator, filter counts
        if (auth()->user()->role === 'creator') {
            $creatorQuery = function($q) {
                $q->where('user_id', Auth::id())
                  ->orWhereHas('user', function($query) {
                      $query->where('created_by', Auth::id());
                  });
            };
            
            $counts = [
                'all' => Feedback::where($creatorQuery)->count(),
                'unread' => Feedback::where('status', 'unread')->where($creatorQuery)->count(),
                'in_progress' => Feedback::where('status', 'in_progress')->where($creatorQuery)->count(),
                'responded' => Feedback::where('status', 'responded')->where($creatorQuery)->count(),
                'closed' => Feedback::where('status', 'closed')->where($creatorQuery)->count(),
            ];
        }
        
        return view('dashboard.feedback.index', compact('feedbacks', 'counts', 'status'));
    }
    
    /**
     * Display the specified feedback.
     */
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        
        // Pastikan user adalah admin atau creator yang memiliki hak akses
        if (!(auth()->user()->role === 'admin' || 
            (auth()->user()->role === 'creator' && 
            ($feedback->user_id === Auth::id() || 
             $feedback->user->created_by === Auth::id())))) {
            abort(403, 'Unauthorized action.');
        }
        
        // Jika feedback masih unread, ubah statusnya
        if ($feedback->isUnread()) {
            $feedback->markAsInProgress();
        }
        
        return view('dashboard.feedback.show', compact('feedback'));
    }
    
    /**
     * Update the status of the specified feedback.
     */
    public function updateStatus(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        
        // Pastikan user adalah admin atau creator yang memiliki hak akses
        if (!(auth()->user()->role === 'admin' || 
            (auth()->user()->role === 'creator' && 
            ($feedback->user_id === Auth::id() || 
             $feedback->user->created_by === Auth::id())))) {
            abort(403, 'Unauthorized action.');
        }
        
        $validatedData = $request->validate([
            'status' => 'required|in:unread,in_progress,responded,closed',
        ]);
        
        $feedback->status = $validatedData['status'];
        
        if ($validatedData['status'] === 'responded' && !$feedback->responded_at) {
            $feedback->responded_by = Auth::id();
            $feedback->responded_at = now();
        }
        
        $feedback->save();
        
        return redirect()->back()->with('success', 'Status kritik & saran berhasil diperbarui.');
    }
    
    /**
     * Respond to the specified feedback.
     */
    public function respond(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        
        // Pastikan user adalah admin atau creator yang memiliki hak akses
        if (!(auth()->user()->role === 'admin' || 
            (auth()->user()->role === 'creator' && 
            ($feedback->user_id === Auth::id() || 
             $feedback->user->created_by === Auth::id())))) {
            abort(403, 'Unauthorized action.');
        }
        
        $validatedData = $request->validate([
            'admin_response' => 'required|string',
            'admin_notes' => 'nullable|string',
        ]);
        
        $feedback->admin_response = $validatedData['admin_response'];
        $feedback->admin_notes = $validatedData['admin_notes'];
        $feedback->status = 'responded';
        $feedback->responded_by = Auth::id();
        $feedback->responded_at = now();
        $feedback->save();
        
        return redirect()->route('dashboard.feedbacks.index')->with('success', 'Respon berhasil dikirim.');
    }
    
    /**
     * Add internal notes to the specified feedback.
     */
    public function addNotes(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        
        // Pastikan user adalah admin atau creator yang memiliki hak akses
        if (!(auth()->user()->role === 'admin' || 
            (auth()->user()->role === 'creator' && 
            ($feedback->user_id === Auth::id() || 
             $feedback->user->created_by === Auth::id())))) {
            abort(403, 'Unauthorized action.');
        }
        
        $validatedData = $request->validate([
            'admin_notes' => 'required|string',
        ]);
        
        $feedback->admin_notes = $validatedData['admin_notes'];
        $feedback->save();
        
        return redirect()->back()->with('success', 'Catatan internal berhasil ditambahkan.');
    }
}
