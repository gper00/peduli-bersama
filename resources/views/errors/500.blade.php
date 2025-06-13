@extends('layouts.app')
@section('title', '500 Internal Server Error')
@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center py-24">
    <div class="text-7xl font-bold text-red-700 mb-4">500</div>
    <div class="text-2xl font-semibold mb-2">Terjadi Kesalahan Server</div>
    <p class="text-gray-500 mb-6">Ups! Ada masalah pada server kami. Silakan coba beberapa saat lagi.</p>
    <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-medium transition">Kembali ke Beranda</a>
</div>
@endsection
