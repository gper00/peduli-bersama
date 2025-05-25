@extends('dashboard.layout')

@section('title', 'Tarik Dana | Peduli Bersama')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Form Penarikan Dana
        </h2>
        <a href="{{ route('withdrawals.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Notification Messages -->
    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-50 text-green-800 rounded-lg shadow-md">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 px-4 py-3 bg-red-50 text-red-800 rounded-lg shadow-md">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Withdrawal Form -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Form Penarikan Dana</h3>
        </div>
        <div class="p-6">
            @if($campaigns->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-wallet text-5xl mb-4"></i>
                <p class="text-lg font-medium">Tidak Ada Dana Tersedia</p>
                <p class="text-sm">Saat ini tidak ada dana yang tersedia untuk ditarik dari kampanye Anda.</p>
            </div>
            @else
            <form action="{{ route('withdrawals.store') }}" method="POST">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="campaign_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kampanye</label>
                        <select name="campaign_id" id="campaign_id" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Kampanye --</option>
                            @foreach($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" data-available="{{ $campaign->available_funds }}">
                                {{ $campaign->title }} (Tersedia: Rp {{ number_format($campaign->available_funds, 0, ',', '.') }})
                            </option>
                            @endforeach
                        </select>
                        @error('campaign_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Penarikan</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="amount" id="amount" min="10000" step="1000" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md" placeholder="0" required>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Minimal penarikan: Rp 10.000</p>
                        <p id="available-message" class="mt-1 text-xs text-blue-600 hidden">Dana tersedia: <span id="available-amount">0</span></p>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                        <select name="bank_name" id="bank_name" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Bank --</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BRI">BRI</option>
                            <option value="BNI">BNI</option>
                            <option value="CIMB Niaga">CIMB Niaga</option>
                            <option value="BSI">BSI</option>
                            <option value="BTN">BTN</option>
                            <option value="Permata">Permata</option>
                            <option value="Danamon">Danamon</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('bank_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                        <input type="text" name="account_number" id="account_number" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                        @error('account_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="account_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                        <input type="text" name="account_name" id="account_name" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                        <p class="mt-1 text-xs text-gray-500">Harus sesuai dengan nama di buku tabungan/rekening</p>
                        @error('account_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                        <textarea name="note" id="note" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                        @error('note')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-md mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-800">Informasi Penarikan</h3>
                            <div class="mt-2 text-sm text-gray-600">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Biaya administrasi sebesar Rp 5.000 akan dikenakan untuk setiap penarikan.</li>
                                    <li>Proses penarikan akan membutuhkan waktu 1-3 hari kerja setelah disetujui.</li>
                                    <li>Pastikan data rekening yang Anda masukkan sudah benar.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center mb-4">
                    <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        Saya menyetujui <a href="#" class="text-blue-600 hover:underline">syarat dan ketentuan</a> penarikan dana di Peduli Bersama
                    </label>
                </div>
                
                <div>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
                        <i class="fas fa-money-bill-wave mr-2"></i> Tarik Dana
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>

    <!-- Withdrawal Info -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Panduan Penarikan Dana</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex items-center justify-center flex-shrink-0 h-8 w-8 bg-blue-100 text-blue-500 rounded-full mr-3">
                        <span class="text-sm font-bold">1</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Pilih Kampanye</p>
                        <p class="text-sm text-gray-600 mt-1">
                            Pilih kampanye yang memiliki dana tersedia untuk ditarik. Dana yang tersedia adalah total donasi 
                            yang sudah berhasil dikurangi dengan total penarikan sebelumnya.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex items-center justify-center flex-shrink-0 h-8 w-8 bg-blue-100 text-blue-500 rounded-full mr-3">
                        <span class="text-sm font-bold">2</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Tentukan Jumlah</p>
                        <p class="text-sm text-gray-600 mt-1">
                            Masukkan jumlah dana yang ingin ditarik. Minimal penarikan adalah Rp 10.000 dan tidak boleh melebihi
                            dana yang tersedia di kampanye tersebut.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex items-center justify-center flex-shrink-0 h-8 w-8 bg-blue-100 text-blue-500 rounded-full mr-3">
                        <span class="text-sm font-bold">3</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Masukkan Data Rekening</p>
                        <p class="text-sm text-gray-600 mt-1">
                            Masukkan data rekening bank yang akan digunakan untuk menerima dana. Pastikan nama pemilik rekening
                            sesuai dengan nama yang terdaftar di akun Anda.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex items-center justify-center flex-shrink-0 h-8 w-8 bg-blue-100 text-blue-500 rounded-full mr-3">
                        <span class="text-sm font-bold">4</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Tunggu Persetujuan</p>
                        <p class="text-sm text-gray-600 mt-1">
                            Setelah mengajukan penarikan dana, tunggu persetujuan dari admin. Anda akan mendapatkan notifikasi
                            jika permintaan penarikan dana Anda telah disetujui.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const campaignSelect = document.getElementById('campaign_id');
        const amountInput = document.getElementById('amount');
        const availableMessage = document.getElementById('available-message');
        const availableAmount = document.getElementById('available-amount');
        
        // Tampilkan dana tersedia saat kampanye dipilih
        campaignSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const available = parseInt(selectedOption.getAttribute('data-available'));
                availableAmount.textContent = 'Rp ' + available.toLocaleString('id-ID');
                availableMessage.classList.remove('hidden');
                
                // Set maksimum jumlah penarikan
                amountInput.setAttribute('max', available);
            } else {
                availableMessage.classList.add('hidden');
                amountInput.removeAttribute('max');
            }
        });
        
        // Validasi jumlah penarikan tidak melebihi dana tersedia
        amountInput.addEventListener('input', function() {
            const selectedOption = campaignSelect.options[campaignSelect.selectedIndex];
            if (selectedOption.value) {
                const available = parseInt(selectedOption.getAttribute('data-available'));
                if (parseInt(this.value) > available) {
                    this.setCustomValidity('Jumlah penarikan tidak boleh melebihi dana tersedia');
                } else {
                    this.setCustomValidity('');
                }
            }
        });
    });
</script>
@endsection
