@extends('layouts.app')

@section('title', 'Donasi - ' . $campaign->title . ' | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Formulir Donasi</h1>
                    <a href="{{ route('public.campaign', $campaign->slug) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
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
                            <div class="flex items-center text-sm text-gray-500">
                                <span>Penggalang: {{ $campaign->user->name }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $campaign->category->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('public.processDonation', $campaign->slug) }}" method="POST" id="donationForm">
                    @csrf
                    <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                    <!-- Nominal Donasi -->
                    <div class="mb-6">
                        <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Nominal Donasi</label>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md px-4 py-2 text-sm font-medium transition-colors duration-200 ease-in-out hover:bg-blue-50" data-amount="10000">Rp10.000</button>
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md px-4 py-2 text-sm font-medium transition-colors duration-200 ease-in-out hover:bg-blue-50" data-amount="50000">Rp50.000</button>
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md px-4 py-2 text-sm font-medium transition-colors duration-200 ease-in-out hover:bg-blue-50" data-amount="100000">Rp100.000</button>
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md px-4 py-2 text-sm font-medium transition-colors duration-200 ease-in-out hover:bg-blue-50" data-amount="500000">Rp500.000</button>
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md px-4 py-2 text-sm font-medium transition-colors duration-200 ease-in-out hover:bg-blue-50" data-amount="1000000">Rp1.000.000</button>
                        </div>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm font-medium">Rp</span>
                            </div>
                            <input type="number" name="amount" id="amount" min="10000" value="{{ old('amount', 50000) }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 pr-12 sm:text-sm border-blue-200 rounded-md py-3" placeholder="Masukkan nominal donasi" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">.00</span>
                            </div>
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Minimal donasi Rp10.000</p>
                    </div>

                    <!-- Data Donatur -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Donatur</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label for="donor_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="donor_name" id="donor_name" value="{{ auth()->check() ? auth()->user()->name : old('donor_name') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-blue-200 rounded-md py-2 px-3" required>
                                @error('donor_name')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="donor_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="donor_email" id="donor_email" value="{{ auth()->check() ? auth()->user()->email : old('donor_email') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-blue-200 rounded-md py-2 px-3" required>
                                @error('donor_email')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="donor_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="tel" name="donor_phone" id="donor_phone" value="{{ auth()->check() && auth()->user()->phone_number ? auth()->user()->phone_number : old('donor_phone') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-blue-200 rounded-md py-2 px-3" required>
                                @error('donor_phone')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Field pesan untuk penggalang dana dihapus -->
                        </div>
                    </div>
                    
                    <!-- Kritik & Saran -->
                    <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Kritik & Saran <span class="text-sm font-normal text-gray-500">(Opsional)</span></h3>
                        <p class="text-sm text-gray-600 mb-3">Masukan Anda sangat berharga untuk meningkatkan kampanye ini dan platform kami. Kritik dan saran hanya akan dilihat oleh admin dan penggalang dana.</p>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="feedback_subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                                <select name="feedback_subject" id="feedback_subject" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-blue-200 rounded-md py-2">
                                    <option value="">Pilih subjek...</option>
                                    <option value="saran" {{ old('feedback_subject') == 'saran' ? 'selected' : '' }}>Saran Perbaikan</option>
                                    <option value="kritik" {{ old('feedback_subject') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                                    <option value="pertanyaan" {{ old('feedback_subject') == 'pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                                    <option value="lainnya" {{ old('feedback_subject') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="feedback_message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                                <textarea name="feedback_message" id="feedback_message" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-blue-200 rounded-md py-2 px-3">{{ old('feedback_message') }}</textarea>
                            </div>
                            
                            <!-- Opsi buat sebagai pesan pribadi dihapus karena semua kritik & saran hanya dilihat oleh admin dan penggalang dana -->
                        </div>
                    
                    <!-- Persetujuan -->
                    <div class="mb-6">
                        <div class="flex items-start mb-4">
                            <div class="flex items-center h-5">
                                <input id="is_anonymous" name="is_anonymous" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" {{ old('is_anonymous') ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_anonymous" class="font-medium text-gray-700">Sembunyikan nama saya (anonim)</label>
                                <p class="text-gray-500">Pilih opsi ini jika Anda tidak ingin nama Anda ditampilkan di daftar donatur.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metode Pembayaran -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Metode Pembayaran</h3>

                        <div class="grid grid-cols-1 gap-3">
                            <div class="border border-gray-200 hover:border-blue-500 rounded-md p-4 payment-method-option transition duration-150 cursor-pointer bg-white hover:bg-blue-50" data-method="bank_transfer">
                                <div class="flex items-center">
                                    <input id="bank_transfer" name="payment_method" type="radio" value="bank_transfer" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" checked>
                                    <label for="bank_transfer" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                                        <div class="flex items-center">
                                            <i class="fas fa-university mr-2 text-blue-600"></i> Transfer Bank
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">BCA, Mandiri, BNI, BRI, dan bank lainnya</p>
                                    </label>
                                </div>
                            </div>

                            <div class="border border-gray-200 hover:border-blue-500 rounded-md p-4 payment-method-option transition duration-150 cursor-pointer bg-white hover:bg-blue-50" data-method="e_wallet">
                                <div class="flex items-center">
                                    <input id="e_wallet" name="payment_method" type="radio" value="e_wallet" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                    <label for="e_wallet" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                                        <div class="flex items-center">
                                            <i class="fas fa-wallet mr-2 text-green-600"></i> E-Wallet
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">GoPay, OVO, DANA, LinkAja, ShopeePay</p>
                                    </label>
                                </div>
                            </div>

                            <div class="border border-gray-200 hover:border-blue-500 rounded-md p-4 payment-method-option transition duration-150 cursor-pointer bg-white hover:bg-blue-50" data-method="credit_card">
                                <div class="flex items-center">
                                    <input id="credit_card" name="payment_method" type="radio" value="credit_card" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                    <label for="credit_card" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                                        <div class="flex items-center">
                                            <i class="fas fa-credit-card mr-2 text-red-600"></i> Kartu Kredit/Debit
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Visa, Mastercard, JCB</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mt-1 mr-3 text-lg"></i>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800 mb-1">Donasi Aman & Terpercaya</h4>
                                <p class="text-sm text-gray-700">
                                    Seluruh donasi diproses dengan aman melalui sistem pembayaran terenkripsi. Kami menjamin keamanan dan transparansi dalam penyaluran dana.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-center text-sm text-gray-600 mb-4">
                            Dengan melakukan donasi, Anda menyetujui <a href="{{ route('terms') }}" class="text-blue-600 hover:text-blue-800 font-medium" target="_blank">Syarat & Ketentuan</a> dan <a href="{{ route('privacy') }}" class="text-blue-600 hover:text-blue-800 font-medium" target="_blank">Kebijakan Privasi</a> Peduli Bersama.
                        </p>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-4 px-6 rounded-md shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center text-lg">
                            <i class="fas fa-heart mr-2 animate-pulse"></i>
                            Lanjutkan Donasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle amount option buttons
        const amountOptions = document.querySelectorAll('.amount-option');
        const amountInput = document.getElementById('amount');

        amountOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove active class from all options
                amountOptions.forEach(opt => {
                    opt.classList.remove('bg-blue-50', 'border-blue-500', 'text-blue-700');
                });

                // Add active class to selected option
                this.classList.add('bg-blue-50', 'border-blue-500', 'text-blue-700');

                // Set the amount value
                const amount = this.getAttribute('data-amount');
                amountInput.value = amount;
            });
        });

        // Handle payment method selection
        const paymentMethods = document.querySelectorAll('.payment-method-option');

        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                const radioInput = this.querySelector('input[type="radio"]');
                radioInput.checked = true;

                // Remove active class from all methods
                paymentMethods.forEach(m => {
                    m.classList.remove('border-blue-500', 'bg-blue-50');
                });

                // Add active class to selected method
                this.classList.add('border-blue-500', 'bg-blue-50');
            });
        });
    });
</script>
@endsection
