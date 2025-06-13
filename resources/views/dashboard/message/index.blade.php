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
        <h4 class="page-title">Pesan Masuk</h4>
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
                <a href="{{ route('dashboard.messages.index') }}"> Pesan Masuk</a>
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
                        <h4 class="card-title">Daftar Pesan Masuk</h4>
                        <span class="badge badge-primary ml-auto">{{ $unreadCount }} Pesan Belum Dibaca</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pengirim</th>
                                    <th>Subjek</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $index => $message)
                                <tr class="{{ $message->is_read ? '' : 'table-primary' }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>
                                        @if($message->is_read)
                                            <span class="badge badge-success">Sudah Dibaca</span>
                                        @else
                                            <span class="badge badge-info">Belum Dibaca</span>
                                        @endif
                                    </td>
                                    <td>{{ $message->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('dashboard.messages.show', $message->id) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" title="Lihat Detail">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form action="{{ route('dashboard.messages.toggle-read', $message->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-link btn-{{ $message->is_read ? 'warning' : 'success' }} btn-lg" data-toggle="tooltip" title="{{ $message->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                                    <i class="fa {{ $message->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada pesan masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
    });
</script>
@endsection
