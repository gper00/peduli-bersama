@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran | Peduli Bersama')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                        <i class="fas fa-receipt text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">Konfirmasi Pembayaran</h1>
                    <p class="text-gray-600 mt-2">Silakan selesaikan pembayaran Anda</p>
                </div>

                <div class="border border-gray-200 rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Invoice</span>
                        <span class="text-sm font-medium">{{ $donation->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Menunggu Pembayaran
                        </span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Tanggal</span>
                        <span class="text-sm font-medium">{{ $donation->created_at->format('d M Y, H:i') }}</span>
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
                        <span class="text-sm font-medium">{{ $donation->donor_name }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Email</span>
                        <span class="text-sm font-medium">{{ $donation->donor_email }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 my-4"></div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-base font-medium text-gray-700">Total Pembayaran</span>
                        <span class="text-lg font-bold text-blue-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($donation->payment_method == 'bank_transfer')
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Instruksi Pembayaran</h3>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-700 mb-2">Silakan transfer ke rekening berikut:</p>
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">Bank</span>
                                <span class="text-sm font-medium">Bank Mandiri</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">Nomor Rekening</span>
                                <div class="flex items-center">
                                    <span class="text-sm font-medium mr-2">1234567890</span>
                                    <button class="text-blue-600 hover:text-blue-800" onclick="copyToClipboard('1234567890')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Atas Nama</span>
                                <span class="text-sm font-medium">Yayasan Peduli Bersama</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Mohon transfer tepat sampai 3 digit terakhir untuk memudahkan verifikasi
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <ol class="list-decimal list-inside text-sm text-gray-700 space-y-2 ml-2">
                        <li>Transfer sesuai dengan nominal yang tertera</li>
                        <li>Setelah transfer, sistem akan memverifikasi pembayaran Anda secara otomatis</li>
                        <li>Jika dalam 1x24 jam pembayaran belum terverifikasi, silakan kirim bukti pembayaran</li>
                    </ol>
                </div>
                @elseif($donation->payment_method == 'e_wallet')
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Instruksi Pembayaran E-Wallet</h3>
                    
                    <div class="mb-4 text-center">
                        <img src="https://via.placeholder.com/200" alt="QR Code" class="mx-auto mb-4">
                        <p class="text-sm text-gray-700">Scan QR code di atas menggunakan aplikasi e-wallet Anda</p>
                    </div>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Pastikan Anda melakukan pembayaran dalam waktu 15 menit
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($donation->payment_method == 'credit_card')
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Pembayaran Kartu Kredit</h3>
                    
                    <form id="creditCardForm" class="space-y-4">
                        <div>
                            <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kartu</label>
                            <input type="text" id="card_number" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="1234 5678 9012 3456">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kadaluarsa</label>
                                <input type="text" id="expiry_date" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="MM/YY">
                            </div>
                            <div>
                                <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input type="text" id="cvv" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="123">
                            </div>
                        </div>
                        
                        <div>
                            <label for="card_holder" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemegang Kartu</label>
                            <input type="text" id="card_holder" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="NAMA LENGKAP">
                        </div>
                        
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Informasi kartu kredit Anda aman dan dilindungi dengan enkripsi SSL
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endif

                <div class="flex flex-col space-y-4">
                    <button id="payNowBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md shadow-sm transition duration-300 flex items-center justify-center">
                        <i class="fas fa-credit-card mr-2"></i>
                        Bayar Sekarang
                    </button>
                    
                    <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="w-full text-center text-gray-700 hover:text-gray-900 font-medium py-3 px-6 rounded-md transition duration-300">
                        Kembali ke Halaman Campaign
                    </a>
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Butuh bantuan? <a href="#" class="text-blue-600 hover:underline">Hubungi Tim Kami</a>
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyToClipboard(text) {
        const tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        
        // Show a temporary notification
        const notification = document.createElement('div');
        notification.textContent = 'Disalin ke clipboard!';
        notification.style.position = 'fixed';
        notification.style.bottom = '20px';
        notification.style.left = '50%';
        notification.style.transform = 'translateX(-50%)';
        notification.style.padding = '10px 20px';
        notification.style.backgroundColor = '#10B981';
        notification.style.color = 'white';
        notification.style.borderRadius = '5px';
        notification.style.zIndex = '1000';
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 2000);
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const payNowBtn = document.getElementById('payNowBtn');
        
        payNowBtn.addEventListener('click', function() {
            // Simulate payment process
            payNowBtn.disabled = true;
            payNowBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
            
            setTimeout(function() {
                // Redirect to success page (in real implementation, this would happen after payment processing)
                window.location.href = "{{ route('public.paymentSuccess', $donation->invoice_number) }}";
            }, 2000);
        });
    });
</script>
@endsection
