<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of withdrawals.
     */
    public function index()
    {
        // Pastikan user adalah admin atau creator
        if (!(auth()->user()->role === 'admin' || auth()->user()->role === 'creator')) {
            abort(403, 'Unauthorized action.');
        }

        // Untuk creator, hanya tampilkan withdrawal mereka
        $query = Withdrawal::query();
        if (auth()->user()->role === 'creator') {
            $campaignIds = Campaign::where('user_id', Auth::id())->pluck('id')->toArray();
            $query->whereIn('campaign_id', $campaignIds);
        }
        
        $withdrawals = $query->with(['campaign.user'])->latest()->paginate(10);
        
        // Hitung total dana tersedia untuk penarikan
        if (auth()->user()->role === 'creator') {
            $campaignIds = Campaign::where('user_id', Auth::id())->pluck('id')->toArray();
            $successfulDonations = Donation::whereIn('campaign_id', $campaignIds)
                ->where('status', 'success')
                ->sum('amount');
                
            $totalWithdrawals = Withdrawal::whereIn('campaign_id', $campaignIds)
                ->where('status', '!=', 'rejected')
                ->sum('amount');
                
            $availableFunds = $successfulDonations - $totalWithdrawals;
        } else {
            // Admin bisa melihat semua data
            $successfulDonations = Donation::where('status', 'success')->sum('amount');
            $totalWithdrawals = Withdrawal::where('status', '!=', 'rejected')->sum('amount');
            $availableFunds = $successfulDonations - $totalWithdrawals;
        }
        
        return view('dashboard.withdrawal.index', [
            'withdrawals' => $withdrawals,
            'availableFunds' => $availableFunds,
        ]);
    }

    /**
     * Show the form for creating a new withdrawal.
     */
    public function create()
    {
        // Pastikan user adalah admin atau creator
        if (!(auth()->user()->role === 'admin' || auth()->user()->role === 'creator')) {
            abort(403, 'Unauthorized action.');
        }
        
        // Ambil kampanye yang tersedia untuk penarikan
        if (auth()->user()->role === 'creator') {
            $campaigns = Campaign::where('user_id', Auth::id())->get();
        } else {
            $campaigns = Campaign::all();
        }
        
        // Untuk setiap campaign, hitung dana yang tersedia
        foreach ($campaigns as $campaign) {
            $successfulDonations = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->sum('amount');
                
            $totalWithdrawals = Withdrawal::where('campaign_id', $campaign->id)
                ->where('status', '!=', 'rejected')
                ->sum('amount');
                
            $campaign->available_funds = $successfulDonations - $totalWithdrawals;
        }
        
        // Filter hanya campaign dengan dana tersedia
        $campaigns = $campaigns->filter(function($campaign) {
            return $campaign->available_funds > 0;
        });
        
        return view('dashboard.withdrawal.create', [
            'campaigns' => $campaigns,
        ]);
    }

    /**
     * Store a newly created withdrawal in storage.
     */
    public function store(Request $request)
    {
        // Pastikan user adalah admin atau creator
        if (!(auth()->user()->role === 'admin' || auth()->user()->role === 'creator')) {
            abort(403, 'Unauthorized action.');
        }
        
        $validatedData = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|numeric|min:10000', // Minimal Rp 10.000
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:100',
            'note' => 'nullable|string|max:255',
        ]);
        
        // Periksa apakah campaign adalah milik user (jika user adalah creator)
        $campaign = Campaign::findOrFail($validatedData['campaign_id']);
        if (auth()->user()->role === 'creator' && $campaign->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Periksa dana tersedia
        $successfulDonations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'success')
            ->sum('amount');
            
        $totalWithdrawals = Withdrawal::where('campaign_id', $campaign->id)
            ->where('status', '!=', 'rejected')
            ->sum('amount');
            
        $availableFunds = $successfulDonations - $totalWithdrawals;
        
        if ($validatedData['amount'] > $availableFunds) {
            return redirect()->back()->with('error', 'Dana yang tersedia tidak mencukupi untuk penarikan ini.');
        }
        
        // Buat kode unik untuk withdrawal
        $withdrawalCode = 'WD-' . strtoupper(Str::random(8));
        
        // Buat withdrawal baru
        $withdrawal = Withdrawal::create([
            'user_id' => Auth::id(),
            'campaign_id' => $validatedData['campaign_id'],
            'amount' => $validatedData['amount'],
            'bank_name' => $validatedData['bank_name'],
            'account_number' => $validatedData['account_number'],
            'account_name' => $validatedData['account_name'],
            'note' => $validatedData['note'],
            'status' => auth()->user()->role === 'admin' ? 'approved' : 'pending',
            'withdrawal_code' => $withdrawalCode,
        ]);
        
        return redirect()->route('dashboard.withdrawals.index')
            ->with('success', 'Permintaan penarikan dana berhasil dibuat dengan kode ' . $withdrawalCode);
    }

    /**
     * Display the specified withdrawal.
     */
    public function show($id)
    {
        // Pastikan user adalah admin atau creator
        if (!(auth()->user()->role === 'admin' || auth()->user()->role === 'creator')) {
            abort(403, 'Unauthorized action.');
        }
        
        $withdrawal = Withdrawal::with(['campaign.user', 'user'])->findOrFail($id);
        
        // Pastikan creator hanya bisa melihat withdrawalnya sendiri
        if (auth()->user()->role === 'creator') {
            $campaignIds = Campaign::where('user_id', Auth::id())->pluck('id')->toArray();
            if (!in_array($withdrawal->campaign_id, $campaignIds)) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        return view('dashboard.withdrawal.show', [
            'withdrawal' => $withdrawal,
        ]);
    }

    /**
     * Update the status of the specified withdrawal.
     */
    public function updateStatus(Request $request, $id)
    {
        // Pastikan user adalah admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $withdrawal = Withdrawal::findOrFail($id);
        
        $validatedData = $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
            'admin_note' => 'nullable|string|max:255',
        ]);
        
        $withdrawal->status = $validatedData['status'];
        $withdrawal->admin_note = $validatedData['admin_note'];
        
        if ($validatedData['status'] === 'completed') {
            $withdrawal->completed_at = Carbon::now();
        }
        
        $withdrawal->save();
        
        return redirect()->route('dashboard.withdrawals.show', $withdrawal->id)
            ->with('success', 'Status penarikan dana berhasil diperbarui.');
    }
}
