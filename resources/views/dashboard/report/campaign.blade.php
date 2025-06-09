@extends('dashboard.layout')

@section('title', 'Laporan Kampanye: ' . $campaign->title . ' | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Laporan Kampanye: {{ $campaign->title }}</h4>
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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.reports.campaign', $campaign->id) }}">Laporan Kampanye</a>
                </li>
            </ul>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('dashboard.reports.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
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

    <!-- Campaign Info -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Kampanye</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td width="40%">Judul Kampanye</td>
                                <td width="60%" class="font-weight-bold">{{ $campaign->title }}</td>
                            </tr>
                            <tr>
                                <td>Penggalang Dana</td>
                                <td>{{ $campaign->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Target Donasi</td>
                                <td>Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Dana Terkumpul</td>
                                <td class="text-success font-weight-bold">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($campaign->status == 'active')
                                    <span class="badge badge-success">Aktif</span>
                                    @elseif($campaign->status == 'pending')
                                    <span class="badge badge-warning">Menunggu</span>
                                    @elseif($campaign->status == 'completed')
                                    <span class="badge badge-primary">Selesai</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Mulai</td>
                                <td>{{ $campaign->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Berakhir</td>
                                <td>{{ $campaign->end_date ? $campaign->end_date->format('d M Y') : 'Tanpa batas waktu' }}</td>
                            </tr>
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body text-center">
                            <h3 class="font-weight-bold">{{ $donations->count() }}</h3>
                            <p class="text-muted">Total Donasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body text-center">
                            <h3 class="font-weight-bold">{{ $donations->groupBy('donor_email')->count() }}</h3>
                            <p class="text-muted">Jumlah Donatur</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body text-center">
                            <h3 class="font-weight-bold">{{ $donations->count() > 0 ? 'Rp ' . number_format($donations->avg('amount'), 0, ',', '.') : 'Rp 0' }}</h3>
                            <p class="text-muted">Rata-rata Donasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Weekly Donation Chart -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Donasi Mingguan</h4>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="weeklyDonationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation List -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Donasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Donatur</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donations as $donation)
                                <tr>
                                    <td>
                                        <div>
                                            <p class="font-weight-bold mb-0">{{ $donation->getDonorNameAttribute() }}</p>
                                            <small class="text-muted">{{ $donation->donor_email ?? ($donation->user ? $donation->user->email : 'Email tidak tersedia') }}</small>
                                        </div>
                                    </td>
                                    <td class="font-weight-bold">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ $donation->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        {{ $donation->message ?: '-' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada donasi untuk kampanye ini.
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

    <!-- Upload Documentation -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Unggah Dokumentasi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.reports.upload', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="title">Judul Dokumentasi</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    
                            <div class="col-md-6 form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" required>
                                <label class="custom-file-label" for="file">Pilih file...</label>
                            </div>
                            <small class="form-text text-muted">Format: PDF, DOC, DOCX, JPG, JPEG, PNG (Max: 10MB)</small>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload mr-1"></i> Unggah Dokumentasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentation List -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dokumentasi Terkini</h4>
                </div>
                <div class="card-body">
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-folder-open fa-4x mb-3"></i>
                        <p class="h5 mt-3">Belum ada dokumentasi</p>
                        <p>Unggah dokumentasi pertama Anda dengan menggunakan form di atas.</p>
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
