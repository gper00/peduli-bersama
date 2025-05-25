@extends('dashboard.layout')

@section('title', 'Penarikan Dana | Peduli Bersama')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Penarikan Dana
        </h2>
        <a href="{{ route('withdrawals.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
            <i class="fas fa-plus mr-2"></i> Tarik Dana
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

    <!-- Available Funds Card -->
    <div class="mb-8 p-4 bg-white rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Dana Tersedia untuk Penarikan
                </p>
                <p class="text-2xl font-bold text-green-600">
                    Rp {{ number_format($availableFunds, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Withdrawals Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Riwayat Penarikan Dana</h3>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Kampanye</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Bank</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($withdrawals as $withdrawal)
                    <tr class="text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm font-medium">
                            {{ $withdrawal->withdrawal_code }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{ Str::limit($withdrawal->campaign->title, 30) }}</p>
                                    <p class="text-xs text-gray-600">{{ $withdrawal->campaign->user->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold">
                            Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $withdrawal->bank_name }} - {{ $withdrawal->account_number }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @if($withdrawal->status == 'completed')
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Selesai
                            </span>
                            @elseif($withdrawal->status == 'approved')
                            <span class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full">
                                Disetujui
                            </span>
                            @elseif($withdrawal->status == 'rejected')
                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">
                                Ditolak
                            </span>
                            @else
                            <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full">
                                Menunggu
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $withdrawal->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('withdrawals.show', $withdrawal->id) }}" class="text-blue-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                            Belum ada riwayat penarikan dana.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($withdrawals->hasPages())
        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
            {{ $withdrawals->links() }}
        </div>
        @endif
    </div>

    <!-- Withdrawal Info -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Informasi Penarikan Dana</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 p-2 bg-blue-100 text-blue-500 rounded-full mr-3">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Syarat Penarikan Dana</p>
                        <ul class="list-disc pl-5 mt-2 text-sm text-gray-600 space-y-1">
                            <li>Minimal penarikan dana adalah Rp 10.000</li>
                            <li>Pastikan data rekening bank yang dimasukkan sudah benar</li>
                            <li>Penarikan dana akan diproses dalam 1-3 hari kerja</li>
                            <li>Biaya administrasi sebesar Rp 5.000 akan dikenakan untuk setiap penarikan</li>
                        </ul>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 p-2 bg-yellow-100 text-yellow-500 rounded-full mr-3">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Perhatian</p>
                        <p class="text-sm text-gray-600 mt-2">
                            Pastikan nama pemilik rekening sesuai dengan nama penggalang dana yang terdaftar. 
                            Jika berbeda, maka penarikan dana tidak akan diproses.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 p-2 bg-green-100 text-green-500 rounded-full mr-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Status Penarikan Dana</p>
                        <ul class="list-disc pl-5 mt-2 text-sm text-gray-600 space-y-1">
                            <li><span class="font-medium text-yellow-600">Menunggu</span> - Permintaan penarikan dana sedang ditinjau oleh admin</li>
                            <li><span class="font-medium text-blue-600">Disetujui</span> - Permintaan penarikan dana telah disetujui dan sedang diproses</li>
                            <li><span class="font-medium text-green-600">Selesai</span> - Dana telah ditransfer ke rekening bank yang dituju</li>
                            <li><span class="font-medium text-red-600">Ditolak</span> - Permintaan penarikan dana ditolak oleh admin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
