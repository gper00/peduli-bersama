@extends('dashboard.layout')

@section('title', 'Detail Penarikan Dana | Peduli Bersama')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detail Penarikan Dana
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

    <!-- Withdrawal Detail Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-700">Informasi Penarikan Dana</h3>
                <div>
                    @if($withdrawal->status == 'completed')
                    <span class="px-3 py-1 text-sm font-medium leading-tight text-green-700 bg-green-100 rounded-full">
                        Selesai
                    </span>
                    @elseif($withdrawal->status == 'approved')
                    <span class="px-3 py-1 text-sm font-medium leading-tight text-blue-700 bg-blue-100 rounded-full">
                        Disetujui
                    </span>
                    @elseif($withdrawal->status == 'rejected')
                    <span class="px-3 py-1 text-sm font-medium leading-tight text-red-700 bg-red-100 rounded-full">
                        Ditolak
                    </span>
                    @else
                    <span class="px-3 py-1 text-sm font-medium leading-tight text-yellow-700 bg-yellow-100 rounded-full">
                        Menunggu
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-4">Informasi Penarikan</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kode Penarikan:</span>
                            <span class="font-semibold">{{ $withdrawal->withdrawal_code }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah:</span>
                            <span class="font-semibold">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Admin:</span>
                            <span class="font-semibold">Rp 5.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Diterima:</span>
                            <span class="font-semibold text-green-600">Rp {{ number_format($withdrawal->amount - 5000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Pengajuan:</span>
                            <span>{{ $withdrawal->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        @if($withdrawal->completed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Selesai:</span>
                            <span>{{ \Carbon\Carbon::parse($withdrawal->completed_at)->format('d M Y, H:i') }}</span>
                        </div>
                        @endif
                    </div>

                    <h4 class="text-md font-semibold text-gray-700 mt-6 mb-4">Informasi Kampanye</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Kampanye:</span>
                            <span class="font-semibold">{{ $withdrawal->campaign->title }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Penggalang Dana:</span>
                            <span>{{ $withdrawal->campaign->user->name }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-4">Informasi Rekening</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bank:</span>
                            <span>{{ $withdrawal->bank_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nomor Rekening:</span>
                            <span>{{ $withdrawal->account_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Pemilik:</span>
                            <span>{{ $withdrawal->account_name }}</span>
                        </div>
                    </div>

                    <h4 class="text-md font-semibold text-gray-700 mt-6 mb-4">Catatan</h4>
                    <p class="text-gray-700">{{ $withdrawal->note ?: 'Tidak ada catatan' }}</p>

                    @if($withdrawal->admin_note)
                    <h4 class="text-md font-semibold text-gray-700 mt-6 mb-4">Catatan Admin</h4>
                    <p class="text-gray-700">{{ $withdrawal->admin_note }}</p>
                    @endif
                </div>
            </div>
            
            <!-- Admin Action Buttons -->
            @if(auth()->user()->role === 'admin' && $withdrawal->status === 'pending')
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h4 class="text-md font-semibold text-gray-700 mb-4">Tindakan Admin</h4>
                <div class="flex space-x-4">
                    <form action="{{ route('withdrawals.update-status', $withdrawal->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-md active:bg-green-600 hover:bg-green-700 focus:outline-none focus:ring">
                            <i class="fas fa-check mr-2"></i> Setujui
                        </button>
                    </form>
                    
                    <button type="button" id="rejectBtn" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md active:bg-red-600 hover:bg-red-700 focus:outline-none focus:ring">
                        <i class="fas fa-times mr-2"></i> Tolak
                    </button>
                </div>
                
                <!-- Rejection Modal (Hidden by default) -->
                <div id="rejectionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Tolak Penarikan Dana</h3>
                        <form action="{{ route('withdrawals.update-status', $withdrawal->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            
                            <div class="mb-4">
                                <label for="admin_note" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                                <textarea name="admin_note" id="admin_note" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required></textarea>
                            </div>
                            
                            <div class="flex justify-end space-x-3">
                                <button type="button" id="cancelBtn" class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-md active:bg-gray-50 hover:bg-gray-50 focus:outline-none focus:ring">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md active:bg-red-600 hover:bg-red-700 focus:outline-none focus:ring">
                                    Tolak Penarikan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Complete Withdrawal Button (For Admin with Approved status) -->
            @if(auth()->user()->role === 'admin' && $withdrawal->status === 'approved')
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h4 class="text-md font-semibold text-gray-700 mb-4">Tindakan Admin</h4>
                <form action="{{ route('withdrawals.update-status', $withdrawal->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="completed">
                    <div class="mb-4">
                        <label for="admin_note" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                        <textarea name="admin_note" id="admin_note" rows="2" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-md active:bg-green-600 hover:bg-green-700 focus:outline-none focus:ring">
                        <i class="fas fa-check-double mr-2"></i> Tandai Selesai
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>

    <!-- Timeline Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Riwayat Status</h3>
        </div>
        <div class="p-6">
            <div class="relative">
                <!-- Vertical Line -->
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <div class="space-y-6">
                    <!-- Created Status -->
                    <div class="relative flex items-start">
                        <div class="absolute left-0 mt-1 flex items-center justify-center w-10 h-10">
                            <div class="w-3.5 h-3.5 bg-blue-500 rounded-full"></div>
                        </div>
                        <div class="ml-14">
                            <p class="font-medium text-gray-800">Penarikan Dana Diajukan</p>
                            <p class="text-sm text-gray-600">{{ $withdrawal->created_at->format('d M Y, H:i') }}</p>
                            <p class="mt-1 text-sm text-gray-700">
                                {{ $withdrawal->user->name }} mengajukan penarikan dana sebesar Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Status Updates -->
                    @if($withdrawal->status !== 'pending')
                    <div class="relative flex items-start">
                        <div class="absolute left-0 mt-1 flex items-center justify-center w-10 h-10">
                            <div class="w-3.5 h-3.5 {{ $withdrawal->status === 'rejected' ? 'bg-red-500' : 'bg-green-500' }} rounded-full"></div>
                        </div>
                        <div class="ml-14">
                            <p class="font-medium text-gray-800">
                                Penarikan Dana {{ $withdrawal->status === 'approved' ? 'Disetujui' : ($withdrawal->status === 'completed' ? 'Selesai' : 'Ditolak') }}
                            </p>
                            <p class="text-sm text-gray-600">{{ $withdrawal->updated_at->format('d M Y, H:i') }}</p>
                            @if($withdrawal->status === 'rejected')
                            <p class="mt-1 text-sm text-gray-700">
                                Admin menolak penarikan dana dengan alasan: {{ $withdrawal->admin_note ?: 'Tidak ada alasan yang diberikan' }}.
                            </p>
                            @elseif($withdrawal->status === 'approved')
                            <p class="mt-1 text-sm text-gray-700">
                                Admin menyetujui penarikan dana dan akan memproses transfernya.
                            </p>
                            @elseif($withdrawal->status === 'completed')
                            <p class="mt-1 text-sm text-gray-700">
                                Dana telah ditransfer ke rekening {{ $withdrawal->bank_name }} {{ $withdrawal->account_number }} atas nama {{ $withdrawal->account_name }}.
                            </p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Rejection Modal
        const rejectBtn = document.getElementById('rejectBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const rejectionModal = document.getElementById('rejectionModal');
        
        if (rejectBtn && cancelBtn && rejectionModal) {
            rejectBtn.addEventListener('click', function() {
                rejectionModal.classList.remove('hidden');
            });
            
            cancelBtn.addEventListener('click', function() {
                rejectionModal.classList.add('hidden');
            });
        }
    });
</script>
@endsection
