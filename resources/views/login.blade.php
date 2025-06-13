@extends('layouts.app')
@php($hasHero = false) @endphp

@section('title', 'Masuk | Peduli Bersama')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 pt-28">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <div class="flex items-center text-blue-500">
                    {{-- <i class="fas fa-heart text-4xl mr-2"></i> --}}
                    <span class="text-2xl font-bold">Peduli Bersama</span>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Masuk ke Akun Anda
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Login untuk mulai berdonasi atau mengelola kampanye
            </p>
            <p class="mt-2 text-center text-sm text-gray-600">
                Atau
                <a href="{{ route('register') }}{{ request()->has('redirect') ? '?redirect=' . urlencode(request()->get('redirect')) : '' }}" class="font-medium text-blue-600 hover:text-blue-600">
                    daftar akun baru
                </a>
            </p>
        </div>

        @if(session('failed'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('failed') }}</span>
        </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            @if(request()->has('redirect'))
            <input type="hidden" name="redirect" value="{{ request()->get('redirect') }}">
            @endif

            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="usernameOrEmail" class="sr-only">Username atau Email</label>
                    <input id="usernameOrEmail" name="usernameOrEmail" type="text" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Username atau Email" value="{{ old('usernameOrEmail') }}" autofocus>
                    @error('usernameOrEmail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Password">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt"></i>
                    </span>
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Flash message handling with SweetAlert if available
    @if(session()->has('failed'))
    if (typeof swal !== 'undefined') {
        swal("Login gagal!", "{{ session('failed') }}", {
            icon: "error",
            buttons: {
                confirm: {
                    className: "btn btn-danger",
                },
            },
        });
    }
    @endif
</script>
@endsection
