<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Console\Command;

class UpdateCampaignDonationData extends Command
{
    protected $signature = 'campaigns:update-donation-data';
    protected $description = 'Update all campaigns with correct donation amounts and donor counts';

    public function handle()
    {
        $campaigns = Campaign::all();
        $this->info('Updating donation data for ' . $campaigns->count() . ' campaigns...');

        $progressBar = $this->output->createProgressBar($campaigns->count());
        $progressBar->start();

        foreach ($campaigns as $campaign) {
            // Calculate total donations
            $totalDonations = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->sum('amount');
                
            // Count total donors
            $donorCount = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->count();
                
            // Update campaign
            $campaign->update([
                'current_amount' => $totalDonations,
                'donor_count' => $donorCount
            ]);

            $this->line("\nUpdated Campaign #{$campaign->id} - {$campaign->title}");
            $this->line("  - Total donations: Rp" . number_format($totalDonations, 0, ',', '.'));
            $this->line("  - Total donors: {$donorCount}");

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->info("\nAll campaigns have been updated with correct donation data!");
    }
}
