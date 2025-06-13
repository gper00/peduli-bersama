@extends('dashboard.layout')

@section('title', 'Profil Saya | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Profil Saya</h4>
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
                    <a href="{{ route('dashboard.profile.index') }}">Profil Saya</a>
                </li>
            </ul>
        </div>

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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Informasi Profil</h4>
                            <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-edit mr-2"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ $user->image ? '/storage/' . $user->image : '/storage/default/user.jpg' }}"
                                     alt="{{ $user->name }}" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                                <h4 class="font-weight-bold">{{ $user->name }}</h4>
                                <div class="badge badge-primary">{{ ucfirst($user->role) }}</div>
                                <p class="mt-2">{{ $user->bio ?: 'Belum ada bio' }}</p>
                                <div class="social-links mt-3">
                                    @if($user->facebook_url)
                                    <a href="{{ $user->facebook_url }}" target="_blank" class="btn btn-sm btn-round btn-primary mx-1" data-toggle="tooltip" title="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    @endif

                                    @if($user->twitter_url)
                                    <a href="{{ $user->twitter_url }}" target="_blank" class="btn btn-sm btn-round btn-info mx-1" data-toggle="tooltip" title="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    @endif

                                    @if($user->instagram_url)
                                    <a href="{{ $user->instagram_url }}" target="_blank" class="btn btn-sm btn-round btn-danger mx-1" data-toggle="tooltip" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td width="200"><strong>Username</strong></td>
                                                <td>{{ $user->username }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nomor Telepon</strong></td>
                                                <td>{{ $user->phone_number ?: 'Belum diisi' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Alamat</strong></td>
                                                <td>{{ $user->address ?: 'Belum diisi' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Bergabung Sejak</strong></td>
                                                <td>{{ $user->created_at->format('d F Y, H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Terakhir Diperbarui</strong></td>
                                                <td>{{ $user->updated_at->format('d F Y, H:i') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
