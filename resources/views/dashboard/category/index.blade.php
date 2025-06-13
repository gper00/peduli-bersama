@extends('dashboard.layout')

@section('page-content')
<div class="content">
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Kelola Kategori</h4>
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
        </ul>
    </div>

    <div class="d-none" id="success-message">{{ session('success') }}</div>
    <div class="d-none" id="error-message">{{ session('error') }}</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Kategori</h4>
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus"></i> Tambah Kategori
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Urutan</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ Str::limit($category->description, 30) }}</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->sort_order }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('dashboard.categories.edit', $category->slug) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Kategori">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" onclick="confirmDelete('{{ $category->slug }}', '{{ $category->name }}')" data-original-title="Hapus Kategori">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <form id="delete-form-{{ $category->slug }}" action="{{ route('dashboard.categories.destroy', $category->slug) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="mt-4">
                        {{ $categories->links() }}
                    </div> --}}
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
        // Handle success message with SweetAlert if present
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

        // Handle error message with SweetAlert if present
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

        // Function to confirm deletion with SweetAlert
        window.confirmDelete = function(categoryId, categoryName) {
            swal({
                title: "Apakah Anda yakin?",
                text: "Anda akan menghapus kategori '" + categoryName + "'. Tindakan ini tidak dapat dibatalkan!",
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
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        };
    });
</script>
@endsection
