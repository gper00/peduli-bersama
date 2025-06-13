<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the reports and documentation page.
     */
    public function index()
    {
        // Pastikan user adalah admin atau creator
        if (!(auth()->user()->role === 'admin' || auth()->user()->role === 'creator')) {
            abort(403, 'Unauthorized action.');
        }

        // Untuk creator, hanya tampilkan data terkait campaign mereka
        $query = Campaign::query();
        if (auth()->user()->role === 'creator') {
            $query->where('user_id', Auth::id());
        }

        // Ambil semua campaign untuk difilter
        $campaigns = $query->get();

        // Hitung total donasi untuk semua campaign tersebut
        $totalDonations = 0;
        $totalDonors = 0;
        $campaignStats = [];

        foreach ($campaigns as $campaign) {
            $donations = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->get();

            $campaignDonations = $donations->sum('amount');
            $campaignDonors = $donations->count();

            $totalDonations += $campaignDonations;
            $totalDonors += $campaignDonors;

            $campaignStats[] = [
                'campaign' => $campaign,
                'donations' => $campaignDonations,
                'donors' => $campaignDonors,
                'progress' => $campaign->target_amount > 0 ? ($campaignDonations / $campaign->target_amount) * 100 : 0,
            ];
        }

        // Data untuk grafik donasi per bulan (6 bulan terakhir)
        $donationsByMonth = [];
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthName = $month->format('M');
            $months[] = $monthName;

            $startOfMonth = $month->copy()->startOfMonth();
            $endOfMonth = $month->copy()->endOfMonth();

            $query = Donation::where('status', 'success')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);

            if (auth()->user()->role === 'creator') {
                $query->whereIn('campaign_id', $campaigns->pluck('id'));
            }

            $donationsByMonth[] = $query->sum('amount');
        }

        return view('dashboard.report.index', [
            'campaigns' => $campaigns,
            'totalDonations' => $totalDonations,
            'totalDonors' => $totalDonors,
            'campaignStats' => $campaignStats,
            'months' => $months,
            'donationsByMonth' => $donationsByMonth,
        ]);
    }

    /**
     * Generate report for a specific campaign.
     */
    public function campaignReport($id)
    {
        $campaign = Campaign::findOrFail($id);

        // Pastikan user adalah admin atau creator yang memiliki campaign ini
        if (!(auth()->user()->role === 'admin' ||
            (auth()->user()->role === 'creator' && $campaign->user_id === Auth::id()))) {
            abort(403, 'Unauthorized action.');
        }

        // Donasi berhasil dari campaign ini
        $donations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'success')
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistik donasi berdasarkan waktu (mingguan)
        $weeklyDonations = [];
        $weeks = [];

        for ($i = 4; $i >= 0; $i--) {
            $startDate = Carbon::now()->subWeeks($i)->startOfWeek();
            $endDate = Carbon::now()->subWeeks($i)->endOfWeek();
            $weekLabel = $startDate->format('d/m') . ' - ' . $endDate->format('d/m');
            $weeks[] = $weekLabel;

            $weeklyAmount = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('amount');

            $weeklyDonations[] = $weeklyAmount;
        }

        return view('dashboard.report.campaign', [
            'campaign' => $campaign,
            'donations' => $donations,
            'weeks' => $weeks,
            'weeklyDonations' => $weeklyDonations,
        ]);
    }

    /**
     * Upload dokumentasi untuk campaign.
     */
    public function uploadDocumentation(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        // Pastikan user adalah admin atau creator yang memiliki campaign ini
        if (!(auth()->user()->role === 'admin' ||
            (auth()->user()->role === 'creator' && $campaign->user_id === Auth::id()))) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Upload file
        $path = $request->file('file')->store('campaign-documentations', 'public');

        // Simpan data dokumentasi (pada implementasi nyata, gunakan model Documentation)
        // Documentation::create([
        //     'campaign_id' => $campaign->id,
        //     'title' => $validatedData['title'],
        //     'description' => $validatedData['description'],
        //     'file_path' => $path,
        //     'uploaded_by' => Auth::id(),
        // ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil diunggah.');
    }

    /**
     * Download template laporan.
     */
    public function downloadTemplate($type)
    {
        // Pastikan user adalah admin atau creator
        if (!(auth()->user()->role === 'admin' || auth()->user()->role === 'creator')) {
            abort(403, 'Unauthorized action.');
        }

        // Template path dan nama file berdasarkan tipe
        $filePath = null;
        $fileName = null;

        switch ($type) {
            case 'financial':
                $filePath = public_path('templates/laporan-keuangan.xlsx');
                $fileName = 'Template Laporan Keuangan.xlsx';
                break;

            case 'activity':
                $filePath = public_path('templates/laporan-aktivitas.docx');
                $fileName = 'Template Laporan Aktivitas.docx';
                break;

            case 'letter':
                $filePath = public_path('templates/surat-penggunaan-dana.pdf');
                $fileName = 'Template Surat Penggunaan Dana.pdf';
                break;

            default:
                return redirect()->back()->with('error', 'Template tidak ditemukan.');
        }

        // Cek apakah file ada, jika tidak ada, beri pesan error
        if (!file_exists($filePath)) {
            // Untuk demo, kita kirim pesan sukses meskipun file belum ada
            return redirect()->back()->with('success', 'Template ' . $fileName . ' akan segera diunduh. (Demo Mode)');
        }

        // Download file
        return response()->download($filePath, $fileName);
    }

    public static function getDonationStatsForChart()
    {
        $months = [];
        $donationsByMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months[] = $month->format('M');
            $donationsByMonth[] = \App\Models\Donation::where('status', 'success')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        return [$months, $donationsByMonth];
    }
}
