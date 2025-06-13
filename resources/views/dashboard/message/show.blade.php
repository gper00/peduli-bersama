@extends('dashboard.layout')

@section('page-content')
<div class="content">
@if(auth()->user()->role !== 'admin')
<div class="page-inner">
    <div class="alert alert-danger">
        <h4><i class="fa fa-exclamation-triangle mr-2"></i> Akses Terbatas</h4>
        <p>Maaf, Anda tidak memiliki akses untuk melihat halaman ini. Hanya administrator yang dapat mengakses halaman pesan masuk.</p>
    </div>
</div>
@else
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Detail Pesan</h4>
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
                <a href="{{ route('dashboard.messages.index') }}">Pesan Masuk</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail Pesan</a>
            </li>
        </ul>
    </div>

    <div class="d-none" id="success-message">{{ session('success') }}</div>
    <div class="d-none" id="error-message">{{ session('error') }}</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Informasi Pesan</h4>
                        <div class="ml-auto">
                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-info btn-sm">
                                <i class="fa fa-reply mr-1"></i> Balas Pesan
                            </a>
                            <form action="{{ route('dashboard.messages.toggle-read', $message->id) }}" method="POST" class="d-inline toggle-read-form">
                                @csrf
                                <button type="submit" class="btn btn-{{ $message->is_read ? 'warning' : 'success' }} btn-sm ml-1">
                                    <i class="fa {{ $message->is_read ? 'fa-envelope' : 'fa-envelope-open' }} mr-1"></i>
                                    {{ $message->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
                                </button>
                            </form>
                            <a href="{{ route('dashboard.messages.index') }}" class="btn btn-primary btn-border btn-sm ml-1">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="alert {{ $message->is_read ? 'alert-success' : 'alert-info' }} d-flex align-items-center" role="alert">
                                <i class="fa {{ $message->is_read ? 'fa-envelope-open' : 'fa-envelope' }} mr-2"></i>
                                <div>
                                    Status: {{ $message->is_read ? 'Sudah Dibaca' : 'Belum Dibaca' }} |
                                    Diterima pada: {{ $message->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pengirim:</label>
                                <p>{{ $message->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Email:</label>
                                <p>
                                    <a href="mailto:{{ $message->email }}" class="text-primary">
                                        {{ $message->email }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Subjek:</label>
                                <p>{{ $message->subject }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($message->user_id)
                            <div class="form-group">
                                <label class="font-weight-bold">Pengguna:</label>
                                <p>
                                    <a href="{{ route('dashboard.users.show', $message->user_id) }}" class="text-primary">
                                        {{ $message->user->name }}
                                    </a>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Isi Pesan:</label>
                                <div class="p-3 bg-light rounded">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard.messages.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                        </a>
                        <div>
                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-info">
                                <i class="fa fa-reply mr-1"></i> Balas Pesan
                            </a>
                            @if(!$message->is_read)
                            <form action="{{ route('dashboard.messages.toggle-read', $message->id) }}" method="POST" class="d-inline ml-1 toggle-read-form">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check mr-1"></i> Tandai Sudah Dibaca
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Sweet Alert untuk notifikasi
        const successMessage = $('#success-message').text();
        const errorMessage = $('#error-message').text();

        if (successMessage) {
            swal("Berhasil!", successMessage, {
                icon: "success",
                buttons: {
                    confirm: {
                        className: 'btn btn-success'
                    }
                }
            });
        }

        if (errorMessage) {
            swal("Gagal!", errorMessage, {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                }
            });
        }

        // Konfirmasi toggle status pesan
        $('.toggle-read-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const isRead = $(this).find('button').hasClass('btn-success');
            const action = isRead ? 'menandai sebagai belum dibaca' : 'menandai sebagai sudah dibaca';

            swal({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin " + action + "?",
                icon: "info",
                buttons: {
                    cancel: {
                        text: "Batal",
                        value: false,
                        visible: true,
                        className: "btn btn-secondary",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Ya, konfirmasi!",
                        value: true,
                        visible: true,
                        className: "btn btn-primary",
                        closeModal: true
                    }
                },
                closeOnClickOutside: false,
                closeOnEsc: false
            }).then((willToggle) => {
                if (willToggle) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
