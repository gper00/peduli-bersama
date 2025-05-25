@extends('dashboard.layout')

@section('title', 'Dokumentasi & Laporan | Peduli Bersama')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Dokumentasi & Laporan
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

    <!-- Statistics Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- Total Campaigns -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Total Kampanye
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ $campaigns->count() }}
                </p>
            </div>
        </div>
        
        <!-- Total Donasi -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Total Donasi
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    Rp {{ number_format($totalDonations, 0, ',', '.') }}
                </p>
            </div>
        </div>
        
        <!-- Total Donors -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Total Donatur
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ $totalDonors }}
                </p>
            </div>
        </div>
        
        <!-- Average Donation -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Rata-rata Donasi
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    Rp {{ $totalDonors > 0 ? number_format($totalDonations / $totalDonors, 0, ',', '.') : 0 }}
                </p>
            </div>
        </div>
    </div>

    <!-- Monthly Donation Chart -->
    <div class="p-4 bg-white rounded-lg shadow-md mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Donasi Bulanan</h3>
        <div class="relative" style="height: 300px;">
            <canvas id="monthlyDonationChart"></canvas>
        </div>
    </div>

    <!-- Campaign Reports -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700">Laporan Per Kampanye</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Kampanye</th>
                            <th class="px-4 py-3">Target</th>
                            <th class="px-4 py-3">Terkumpul</th>
                            <th class="px-4 py-3">Progress</th>
                            <th class="px-4 py-3">Donatur</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($campaignStats as $stat)
                        <tr class="text-gray-700 hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="{{ $stat['campaign']->featured_image ?: asset('images/default-campaign.jpg') }}" alt="{{ $stat['campaign']->title }}">
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ Str::limit($stat['campaign']->title, 30) }}</p>
                                        <p class="text-xs text-gray-600">{{ $stat['campaign']->end_date ? 'Berakhir: ' . \Carbon\Carbon::parse($stat['campaign']->end_date)->format('d M Y') : 'Tanpa batas waktu' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                Rp {{ number_format($stat['campaign']->target_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                Rp {{ number_format($stat['donations'], 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                        <div style="width: {{ min(100, round($stat['progress'])) }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                    </div>
                                    <div class="text-right mt-1 text-xs font-semibold text-gray-600">{{ round($stat['progress']) }}%</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $stat['donors'] }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('reports.campaign', $stat['campaign']->id) }}" class="px-2 py-1 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring">
                                        <i class="fas fa-chart-bar mr-1"></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                Tidak ada data kampanye yang tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Documentation Templates -->
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Template Laporan</h3>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-700">Laporan Keuangan Bulanan</p>
                            <p class="text-sm text-gray-600">Template Excel untuk laporan keuangan campaign</p>
                        </div>
                        <a href="{{ route('reports.template', 'financial') }}" class="px-3 py-1 text-xs font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fas fa-download mr-1"></i> Unduh
                        </a>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-700">Laporan Aktivitas Campaign</p>
                            <p class="text-sm text-gray-600">Template Word untuk laporan aktivitas campaign</p>
                        </div>
                        <a href="{{ route('reports.template', 'activity') }}" class="px-3 py-1 text-xs font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fas fa-download mr-1"></i> Unduh
                        </a>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-700">Surat Penggunaan Dana</p>
                            <p class="text-sm text-gray-600">Template PDF untuk surat penggunaan dana</p>
                        </div>
                        <a href="{{ route('reports.template', 'letter') }}" class="px-3 py-1 text-xs font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fas fa-download mr-1"></i> Unduh
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Panduan & Bantuan</h3>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 p-2 bg-blue-100 text-blue-500 rounded-full mr-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700">Panduan Pembuatan Laporan</p>
                            <p class="text-sm text-gray-600 mb-2">Panduan langkah-demi-langkah untuk membuat laporan yang efektif</p>
                            <a href="#" class="text-xs text-blue-600 hover:underline">Baca selengkapnya</a>
                        </div>
                    </div>
                    
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 p-2 bg-green-100 text-green-500 rounded-full mr-3">
                            <i class="fas fa-video"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700">Video Tutorial</p>
                            <p class="text-sm text-gray-600 mb-2">Video tutorial untuk membuat dokumentasi campaign</p>
                            <a href="#" class="text-xs text-blue-600 hover:underline">Tonton video</a>
                        </div>
                    </div>
                    
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 p-2 bg-purple-100 text-purple-500 rounded-full mr-3">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700">FAQ</p>
                            <p class="text-sm text-gray-600 mb-2">Pertanyaan yang sering diajukan tentang pelaporan</p>
                            <a href="#" class="text-xs text-blue-600 hover:underline">Lihat FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Donation Chart
        var ctx = document.getElementById('monthlyDonationChart').getContext('2d');
        var monthlyDonationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Donasi per Bulan (Rp)',
                    data: {!! json_encode($donationsByMonth) !!},
                    backgroundColor: 'rgba(66, 135, 245, 0.5)',
                    borderColor: 'rgba(66, 135, 245, 1)',
                    borderWidth: 1
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
