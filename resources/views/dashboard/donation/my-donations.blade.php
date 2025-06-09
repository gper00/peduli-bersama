@extends('dashboard.layout')

@section('title', 'Donasi Saya | Peduli Bersama')

@section('page-content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Donasi Saya
    </h2>

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

    <!-- Filter Form -->
    <div class="mb-6 p-4 bg-white rounded-lg shadow-md">
        <h4 class="mb-4 font-semibold text-gray-600">Filter Donasi</h4>
        <form action="{{ route('dashboard.donations.my') }}" method="GET" class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Berhasil</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Kedaluwarsa</option>
                    <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm mb-1">Tanggal Mulai</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            
            <div>
                <label class="block text-sm mb-1">Tanggal Akhir</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            
            <div class="md:col-span-3 flex justify-end">
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('dashboard.donations.my') }}" class="ml-2 px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-md active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300">
                    <i class="fas fa-sync mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>
    
    <!-- Statistics -->
    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <div class="p-4 bg-white rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <i class="fas fa-hand-holding-usd text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Donasi</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $donations->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="p-4 bg-white rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Donasi Berhasil</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $successfulDonations }}</p>
                </div>
            </div>
        </div>
        
        <div class="p-4 bg-white rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Menunggu Pembayaran</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $pendingDonations }}</p>
                </div>
            </div>
        </div>
    </div>
        
    @if($totalDonated > 0)
    <div class="p-4 bg-white rounded-lg shadow-md mb-8">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                <i class="fas fa-money-bill-wave text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Donasi Berhasil</p>
                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($totalDonated, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Donation List -->
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Campaign</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($donations as $donation)
                    <tr class="text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="text-sm font-semibold">{{ $donation->invoice_number }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="text-blue-600 hover:text-blue-900">
                                {{ Str::limit($donation->campaign->title, 30) }}
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold">
                            Rp {{ number_format($donation->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @if($donation->status == 'success')
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Berhasil
                            </span>
                            @elseif($donation->status == 'pending')
                            <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full">
                                Menunggu
                            </span>
                            @elseif($donation->status == 'processing')
                            <span class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full">
                                Diproses
                            </span>
                            @elseif($donation->status == 'failed')
                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">
                                Gagal
                            </span>
                            @elseif($donation->status == 'expired')
                            <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full">
                                Kedaluwarsa
                            </span>
                            @elseif($donation->status == 'refunded')
                            <span class="px-2 py-1 font-semibold leading-tight text-purple-700 bg-purple-100 rounded-full">
                                Dikembalikan
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $donation->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('dashboard.donations.show', $donation->id) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($donation->status == 'pending')
                                <a href="{{ route('donation.pay', $donation->invoice_number) }}" class="text-yellow-600 hover:text-yellow-900" target="_blank">
                                    <i class="fas fa-credit-card"></i>
                                </a>
                                @endif
                                
                                @if($donation->status == 'success')
                                <a href="{{ route('dashboard.donations.receipt', $donation->id) }}" class="text-gray-600 hover:text-gray-900" target="_blank">
                                    <i class="fas fa-file-invoice"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                            Anda belum memiliki riwayat donasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 py-3 bg-white border-t">
            {{ $donations->appends(request()->except('page'))->links() }}
        </div>
    </div>
        
    <div class="mt-8 p-6 bg-blue-50 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Mulai Berdonasi</h3>
        <p class="text-gray-600 mb-4">Anda dapat membantu lebih banyak orang dengan berdonasi ke campaign-campaign yang sedang aktif.</p>
        <a href="{{ route('public.campaigns') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
            <i class="fas fa-hand-holding-heart mr-2"></i> Lihat Campaign
        </a>
    </div>
</div>
@endsection
