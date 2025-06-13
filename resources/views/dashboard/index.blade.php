@extends('dashboard.layout')

@section('title', 'Dashboard | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    Dashboard
                </li>
            </ul>
        </div>

        <!-- Welcome Message -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1 pr-0">
                                <div class="avatar-lg">
                                    @if (auth()->user()->image)
                                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle">
                                    @else
                                        <img src="{{ asset('storage/default/user.jpg') }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-11">
                                <h4 class="card-title">Selamat datang, {{ auth()->user()->name }}!</h4>
                                <p class="card-category">
                                    @if(auth()->user()->role == 'admin')
                                        Anda login sebagai Administrator. Anda memiliki akses ke semua fitur pengelolaan situs.
                                    @elseif(auth()->user()->role == 'creator')
                                        Anda login sebagai Pengelola Kampanye. Anda dapat membuat dan mengelola kampanye donasi.
                                    @else
                                        Anda login sebagai Donatur. Terima kasih atas dukungan Anda untuk kampanye-kampanye kami.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->role == 'admin')
        <!-- Admin Dashboard Content -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Pengguna</p>
                                    <h4 class="card-title">{{ \App\Models\User::count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Kampanye</p>
                                    <h4 class="card-title">{{ \App\Models\Campaign::count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Donasi</p>
                                    <h4 class="card-title">{{ \App\Models\Donation::where('status', 'success')->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-warning card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Kritik & Saran</p>
                                    <h4 class="card-title">{{ \App\Models\Feedback::count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Kampanye Terbaru</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Pengelola</th>
                                        <th>Target</th>
                                        <th>Terkumpul</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Campaign::latest()->take(5)->get() as $campaign)
                                    <tr>
                                        <td>{{ Str::limit($campaign->title, 30) }}</td>
                                        <td>{{ $campaign->user->name }}</td>
                                        <td>Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</td>
                                        <td>
                                            @if($campaign->status == 'active')
                                            <span class="badge badge-success">Aktif</span>
                                            @elseif($campaign->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                            @else
                                            <span class="badge badge-secondary">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.campaigns.show', $campaign->slug) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">5 Donasi Terbaru</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Donatur</th>
                                        <th>Kampanye</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Donation::with('user', 'campaign')->where('status', 'success')->latest()->take(5)->get() as $donation)
                                    <tr>
                                        <td>{{ $donation->user ? $donation->user->name : ($donation->donor_name ?? 'Anonim') }}</td>
                                        <td>{{ $donation->campaign ? $donation->campaign->title : '-' }}</td>
                                        <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                        <td>{{ $donation->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Kritik & Saran Terbaru</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Subjek</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Feedback::latest()->take(5)->get() as $feedback)
                                    <tr>
                                        <td>{{ Str::limit($feedback->subject, 25) }}</td>
                                        <td>{{ Str::limit($feedback->message, 50) }}</td>
                                        <td>
                                            @if($feedback->status == 'unread')
                                            <span class="badge badge-warning">Belum Dibaca</span>
                                            @elseif($feedback->status == 'in_progress')
                                            <span class="badge badge-info">Sedang Diproses</span>
                                            @elseif($feedback->status == 'responded')
                                            <span class="badge badge-success">Telah Direspon</span>
                                            @else
                                            <span class="badge badge-secondary">Ditutup</span>
                                            @endif
                                        </td>
                                        <td>{{ $feedback->created_at->diffForHumans() }}</td>
                                        <td><a href="{{ route('dashboard.feedbacks.show', $feedback->id) }}" class="btn btn-sm btn-primary">Lihat</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Statistik Donasi 6 Bulan Terakhir</div>
                    </div>
                    <div class="card-body">
                        <canvas id="donationChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @elseif(auth()->user()->role == 'creator')
        <!-- Creator Dashboard Content -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Kampanye Saya</p>
                                    <h4 class="card-title">{{ \App\Models\Campaign::where('user_id', auth()->id())->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Donasi</p>
                                    <h4 class="card-title">{{ \App\Models\Donation::whereHas('campaign', function($q) { $q->where('user_id', auth()->id()); })->where('status', 'success')->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-warning card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Kritik & Saran</p>
                                    <h4 class="card-title">{{ \App\Models\Feedback::where('user_id', auth()->id())->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-money-check-alt"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Dana Terkumpul</p>
                                    <h4 class="card-title">
                                        Rp {{ number_format(\App\Models\Donation::whereHas('campaign', function($q) { $q->where('user_id', auth()->id()); })->where('status', 'success')->sum('amount'), 0, ',', '.') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Kampanye Saya</div>
                        <div class="card-category">Daftar kampanye yang Anda kelola</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Target</th>
                                        <th>Terkumpul</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Campaign::where('user_id', auth()->id())->latest()->take(5)->get() as $campaign)
                                    <tr>
                                        <td>{{ Str::limit($campaign->title, 30) }}</td>
                                        <td>Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $campaign->target_amount > 0 ? min(100, ($campaign->collected_amount / $campaign->target_amount) * 100) : 0 }}%" aria-valuenow="{{ $campaign->target_amount > 0 ? min(100, ($campaign->collected_amount / $campaign->target_amount) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small>{{ $campaign->target_amount > 0 ? number_format(min(100, ($campaign->collected_amount / $campaign->target_amount) * 100), 1) : 0 }}%</small>
                                        </td>
                                        <td>
                                            @if($campaign->status == 'active')
                                            <span class="badge badge-success">Aktif</span>
                                            @elseif($campaign->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                            @else
                                            <span class="badge badge-secondary">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('dashboard.campaigns.show', $campaign->slug) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('dashboard.reports.campaign', $campaign->id) }}" class="btn btn-success btn-sm"><i class="fa fa-chart-bar"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ route('dashboard.campaigns.index') }}" class="btn btn-primary">Lihat Semua Kampanye</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(auth()->user()->role == 'donor')
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-money-check-alt"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Donasi</p>
                                    <h4 class="card-title">Rp {{ number_format(\App\Models\Donation::where('user_id', auth()->id())->where('status', 'success')->sum('amount'), 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Donasi</p>
                                    <h4 class="card-title">{{ \App\Models\Donation::where('user_id', auth()->id())->where('status', 'success')->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-heart"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Kampanye Didukung</p>
                                    <h4 class="card-title">{{ \App\Models\Donation::where('user_id', auth()->id())->where('status', 'success')->distinct('campaign_id')->count('campaign_id') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Riwayat Donasi Saya</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Kampanye</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Donation::where('user_id', auth()->id())->latest()->take(5)->get() as $donation)
                                    <tr>
                                        <td>{{ Str::limit($donation->campaign->title, 30) }}</td>
                                        <td>{{ $donation->created_at->format('d M Y, H:i') }}</td>
                                        <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                        <td>
                                            @if($donation->status == 'success')
                                            <span class="badge badge-success">Berhasil</span>
                                            @elseif($donation->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                            @elseif($donation->status == 'processing')
                                            <span class="badge badge-info">Diproses</span>
                                            @elseif($donation->status == 'failed')
                                            <span class="badge badge-danger">Gagal</span>
                                            @elseif($donation->status == 'expired')
                                            <span class="badge badge-secondary">Kedaluwarsa</span>
                                            @elseif($donation->status == 'refunded')
                                            <span class="badge badge-dark">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.donations.show', $donation->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            @if($donation->status == 'success')
                                            <a href="{{ route('dashboard.donations.receipt', $donation->id) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-file-invoice"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ route('dashboard.donations.my') }}" class="btn btn-primary">Lihat Semua Donasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@parent
@if(auth()->user()->role == 'admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('donationChart').getContext('2d');
    const donationChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months ?? ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"]) !!},
            datasets: [{
                label: 'Jumlah Donasi',
                data: {!! json_encode($donationsByMonth ?? [12, 19, 7, 15, 10, 22]) !!},
                backgroundColor: 'rgba(30, 64, 175, 0.7)',
                borderColor: 'rgba(30, 64, 175, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endif
@endsection
