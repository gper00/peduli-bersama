@extends('dashboard.layout')

@section('title', 'Detail Kritik & Saran | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Detail Kritik & Saran</h4>
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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detail</a>
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

        <div class="row">
            <!-- Informasi Feedback -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Informasi Kritik & Saran</h4>
                            <div>
                                <span class="mr-2">
                                    @if($feedback->status == 'unread')
                                        <span class="badge badge-warning">Belum Dibaca</span>
                                    @elseif($feedback->status == 'in_progress')
                                        <span class="badge badge-info">Sedang Diproses</span>
                                    @elseif($feedback->status == 'responded')
                                        <span class="badge badge-success">Telah Direspon</span>
                                    @elseif($feedback->status == 'closed')
                                        <span class="badge badge-secondary">Ditutup</span>
                                    @endif
                                </span>
                                <a href="{{ route('dashboard.feedbacks.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="font-weight-bold">{{ $feedback->subject }}</h5>
                            <div class="d-flex justify-content-between text-muted mb-3">
                                <span>
                                    <i class="far fa-user mr-1"></i> {{ $feedback->name }}
                                    ({{ $feedback->email }})
                                </span>
                                <span>
                                    <i class="far fa-clock mr-1"></i> {{ $feedback->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="mr-3">
                                    <strong>Tipe:</strong>
                                    @if($feedback->type == 'complaint')
                                        <span class="badge badge-danger">Komplain</span>
                                    @elseif($feedback->type == 'suggestion')
                                        <span class="badge badge-info">Saran</span>
                                    @elseif($feedback->type == 'question')
                                        <span class="badge badge-warning">Pertanyaan</span>
                                    @else
                                        <span class="badge badge-secondary">Lainnya</span>
                                    @endif
                                </span>
                                <span>
                                    <strong>Prioritas:</strong>
                                    @if($feedback->priority == 'high')
                                        <span class="badge badge-danger">Tinggi</span>
                                    @elseif($feedback->priority == 'medium')
                                        <span class="badge badge-warning">Sedang</span>
                                    @else
                                        <span class="badge badge-info">Rendah</span>
                                    @endif
                                </span>
                            </div>
                            <hr>
                            <div class="mt-3">
                                <div class="p-3 bg-light rounded">
                                    {{ $feedback->message }}
                                </div>
                            </div>
                        </div>

                        @if($feedback->status == 'responded' && $feedback->admin_response)
                        <div class="mt-4">
                            <h5 class="font-weight-bold">Respon Admin</h5>
                            <div class="d-flex justify-content-between text-muted mb-3">
                                <span>
                                    <i class="far fa-user mr-1"></i> 
                                    {{ $feedback->responder ? $feedback->responder->name : 'Admin' }}
                                </span>
                                <span>
                                    <i class="far fa-clock mr-1"></i> {{ $feedback->responded_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                            <div class="p-3 bg-light rounded">
                                {{ $feedback->admin_response }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Update Status -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Ubah Status</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.feedbacks.updateStatus', $feedback->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="unread" {{ $feedback->status == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                    <option value="in_progress" {{ $feedback->status == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="responded" {{ $feedback->status == 'responded' ? 'selected' : '' }}>Telah Direspon</option>
                                    <option value="closed" {{ $feedback->status == 'closed' ? 'selected' : '' }}>Ditutup</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Perbarui Status</button>
                        </form>
                    </div>
                </div>

                <!-- Tambah Respon -->
                @if($feedback->status != 'closed')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Respon</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.feedbacks.respond', $feedback->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="admin_response">Respon</label>
                                <textarea name="admin_response" id="admin_response" rows="5" class="form-control" required>{{ old('admin_response', $feedback->admin_response) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="admin_notes">Catatan Internal (Hanya untuk admin)</label>
                                <textarea name="admin_notes" id="admin_notes" rows="3" class="form-control">{{ old('admin_notes', $feedback->admin_notes) }}</textarea>
                                <small class="form-text text-muted">Catatan ini hanya terlihat oleh admin dan tidak akan dikirim ke pengguna.</small>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Kirim Respon</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
