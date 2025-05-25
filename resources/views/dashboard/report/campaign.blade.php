@extends('dashboard.layout')

@section('title', 'Laporan Kampanye: ' . $campaign->title . ' | Peduli Bersama')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Laporan Kampanye: {{ $campaign->title }}
        </h2>
        <a href="{{ route('reports.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
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

    <!-- Campaign Info -->
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Informasi Kampanye</h3>
            </div>
            <div class="p-6">
                <div class="flex items-start mb-6">
                    <img src="{{ $campaign->featured_image ?: asset('images/default-campaign.jpg') }}" alt="{{ $campaign->title }}" class="w-24 h-24 object-cover rounded-md mr-4">
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">{{ $campaign->title }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $campaign->short_description }}</p>
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <span>Penggalang: {{ $campaign->user->name }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $campaign->category->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Target Donasi</span>
                        <p class="text-lg font-bold text-gray-800">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Terkumpul</span>
                        <p class="text-lg font-bold text-blue-600">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Tanggal Mulai</span>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($campaign->created_at)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Tanggal Berakhir</span>
                        <p class="text-gray-800">{{ $campaign->end_date ? \Carbon\Carbon::parse($campaign->end_date)->format('d M Y') : 'Tanpa batas waktu' }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500">Progress</span>
                    <div class="mt-2 relative pt-1">
                        <div class="overflow-hidden h-4 text-xs flex rounded bg-blue-200">
                            <div style="width: {{ min(100, round(($campaign->current_amount / $campaign->target_amount) * 100)) }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                {{ min(100, round(($campaign->current_amount / $campaign->target_amount) * 100)) }}%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <p class="text-2xl font-bold text-gray-800">{{ $donations->count() }}</p>
                        <p class="text-xs text-gray-500">Total Donasi</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <p class="text-2xl font-bold text-gray-800">{{ $donations->groupBy('donor_email')->count() }}</p>
                        <p class="text-xs text-gray-500">Jumlah Donatur</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <p class="text-2xl font-bold text-gray-800">{{ $donations->count() > 0 ? 'Rp ' . number_format($donations->avg('amount'), 0, ',', '.') : 'Rp 0' }}</p>
                        <p class="text-xs text-gray-500">Rata-rata Donasi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Donation Chart -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Grafik Donasi Mingguan</h3>
            </div>
            <div class="p-6">
                <div class="relative" style="height: 300px;">
                    <canvas id="weeklyDonationChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation List -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Daftar Donasi</h3>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">Donatur</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Pesan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($donations as $donation)
                    <tr class="text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{ $donation->getDonorNameAttribute() }}</p>
                                    <p class="text-xs text-gray-600">{{ $donation->donor_email ?? ($donation->user ? $donation->user->email : 'Email tidak tersedia') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold">
                            Rp {{ number_format($donation->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $donation->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $donation->message ?: '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                            Belum ada donasi untuk kampanye ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Upload Documentation -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Unggah Dokumentasi</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('reports.upload', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Dokumentasi</label>
                        <input type="text" name="title" id="title" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File</label>
                        <input type="file" name="file" id="file" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                        <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX, JPG, JPEG, PNG (Max: 10MB)</p>
                        @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
                        <i class="fas fa-upload mr-2"></i> Unggah Dokumentasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Documentation List -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Dokumentasi Terkini</h3>
        </div>
        <div class="p-6">
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-folder-open text-5xl mb-4"></i>
                <p class="text-lg font-medium">Belum ada dokumentasi</p>
                <p class="text-sm">Unggah dokumentasi pertama Anda dengan menggunakan form di atas.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Weekly Donation Chart
        var ctx = document.getElementById('weeklyDonationChart').getContext('2d');
        var weeklyDonationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($weeks) !!},
                datasets: [{
                    label: 'Donasi per Minggu (Rp)',
                    data: {!! json_encode($weeklyDonations) !!},
                    backgroundColor: 'rgba(66, 135, 245, 0.2)',
                    borderColor: 'rgba(66, 135, 245, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(66, 135, 245, 1)',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
