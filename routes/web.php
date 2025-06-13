<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Controllers\dashboard\CampaignController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\DonationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Public routes
Route::get('/', [App\Http\Controllers\PublicController::class, 'index'])->name('home');
Route::get('/home', function() {return redirect('/');});
Route::get('/campaigns', [App\Http\Controllers\PublicController::class, 'campaigns'])->name('public.campaigns');
Route::get('/campaigns/{slug}', [App\Http\Controllers\PublicController::class, 'campaignDetail'])->name('public.campaign');
// Route::get('/categories/{slug}', [App\Http\Controllers\PublicController::class, 'campaignsByCategory'])->name('public.category');
Route::get('/about', [App\Http\Controllers\PublicController::class, 'about'])->name('public.about');
Route::get('/contact', [App\Http\Controllers\PublicController::class, 'contact'])->name('public.contact');

// Static pages
Route::get('/terms', [App\Http\Controllers\StaticPageController::class, 'terms'])->name('terms');
Route::get('/privacy', [App\Http\Controllers\StaticPageController::class, 'privacy'])->name('privacy');

// Messages routes
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// Comments routes
Route::post('/campaigns/{slug}/comments', [CommentController::class, 'store'])->name('comments.store');

// Public routes for donation process
Route::get('/donate/{slug}', [App\Http\Controllers\PublicController::class, 'donateForm'])->middleware('auth')->name('public.donate');
Route::post('/donate/{slug}', [App\Http\Controllers\PublicController::class, 'processDonation'])->name('public.processDonation');
Route::get('/payment/{invoice}', [App\Http\Controllers\PublicController::class, 'paymentPage'])->name('donation.pay');
Route::post('/payment/callback', [App\Http\Controllers\PublicController::class, 'paymentCallback'])->name('donation.callback');


// Payment success and failed pages
Route::get('/payment/success/{invoice}', [App\Http\Controllers\PublicController::class, 'paymentSuccess'])->name('public.paymentSuccess');
Route::get('/payment/failed/{invoice}', [App\Http\Controllers\PublicController::class, 'paymentFailed'])->name('public.paymentFailed');

// Donation feedback routes
Route::get('/donation/{invoice}/feedback', [App\Http\Controllers\DonationFeedbackController::class, 'showForm'])->name('donation.feedback');
Route::post('/donation/{donationId}/feedback', [App\Http\Controllers\DonationFeedbackController::class, 'store'])->name('donation.feedback.store');

// Authentication routes
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);

