@extends('layouts.app')
@section('title', '419 Session Expired')
@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center py-24">
    <div class="text-7xl font-bold text-gray-400 mb-4">419</div>
    <div class="text-2xl font-semibold mb-2">Session Expired</div>
    <p class="text-gray-500 mb-6">Sesi kamu telah berakhir. Silakan login ulang untuk melanjutkan.</p>
    <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-medium transition">Login Ulang</a>
</div>
@endsection
