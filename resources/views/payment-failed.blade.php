@extends('layouts.app')
@php($hasHero = false) @endphp

@section('title', 'Pembayaran Gagal | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-10 pt-28">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-red-100 text-red-600 mb-4">
                        <i class="fas fa-times-circle text-3xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">Pembayaran Gagal</h1>
                    <p class="text-gray-600 mt-2">Terjadi kesalahan saat memproses pembayaran Anda</p>
                </div>

                <div class="border border-gray-200 rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Invoice</span>
                        <span class="text-sm font-medium">{{ $donation->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Pembayaran Gagal
                        </span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Tanggal</span>
                        <span class="text-sm font-medium">{{ $donation->updated_at->format('d M Y, H:i') }}</span>
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
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Nama Donatur</span>
                        <span class="text-sm font-medium">{{ $donation->is_anonymous ? 'Anonim' : $donation->donor_name }}</span>
                    </div>

                    <div class="border-t border-gray-200 my-4"></div>

                    <div class="flex justify-between items-center">
                        <span class="text-base font-medium text-gray-700">Total Pembayaran</span>
                        <span class="text-lg font-bold text-gray-800">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-red-50 rounded-lg p-6 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-gray-800">Informasi Kesalahan</h3>
                            <p class="text-gray-600 mt-2">
                                {{ $errorMessage ?? 'Pembayaran Anda tidak dapat diproses. Hal ini mungkin disebabkan oleh beberapa alasan seperti saldo tidak mencukupi, koneksi terputus, atau masalah teknis lainnya.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Apa yang Harus Dilakukan?</h3>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Periksa saldo atau limit kartu kredit Anda</li>
                        <li>Pastikan informasi pembayaran yang Anda masukkan sudah benar</li>
                        <li>Coba gunakan metode pembayaran lain</li>
                        <li>Periksa koneksi internet Anda</li>
                        <li>Tunggu beberapa saat dan coba lagi</li>
                    </ul>
                </div>

                <div class="flex flex-col space-y-4">
                    <a href="{{ route('public.campaign', $donation->campaign->slug) }}?retry=true" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md shadow-sm transition duration-300 flex items-center justify-center">
                        <i class="fas fa-redo mr-2"></i>
                        Coba Lagi
                    </a>

                    <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="w-full text-center text-gray-700 hover:text-gray-900 font-medium py-3 px-6 rounded-md transition duration-300">
                        Kembali ke Halaman Campaign
                    </a>

                    <a href="#" class="w-full text-center text-blue-600 hover:text-blue-800 font-medium py-3 px-6 rounded-md transition duration-300">
                        <i class="fas fa-headset mr-2"></i>
                        Hubungi Tim Bantuan
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Jika masalah berlanjut, silakan hubungi kami di <a href="mailto:support@pedulibersama.org" class="text-blue-600 hover:underline">support@pedulibersama.org</a>
            </p>
        </div>
    </div>
</div>
@endsection
