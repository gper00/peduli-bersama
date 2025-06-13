@extends('dashboard.layout')

@section('page-content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Edit User</h4>
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
                <li class="nav-item">
                    <a href="#">Edit User</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit User: {{ $user->name }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <form action="/dashboard/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
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
                                                value="{{ old('name', $user->name) }}"
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
                                            <img src="{{ $user->image ? '/storage/' . $user->image : '/storage/default/user.jpg' }}" height="100px" alt="" id="imgPreview" class="d-block mb-2 rounded">
                                            <input
                                                type="file"
                                                class="form-control @error('image') is-invalid @enderror"
                                                id="image"
                                                name="image"
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
                                                value="{{ old('username', $user->username) }}"
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
                                                value="{{ old('email', $user->email) }}"
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

                                    {{-- Only admins can see and change roles based on permissions --}}
                                    @if(auth()->user()->isAdmin() && auth()->id() !== $user->id)
                                    <div class="form-group row">
                                        <label for="role" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Role *</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <select
                                                class="form-control @error('role') is-invalid @enderror"
                                                id="role"
                                                name="role"
                                                {{ !auth()->user()->isSuperAdmin() && $user->isAdmin() ? 'disabled' : '' }}
                                                required
                                            >
                                                @if(auth()->user()->isSuperAdmin())
                                                    <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                                                @endif
                                                <option value="creator" {{ (old('role', $user->role) == 'creator') ? 'selected' : '' }}>Creator</option>
                                                <option value="donor" {{ (old('role', $user->role) == 'donor') ? 'selected' : '' }}>Donor</option>
                                            </select>
                                            @if(!auth()->user()->isSuperAdmin() && $user->isAdmin())
                                                <small class="text-muted">Only super admin can edit admin roles</small>
                                            @endif
                                            @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif

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
                                                value="{{ old('phone_number', $user->phone_number) }}"
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
                                        <label for="bio" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Bio</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <textarea
                                                class="form-control @error('bio') is-invalid @enderror"
                                                id="bio"
                                                name="bio"
                                                rows="3"
                                            >{{ old('bio', $user->bio) }}</textarea>
                                            @error('bio')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Address</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <textarea
                                                class="form-control @error('address') is-invalid @enderror"
                                                id="address"
                                                name="address"
                                                rows="2"
                                            >{{ old('address', $user->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="facebook_url" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Facebook URL</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="url"
                                                class="form-control @error('facebook_url') is-invalid @enderror"
                                                id="facebook_url"
                                                name="facebook_url"
                                                value="{{ old('facebook_url', $user->facebook_url) }}"
                                                placeholder="https://facebook.com/username"
                                            >
                                            @error('facebook_url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="twitter_url" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Twitter URL</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="url"
                                                class="form-control @error('twitter_url') is-invalid @enderror"
                                                id="twitter_url"
                                                name="twitter_url"
                                                value="{{ old('twitter_url', $user->twitter_url) }}"
                                                placeholder="https://twitter.com/username"
                                            >
                                            @error('twitter_url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="instagram_url" class="col-form-label col-lg-3 text-lg-right">
                                            <span>Instagram URL</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="url"
                                                class="form-control @error('instagram_url') is-invalid @enderror"
                                                id="instagram_url"
                                                name="instagram_url"
                                                value="{{ old('instagram_url', $user->instagram_url) }}"
                                                placeholder="https://instagram.com/username"
                                            >
                                            @error('instagram_url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-form-label col-lg-3 text-lg-right">
                                            <span>New Password</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password"
                                                name="password"
                                                placeholder="Leave blank to keep current password"
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
                                            <span>Confirm New Password</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input
                                                type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="repassword"
                                                name="password_confirmation"
                                                placeholder="Leave blank to keep current password"
                                            >
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                                            <a href="{{ auth()->id() === $user->id ? route('dashboard.profile.index') : route('dashboard.users.index') }}" class="btn btn-primary btn-border">Cancel</a>
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

@push('custom-scripts')
<script>
    // Image preview
    $(document).ready(function(){
        $("#image").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#imgPreview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endpush

@endsection
