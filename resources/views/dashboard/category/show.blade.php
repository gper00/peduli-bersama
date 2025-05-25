@extends('dashboard.layout')

@section('page-content')
<div class="d-none" id="success-message">{{ session('success') }}</div>
<div class="d-none" id="error-message">{{ session('error') }}</div>

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Detail Kategori</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.categories.index') }}">Kategori</a>
            </li>
            <li class="separator">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail</a>
            </li>
        </ul>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Informasi Kategori</h4>
                        <div class="ml-auto">
                            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th width="200">ID</th>
                                <td>{{ $category->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $category->description ?? 'Tidak ada deskripsi' }}</td>
                            </tr>
                            <tr>
                                <th>Icon</th>
                                <td>
                                    @if($category->icon)
                                    <i class="fas {{ $category->icon }} fa-2x" style="color: {{ $category->color ?? '#000' }}"></i>
                                    <code>{{ $category->icon }}</code>
                                    @else
                                    <span class="text-muted">Tidak ada icon</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Warna</th>
                                <td>
                                    @if($category->color)
                                    <div class="d-flex align-items-center">
                                        <div style="width: 25px; height: 25px; background-color: {{ $category->color }}; border-radius: 5px; margin-right: 10px;"></div>
                                        <code>{{ $category->color }}</code>
                                    </div>
                                    @else
                                    <span class="text-muted">Tidak ada warna</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($category->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Urutan</th>
                                <td>{{ $category->sort_order }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat pada</th>
                                <td>{{ $category->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diperbarui pada</th>
                                <td>{{ $category->updated_at->format('d M Y, H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Aksi</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <a href="{{ route('dashboard.categories.edit', $category->slug) }}" class="btn btn-primary mb-2">
                            <i class="fa fa-edit"></i> Edit Kategori
                        </a>
                        
                        <button id="delete-category-btn" class="btn btn-danger mb-2">
                            <i class="fa fa-trash"></i> Hapus Kategori
                        </button>
                        
                        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-info">
                            <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                        
                        <form id="delete-form" action="{{ route('dashboard.categories.destroy', $category->slug) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Statistik Kategori</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Total Campaign</h4>
                        <h4>{{ $category->campaigns->count() }}</h4>
                    </div>
                    
                    @if($category->campaigns->count() > 0)
                    <a href="#" class="btn btn-sm btn-primary btn-block">
                        <i class="fa fa-list"></i> Lihat Semua Campaign
                    </a>
                    @else
                    <p class="text-muted text-center">Belum ada campaign untuk kategori ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Handle success messages with SweetAlert
        var successMessage = $('#success-message').text();
        if (successMessage && successMessage.trim() !== '') {
            swal({
                title: "Berhasil!",
                text: successMessage,
                icon: "success",
                buttons: {
                    confirm: {
                        text: "OK",
                        className: "btn btn-success",
                    },
                },
            });
        }
        
        // Handle error messages with SweetAlert
        var errorMessage = $('#error-message').text();
        if (errorMessage && errorMessage.trim() !== '') {
            swal({
                title: "Error!",
                text: errorMessage,
                icon: "error",
                buttons: {
                    confirm: {
                        text: "OK",
                        className: "btn btn-danger",
                    },
                },
            });
        }
        
        // SweetAlert for delete button
        $('#delete-category-btn').on('click', function(e) {
            e.preventDefault();
            const deleteForm = document.getElementById('delete-form');
            
            swal({
                title: "Apakah Anda yakin?",
                text: "Anda akan menghapus kategori ini. Tindakan ini tidak dapat dibatalkan!",
                type: "warning",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Ya, hapus!",
                        className: "btn btn-primary",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    deleteForm.submit();
                }
            });
        });
    });
</script>
@endsection