// Dashboard routes
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard home
    Route::get('/', function(){
        $months = $donationsByMonth = [];
        if (auth()->check() && auth()->user()->role === 'admin') {
            [$months, $donationsByMonth] = \App\Http\Controllers\dashboard\ReportController::getDonationStatsForChart();
        }
        return view('dashboard.index', compact('months', 'donationsByMonth'));
    })->name('index');

    // Campaign routes - restricted to admin and creator roles
    Route::middleware(['campaign-manager'])->group(function () {
        Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
        Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
        Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
        Route::get('/campaigns/{slug}', [CampaignController::class, 'show'])->name('campaigns.show');
        Route::get('/campaigns/{slug}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
        Route::put('/campaigns/{slug}', [CampaignController::class, 'update'])->name('campaigns.update');
        Route::delete('/campaigns/{slug}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
        Route::patch('/campaigns/{slug}/change-status', [CampaignController::class, 'changeStatus'])->name('campaigns.change-status');

        // API routes for campaign tracking
        Route::post('/campaigns/{slug}/view', [CampaignController::class, 'incrementViewCount'])->name('campaigns.view');
        Route::post('/campaigns/{slug}/share', [CampaignController::class, 'incrementShareCount'])->name('campaigns.share');
    });

    // User's own campaigns
    Route::get('/my-campaigns', [CampaignController::class, 'myCampaigns'])->name('campaigns.my');

    // Admin only campaign routes
    Route::middleware(['admin'])->group(function () {
        Route::patch('/campaigns/{slug}/verify', [CampaignController::class, 'verify'])->name('campaigns.verify');
        Route::patch('/campaigns/{slug}/featured', [CampaignController::class, 'toggleFeatured'])->name('campaigns.toggleFeatured');

        // Category management - admin only
        Route::resource('categories', CategoryController::class);
    });

    // Donation routes
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{id}', [DonationController::class, 'show'])->name('donations.show')->where('id', '[0-9]+');
    Route::get('/my-donations', [DonationController::class, 'myDonations'])->name('donations.my');
    Route::post('/donations/{id}/process-payment', [DonationController::class, 'processPayment'])->name('donations.processPayment');
    Route::get('/donations/{id}/receipt', [DonationController::class, 'generateReceipt'])->name('donations.receipt');

    // Admin only donation routes
    Route::middleware(['admin'])->group(function () {
        Route::patch('/donations/{id}/status', [DonationController::class, 'updateStatus'])->name('donations.updateStatus');

        // Messages management - admin only
        Route::resource('messages', MessageController::class, [
            'only' => ['index', 'show']
        ]);
        Route::post('/messages/{message}/toggle-read', [MessageController::class, 'toggleRead'])->name('messages.toggle-read');
        Route::get('/messages/unread-count', [MessageController::class, 'getUnreadCount'])->name('messages.unread-count');

        // Comments management - admin only
        Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
        Route::patch('/comments/{comment}/status', [CommentController::class, 'updateStatus'])->name('comments.update-status');
        Route::patch('/comments/{comment}/pin', [CommentController::class, 'togglePin'])->name('comments.toggle-pin');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    // Reports & Documentation routes - for admin and creator
    Route::get('/reports', [App\Http\Controllers\dashboard\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/campaign/{id}', [App\Http\Controllers\dashboard\ReportController::class, 'campaignReport'])->name('reports.campaign');
    Route::post('/reports/campaign/{id}/upload', [App\Http\Controllers\dashboard\ReportController::class, 'uploadDocumentation'])->name('reports.upload');
    Route::get('/reports/template/{type}', [App\Http\Controllers\dashboard\ReportController::class, 'downloadTemplate'])->name('reports.template');

    // Feedback routes - for admin and creator
    Route::get('/feedbacks', [App\Http\Controllers\dashboard\FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/{id}', [App\Http\Controllers\dashboard\FeedbackController::class, 'show'])->name('feedbacks.show');
    Route::patch('/feedbacks/{id}/status', [App\Http\Controllers\dashboard\FeedbackController::class, 'updateStatus'])->name('feedbacks.updateStatus');
    Route::post('/feedbacks/{id}/respond', [App\Http\Controllers\dashboard\FeedbackController::class, 'respond'])->name('feedbacks.respond');
    Route::post('/feedbacks/{id}/notes', [App\Http\Controllers\dashboard\FeedbackController::class, 'addNotes'])->name('feedbacks.addNotes');

    // Withdrawal routes - for admin and creator
    Route::get('/withdrawals', [App\Http\Controllers\dashboard\WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('/withdrawals/create', [App\Http\Controllers\dashboard\WithdrawalController::class, 'create'])->name('withdrawals.create');
    Route::post('/withdrawals', [App\Http\Controllers\dashboard\WithdrawalController::class, 'store'])->name('withdrawals.store');
    Route::get('/withdrawals/{id}', [App\Http\Controllers\dashboard\WithdrawalController::class, 'show'])->name('withdrawals.show');
    Route::patch('/withdrawals/{id}/status', [App\Http\Controllers\dashboard\WithdrawalController::class, 'updateStatus'])->name('withdrawals.updateStatus');

    // Notification routes
    Route::get('notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/unread-count', [\App\Http\Controllers\NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::get('notifications/latest', [\App\Http\Controllers\NotificationController::class, 'getLatest'])->name('notifications.latest');
    Route::post('notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');

    // Profile routes - accessible by all authenticated users for managing their own profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // User management routes - accessible only by admin
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

Route::get('/campaigns/{slug}/donors', [App\Http\Controllers\PublicController::class, 'campaignDonors'])->name('public.campaign.donors');
