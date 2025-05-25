@extends('layouts.app')

@section('title', 'Pembayaran Donasi - ' . $donation->campaign->title . ' | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Instruksi Pembayaran</h1>
                    <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Kampanye
                    </a>
                </div>

                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                Silakan selesaikan pembayaran Anda dalam <span class="font-bold" id="countdown">24:00:00</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-start">
                        <img src="{{ $donation->campaign->featured_image }}" alt="{{ $donation->campaign->title }}" class="w-24 h-24 object-cover rounded-md mr-4">
                        <div>
                            <h2 class="text-lg font-medium text-gray-800">{{ $donation->campaign->title }}</h2>
                            <div class="mt-1 text-sm text-gray-500">
                                <span>{{ $donation->campaign->user->name }}</span>
                                <span class="mx-1">•</span>
                                <span>{{ $donation->campaign->category->name }}</span>
                            </div>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Donasi ID: {{ $donation->invoice_number }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Donasi -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Detail Donasi</h3>
                    <div class="border border-gray-200 rounded-md overflow-hidden">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-500">Informasi</span>
                                <span class="text-sm font-medium text-gray-500">Detail</span>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="px-4 py-3 flex justify-between">
                                <span class="text-sm text-gray-600">Tanggal</span>
                                <span class="text-sm font-medium text-gray-900">{{ $donation->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="px-4 py-3 flex justify-between">
                                <span class="text-sm text-gray-600">Jumlah Donasi</span>
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="px-4 py-3 flex justify-between">
                                <span class="text-sm text-gray-600">Metode Pembayaran</span>
                                <span class="text-sm font-medium text-gray-900">
                                    @if($donation->payment_method == 'bank_transfer')
                                        Transfer Bank
                                    @elseif($donation->payment_method == 'e_wallet')
                                        E-Wallet
                                    @elseif($donation->payment_method == 'credit_card')
                                        Kartu Kredit
                                    @else
                                        {{ $donation->payment_method }}
                                    @endif
                                </span>
                            </div>
                            <div class="px-4 py-3 flex justify-between">
                                <span class="text-sm text-gray-600">Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Menunggu Pembayaran
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instruksi Pembayaran -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Instruksi Pembayaran</h3>
                    
                    @if($donation->payment_method == 'bank_transfer')
                    <div class="border border-gray-200 rounded-md overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center mb-4">
                                <img src="{{ asset('images/bank-bca.png') }}" alt="BCA" class="h-8 mr-3">
                                <div>
                                    <p class="font-medium text-gray-900">Bank Central Asia (BCA)</p>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1">Nomor Rekening</p>
                                <div class="flex items-center">
                                    <p class="text-lg font-bold text-gray-800 mr-2">1234567890</p>
                                    <button type="button" class="text-blue-600 hover:text-blue-800 text-sm" onclick="copyToClipboard('1234567890')">
                                        <i class="far fa-copy"></i> Salin
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1">Atas Nama</p>
                                <p class="font-medium text-gray-800">YAYASAN PEDULI BERSAMA</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1">Jumlah Transfer</p>
                                <div class="flex items-center">
                                    <p class="text-lg font-bold text-gray-800 mr-2">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                    <button type="button" class="text-blue-600 hover:text-blue-800 text-sm" onclick="copyToClipboard('{{ $donation->amount }}')">
                                        <i class="far fa-copy"></i> Salin
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1">Kode Unik</p>
                                <div class="flex items-center">
                                    <p class="text-lg font-bold text-gray-800 mr-2">{{ $donation->payment_code }}</p>
                                    <button type="button" class="text-blue-600 hover:text-blue-800 text-sm" onclick="copyToClipboard('{{ $donation->payment_code }}')">
                                        <i class="far fa-copy"></i> Salin
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Pastikan mencantumkan kode unik ini di keterangan transfer untuk verifikasi otomatis.</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 p-4 bg-gray-50">
                            <h4 class="font-medium text-gray-800 mb-2">Cara Pembayaran:</h4>
                            <ol class="list-decimal list-inside text-sm text-gray-600 space-y-2">
                                <li>Lakukan transfer ke nomor rekening di atas dengan jumlah persis sesuai yang tertera.</li>
                                <li>Cantumkan kode unik <strong>{{ $donation->payment_code }}</strong> pada keterangan transfer.</li>
                                <li>Simpan bukti transfer sebagai referensi.</li>
                                <li>Pembayaran akan diverifikasi otomatis dalam 5-10 menit. Jika dalam 1 jam belum diverifikasi, silakan hubungi tim kami.</li>
                            </ol>
                        </div>
                    </div>
                    @elseif($donation->payment_method == 'e_wallet')
                    <div class="border border-gray-200 rounded-md overflow-hidden">
                        <div class="p-4">
                            <div class="flex justify-center mb-6">
                                <img src="{{ asset('images/qr-code-example.png') }}" alt="QR Code Pembayaran" class="h-48">
                            </div>
                            
                            <div class="text-center mb-4">
                                <p class="text-sm text-gray-600 mb-1">Scan QR Code di atas menggunakan:</p>
                                <div class="flex justify-center space-x-4 mt-2">
                                    <img src="{{ asset('images/logo-gopay.png') }}" alt="GoPay" class="h-8">
                                    <img src="{{ asset('images/logo-ovo.png') }}" alt="OVO" class="h-8">
                                    <img src="{{ asset('images/logo-dana.png') }}" alt="DANA" class="h-8">
                                </div>
                            </div>
                            
                            <div class="mb-4 text-center">
                                <p class="text-sm text-gray-600 mb-1">Jumlah Pembayaran</p>
                                <p class="text-lg font-bold text-gray-800">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 p-4 bg-gray-50">
                            <h4 class="font-medium text-gray-800 mb-2">Cara Pembayaran:</h4>
                            <ol class="list-decimal list-inside text-sm text-gray-600 space-y-2">
                                <li>Buka aplikasi e-wallet Anda (GoPay, OVO, atau DANA).</li>
                                <li>Pilih "Scan QR" atau "Pay" pada aplikasi.</li>
                                <li>Scan QR Code di atas.</li>
                                <li>Masukkan jumlah pembayaran persis sesuai yang tertera.</li>
                                <li>Konfirmasi dan selesaikan pembayaran.</li>
                                <li>Pembayaran akan diverifikasi otomatis setelah Anda menyelesaikan transaksi.</li>
                            </ol>
                        </div>
                    </div>
                    @else
                    <div class="border border-gray-200 rounded-md overflow-hidden">
                        <div class="p-4">
                            <p class="text-center text-gray-700">Untuk simulasi pembayaran, silahkan klik tombol di bawah ini:</p>
                            
                            <div class="mt-6 text-center">
                                <form action="{{ route('donation.callback') }}" method="POST" id="simulateForm">
                                    @csrf
                                    <input type="hidden" name="invoice" value="{{ $donation->invoice_number }}">
                                    <input type="hidden" name="status" value="success">
                                    <input type="hidden" name="payment_id" value="SIM-{{ Str::random(8) }}">
                                    
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md shadow-sm">
                                        <i class="fas fa-check-circle mr-2"></i> Simulasi Pembayaran Berhasil
                                    </button>
                                </form>
                                
                                <form action="{{ route('donation.callback') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="invoice" value="{{ $donation->invoice_number }}">
                                    <input type="hidden" name="status" value="failed">
                                    <input type="hidden" name="payment_id" value="SIM-{{ Str::random(8) }}">
                                    
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md shadow-sm">
                                        <i class="fas fa-times-circle mr-2"></i> Simulasi Pembayaran Gagal
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="flex justify-between">
                    <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-md">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kampanye
                    </a>
                    
                    <a href="{{ route('donation.pay', ['invoice' => $donation->invoice_number]) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-md">
                        <i class="fas fa-sync-alt mr-2"></i> Cek Status Pembayaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Function to copy text to clipboard
    function copyToClipboard(text) {
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        
        // Show a temporary "Copied!" toast or notification
        alert('Berhasil disalin!');
    }
    
    // Countdown timer
    document.addEventListener('DOMContentLoaded', function() {
        const countdownEl = document.getElementById('countdown');
        let hours = 24;
        let minutes = 0;
        let seconds = 0;
        
        function updateCountdown() {
            if (hours === 0 && minutes === 0 && seconds === 0) {
                clearInterval(timer);
                location.reload(); // Refresh to check if payment expired
                return;
            }
            
            if (seconds === 0) {
                seconds = 59;
                if (minutes === 0) {
                    minutes = 59;
                    hours--;
                } else {
                    minutes--;
                }
            } else {
                seconds--;
            }
            
            countdownEl.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        const timer = setInterval(updateCountdown, 1000);
    });
</script>
@endsection
