@extends('dashboard.layout')

@section('page-content')
<div class="content">
@if(auth()->user()->role !== 'admin')
<div class="page-inner">
    <div class="alert alert-danger">
        <h4><i class="fa fa-exclamation-triangle mr-2"></i> Akses Terbatas</h4>
        <p>Maaf, Anda tidak memiliki akses untuk melihat halaman ini. Hanya administrator yang dapat mengakses halaman komentar publik.</p>
    </div>
</div>
@else
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Kelola Komentar Publik</h4>
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
                <a href="{{ route('dashboard.comments.index') }}">Komentar Publik</a>
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
                        <h4 class="card-title">Filter Komentar</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.comments.index') }}" method="GET" class="form-inline">
                        <div class="form-group mr-3">
                            <label class="mr-2">Status:</label>
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Moderasi</option>
                                <option value="spam" {{ request('status') == 'spam' ? 'selected' : '' }}>Spam</option>
                                <option value="deleted" {{ request('status') == 'deleted' ? 'selected' : '' }}>Dihapus</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('dashboard.comments.index') }}" class="btn btn-secondary ml-2">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                            <div class="p-2 bg-success text-white rounded">
                                <h5>Dipublikasikan</h5>
                                <h3>{{ $counts['published'] }}</h3>
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="p-2 bg-info text-white rounded">
                                <h5>Menunggu</h5>
                                <h3>{{ $counts['pending'] }}</h3>
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="p-2 bg-warning text-white rounded">
                                <h5>Spam</h5>
                                <h3>{{ $counts['spam'] }}</h3>
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="p-2 bg-danger text-white rounded">
                                <h5>Dihapus</h5>
                                <h3>{{ $counts['deleted'] }}</h3>
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
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Komentar</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pengguna</th>
                                    <th>Kampanye</th>
                                    <th>Komentar</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comments as $index => $comment)
                                <tr class="{{ $comment->status == 'pending' ? 'table-warning' : ($comment->status == 'spam' ? 'table-danger' : ($comment->status == 'deleted' ? 'table-secondary' : '')) }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if($comment->user)
                                        <a href="{{ route('dashboard.users.show', ['user' => $comment->user_id]) }}">
                                            {{ $comment->user->name }}
                                        </a>
                                        @else
                                            {{ $comment->guest_name ?? 'Anonymous' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('public.campaign', $comment->campaign->slug) }}">
                                            {{ $comment->campaign->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                            @if($comment->parent_id)
                                                <span class="badge badge-info mr-1">Balasan</span>
                                            @endif
                                            {{ Str::limit($comment->comment, 100) }}
                                        </div>
                                        @if($comment->is_pinned)
                                            <span class="badge badge-success">Dipin</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($comment->status == 'published')
                                            <span class="badge badge-success">Dipublikasikan</span>
                                        @elseif($comment->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($comment->status == 'spam')
                                            <span class="badge badge-danger">Spam</span>
                                        @elseif($comment->status == 'deleted')
                                            <span class="badge badge-secondary">Dihapus</span>
                                        @endif
                                    </td>
                                    <td>{{ $comment->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#commentModal{{ $comment->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <div class="dropdown d-inline">
                                                <button class="btn btn-link btn-info btn-lg" data-toggle="dropdown">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form action="{{ route('dashboard.comments.update-status', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="published">
                                                        <button type="submit" class="dropdown-item">Terima Komentar</button>
                                                    </form>
                                                    <form action="{{ route('dashboard.comments.update-status', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="pending">
                                                        <button type="submit" class="dropdown-item">Tandai Pending</button>
                                                    </form>
                                                    <form action="{{ route('dashboard.comments.update-status', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="spam">
                                                        <button type="submit" class="dropdown-item">Tandai Spam</button>
                                                    </form>
                                                    <form action="{{ route('dashboard.comments.update-status', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="deleted">
                                                        <button type="submit" class="dropdown-item">Hapus Komentar</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <form action="{{ route('dashboard.comments.destroy', $comment->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link btn-danger btn-lg" data-toggle="tooltip" title="Hapus Permanen">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Comment Detail Modal -->
                                        <div class="modal fade" id="commentModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel{{ $comment->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="commentModalLabel{{ $comment->id }}">Detail Komentar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <strong>Pengguna:</strong>
                                                                @if($comment->user)
                                                                    {{ $comment->user->name }}
                                                                @else
                                                                    {{ $comment->guest_name ?? 'Anonymous' }}
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Email:</strong>
                                                                @if($comment->user)
                                                                    {{ $comment->user->email }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <strong>Kampanye:</strong> {{ $comment->campaign->title }}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Waktu:</strong> {{ $comment->created_at->format('d M Y, H:i') }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <strong>Status:</strong>
                                                                @if($comment->status == 'published')
                                                                    <span class="badge badge-success">Dipublikasikan</span>
                                                                @elseif($comment->status == 'pending')
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @elseif($comment->status == 'spam')
                                                                    <span class="badge badge-danger">Spam</span>
                                                                @elseif($comment->status == 'deleted')
                                                                    <span class="badge badge-secondary">Dihapus</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Dipin:</strong> {{ $comment->is_pinned ? 'Ya' : 'Tidak' }}
                                                            </div>
                                                        </div>
                                                        @if($comment->parent_id)
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <strong>Balasan untuk:</strong>
                                                                <div class="p-3 bg-light rounded mt-1">
                                                                    {{ $comment->parent->comment }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <strong>Isi Komentar:</strong>
                                                                <div class="p-3 bg-light rounded mt-1">
                                                                    {{ $comment->comment }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($comment->moderated_at)
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <strong>Dimoderasi oleh:</strong>
                                                                @if($comment->moderator)
                                                                    {{ $comment->moderator->name }} pada {{ $comment->moderated_at->format('d M Y, H:i') }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <div class="btn-group">
                                                            <form action="{{ route('dashboard.comments.update-status', $comment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="published">
                                                                <button type="submit" class="btn btn-success mr-1">Terima</button>
                                                            </form>
                                                            <form action="{{ route('dashboard.comments.update-status', $comment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="spam">
                                                                <button type="submit" class="btn btn-warning mr-1">Spam</button>
                                                            </form>
                                                            <form action="{{ route('dashboard.comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada komentar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        {{ $comments->links() }}
                    </div>
                </div> --}}
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

        // Konfirmasi hapus
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;

            confirmDelete("Komentar akan dihapus secara permanen dan tidak dapat dikembalikan!")
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
