@extends('dashboard.layout')

@section('page-content')

<div class="d-none" id="success-message">{{ session('success') }}</div>
<div class="d-none" id="error-message">{{ session('error') }}</div>

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kelola Pengguna</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/dashboard">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Daftar Pengguna</h4>
                            <a href="/dashboard/users/create" class="btn btn-md btn-primary btn-round ml-auto" >
                                <i class="fa fa-plus"></i>
                                Tambah Pengguna
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        {{-- <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            New</span>
                                            <span class="fw-light">
                                                Row
                                            </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">Create a new row using this form, make sure you fill them all</p>
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Name</label>
                                                        <input id="addName" type="text" class="form-control" placeholder="fill name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pr-0">
                                                    <div class="form-group form-group-default">
                                                        <label>Position</label>
                                                        <input id="addPosition" type="text" class="form-control" placeholder="fill position">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>Office</label>
                                                        <input id="addOffice" type="text" class="form-control" placeholder="fill office">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div>
                            <table id="add-row" class="table-responsive display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="avatar avatar-lg my-3">
                                                <img src="/storage/{{ $user->image ?? 'default/user.jpg' }}" alt="{{ $user->name }}" class="avatar-img rounded-circle">
                                            </div>
                                        </td>
                                        <td>{{ ucwords($user->name) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="/dashboard/users/{{ $user->id }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Lihat Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="/dashboard/users/{{ $user->id }}/edit" data-toggle="tooltip" title="" class="btn btn-link btn-warning btn-lg" data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form id="delete-user-form-{{ $user->id }}" action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger btn-lg delete-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-original-title="Hapus">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

        // Delete user button functionality
        $('.delete-user').on('click', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            var userName = $(this).data('name');
            var deleteForm = document.getElementById('delete-user-form-' + userId);

            swal({
                title: "Apakah Anda yakin?",
                text: "Anda akan menghapus pengguna '" + userName + "'. Tindakan ini tidak dapat dibatalkan!",
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
