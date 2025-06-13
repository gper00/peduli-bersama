@extends('layouts.app')
@section('title', '404 Not Found')
@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center py-24">
    <div class="text-7xl font-bold text-blue-700 mb-4">404</div>
    <div class="text-2xl font-semibold mb-2">Halaman Tidak Ditemukan</div>
    <p class="text-gray-500 mb-6">Maaf, halaman yang kamu cari tidak tersedia atau sudah dipindahkan.</p>
    <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-medium transition">Kembali ke Beranda</a>
</div>
@endsection
