<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixCampaignAndDonationData extends Command
{
    protected $signature = 'campaigns:fix-data';
    protected $description = 'Fix campaign and donation data integration';

    public function handle()
    {
        $this->info('Starting campaign and donation data fix...');

        // 1. Actualizar datos de donaciones en campañas
        $this->info('Updating donation data in campaigns...');
        $campaigns = Campaign::all();
        
        foreach ($campaigns as $campaign) {
            // Calcular donaciones exitosas
            $totalDonations = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->sum('amount');
                
            // Contar donadores
            $donorCount = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->count();
                
            // Actualizar campaña
            $campaign->update([
                'current_amount' => $totalDonations,
                'donor_count' => $donorCount
            ]);
            
            $this->line("Campaign #{$campaign->id} - {$campaign->title}: Updated with {$donorCount} donors and Rp " . number_format($totalDonations));
        }

        // 2. Asegurar que todas las campañas creadas por admin tengan verification_status = verified
        $this->info('Ensuring admin campaigns are verified...');
        $adminCampaigns = Campaign::whereHas('user', function($query) {
            $query->where('role', 'admin');
        })->update(['verification_status' => 'verified']);
        
        $this->info("{$adminCampaigns} admin campaigns updated to verified status");

        // 3. Verificar consistencia de datos
        $this->info('Checking data consistency...');
        $inconsistentCampaigns = DB::table('campaigns as c')
            ->join('donations as d', 'c.id', '=', 'd.campaign_id')
            ->select('c.id', 'c.title', 
                     DB::raw('SUM(CASE WHEN d.status = "success" THEN d.amount ELSE 0 END) as total_donations'),
                     DB::raw('c.current_amount as recorded_amount'))
            ->groupBy('c.id', 'c.title', 'c.current_amount')
            ->havingRaw('total_donations != recorded_amount')
            ->get();
            
        if ($inconsistentCampaigns->count() > 0) {
            $this->warn('Found inconsistent campaign donation data:');
            foreach ($inconsistentCampaigns as $campaign) {
                $this->warn("Campaign #{$campaign->id} - {$campaign->title}: Recorded amount: {$campaign->recorded_amount}, Actual donations: {$campaign->total_donations}");
                
                // Auto-fix
                Campaign::where('id', $campaign->id)->update(['current_amount' => $campaign->total_donations]);
            }
        } else {
            $this->info('All campaign donation data is consistent');
        }

        $this->info('Campaign and donation data fix completed successfully!');
    }
}
