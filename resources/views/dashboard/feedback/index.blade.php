@extends('dashboard.layout')

@section('title', 'Kritik & Saran | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kritik & Saran</h4>
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
                    <a href="{{ route('dashboard.feedbacks.index') }}">Kritik & Saran</a>
                </li>
            </ul>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Filter -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Filter Kritik & Saran</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.feedbacks.index') }}" method="GET" class="form-inline">
                            <div class="form-group mr-3">
                                <label class="mr-2">Status:</label>
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="responded" {{ request('status') == 'responded' ? 'selected' : '' }}>Telah Direspon</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Ditutup</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('dashboard.feedbacks.index') }}" class="btn btn-secondary ml-2">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <div class="p-2">
                                    <h5>Semua</h5>
                                    <h3>{{ $counts['all'] }}</h3>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="p-2 bg-warning text-white rounded">
                                    <h5>Belum Dibaca</h5>
                                    <h3>{{ $counts['unread'] }}</h3>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="p-2 bg-info text-white rounded">
                                    <h5>Sedang Diproses</h5>
                                    <h3>{{ $counts['in_progress'] }}</h3>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="p-2 bg-success text-white rounded">
                                    <h5>Telah Direspon</h5>
                                    <h3>{{ $counts['responded'] }}</h3>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="p-2 bg-secondary text-white rounded">
                                    <h5>Ditutup</h5>
                                    <h3>{{ $counts['closed'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Kritik & Saran -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Daftar Kritik & Saran</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pengirim</th>
                                        <th>Subjek</th>
                                        <th>Tipe</th>
                                        <th>Prioritas</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($feedbacks as $feedback)
                                    <tr>
                                        <td>{{ $feedback->id }}</td>
                                        <td>
                                            <div>
                                                <strong>{{ $feedback->name }}</strong><br>
                                                <small>{{ $feedback->email }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $feedback->subject }}</td>
                                        <td>
                                            @if($feedback->type == 'complaint')
                                                <span class="badge badge-danger">Komplain</span>
                                            @elseif($feedback->type == 'suggestion')
                                                <span class="badge badge-info">Saran</span>
                                            @elseif($feedback->type == 'question')
                                                <span class="badge badge-warning">Pertanyaan</span>
                                            @else
                                                <span class="badge badge-secondary">Lainnya</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($feedback->priority == 'high')
                                                <span class="badge badge-danger">Tinggi</span>
                                            @elseif($feedback->priority == 'medium')
                                                <span class="badge badge-warning">Sedang</span>
                                            @else
                                                <span class="badge badge-info">Rendah</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($feedback->status == 'unread')
                                                <span class="badge badge-warning">Belum Dibaca</span>
                                            @elseif($feedback->status == 'in_progress')
                                                <span class="badge badge-info">Sedang Diproses</span>
                                            @elseif($feedback->status == 'responded')
                                                <span class="badge badge-success">Telah Direspon</span>
                                            @elseif($feedback->status == 'closed')
                                                <span class="badge badge-secondary">Ditutup</span>
                                            @endif
                                        </td>
                                        <td>{{ $feedback->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.feedbacks.show', $feedback->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            @if($feedback->status != 'closed')
                                            <form action="{{ route('dashboard.feedbacks.updateStatus', $feedback->id) }}" method="POST" class="d-inline close-feedback-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="closed">
                                                <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Yakin ingin menutup kritik & saran ini?')">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data kritik & saran</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $feedbacks->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Konfirmasi tutup feedback
        $('.close-feedback-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;

            confirmComplete("Anda akan menutup kritik & saran ini. Tindakan ini tidak dapat dibatalkan!")
                .then((willClose) => {
                    if (willClose) {
                        form.submit();
                    }
                });
        });
    });
</script>
@endsection
