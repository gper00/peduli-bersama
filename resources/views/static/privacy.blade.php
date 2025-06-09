@extends('layouts.app')

@section('title', 'Kebijakan Privasi | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-8 md:p-10">
                <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Kebijakan Privasi</h1>
                
                <div class="prose prose-blue max-w-none">
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full w-8 h-8 mr-3">1</span>
                            Pengumpulan Data
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Kami mengumpulkan data pengguna saat mendaftar, termasuk nama, email, dan data lainnya.</li>
                            <li>Data juga dikumpulkan saat pengguna melakukan donasi atau mengirim kritik dan saran.</li>
                        </ul>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full w-8 h-8 mr-3">2</span>
                            Penggunaan Data
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Data pengguna digunakan untuk memproses donasi, menampilkan laporan, dan meningkatkan layanan.</li>
                            <li>Data tidak akan dijual atau dibagikan kepada pihak ketiga tanpa izin.</li>
                        </ul>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full w-8 h-8 mr-3">3</span>
                            Keamanan Data
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Kami berkomitmen menjaga keamanan data pengguna.</li>
                            <li>Data disimpan menggunakan teknologi enkripsi untuk melindungi dari akses ilegal.</li>
                        </ul>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full w-8 h-8 mr-3">4</span>
                            Hak Pengguna
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Pengguna berhak mengubah atau menghapus data pribadinya.</li>
                            <li>Pengguna berhak meminta salinan data pribadi yang tersimpan di platform.</li>
                        </ul>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <span class="flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full w-8 h-8 mr-3">5</span>
                            Perubahan Kebijakan
                        </h2>
                        <ul class="list-disc pl-12 space-y-2 text-gray-700">
                            <li>Kebijakan ini dapat diperbarui sewaktu-waktu sesuai kebutuhan.</li>
                            <li>Pengguna akan diberitahu tentang perubahan kebijakan melalui email atau notifikasi di platform.</li>
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
