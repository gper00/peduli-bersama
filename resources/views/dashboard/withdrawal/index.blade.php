@extends('dashboard.layout')

@section('title', 'Penarikan Dana | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Penarikan Dana</h4>
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
                    <a href="{{ route('dashboard.withdrawals.index') }}">Penarikan Dana</a>
                </li>
            </ul>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('dashboard.withdrawals.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tarik Dana
                    </a>
                </div>
            </div>
        </div>

    <!-- Notification Messages -->
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        <i class="fa fa-exclamation-circle mr-2"></i> {{ session('error') }}
    </div>
    @endif

    <!-- Available Funds Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-lg bg-success mr-3">
                            <i class="fa fa-wallet"></i>
                        </div>
                        <div>
                            <p class="mb-0 text-muted">Dana Tersedia untuk Penarikan</p>
                            <h4 class="font-weight-bold text-success">Rp {{ number_format($availableFunds, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawals Table -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Riwayat Penarikan Dana</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kampanye</th>
                                    <th>Jumlah</th>
                                    <th>Bank</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdrawals as $withdrawal)
                                <tr>
                                    <td>{{ $withdrawal->withdrawal_code }}</td>
                                    <td>
                                        <div>
                                            <div class="font-weight-bold">{{ Str::limit($withdrawal->campaign->title, 30) }}</div>
                                            <div class="text-muted small">{{ $withdrawal->campaign->user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="font-weight-bold">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                                    <td>{{ $withdrawal->bank_name }} - {{ $withdrawal->account_number }}</td>
                                    <td>
                                        @if($withdrawal->status == 'completed')
                                        <span class="badge badge-success">Selesai</span>
                                        @elseif($withdrawal->status == 'approved')
                                        <span class="badge badge-primary">Disetujui</span>
                                        @elseif($withdrawal->status == 'rejected')
                                        <span class="badge badge-danger">Ditolak</span>
                                        @else
                                        <span class="badge badge-warning">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>{{ $withdrawal->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.withdrawals.show', $withdrawal->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada riwayat penarikan dana.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($withdrawals->hasPages())
                    <div class="mt-3">
                        {{ $withdrawals->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawal Info -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Penarikan Dana</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-sm bg-primary mr-3">
                                    <i class="fa fa-info-circle"></i>
                                </div>
                                <div>
                                    <h5>Syarat Penarikan Dana</h5>
                                    <ul class="pl-3">
                                        <li>Minimal penarikan dana adalah Rp 10.000</li>
                                        <li>Pastikan data rekening bank yang dimasukkan sudah benar</li>
                                        <li>Penarikan dana akan diproses dalam 1-3 hari kerja</li>
                                        <li>Biaya administrasi sebesar Rp 5.000 akan dikenakan untuk setiap penarikan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-sm bg-warning mr-3">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h5>Perhatian</h5>
                                    <p>
                                        Pastikan nama pemilik rekening sesuai dengan nama penggalang dana yang terdaftar. 
                                        Jika berbeda, maka penarikan dana tidak akan diproses.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-sm bg-success mr-3">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5>Status Penarikan Dana</h5>
                                    <ul class="pl-3">
                                        <li><span class="text-warning font-weight-bold">Menunggu</span> - Permintaan penarikan dana sedang ditinjau oleh admin</li>
                                        <li><span class="text-primary font-weight-bold">Disetujui</span> - Permintaan penarikan dana telah disetujui dan sedang diproses</li>
                                        <li><span class="text-success font-weight-bold">Selesai</span> - Dana telah ditransfer ke rekening bank yang dituju</li>
                                        <li><span class="text-danger font-weight-bold">Ditolak</span> - Permintaan penarikan dana ditolak oleh admin</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
