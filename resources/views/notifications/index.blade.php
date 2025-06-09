@extends('layouts.app')

@section('title', 'Notifikasi | Peduli Bersama')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">Notifikasi</h1>
                
                @if($notifications->where('is_read', false)->count() > 0)
                <form action="{{ route('dashboard.notifications.mark-all-as-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                        Tandai Semua Dibaca
                    </button>
                </form>
                @endif
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse($notifications as $notification)
                    <div class="p-4 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }} hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                @if($notification->type == 'donation')
                                    <i class="fas fa-donate text-green-500 text-lg"></i>
                                @elseif($notification->type == 'feedback')
                                    <i class="fas fa-comment-alt text-blue-500 text-lg"></i>
                                @else
                                    <i class="fas fa-bell text-yellow-500 text-lg"></i>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium text-gray-900">{{ $notification->title }}</h3>
                                    <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">{{ $notification->message }}</p>
                                
                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex space-x-2">
                                        @if($notification->campaign_id)
                                            <a href="{{ route('dashboard.campaigns.show', $notification->campaign->slug) }}" class="text-xs text-blue-600 hover:text-blue-800">
                                                Lihat Campaign
                                            </a>
                                        @endif
                                        
                                        @if($notification->donation_id)
                                            <a href="{{ route('dashboard.donations.show', $notification->donation_id) }}" class="text-xs text-blue-600 hover:text-blue-800">
                                                Lihat Donasi
                                            </a>
                                        @endif
                                    </div>
                                    
                                    @if(!$notification->is_read)
                                        <form action="{{ route('dashboard.notifications.mark-as-read', $notification->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs text-gray-500 hover:text-gray-700">
                                                Tandai Dibaca
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-bell-slash text-gray-300 text-4xl mb-4"></i>
                        <p>Tidak ada notifikasi saat ini</p>
                    </div>
                @endforelse
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
