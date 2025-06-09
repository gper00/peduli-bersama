@extends('layouts.app')

@section('title', 'Kritik & Saran - ' . $campaign->title . ' | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Kritik & Saran</h1>
                </div>

                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-start">
                        @if ($campaign->cover_image)
                            <img src="{{ asset('storage/' . $campaign->cover_image) }}" alt="{{ $campaign->title }}" class="w-24 h-24 object-cover rounded-md mr-4">
                        @else
                            <img src="{{ asset('storage/default/image.jpg') }}" alt="{{ $campaign->title }}" class="w-24 h-24 object-cover rounded-md mr-4">
                        @endif
                        <div>
                            <h2 class="text-lg font-medium text-gray-800">{{ $campaign->title }}</h2>
                            <p class="text-gray-600 text-sm mb-2">{{ $campaign->short_description }}</p>
                            <div class="flex flex-col text-sm">
                                <span class="text-gray-500">Donasi #{{ $donation->invoice }}</span>
                                <span class="text-gray-500">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3 text-xl"></i>
                        <div>
                            <h3 class="font-semibold text-green-800">Terima Kasih Atas Donasi Anda!</h3>
                            <p class="text-green-700 text-sm">Donasi Anda telah berhasil diproses. Kami sangat menghargai feedback Anda untuk meningkatkan kampanye ini.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('donation.feedback.store', $donation->id) }}" method="POST" id="feedbackForm">
                    @csrf

                    <!-- Kritik & Saran -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Kritik & Saran <span class="text-sm font-normal text-gray-500">(Opsional)</span></h3>
                        <p class="text-sm text-gray-600 mb-3">Masukan Anda sangat berharga untuk meningkatkan kampanye ini dan platform kami. Kritik dan saran hanya akan dilihat oleh admin dan penggalang dana.</p>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="feedback_subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                                <select name="feedback_subject" id="feedback_subject" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md py-2" required>
                                    <option value="">Pilih subjek...</option>
                                    <option value="saran" {{ old('feedback_subject') == 'saran' ? 'selected' : '' }}>Saran Perbaikan</option>
                                    <option value="kritik" {{ old('feedback_subject') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                                    <option value="pertanyaan" {{ old('feedback_subject') == 'pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                                    <option value="lainnya" {{ old('feedback_subject') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('feedback_subject')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="feedback_message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                                <textarea name="feedback_message" id="feedback_message" rows="4" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3" required>{{ old('feedback_message') }}</textarea>
                                @error('feedback_message')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Opsi buat sebagai pesan pribadi dihapus karena semua kritik & saran hanya dilihat oleh admin dan penggalang dana -->
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md transition duration-300">
                            <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-2 px-6 rounded-md shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
