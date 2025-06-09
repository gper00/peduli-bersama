<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class DonationFeedbackController extends Controller
{
    /**
     * Store a new feedback from a donation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $donationId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $donationId)
    {
        // Validasi input
        $request->validate([
            'feedback_subject' => 'required|string|max:255',
            'feedback_message' => 'required|string',
            'feedback_private' => 'sometimes|boolean',
        ]);

        // Ambil data donasi
        $donation = Donation::findOrFail($donationId);

        // Buat feedback baru
        $feedback = new Feedback();
        $feedback->user_id = Auth::check() ? Auth::id() : null;
        $feedback->campaign_id = $donation->campaign_id;
        $feedback->donation_id = $donation->id;
        $feedback->name = $donation->donor_name;
        $feedback->email = $donation->donor_email;
        $feedback->subject = $request->feedback_subject;
        $feedback->message = $request->feedback_message;
        $feedback->type = 'donor_feedback';
        $feedback->priority = 'medium';
        $feedback->status = 'unread';
        $feedback->is_private = $request->has('feedback_private');
        
        $feedback->save();
        
        // Buat notifikasi untuk admin dan pemilik campaign
        NotificationService::createFeedbackNotification($feedback);

        return redirect()->route('donation.payment.success', $donation->invoice)
            ->with('success', 'Terima kasih atas feedback Anda!');
    }

    /**
     * Tampilkan form feedback untuk donasi tertentu.
     *
     * @param  string  $invoice
     * @return \Illuminate\Http\Response
     */
    public function showForm($invoice)
    {
        // Ambil data donasi berdasarkan nomor invoice
        $donation = Donation::where('invoice', $invoice)->firstOrFail();
        $campaign = Campaign::findOrFail($donation->campaign_id);

        return view('donation.feedback', [
            'donation' => $donation,
            'campaign' => $campaign,
        ]);
    }
}
