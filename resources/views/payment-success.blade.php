@extends('layouts.app')
@php($hasHero = false) @endphp

@section('title', 'Pembayaran Berhasil | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-10 pt-28">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-8">
                <div class="flex flex-col items-center mb-8">
                    <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-blue-100 text-blue-600 mb-4 shadow">
                        <i class="fas fa-check-circle text-4xl"></i>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Donasi Berhasil!</h1>
                    <p class="text-gray-600 text-lg">Terima kasih atas kebaikan hati Anda</p>
                </div>

                <div class="border border-blue-100 rounded-xl p-6 mb-8 bg-blue-50/30">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="flex justify-between items-center">
                            <dt class="text-sm text-gray-500">Invoice</dt>
                            <dd class="text-sm font-medium text-gray-800">{{ $donation->invoice_number }}</dd>
                        </div>
                        <div class="flex justify-between items-center">
                            <dt class="text-sm text-gray-500">Status</dt>
                            <dd><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Pembayaran Berhasil</span></dd>
                        </div>
                        <div class="flex justify-between items-center">
                            <dt class="text-sm text-gray-500">Tanggal</dt>
                            <dd class="text-sm font-medium text-gray-800">{{ $donation->payment_date ? $donation->payment_date->format('d M Y, H:i') : $donation->updated_at->format('d M Y, H:i') }}</dd>
                        </div>
                        <div class="flex justify-between items-center">
                            <dt class="text-sm text-gray-500">Metode Pembayaran</dt>
                            <dd class="text-sm font-medium text-gray-800">{{ ucwords(str_replace('_', ' ', $donation->payment_method)) }}</dd>
                        </div>
                        <div class="flex justify-between items-center sm:col-span-2 border-t border-gray-200 pt-4 mt-2">
                            <dt class="text-sm text-gray-500">Donasi untuk</dt>
                            <dd class="text-sm font-medium text-gray-800">{{ $donation->campaign->title }}</dd>
                        </div>
                        <div class="flex justify-between items-center">
                            <dt class="text-sm text-gray-500">Nama Donatur</dt>
                            <dd class="text-sm font-medium text-gray-800">{{ $donation->is_anonymous ? 'Anonim' : $donation->donor_name }}</dd>
                        </div>
                        <div class="flex justify-between items-center">
                            <dt class="text-sm text-gray-500">Email</dt>
                            <dd class="text-sm font-medium text-gray-800">{{ $donation->donor_email }}</dd>
                        </div>
                        <div class="flex justify-between items-center sm:col-span-2">
                            <dt class="text-sm text-gray-500">Pesan</dt>
                            <dd class="text-sm font-medium text-gray-800">{{ $donation->message ? $donation->message : '-' }}</dd>
                        </div>
                        <div class="flex justify-between items-center sm:col-span-2 border-t border-gray-200 pt-4 mt-2">
                            <dt class="text-base font-bold text-gray-700">Total Pembayaran</dt>
                            <dd class="text-lg font-extrabold text-blue-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="bg-blue-50 rounded-xl p-6 mb-6 flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <i class="fas fa-heart text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Dampak Donasi Anda</h3>
                        <p class="text-gray-600">
                            Donasi Anda akan membantu <span class="font-semibold">{{ $donation->campaign->title }}</span> mendekati target <span class="font-semibold">Rp {{ number_format($donation->campaign->target_amount, 0, ',', '.') }}</span>. Saat ini sudah terkumpul <span class="font-semibold">{{ round(($donation->campaign->current_amount / $donation->campaign->target_amount) * 100) }}%</span> dari target.
                        </p>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Bagikan Kebaikan</h3>
                    <p class="text-gray-600 mb-4">
                        Ajak teman dan keluarga Anda untuk ikut berdonasi dan membantu lebih banyak orang
                    </p>
                    <div class="flex flex-col sm:flex-row gap-2">
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
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                Email konfirmasi telah dikirim ke <span class="font-semibold">{{ $donation->donor_email }}</span>
            </p>
        </div>
    </div>
</div>
@endsection
