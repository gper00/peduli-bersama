@extends('layouts.app')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Hubungi Kami</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Kami Siap Membantu Anda
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.
            </p>
        </div>

        <div class="mt-12">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Kontak</h3>
                    <div class="mt-5">
                        <div class="flex items-center mt-2">
                            <i class="fas fa-map-marker-alt text-blue-500 w-5"></i>
                            <span class="ml-3 text-gray-700">Jl. Contoh Alamat No. 123, Jakarta</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <i class="fas fa-envelope text-blue-500 w-5"></i>
                            <span class="ml-3 text-gray-700">info@pedulibersama.org</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <i class="fas fa-phone text-blue-500 w-5"></i>
                            <span class="ml-3 text-gray-700">+62 21 1234 5678</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <i class="fas fa-clock text-blue-500 w-5"></i>
                            <span class="ml-3 text-gray-700">Senin - Jumat: 09:00 - 17:00</span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h4 class="text-md font-medium text-gray-900">Ikuti Kami</h4>
                        <div class="flex space-x-4 mt-3">
                            <a href="#" class="text-gray-700 hover:text-blue-500">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-blue-500">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-blue-500">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-blue-500">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium text-gray-900">Kirim Pesan</h3>
                    
                    @if(session('success'))
                        <div class="rounded-md bg-green-50 p-4 mt-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <form class="mt-5" action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('name') border-red-300 @enderror" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('email') border-red-300 @enderror" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subjek</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('subject') border-red-300 @enderror" required>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea name="message" id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('message') border-red-300 @enderror" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
