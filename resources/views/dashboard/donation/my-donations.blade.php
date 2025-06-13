@extends('dashboard.layout')

@section('title', 'Riwayat Donasi | Peduli Bersama')

@section('page-content')
<div class="container-fluid">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Riwayat Donasi</h4>
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
                    <span>Riwayat Donasi</span>
                </li>
            </ul>
        </div>

    <!-- Notification Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Donasi</p>
                                    <h4 class="card-title">{{ $donations->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Donasi Berhasil</p>
                                    <h4 class="card-title">{{ $successfulDonations }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-warning card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Menunggu Pembayaran</p>
                                    <h4 class="card-title">{{ $pendingDonations }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($totalDonated > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Donasi Berhasil</p>
                                    <h4 class="card-title">Rp {{ number_format($totalDonated, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @endif

    <!-- Filter Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter Donasi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.donations.my') }}" method="GET" class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Berhasil</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Kedaluwarsa</option>
                    <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
            </div>
            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                                <a href="{{ route('dashboard.donations.my') }}" class="btn btn-secondary">
                    <i class="fas fa-sync mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>
                </div>
            </div>
        </div>

        <!-- Donation List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Donasi</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Campaign</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                    </tr>
                </thead>
                                <tbody>
                    @forelse($donations as $donation)
                                    <tr>
                                        <td>{{ $donation->invoice_number }}</td>
                                        <td>
                                            <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="text-primary">
                                {{ Str::limit($donation->campaign->title, 30) }}
                            </a>
                        </td>
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
                                            <span class="badge badge-primary">Dikembalikan</span>
                            @endif
                        </td>
                                        <td>{{ $donation->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('dashboard.donations.show', $donation->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @if($donation->status == 'pending')
                                                <a href="{{ route('donation.pay', $donation->invoice_number) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Bayar" target="_blank">
                                    <i class="fas fa-credit-card"></i>
                                </a>
                                @endif

                                @if($donation->status == 'success')
                                                <a href="{{ route('dashboard.donations.receipt', $donation->id) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Unduh Bukti" target="_blank">
                                    <i class="fas fa-file-invoice"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                                        <td colspan="6" class="text-center">Anda belum memiliki riwayat donasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
                        {{-- <div class="d-flex justify-content-center mt-4">
            {{ $donations->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>

        <!-- Call to Action -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title">Mulai Berdonasi</h4>
                                <p class="card-text">Anda dapat membantu lebih banyak orang dengan berdonasi ke campaign-campaign yang sedang aktif.</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{ route('public.campaigns') }}" class="btn btn-light">
            <i class="fas fa-hand-holding-heart mr-2"></i> Lihat Campaign
        </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
