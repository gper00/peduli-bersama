<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use App\Models\Feedback;

class NotificationService
{
    /**
     * Membuat notifikasi donasi baru untuk admin dan penggalang dana
     *
     * @param Donation $donation
     * @return void
     */
    public static function createDonationNotification(Donation $donation)
    {
        $campaign = Campaign::findOrFail($donation->campaign_id);
        $campaignOwner = User::findOrFail($campaign->user_id);
        
        // Buat notifikasi untuk penggalang dana
        Notification::create([
            'user_id' => $campaignOwner->id,
            'campaign_id' => $campaign->id,
            'donation_id' => $donation->id,
            'type' => 'donation',
            'title' => 'Donasi Baru',
            'message' => "Ada donasi baru sebesar Rp " . number_format($donation->amount, 0, ',', '.') . " untuk kampanye {$campaign->title}",
            'is_read' => false,
        ]);
        
        // Buat notifikasi untuk semua admin
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            // Jangan buat notifikasi duplikat jika admin adalah pemilik kampanye
            if ($admin->id !== $campaignOwner->id) {
                Notification::create([
                    'user_id' => $admin->id,
                    'campaign_id' => $campaign->id,
                    'donation_id' => $donation->id,
                    'type' => 'donation',
                    'title' => 'Donasi Baru',
                    'message' => "Ada donasi baru sebesar Rp " . number_format($donation->amount, 0, ',', '.') . " untuk kampanye {$campaign->title}",
                    'is_read' => false,
                ]);
            }
        }
    }
    
    /**
     * Membuat notifikasi feedback baru untuk admin dan penggalang dana
     *
     * @param Feedback $feedback
     * @return void
     */
    public static function createFeedbackNotification(Feedback $feedback)
    {
        $campaign = Campaign::findOrFail($feedback->campaign_id);
        $campaignOwner = User::findOrFail($campaign->user_id);
        
        // Buat notifikasi untuk penggalang dana
        Notification::create([
            'user_id' => $campaignOwner->id,
            'campaign_id' => $campaign->id,
            'donation_id' => $feedback->donation_id,
            'type' => 'feedback',
            'title' => 'Feedback Baru',
            'message' => "Ada feedback baru untuk kampanye {$campaign->title}",
            'is_read' => false,
        ]);
        
        // Buat notifikasi untuk semua admin
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            // Jangan buat notifikasi duplikat jika admin adalah pemilik kampanye
            if ($admin->id !== $campaignOwner->id) {
                Notification::create([
                    'user_id' => $admin->id,
                    'campaign_id' => $campaign->id,
                    'donation_id' => $feedback->donation_id,
                    'type' => 'feedback',
                    'title' => 'Feedback Baru',
                    'message' => "Ada feedback baru untuk kampanye {$campaign->title}",
                    'is_read' => false,
                ]);
            }
        }
    }
}
