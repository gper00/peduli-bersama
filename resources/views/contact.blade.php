@extends('layouts.app')

@section('title', 'Hubungi Kami | Peduli Bersama')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:16px]"></div>
    <div class="absolute h-full w-full bg-gradient-to-t from-blue-900/50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative">
        <div class="md:flex md:items-center md:justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl mb-6">
                    Mari Terhubung
                </h1>
                <p class="text-xl text-blue-100 leading-relaxed">
                    Kami siap mendengar dan membantu Anda. Tim dukungan kami akan merespons dalam waktu 24 jam.
                </p>
            </div>
            <div class="md:w-1/2 relative">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-lg">
                        <div class="text-blue-300 mb-2">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-1">Jam Operasional</h3>
                        <p class="text-blue-100 text-sm">Senin - Jumat</p>
                        <p class="text-blue-100 text-sm">09:00 - 17:00 WIB</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-lg">
                        <div class="text-blue-300 mb-2">
                            <i class="fas fa-headset text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-1">Dukungan</h3>
                        <p class="text-blue-100 text-sm">24/7 Online</p>
                        <p class="text-blue-100 text-sm">Via Email & Telepon</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Info Cards -->
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-envelope text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                        <p class="mt-1 text-gray-600">support@pedulibersama.org</p>
                        <p class="text-sm text-gray-500">Respons dalam 24 jam</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-phone text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Telepon</h3>
                        <p class="mt-1 text-gray-600">+62 21 1234 5678</p>
                        <p class="text-sm text-gray-500">Senin - Jumat, 09:00 - 17:00</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Sosial Media</h3>
                        <div class="mt-2 flex space-x-3">
                            <a href="#" class="text-gray-600 hover:text-blue-600"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-gray-600 hover:text-blue-600"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-600 hover:text-blue-600"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Form Section -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Kirim Pesan</h2>
        <p class="text-lg text-gray-600">
            Apakah Anda memiliki pertanyaan atau ingin berkolaborasi? Isi formulir di bawah ini.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden backdrop-blur-sm">
        <div class="p-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-800 flex items-center animate-fade-in">
                    <i class="fas fa-check-circle text-green-400 mr-3 text-lg"></i>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('messages.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <!-- Name Field -->
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}"
                                class="pl-10 w-full rounded-lg border-0 ring-1 ring-inset ring-gray-300 bg-gray-50/50 py-3 text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm transition-shadow @error('name') ring-red-500 @enderror"
                                placeholder="Masukkan nama lengkap Anda"
                                required>
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="sm:col-span-1">
                        <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                class="pl-10 w-full rounded-lg border-0 ring-1 ring-inset ring-gray-300 bg-gray-50/50 py-3 text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm transition-shadow @error('email') ring-red-500 @enderror"
                                placeholder="Masukkan alamat email Anda"
                                required>
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Field -->
                    <div class="sm:col-span-2">
                        <label for="subject" class="block text-sm font-semibold text-gray-800 mb-2">Subjek</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-tag"></i>
                            </span>
                            <input type="text" name="subject" id="subject"
                                value="{{ old('subject') }}"
                                class="pl-10 w-full rounded-lg border-0 ring-1 ring-inset ring-gray-300 bg-gray-50/50 py-3 text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm transition-shadow @error('subject') ring-red-500 @enderror"
                                placeholder="Subjek pesan Anda"
                                required>
                        </div>
                        @error('subject')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Field -->
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-semibold text-gray-800 mb-2">Pesan</label>
                        <div class="relative">
                            <textarea name="message" id="message" rows="5"
                                class="w-full rounded-lg border-0 ring-1 ring-inset ring-gray-300 bg-gray-50/50 py-3 px-4 text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm transition-shadow @error('message') ring-red-500 @enderror"
                                placeholder="Tulis pesan Anda di sini..."
                                required>{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-shield-alt text-blue-500 mr-2"></i>
                        <span>Informasi Anda aman bersama kami</span>
                    </div>
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
            <p class="text-lg text-gray-600">
                Beberapa pertanyaan yang sering ditanyakan oleh pengguna kami
            </p>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-medium text-gray-900">Berapa lama waktu respons?</span>
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </div>
                </button>
                <div class="px-6 pb-4">
                    <p class="text-gray-600">Kami berusaha merespons semua pesan dalam waktu 24 jam kerja.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-medium text-gray-900">Bagaimana cara melacak donasi saya?</span>
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </div>
                </button>
                <div class="px-6 pb-4">
                    <p class="text-gray-600">Anda dapat melacak donasi melalui dashboard akun Anda atau menghubungi tim support kami.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
