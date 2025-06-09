<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\NotificationService;

class PublicController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        $featuredCampaigns = Campaign::with(['category', 'user'])
            ->where('featured', true)
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->where(function($q) {
                $q->where('end_date', '>', now())
                  ->orWhereNull('end_date');
            })
            ->whereRaw('current_amount < target_amount') // Hanya tampilkan campaign yang belum mencapai 100% target
            ->take(5)
            ->get();

        $categories = Category::active()->ordered()->get();

        $recentCampaigns = Campaign::with(['category', 'user'])
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->where(function($q) {
                $q->where('end_date', '>', now())
                  ->orWhereNull('end_date');
            })
            ->whereRaw('current_amount < target_amount') // Hanya tampilkan campaign yang belum mencapai 100% target
            ->latest()
            ->take(6)
            ->get();

        $urgentCampaigns = Campaign::with(['category', 'user'])
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->where(function($q) {
                $q->where('end_date', '>', now())
                  ->orWhereNull('end_date');
            })
            ->whereRaw('current_amount < target_amount') // Hanya tampilkan campaign yang belum mencapai 100% target
            ->where(function($q) {
                // Mengurutkan campaign mendesak berdasarkan progress dan deadline
                $q->where('end_date', '<=', now()->addDays(7))
                  ->orWhereRaw('(current_amount / target_amount) < 0.5');
            })
            ->orderByRaw('CASE WHEN end_date IS NOT NULL THEN 1 ELSE 2 END, end_date ASC')
            ->take(3)
            ->get();

        $recentCampaigns = Campaign::with(['category', 'user'])
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->latest()
            ->take(6)
            ->get();

        // Statistik untuk halaman beranda
        $totalCampaigns = Campaign::where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->count();

        $totalDonors = Donation::where('status', 'success')
            ->distinct('donor_email')
            ->count();

        $totalDonations = Donation::where('status', 'success')
            ->sum('amount');

        $successfulCampaigns = Campaign::where('status', 'completed')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->count();

        return view('home', [
            'homePage' => true,
            'featuredCampaigns' => $featuredCampaigns,
            'categories' => $categories,
            'urgentCampaigns' => $urgentCampaigns,
            'recentCampaigns' => $recentCampaigns,
            'totalCampaigns' => $totalCampaigns,
            'totalDonors' => $totalDonors,
            'totalDonations' => $totalDonations,
            'successfulCampaigns' => $successfulCampaigns,
        ]);
    }

    /**
     * Display all campaigns.
     */
    public function campaigns(Request $request)
    {
        // Query dasar untuk kampanye
        $query = Campaign::with(['category', 'user', 'donations'])
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            });

        // Kampanye yang belum berakhir atau tidak memiliki tanggal akhir
        // Filter tanggal hanya jika tidak memilih opsi "Tampilkan Semua"
        if (!$request->has('sort') || $request->sort !== 'all') {
            $query->where(function($q) {
                $q->where('end_date', '>', now())
                  ->orWhereNull('end_date');
            });
        }

        // Hanya tampilkan campaign yang belum mencapai 100% target
        $query->whereRaw('current_amount < target_amount');

        // Filter by category
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search by keyword
        if ($request->has('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('short_description', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        // Sort by
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'end_date':
                    $query->orderBy('end_date', 'asc');
                    break;
                case 'target_high':
                    $query->orderBy('target_amount', 'desc');
                    break;
                case 'target_low':
                    $query->orderBy('target_amount', 'asc');
                    break;
                case 'progress':
                    $query->orderByRaw('(current_amount / target_amount) DESC');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $campaigns = $query->paginate(9);
        $categories = Category::active()->ordered()->get();

        return view('campaigns', [
            'campaigns' => $campaigns,
            'categories' => $categories,
            'activeCategory' => $request->category ?? null,
            'searchQuery' => $request->q ?? null,
            'sortBy' => $request->sort ?? 'newest',
        ]);
    }

    /**
     * Display a single campaign.
     */
    public function campaignDetail($slug)
    {
        $campaign = Campaign::where('slug', $slug)
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->with(['category', 'user', 'comments' => function($query) {
                // $query->published()->with('user')->latest();
                $query->where('status', 'published')->with('user')->latest();
            }, 'updates' => function($query) {
                $query->published()->latest();
            }])
            ->firstOrFail();

        // Increment view count for this campaign
        $campaign->increment('view_count');

        // Get similar campaigns
        $similarCampaigns = Campaign::where('id', '!=', $campaign->id)
            ->where('category_id', $campaign->category_id)
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->where(function($q) {
                $q->where('end_date', '>', now())
                  ->orWhereNull('end_date');
            })
            ->take(3)
            ->get();

        // Get recent donations for this campaign
        $recentDonations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'success')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('campaign-detail', [
            'campaign' => $campaign,
            'similarCampaigns' => $similarCampaigns,
            'recentDonations' => $recentDonations,
        ]);
    }

    /**
     * Display donation form for a campaign.
     */
    public function donateForm($slug)
    {
        $campaign = Campaign::where('slug', $slug)
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->where(function($q) {
                $q->where('end_date', '>', now())
                  ->orWhereNull('end_date');
            })
            ->firstOrFail();

        // Check if campaign can still accept donations
        if (!$campaign->can_donate) {
            return redirect()->route('public.campaign', $campaign->slug)
                ->with('error', 'Campaign ini sudah mencapai target donasi.');
        }

        return view('donate', [
            'campaign' => $campaign,
        ]);
    }

    /**
     * Process donation from public page.
     */
    public function processDonation(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)
            ->where('status', 'active')
            ->where(function($q) {
                // Campaign harus terverifikasi ATAU dibuat oleh admin
                $q->where('verification_status', 'verified')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'admin');
                  });
            })
            ->where(function($q) {
                $q->where('end_date', '>', now())
                  ->orWhereNull('end_date');
            })
            ->firstOrFail();

        // Check if campaign can still accept donations
        if (!$campaign->can_donate) {
            return redirect()->route('public.campaign', $campaign->slug)
                ->with('error', 'Campaign ini sudah mencapai target donasi.');
        }

        $validatedData = $request->validate([
            'amount' => 'required|integer|min:10000',
            'payment_method' => 'required|string',
            'donor_name' => 'required|string|max:100',
            'donor_email' => 'required|email|max:100',
            'donor_phone' => 'nullable|string|max:20',
            'anonymous' => 'nullable|boolean',
            'message' => 'nullable|string|max:500',
        ]);

        // Generate invoice number
        $invoiceNumber = 'DON-' . time() . '-' . Str::random(6);

        // Set user_id if user is logged in and not anonymous
        $userId = null;
        if (Auth::check() && !($validatedData['anonymous'] ?? false)) {
            $userId = Auth::id();
        }

        $donationData = [
            'invoice_number' => $invoiceNumber,
            'campaign_id' => $campaign->id,
            'user_id' => $userId,
            'amount' => $validatedData['amount'],
            'status' => 'pending',
            'payment_method' => $validatedData['payment_method'],
            'anonymous' => $validatedData['anonymous'] ?? false,
            'donor_name' => $validatedData['donor_name'],
            'donor_email' => $validatedData['donor_email'],
            'donor_phone' => $validatedData['donor_phone'] ?? null,
            'message' => $validatedData['message'] ?? null,
        ];

        // Simulasi pembayaran (pada aplikasi nyata gunakan payment gateway)
        $donationData['payment_code'] = strtoupper(Str::random(8));
        $donationData['payment_url'] = route('donation.pay', ['invoice' => $invoiceNumber]);

        $donation = Donation::create($donationData);

        return redirect()->route('donation.pay', ['invoice' => $donation->invoice_number]);
    }

    /**
     * Display payment page for a donation.
     */
    public function paymentPage($invoice)
    {
        $donation = Donation::where('invoice_number', $invoice)
            ->with('campaign')
            ->firstOrFail();

        // Jika donasi sudah tidak pending, redirect ke halaman yang sesuai
        if ($donation->status == 'success') {
            return redirect()->route('public.paymentSuccess', ['invoice' => $invoice]);
        } elseif (in_array($donation->status, ['failed', 'expired'])) {
            return redirect()->route('public.paymentFailed', ['invoice' => $invoice]);
        }

        return view('payment-page', [
            'donation' => $donation,
        ]);
    }

    /**
     * Handle payment callback.
     * Pada implementasi nyata, ini akan dipanggil oleh payment gateway.
     */
    public function paymentCallback(Request $request)
    {
        // Validasi data callback dari payment gateway
        $validatedData = $request->validate([
            'invoice' => 'required|string|exists:donations,invoice_number',
            'status' => 'required|in:success,failed',
            'payment_id' => 'required|string',
        ]);

        $donation = Donation::where('invoice_number', $validatedData['invoice'])->firstOrFail();

        // Update status donasi berdasarkan callback
        if ($validatedData['status'] == 'success') {
            $donation->update([
                'status' => 'success',
                'transaction_id' => $validatedData['payment_id'],
                'payment_date' => now(),
            ]);

            // Update jumlah donasi pada campaign
            $campaign = $donation->campaign;

            // Recalculate total amount from all successful donations
            $totalDonations = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->sum('amount');

            // Count total donors with successful donations
            $donorCount = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->count();

            // Update campaign with correct amounts and donor count
            $campaign->update([
                'current_amount' => $totalDonations,
                'donor_count' => $donorCount
            ]);

            // Log success for debugging
            \Illuminate\Support\Facades\Log::info("Campaign {$campaign->id} updated with amount: {$totalDonations} and donors: {$donorCount}");

            // Buat notifikasi untuk admin dan pemilik campaign
            NotificationService::createDonationNotification($donation);
        } else {
            $donation->update([
                'status' => 'failed',
                'transaction_id' => $validatedData['payment_id'],
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display payment success page.
     */
    public function paymentSuccess($invoice)
    {
        $donation = Donation::where('invoice_number', $invoice)
            ->where('status', 'success')
            ->with('campaign')
            ->firstOrFail();

        return view('payment-success', [
            'donation' => $donation,
        ]);
    }

    /**
     * Display payment failed page.
     */
    public function paymentFailed($invoice)
    {
        $donation = Donation::where('invoice_number', $invoice)
            ->where('status', 'failed')
            ->with('campaign')
            ->firstOrFail();

        return view('payment-failed', [
            'donation' => $donation,
        ]);
    }

    /**
     * Display about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display contact page.
     */
    public function contact()
    {
        return view('contact');
    }
}
