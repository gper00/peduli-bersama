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
                        <img src="{{ $campaign->featured_image }}" alt="{{ $campaign->title }}" class="w-24 h-24 object-cover rounded-md mr-4">
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
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Nominal Donasi</label>
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md py-3 text-center" data-amount="10000">
                                Rp 10.000
                            </button>
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md py-3 text-center" data-amount="50000">
                                Rp 50.000
                            </button>
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md py-3 text-center" data-amount="100000">
                                Rp 100.000
                            </button>
                            <button type="button" class="amount-option border border-gray-300 hover:border-blue-500 rounded-md py-3 text-center" data-amount="500000">
                                Rp 500.000
                            </button>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="amount" id="amount" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 pr-12 sm:text-sm border-gray-300 rounded-md py-3" placeholder="Nominal lainnya" min="10000" required>
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Data Donatur -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Data Donatur</h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="donor_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="donor_name" id="donor_name" value="{{ auth()->check() ? auth()->user()->name : old('donor_name') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                @error('donor_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="donor_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="donor_email" id="donor_email" value="{{ auth()->check() ? auth()->user()->email : old('donor_email') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                @error('donor_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="donor_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="tel" name="donor_phone" id="donor_phone" value="{{ auth()->check() && auth()->user()->phone ? auth()->user()->phone : old('donor_phone') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                @error('donor_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan (Opsional)</label>
                                <textarea name="message" id="message" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('message') }}</textarea>
                            </div>
                            
                            <div>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="is_anonymous" name="is_anonymous" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="is_anonymous" class="font-medium text-gray-700">Sembunyikan nama saya (donasi anonim)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Metode Pembayaran</h3>
                        
                        <div class="grid grid-cols-1 gap-3">
                            <div class="border border-gray-200 rounded-md p-4 payment-method-option" data-method="bank_transfer">
                                <div class="flex items-center">
                                    <input id="bank_transfer" name="payment_method" type="radio" value="bank_transfer" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" checked>
                                    <label for="bank_transfer" class="ml-3 block text-sm font-medium text-gray-700">
                                        Transfer Bank
                                    </label>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-md p-4 payment-method-option" data-method="e_wallet">
                                <div class="flex items-center">
                                    <input id="e_wallet" name="payment_method" type="radio" value="e_wallet" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                    <label for="e_wallet" class="ml-3 block text-sm font-medium text-gray-700">
                                        E-Wallet (GoPay, OVO, DANA)
                                    </label>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-md p-4 payment-method-option" data-method="credit_card">
                                <div class="flex items-center">
                                    <input id="credit_card" name="payment_method" type="radio" value="credit_card" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                    <label for="credit_card" class="ml-3 block text-sm font-medium text-gray-700">
                                        Kartu Kredit
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-2"></i>
                            <p class="text-sm text-gray-700">
                                Dengan melakukan donasi, Anda menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> Peduli Bersama.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex justify-center">
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md shadow-sm transition duration-300 flex items-center justify-center">
                            <i class="fas fa-heart mr-2"></i>
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
