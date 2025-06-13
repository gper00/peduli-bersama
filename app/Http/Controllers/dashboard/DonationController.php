<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DonationController extends Controller
{
    /**
     * Display a listing of the donations.
     */
    public function index(Request $request)
    {
        // Admin dapat melihat semua donasi, donatur hanya bisa melihat donasi mereka
        $query = Donation::with(['campaign', 'user']);

        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        // Filter berdasarkan status
        if ($request->filled('status') && in_array($request->status, ['pending', 'processing', 'success', 'failed', 'expired', 'refunded'])) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan campaign
        if ($request->filled('campaign_id')) {
            $query->where('campaign_id', $request->campaign_id);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        // Filter berdasarkan rentang nominal
        if ($request->filled('amount_min') && $request->filled('amount_max')) {
            $query->whereBetween('amount', [$request->amount_min, $request->amount_max]);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $donations = $query->latest()->get();

        // Untuk dropdown filter
        $campaigns = Campaign::active()->get(['id', 'title']);

        return view('dashboard.donation.index', compact('donations', 'campaigns'));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create(Request $request)
    {
        // Untuk donasi dari halaman dashboard
        if ($request->has('campaign_id')) {
            $campaign = Campaign::findOrFail($request->campaign_id);
            return view('dashboard.donation.create', compact('campaign'));
        }

        // Jika tidak ada campaign_id, tampilkan list campaign untuk dipilih
        $campaigns = Campaign::active()->get();
        return view('dashboard.donation.select-campaign', compact('campaigns'));
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|integer|min:1000',
            'payment_method' => 'required|string',
            'anonymous' => 'nullable|boolean',
            'message' => 'nullable|string|max:500',
            'donor_name' => 'nullable|required_if:anonymous,1|string|max:100',
            'donor_email' => 'nullable|required_if:anonymous,1|email|max:100',
            'donor_phone' => 'nullable|string|max:20',
        ]);

        // Cek apakah campaign masih aktif
        $campaign = Campaign::findOrFail($validatedData['campaign_id']);
        if (!$campaign->is_active || !$campaign->can_donate) {
            return back()->with('error', 'Campaign tidak aktif atau target donasi sudah terpenuhi.');
        }

        // Generate invoice number
        $invoiceNumber = 'DON-' . time() . '-' . Str::random(6);

        // Set user_id jika user login dan tidak anonymous
        $userId = null;
        if (Auth::check() && !($validatedData['anonymous'] ?? false)) {
            $userId = Auth::id();

            // Jika user login, tambahkan nama dan email user jika tidak diisi
            if (empty($validatedData['donor_name'])) {
                $validatedData['donor_name'] = Auth::user()->name;
            }

            if (empty($validatedData['donor_email'])) {
                $validatedData['donor_email'] = Auth::user()->email;
            }
        }

        $donationData = [
            'invoice_number' => $invoiceNumber,
            'campaign_id' => $validatedData['campaign_id'],
            'user_id' => $userId,
            'amount' => $validatedData['amount'],
            'status' => 'pending',
            'payment_method' => $validatedData['payment_method'],
            'anonymous' => $validatedData['anonymous'] ?? false,
            'donor_name' => $validatedData['donor_name'] ?? null,
            'donor_email' => $validatedData['donor_email'] ?? null,
            'donor_phone' => $validatedData['donor_phone'] ?? null,
            'message' => $validatedData['message'] ?? null,
        ];

        // Simulasi pembayaran (pada aplikasi nyata gunakan payment gateway)
        // Contoh menggunakan kode pembayaran sederhana
        $donationData['payment_code'] = strtoupper(Str::random(8));
        $donationData['payment_url'] = route('donation.pay', ['invoice' => $invoiceNumber]);

        $donation = Donation::create($donationData);

        return redirect()->route('dashboard.donations.show', $donation->id)
            ->with('success', 'Donasi berhasil dibuat. Silakan lakukan pembayaran.');
    }

    /**
     * Display the specified donation.
     */
    public function show($id)
    {
        $donation = Donation::with(['campaign', 'user'])->findOrFail($id);

        // Cek apakah user berhak melihat donasi ini
        if (!auth()->user()->isAdmin() && $donation->user_id != Auth::id()) {
            abort(403, 'Anda tidak berhak melihat donasi ini.');
        }

        return view('dashboard.donation.show', compact('donation'));
    }

    /**
     * Process payment for a donation.
     */
    public function processPayment(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        // Cek apakah donasi masih pending atau expired
        if (!in_array($donation->status, ['pending', 'expired'])) {
            return back()->with('error', 'Donasi ini tidak dapat diproses lagi.');
        }

        // Simulasi proses pembayaran
        // Pada implementasi nyata, ini akan terhubung ke payment gateway
        $donation->update([
            'status' => 'processing',
            'payment_date' => now(),
        ]);

        // Setelah proses verifikasi, update status menjadi success
        // Ini simulasi proses callback dari payment gateway
        $this->simulatePaymentSuccess($donation);

        return redirect()->route('dashboard.donations.show', $donation->id)
            ->with('success', 'Pembayaran donasi sedang diproses.');
    }

    /**
     * Simulasi pembayaran berhasil.
     * Pada implementasi nyata, ini akan dipanggil oleh callback payment gateway.
     */
    private function simulatePaymentSuccess($donation)
    {
        // Simulasi delay proses pembayaran
        // Pada implementasi nyata, fungsi ini akan dipanggil oleh callback payment gateway
        $donation->update([
            'status' => 'success',
            'transaction_id' => 'TRX-' . time() . '-' . Str::random(6),
            'payment_date' => now(),
        ]);

        // Update jumlah donasi pada campaign
        $campaign = $donation->campaign;
        $campaign->increment('current_amount', $donation->amount);

        // Update jumlah donor pada campaign jika donor belum pernah donasi
        $campaignDonorCount = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'success')
            ->distinct('user_id')
            ->count('user_id');

        $campaign->update(['donor_count' => $campaignDonorCount]);
    }

    /**
     * Update donation status manually (admin only).
     */
    public function updateStatus(Request $request, $id)
    {
        // Only admin can manually update donation status
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $donation = Donation::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|in:pending,processing,success,failed,expired,refunded',
        ]);

        $oldStatus = $donation->status;
        $newStatus = $validatedData['status'];

        $donation->update(['status' => $newStatus]);

        // Jika status berubah menjadi success, update campaign amount
        if ($oldStatus != 'success' && $newStatus == 'success') {
            $campaign = $donation->campaign;
            $campaign->increment('current_amount', $donation->amount);

            // Update jumlah donor pada campaign
            $campaignDonorCount = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->distinct('user_id')
                ->count('user_id');

            $campaign->update(['donor_count' => $campaignDonorCount]);
        }

        // Jika status berubah dari success, kurangi campaign amount
        if ($oldStatus == 'success' && $newStatus != 'success') {
            $campaign = $donation->campaign;
            $campaign->decrement('current_amount', $donation->amount);

            // Update jumlah donor pada campaign
            $campaignDonorCount = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->distinct('user_id')
                ->count('user_id');

            $campaign->update(['donor_count' => $campaignDonorCount]);
        }

        return redirect()->back()->with('success', 'Status donasi berhasil diperbarui.');
    }

    /**
     * Display list of user's donations.
     */
    public function myDonations(Request $request)
    {
        $query = Donation::with(['campaign'])
            ->where('user_id', Auth::id());

        // Filter berdasarkan status
        if ($request->filled('status') && in_array($request->status, ['pending', 'processing', 'success', 'failed', 'expired', 'refunded'])) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $donations = $query->latest()->get();

        // Statistik untuk halaman riwayat donasi
        $successfulDonations = Donation::where('user_id', Auth::id())
            ->where('status', 'success')
            ->count();

        $pendingDonations = Donation::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        $totalDonated = Donation::where('user_id', Auth::id())
            ->where('status', 'success')
            ->sum('amount');

        return view('dashboard.donation.my-donations', compact('donations', 'successfulDonations', 'pendingDonations', 'totalDonated'));
    }

    /**
     * Generate donation receipt/invoice PDF.
     */
    public function generateReceipt($id)
    {
        $donation = Donation::with(['campaign', 'user'])->findOrFail($id);

        // Cek apakah user berhak melihat donasi ini
        if (!auth()->user()->isAdmin() && $donation->user_id != Auth::id()) {
            abort(403, 'Anda tidak berhak melihat donasi ini.');
        }

        // Hanya donasi sukses yang bisa dicetak receipt-nya
        if ($donation->status != 'success') {
            return back()->with('error', 'Hanya donasi yang sukses yang dapat dicetak invoice-nya.');
        }

        // Pada implementasi nyata, gunakan package seperti dompdf untuk generate PDF
        // Untuk saat ini, kita akan menampilkan view HTML saja
        return view('dashboard.donation.receipt', compact('donation'));
    }
}
