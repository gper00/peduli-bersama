@extends('dashboard.layout')

@section('title', 'Detail Donasi | Peduli Bersama')

@section('page-content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detail Donasi
        </h2>
        <a href="{{ route('dashboard.donations.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
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

    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <!-- Donation Details -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Informasi Donasi</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <span class="text-sm font-medium text-gray-500">Invoice Number</span>
                        <p class="text-lg font-semibold text-gray-800 mt-1">{{ $donation->invoice_number }}</p>
                    </div>

                    <div>
                        <span class="text-sm font-medium text-gray-500">Status</span>
                        <p class="mt-1">
                            @if($donation->status == 'success')
                            <span class="px-2 py-1 font-semibold text-sm leading-tight text-green-700 bg-green-100 rounded-full">
                                Berhasil
                            </span>
                            @elseif($donation->status == 'pending')
                            <span class="px-2 py-1 font-semibold text-sm leading-tight text-yellow-700 bg-yellow-100 rounded-full">
                                Menunggu
                            </span>
                            @elseif($donation->status == 'processing')
                            <span class="px-2 py-1 font-semibold text-sm leading-tight text-blue-700 bg-blue-100 rounded-full">
                                Diproses
                            </span>
                            @elseif($donation->status == 'failed')
                            <span class="px-2 py-1 font-semibold text-sm leading-tight text-red-700 bg-red-100 rounded-full">
                                Gagal
                            </span>
                            @elseif($donation->status == 'expired')
                            <span class="px-2 py-1 font-semibold text-sm leading-tight text-gray-700 bg-gray-100 rounded-full">
                                Kedaluwarsa
                            </span>
                            @elseif($donation->status == 'refunded')
                            <span class="px-2 py-1 font-semibold text-sm leading-tight text-purple-700 bg-purple-100 rounded-full">
                                Dikembalikan
                            </span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <span class="text-sm font-medium text-gray-500">Tanggal Donasi</span>
                        <p class="text-gray-800 mt-1">{{ $donation->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <span class="text-sm font-medium text-gray-500">Metode Pembayaran</span>
                        <p class="text-gray-800 mt-1">{{ ucwords(str_replace('_', ' ', $donation->payment_method)) }}</p>
                    </div>

                    <div>
                        <span class="text-sm font-medium text-gray-500">Tanggal Pembayaran</span>
                        <p class="text-gray-800 mt-1">{{ $donation->payment_date ? $donation->payment_date->format('d M Y, H:i') : '-' }}</p>
                    </div>

                    <div class="col-span-2">
                        <span class="text-sm font-medium text-gray-500">Jumlah Donasi</span>
                        <p class="text-xl font-bold text-blue-600 mt-1">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                    </div>

                    @if($donation->transaction_id)
                    <div class="col-span-2">
                        <span class="text-sm font-medium text-gray-500">ID Transaksi</span>
                        <p class="text-gray-800 mt-1">{{ $donation->transaction_id }}</p>
                    </div>
                    @endif

                    @if($donation->payment_code)
                    <div class="col-span-2">
                        <span class="text-sm font-medium text-gray-500">Kode Pembayaran</span>
                        <p class="text-gray-800 mt-1">{{ $donation->payment_code }}</p>
                    </div>
                    @endif

                    @if($donation->message)
                    <div class="col-span-2">
                        <span class="text-sm font-medium text-gray-500">Pesan</span>
                        <p class="text-gray-800 mt-1 italic">{{ $donation->message }}</p>
                    </div>
                    @endif
                </div>

                @if(auth()->user()->isAdmin() && $donation->status == 'pending')
                <div class="mt-6 border-t border-gray-200 pt-4 flex space-x-2">
                    <form action="{{ route('dashboard.donations.updateStatus', $donation->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="success">
                        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-md active:bg-green-600 hover:bg-green-700 focus:outline-none focus:ring" onclick="return confirm('Konfirmasi donasi ini sebagai berhasil?')">
                            <i class="fas fa-check-circle mr-2"></i> Konfirmasi Pembayaran
                        </button>
                    </form>

                    <form action="{{ route('dashboard.donations.updateStatus', $donation->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="failed">
                        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md active:bg-red-600 hover:bg-red-700 focus:outline-none focus:ring" onclick="return confirm('Tandai donasi ini sebagai gagal?')">
                            <i class="fas fa-times-circle mr-2"></i> Tandai Gagal
                        </button>
                    </form>
                </div>
                @endif

                @if($donation->status == 'success')
                <div class="mt-6 border-t border-gray-200 pt-4">
                    <a href="{{ route('dashboard.donations.receipt', $donation->id) }}" target="_blank" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
                        <i class="fas fa-file-invoice mr-2"></i> Lihat Kuitansi
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Donor and Campaign Information -->
        <div class="space-y-6">
            <!-- Donor Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700">Informasi Donatur</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <span class="text-sm font-medium text-gray-500">Nama</span>
                            <p class="text-gray-800 font-semibold mt-1">
                                {{ $donation->getDonorNameAttribute() }}
                                @if($donation->is_anonymous)
                                <span class="ml-2 px-2 py-1 text-xs font-medium leading-tight text-gray-700 bg-gray-100 rounded-full">
                                    Donasi Anonim
                                </span>
                                @endif
                            </p>
                        </div>

                        <div class="col-span-2">
                            <span class="text-sm font-medium text-gray-500">Email</span>
                            <p class="text-gray-800 mt-1">{{ $donation->donor_email ?? ($donation->user ? $donation->user->email : 'Email tidak tersedia') }}</p>
                        </div>

                        @if($donation->donor_phone)
                        <div class="col-span-2">
                            <span class="text-sm font-medium text-gray-500">Nomor Telepon</span>
                            <p class="text-gray-800 mt-1">{{ $donation->donor_phone }}</p>
                        </div>
                        @endif

                        @if($donation->user_id)
                        <div class="col-span-2">
                            <span class="text-sm font-medium text-gray-500">Akun Terkait</span>
                            <p class="text-blue-600 mt-1">
                                <a href="{{ route('dashboard.users.show', $donation->user_id) }}" class="hover:underline">
                                    {{ $donation->user->name }} ({{ $donation->user->email }})
                                </a>
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Campaign Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700">Informasi Campaign</h3>
                </div>
                <div class="p-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Kampanye:</label>
                                <div class="d-flex align-items-center mt-2">
                            @if($donation->campaign->cover_image)
                                    <img src="{{ $donation->campaign->cover_image }}" alt="{{ $donation->campaign->title }}" class="img-thumbnail mr-3" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                    <img src="{{ asset('storage/default/image.jpg') }}" alt="{{ $donation->campaign->title }}" class="img-thumbnail mr-3" style="width: 100px; height: 100px; object-fit: cover;">
                            @endif
                        <div>
                                        <h5 class="mb-1">
                                            <a href="{{ route('public.campaign', $donation->campaign->slug) }}" class="text-primary" target="_blank">
                                    {{ $donation->campaign->title }}
                                </a>
                                        </h5>
                                        <p class="text-muted mb-0">{{ Str::limit($donation->campaign->short_description, 100) }}</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction History -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Riwayat Transaksi</h3>
        </div>
        <div class="p-6">
            <div class="relative">
                <div class="border-l-2 border-gray-200 ml-3 space-y-6">
                    <div class="relative flex items-start">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 absolute -left-3">
                            <i class="fas fa-plus-circle text-sm"></i>
                        </div>
                        <div class="ml-6">
                            <p class="text-sm font-medium text-gray-800">Donasi Dibuat</p>
                            <p class="text-xs text-gray-500">{{ $donation->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    @if($donation->status != 'pending')
                    <div class="relative flex items-start">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full
                            {{ $donation->status == 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}
                            absolute -left-3">
                            <i class="fas {{ $donation->status == 'success' ? 'fa-check-circle' : 'fa-times-circle' }} text-sm"></i>
                        </div>
                        <div class="ml-6">
                            <p class="text-sm font-medium text-gray-800">
                                {{ $donation->status == 'success' ? 'Pembayaran Berhasil' : 'Pembayaran Gagal' }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $donation->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($donation->status == 'refunded')
                    <div class="relative flex items-start">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-purple-100 text-purple-600 absolute -left-3">
                            <i class="fas fa-undo-alt text-sm"></i>
                        </div>
                        <div class="ml-6">
                            <p class="text-sm font-medium text-gray-800">Dana Dikembalikan</p>
                            <p class="text-xs text-gray-500">{{ $donation->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
