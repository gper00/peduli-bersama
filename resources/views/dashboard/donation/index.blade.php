@extends('dashboard.layout')

@section('title', 'Kelola Donasi | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kelola Donasi</h4>
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
                    <a href="{{ route('dashboard.donations.index') }}">Kelola Donasi</a>
                </li>
            </ul>
        </div>

    <!-- Filter Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Filter Donasi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.donations.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
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

                            @if(auth()->user()->isAdmin())
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Campaign</label>
                                    <select name="campaign_id" class="form-control">
                                        <option value="">Semua Campaign</option>
                                        @foreach($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}" {{ request('campaign_id') == $campaign->id ? 'selected' : '' }}>{{ $campaign->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                                <a href="{{ route('dashboard.donations.index') }}" class="btn btn-secondary ml-2">
                                    <i class="fas fa-sync mr-2"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
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
                                <h4 class="card-title">{{ $donations->total() }}</h4>
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
                                <h4 class="card-title">{{ $donations->where('status', 'success')->count() }}</h4>
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
                                <h4 class="card-title">{{ $donations->where('status', 'pending')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation List -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Donasi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Donatur</th>
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
                                    <td>
                                        <div>{{ $donation->invoice_number }}</div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="mb-0 font-weight-bold">{{ $donation->getDonorNameAttribute() }}</p>
                                            <p class="text-muted mb-0 small">{{ $donation->donor_email ?? ($donation->user ? $donation->user->email : 'Email tidak tersedia') }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="text-primary" target="_blank">
                                            {{ Str::limit($donation->campaign->title, 30) }}
                                        </a>
                                    </td>
                                    <td class="font-weight-bold">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
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
                                        {{ $donation->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('dashboard.donations.show', $donation->id) }}" class="btn btn-primary btn-sm mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if(auth()->user()->isAdmin())
                                            <form action="{{ route('dashboard.donations.updateStatus', $donation->id) }}" method="POST" class="d-inline mr-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="success">
                                                <button type="submit" class="btn btn-success btn-sm btn-confirm" data-action="mengonfirmasi donasi ini sebagai berhasil">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('dashboard.donations.updateStatus', $donation->id) }}" method="POST" class="d-inline mr-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="failed">
                                                <button type="submit" class="btn btn-danger btn-sm btn-confirm" data-action="menandai donasi ini sebagai gagal">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            @endif

                                            @if($donation->status == 'success')
                                            <a href="{{ route('dashboard.donations.receipt', $donation->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data donasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $donations->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
