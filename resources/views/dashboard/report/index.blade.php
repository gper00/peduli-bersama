@extends('dashboard.layout')

@section('title', 'Dokumentasi & Laporan | Peduli Bersama')

<!-- Custom styles for this page -->
@include('dashboard.report.styles')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dokumentasi & Laporan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.reports.index') }}">Dokumentasi & Laporan</a>
                </li>
            </ul>
        </div>

        <!-- Notification Messages -->
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <i class="fa fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
        @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Campaigns Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-primary">
                                <i class="fa fa-bullhorn"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Total Kampanye</p>
                                <h4 class="card-title">{{ $campaigns->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Donations Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-success">
                                <i class="fa fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Total Donasi</p>
                                <h4 class="card-title">Rp {{ number_format($totalDonations, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Donors Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Total Donatur</p>
                                <h4 class="card-title">{{ $totalDonors }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Donation Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-danger">
                                <i class="fa fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Rata-rata Donasi</p>
                                <h4 class="card-title">Rp {{ $totalDonors > 0 ? number_format($totalDonations / $totalDonors, 0, ',', '.') : 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Donation Chart -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Donasi Bulanan</h4>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="monthlyDonationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaign Reports -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Laporan Per Kampanye</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kampanye</th>
                                    <th>Target</th>
                                    <th>Terkumpul</th>
                                    <th>Progress</th>
                                    <th>Donatur</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($campaignStats as $stat)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                @if($stat['campaign']->cover_image)
                                                <img class="rounded-circle" width="40" height="40" src="{{ asset('storage/' . $stat['campaign']->cover_image) }}" alt="{{ $stat['campaign']->title }}">
                                                @else
                                                <img class="rounded-circle" width="40" height="40" src="{{ asset('storage/default/image.jpg') }}" alt="{{ $stat['campaign']->title }}">
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-weight-bold mb-0">{{ Str::limit($stat['campaign']->title, 30) }}</p>
                                                <small class="text-muted">{{ $stat['campaign']->end_date ? 'Berakhir: ' . \Carbon\Carbon::parse($stat['campaign']->end_date)->format('d M Y') : 'Tanpa batas waktu' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Rp {{ number_format($stat['campaign']->target_amount, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($stat['donations'], 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min(100, round($stat['progress'])) }}%" aria-valuenow="{{ round($stat['progress']) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted text-right d-block">{{ round($stat['progress']) }}%</small>
                                    </td>
                                    <td>
                                        {{ $stat['donors'] }}
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.reports.campaign', $stat['campaign']->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-chart-bar mr-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Tidak ada data kampanye yang tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentation Templates -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Template Laporan</h4>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Laporan Keuangan Bulanan</h6>
                                    <small class="text-muted">Template Excel untuk laporan keuangan campaign</small>
                                </div>
                                <a href="{{ route('dashboard.reports.template', 'financial') }}" class="btn btn-outline-primary btn-sm btn-download-template" data-template-name="Laporan Keuangan Bulanan">
                                    <i class="fas fa-download mr-1"></i> Unduh
                                </a>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Laporan Aktivitas Campaign</h6>
                                    <small class="text-muted">Template Word untuk laporan aktivitas campaign</small>
                                </div>
                                <a href="{{ route('dashboard.reports.template', 'activity') }}" class="btn btn-outline-primary btn-sm btn-download-template" data-template-name="Laporan Aktivitas Campaign">
                                    <i class="fas fa-download mr-1"></i> Unduh
                                </a>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Surat Penggunaan Dana</h6>
                                    <small class="text-muted">Template PDF untuk surat penggunaan dana</small>
                                </div>
                                <a href="{{ route('dashboard.reports.template', 'letter') }}" class="btn btn-outline-primary btn-sm btn-download-template" data-template-name="Surat Penggunaan Dana">
                                    <i class="fas fa-download mr-1"></i> Unduh
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Panduan & Bantuan</h4>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-book text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-1">Panduan Pembuatan Laporan</h6>
                                    <p class="text-muted mb-1">Panduan langkah-demi-langkah untuk membuat laporan yang efektif</p>
                                    <a href="#" class="btn btn-link btn-sm p-0">Baca selengkapnya</a>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-video text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-1">Video Tutorial</h6>
                                    <p class="text-muted mb-1">Video tutorial untuk membuat dokumentasi campaign</p>
                                    <a href="#" class="btn btn-link btn-sm p-0">Tonton video</a>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <div class="icon-circle bg-info">
                                        <i class="fas fa-question-circle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-1">FAQ</h6>
                                    <p class="text-muted mb-1">Pertanyaan yang sering diajukan tentang pelaporan</p>
                                    <a href="#" class="btn btn-link btn-sm p-0">Lihat FAQ</a>
                                </div>
                            </div>
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
<!-- Custom scripts for this page -->
@include('dashboard.report.scripts')
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
