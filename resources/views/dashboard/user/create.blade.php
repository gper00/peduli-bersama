@extends('dashboard.layout')

@section('page-content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Buat Pengguna</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/dashboard">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/users">Kelola Pengguna</a>
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
                        <div class="card-title">Buat Pengguna</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <form action="/dashboard/users" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Name *</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name"
                                                name="name"
                                                value="{{ old('name') }}"
                                                autocomplete="off"
                                                autofocus
                                                required
                                            >
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-form-label col-lg-3 text-lg-right">Photo</label>
                                        <div class="col-lg-9">
                                            <img src="/storage/default/user.jpg" height="100px" alt="" id="imgPreview" class="d-block mb-2 rounded">
                                            <input
                                                type="file"
                                                class="form-control @error('image') is-invalid @enderror"
                                                id="image"
                                                name="image"
                                                value="{{ old('image') }}"
                                            >
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Username *</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                id="username"
                                                name="username"
                                                value="{{ old('username') }}"
                                                autocomplete="off"
                                                required
                                            >
                                            @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Email *</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                autocomplete="off"
                                                required
                                            >
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Password *</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password"
                                                name="password"
                                                value="{{ old('password') }}"
                                                required
                                            >
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="repassword" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Confirm Password *</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="repassword"
                                                name="password_confirmation"
                                                value="{{ old('password_confirmation') }}"
                                                required
                                            >
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Role *</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <select
                                                class="form-control @error('role') is-invalid @enderror"
                                                id="role"
                                                name="role"
                                                required
                                            >
                                                <option value="">Select Role</option>
                                                @if($canCreateAdmin)
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                @endif
                                                <option value="creator" {{ old('role') == 'creator' ? 'selected' : '' }}>Creator</option>
                                            </select>
                                            @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Phone Number</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                id="phone_number"
                                                name="phone_number"
                                                value="{{ old('phone_number') }}"
                                                autocomplete="off"
                                            >
                                            @error('phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-primary mr-2">Create</button>
                                            <a href="/dashboard/users" class="btn btn-primary btn-border">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
