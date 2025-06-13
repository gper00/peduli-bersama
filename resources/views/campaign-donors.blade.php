@extends('layouts.app')
@section('title', 'Daftar Donatur - ' . $campaign->title)
@section('content')
<div class="max-w-3xl mx-auto py-16 px-4 sm:px-6 lg:px-8 min-h-[60vh] pt-28">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Daftar Donatur</h1>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">{{ $campaign->title }}</h2>
        @if($donations->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($donations as $donation)
            <div class="flex items-center py-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                    <i class="fas fa-user text-blue-600"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium text-gray-800">
                        @if($donation->is_anonymous)
                            Anonim
                        @elseif($donation->user)
                            {{ $donation->user->name }}
                        @else
                            {{ $donation->donor_name ?? 'Donatur' }}
                        @endif
                    </div>
                    <div class="text-sm text-gray-500">
                        Donasi Rp{{ number_format($donation->amount, 0, ',', '.') }} - {{ $donation->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $donations->links() }}
        </div>
        @else
        <div class="text-center py-8">
            <i class="fas fa-hand-holding-heart text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Belum ada donasi untuk kampanye ini.</p>
        </div>
        @endif
        <div class="mt-8 text-center">
            <a href="{{ route('public.campaign', $campaign->slug) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-medium transition">Kembali ke Detail Kampanye</a>
        </div>
    </div>
</div>
@endsection
