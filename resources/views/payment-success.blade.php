@extends('layouts.app')

@section('title', 'Pembayaran Berhasil | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                        <i class="fas fa-check-circle text-3xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">Donasi Berhasil!</h1>
                    <p class="text-gray-600 mt-2">Terima kasih atas kebaikan hati Anda</p>
                </div>

                <div class="border border-gray-200 rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Invoice</span>
                        <span class="text-sm font-medium">{{ $donation->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Pembayaran Berhasil
                        </span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Tanggal</span>
                        <span class="text-sm font-medium">{{ $donation->payment_date ? $donation->payment_date->format('d M Y, H:i') : $donation->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Metode Pembayaran</span>
                        <span class="text-sm font-medium">{{ ucwords(str_replace('_', ' ', $donation->payment_method)) }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 my-4"></div>
                    
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">Donasi untuk</span>
                        <span class="text-sm font-medium">{{ $donation->campaign->title }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">Nama Donatur</span>
                        <span class="text-sm font-medium">{{ $donation->is_anonymous ? 'Anonim' : $donation->donor_name }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">Email</span>
                        <span class="text-sm font-medium">{{ $donation->donor_email }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Pesan</span>
                        <span class="text-sm font-medium">{{ $donation->message ? $donation->message : '-' }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 my-4"></div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-base font-medium text-gray-700">Total Pembayaran</span>
                        <span class="text-lg font-bold text-blue-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-6 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-heart text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-gray-800">Dampak Donasi Anda</h3>
                            <p class="text-gray-600 mt-2">
                                Donasi Anda akan membantu {{ $donation->campaign->title }} mendekati target Rp {{ number_format($donation->campaign->target_amount, 0, ',', '.') }}. Saat ini sudah terkumpul {{ round(($donation->campaign->current_amount / $donation->campaign->target_amount) * 100) }}% dari target.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-blue-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Bagikan Kebaikan</h3>
                    <p class="text-gray-600 mb-4">
                        Ajak teman dan keluarga Anda untuk ikut berdonasi dan membantu lebih banyak orang
                    </p>
                    <div class="flex space-x-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('public.campaign', $donation->campaign->slug)) }}" target="_blank" class="flex-1 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            <i class="fab fa-facebook-f mr-2"></i>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Saya%20baru%20saja%20berdonasi%20untuk%20{{ urlencode($donation->campaign->title) }}%20di%20Peduli%20Bersama.%20Ayo%20ikut%20membantu!&url={{ urlencode(route('public.campaign', $donation->campaign->slug)) }}" target="_blank" class="flex-1 flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            <i class="fab fa-twitter mr-2"></i>
                            Twitter
                        </a>
                        <a href="https://api.whatsapp.com/send?text=Saya%20baru%20saja%20berdonasi%20untuk%20{{ urlencode($donation->campaign->title) }}%20di%20Peduli%20Bersama.%20Ayo%20ikut%20membantu!%20{{ urlencode(route('public.campaign', $donation->campaign->slug)) }}" target="_blank" class="flex-1 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            <i class="fab fa-whatsapp mr-2"></i>
                            WhatsApp
                        </a>
                    </div>
                </div>

                <div class="flex flex-col space-y-4">
                    <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-md shadow-sm transition duration-300 flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Halaman Campaign
                    </a>
                    
                    <a href="{{ route('public.campaigns') }}" class="w-full text-center text-gray-700 hover:text-gray-900 font-medium py-3 px-6 rounded-md transition duration-300">
                        Jelajahi Campaign Lainnya
                    </a>
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Email konfirmasi telah dikirim ke {{ $donation->donor_email }}
            </p>
        </div>
    </div>
</div>
@endsection
