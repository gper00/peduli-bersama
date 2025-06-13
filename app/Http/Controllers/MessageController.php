<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the message
        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;

        // Associate with user if logged in
        if (Auth::check()) {
            $message->user_id = Auth::id();
        }

        $message->save();

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih atas masukan Anda!');
    }

    /**
     * Display a listing of the messages.
     * Only accessible by admin.
     */
    public function index(Request $request)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // For notification dropdown, limit to 5 unread messages
        if ($request->has('limit') && $request->format === 'json') {
            $limit = $request->limit ?? 5;
            $messages = Message::unread()->newest()->take($limit)->get();

            $formattedMessages = $messages->map(function($message) {
                return [
                    'id' => $message->id,
                    'name' => $message->name,
                    'email' => $message->email,
                    'subject' => $message->subject,
                    'is_read' => $message->is_read,
                    'time_ago' => $message->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'messages' => $formattedMessages,
                'unread_count' => Message::unread()->count()
            ]);
        }

        // For normal page view
        $messages = Message::newest()->get();
        $unreadCount = Message::unread()->count();

        return view('dashboard.message.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified message.
     * Only accessible by admin.
     */
    public function show(Message $message)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Mark as read if not already
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return view('dashboard.message.show', compact('message'));
    }

    /**
     * Mark message as read/unread.
     * Only accessible by admin.
     */
    public function toggleRead(Message $message)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $message->is_read = !$message->is_read;
        $message->save();

        return redirect()->back()->with('success', 'Status pesan berhasil diperbarui');
    }

    /**
     * Get unread messages count for notification badge.
     */
    public function getUnreadCount()
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return response()->json(['count' => 0]);
        }

        $count = Message::unread()->count();
        return response()->json(['count' => $count]);
    }
}
