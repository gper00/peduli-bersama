@extends('dashboard.layout')

@section('title', 'Kelola Donasi | Peduli Bersama')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Kelola Donasi
    </h2>

    <!-- Filter Form -->
    <div class="mb-6 p-4 bg-white rounded-lg shadow-md">
        <h4 class="mb-4 font-semibold text-gray-600">Filter Donasi</h4>
        <form action="{{ route('dashboard.donations.index') }}" method="GET" class="grid gap-4 md:grid-cols-4">
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
            
            @if(auth()->user()->isAdmin())
            <div>
                <label class="block text-sm mb-1">Campaign</label>
                <select name="campaign_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400">
                    <option value="">Semua Campaign</option>
                    @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}" {{ request('campaign_id') == $campaign->id ? 'selected' : '' }}>{{ $campaign->title }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            
            <div>
                <label class="block text-sm mb-1">Tanggal Mulai</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            
            <div>
                <label class="block text-sm mb-1">Tanggal Akhir</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            
            <div class="md:col-span-4 flex justify-end">
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('dashboard.donations.index') }}" class="ml-2 px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-md active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300">
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
                    <p class="text-lg font-semibold text-gray-700">{{ $donations->where('status', 'success')->count() }}</p>
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
                    <p class="text-lg font-semibold text-gray-700">{{ $donations->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Donation List -->
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Donatur</th>
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
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{ $donation->getDonorNameAttribute() }}</p>
                                    <p class="text-xs text-gray-600">{{ $donation->donor_email ?? ($donation->user ? $donation->user->email : 'Email tidak tersedia') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="text-blue-600 hover:underline" target="_blank">
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
                                
                                @if(auth()->user()->isAdmin())
                                <form action="{{ route('dashboard.donations.updateStatus', $donation->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="success">
                                    <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Konfirmasi donasi ini sebagai berhasil?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('dashboard.donations.updateStatus', $donation->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="failed">
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tandai donasi ini sebagai gagal?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
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
                        <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                            Tidak ada data donasi yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 py-3 bg-white border-t">
            {{ $donations->links() }}
        </div>
    </div>
</div>
@endsection
