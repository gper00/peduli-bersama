@extends('layouts.app')

@section('title', 'Syarat & Ketentuan | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-12 pt-28">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-8 md:p-10">
                <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Syarat & Ketentuan</h1>

                <div class="prose prose-blue max-w-none">
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-blue-100 text-blue-600 rounded-full w-8 h-8 mr-3">1</span>
                            Akun Pengguna
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Pengguna wajib mendaftar dan memberikan data yang benar dan lengkap.</li>
                            <li>Pengguna bertanggung jawab menjaga kerahasiaan akun.</li>
                        </ul>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-blue-100 text-blue-600 rounded-full w-8 h-8 mr-3">2</span>
                            Donasi
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Donasi yang dilakukan bersifat sukarela dan tidak dapat dikembalikan.</li>
                            <li>Pengguna harus memastikan kebenaran data donasi yang diinput.</li>
                        </ul>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-blue-100 text-blue-600 rounded-full w-8 h-8 mr-3">3</span>
                            Konten Campaign
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Pengelola donasi wajib mematuhi aturan hukum yang berlaku.</li>
                            <li>Konten campaign tidak boleh mengandung unsur SARA, pornografi, atau melanggar hukum.</li>
                        </ul>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-blue-100 text-blue-600 rounded-full w-8 h-8 mr-3">4</span>
                            Kritik dan Saran
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Kritik dan saran disampaikan dengan sopan dan tidak mengandung ujaran kebencian.</li>
                        </ul>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-blue-100 text-blue-600 rounded-full w-8 h-8 mr-3">5</span>
                            Penyaluran Dana
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Pengelola donasi wajib memberikan laporan pertanggungjawaban atas penggunaan dana.</li>
                            <li>Platform tidak bertanggung jawab atas kesalahan penggunaan dana oleh pengelola.</li>
                        </ul>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-blue-100 text-blue-600 rounded-full w-8 h-8 mr-3">6</span>
                            Ketentuan Lain
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Pelanggaran syarat dan ketentuan dapat menyebabkan akun dinonaktifkan.</li>
                            <li>Syarat dan ketentuan dapat berubah sewaktu-waktu.</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-gray-200">
                    <p class="text-center text-gray-600">
                        Terakhir diperbarui: 29 Mei 2025
                    </p>
                    <div class="mt-6 flex justify-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
