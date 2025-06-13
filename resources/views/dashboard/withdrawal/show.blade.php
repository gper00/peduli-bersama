@extends('dashboard.layout')

@section('title', 'Detail Penarikan Dana | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Detail Penarikan Dana</h4>
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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.withdrawals.show', $withdrawal->id) }}">Detail</a>
                </li>
            </ul>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('dashboard.withdrawals.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
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

        <!-- Withdrawal Detail Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Informasi Penarikan Dana</h4>
                        <div>
                            @if($withdrawal->status == 'completed')
                            <span class="badge badge-success">Selesai</span>
                            @elseif($withdrawal->status == 'approved')
                            <span class="badge badge-primary">Disetujui</span>
                            @elseif($withdrawal->status == 'rejected')
                            <span class="badge badge-danger">Ditolak</span>
                            @else
                            <span class="badge badge-warning">Menunggu</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold mb-3">Informasi Penarikan</h5>
                                <table class="table table-sm">
                                    <tr>
                                        <td width="50%">Kode Penarikan</td>
                                        <td width="50%" class="font-weight-bold">{{ $withdrawal->withdrawal_code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td class="font-weight-bold">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Admin</td>
                                        <td class="font-weight-bold">Rp 5.000</td>
                                    </tr>
                                    <tr>
                                        <td>Total Diterima</td>
                                        <td class="font-weight-bold text-success">Rp {{ number_format($withdrawal->amount - 5000, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pengajuan</td>
                                        <td>{{ $withdrawal->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                    @if($withdrawal->completed_at)
                                    <tr>
                                        <td>Tanggal Selesai</td>
                                        <td>{{ \Carbon\Carbon::parse($withdrawal->completed_at)->format('d M Y, H:i') }}</td>
                                    </tr>
                                    @endif
                                </table>

                                <h5 class="font-weight-bold mb-3 mt-4">Informasi Kampanye</h5>
                                <table class="table table-sm">
                                    <tr>
                                        <td width="50%">Nama Kampanye</td>
                                        <td width="50%" class="font-weight-bold">{{ $withdrawal->campaign->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penggalang Dana</td>
                                        <td>{{ $withdrawal->campaign->user->name }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="font-weight-bold mb-3">Informasi Rekening</h5>
                                <table class="table table-sm">
                                    <tr>
                                        <td width="50%">Bank</td>
                                        <td width="50%">{{ $withdrawal->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td>{{ $withdrawal->account_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pemilik</td>
                                        <td>{{ $withdrawal->account_name }}</td>
                                    </tr>
                                </table>

                                <h5 class="font-weight-bold mb-3 mt-4">Catatan</h5>
                                <p>{{ $withdrawal->note ?: 'Tidak ada catatan' }}</p>

                                {{-- Tampilkan alasan penolakan jika ada --}}
                                @if($withdrawal->rejection_reason)
                                    <p>{{ $withdrawal->rejection_reason }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Admin Action Buttons -->
                        @if(auth()->user()->role === 'admin' && $withdrawal->status === 'pending')
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="border-top pt-4">
                                    <h5 class="font-weight-bold mb-3">Tindakan Admin</h5>
                                    <div class="d-flex">
                                        <form action="{{ route('dashboard.withdrawals.updateStatus', $withdrawal->id) }}" method="POST" class="mr-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check mr-2"></i> Terima Penarikan
                                            </button>
                                        </form>

                                        <button type="button" id="rejectBtn" class="btn btn-danger">
                                            <i class="fa fa-times mr-2"></i> Tolak Penarikan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rejection Modal -->
                        <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog" aria-labelledby="rejectionModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectionModalLabel">Tolak Penarikan Dana</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('dashboard.withdrawals.updateStatus', $withdrawal->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">

                                            <div class="form-group">
                                                <label for="rejection_reason">Alasan Penolakan</label>
                                                <textarea name="rejection_reason" id="rejection_reason" rows="3" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Tolak Penarikan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Complete Withdrawal Button (For Admin with Approved status) -->
                        @if(auth()->user()->role === 'admin' && $withdrawal->status === 'approved')
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="border-top pt-4">
                                    <h5 class="font-weight-bold mb-3">Tindakan Admin</h5>
                                    <form action="{{ route('dashboard.withdrawals.updateStatus', $withdrawal->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <div class="form-group">
                                            <label for="admin_note">Catatan (Opsional)</label>
                                            <textarea name="admin_note" id="admin_note" rows="2" class="form-control"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-check-circle mr-2"></i> Selesaikan Penarikan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Card -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Riwayat Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <!-- Created Status -->
                            <div class="timeline-item">
                                <div class="timeline-badge">
                                    <i class="fa fa-clock text-info"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title font-weight-bold">Penarikan Dana Diajukan</h6>
                                        <p><small class="text-muted">{{ $withdrawal->created_at->format('d M Y, H:i') }}</small></p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{{ $withdrawal->user->name }} mengajukan penarikan dana sebesar Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Updates -->
                            @if($withdrawal->status !== 'pending')
                            <div class="timeline-item">
                                <div class="timeline-badge">
                                    @if($withdrawal->status == 'approved')
                                    <i class="fa fa-check text-primary"></i>
                                    @elseif($withdrawal->status == 'rejected')
                                    <i class="fa fa-times text-danger"></i>
                                    @else
                                    <i class="fa fa-check-circle text-success"></i>
                                    @endif
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title font-weight-bold">
                                            @if($withdrawal->status == 'approved')
                                            Penarikan Dana Disetujui
                                            @elseif($withdrawal->status == 'rejected')
                                            Penarikan Dana Ditolak
                                            @else
                                            Penarikan Dana Selesai
                                            @endif
                                        </h6>
                                        <p><small class="text-muted">{{ $withdrawal->updated_at->format('d M Y, H:i') }}</small></p>
                                    </div>
                                    @if($withdrawal->admin_note)
                                    <div class="timeline-body">
                                        <div class="p-3 bg-light rounded">
                                            {{ $withdrawal->admin_note }}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
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
        // Rejection Modal
        $('#rejectBtn').click(function() {
            $('#rejectionModal').modal('show');
        });
    });
</script>
@endsection
