@extends('layouts.dashboard')

@section('title', 'Campaign Saya')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Campaign Saya</h4>
        <div class="btn-group btn-group-page-header ml-auto">
            <a href="{{ route('dashboard.campaigns.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Buat Campaign Baru
            </a>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Daftar Campaign Saya</div>
                </div>
                <div class="card-body">
                    @if($campaigns->isEmpty())
                        <div class="alert alert-info">
                            Anda belum memiliki campaign. Klik tombol "Buat Campaign Baru" untuk mulai membuat campaign.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Target</th>
                                        <th>Terkumpul</th>
                                        <th>Status</th>
                                        <th>Verifikasi</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campaigns as $campaign)
                                    <tr>
                                        <td>
                                            <a href="{{ route('dashboard.campaigns.show', $campaign->slug) }}">
                                                {{ $campaign->title }}
                                            </a>
                                        </td>
                                        <td>{{ $campaign->category->name }}</td>
                                        <td>Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</td>
                                        <td>
                                            @if($campaign->status == 'draft')
                                                <span class="badge badge-warning">Draft</span>
                                            @elseif($campaign->status == 'active')
                                                <span class="badge badge-success">Aktif</span>
                                            @elseif($campaign->status == 'completed')
                                                <span class="badge badge-info">Selesai</span>
                                            @else
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($campaign->verification_status == 'pending')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($campaign->verification_status == 'verified')
                                                <span class="badge badge-success">Terverifikasi</span>
                                            @else
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>{{ $campaign->end_date->format('d M Y') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                
                                                @if($campaign->status == 'draft')
                                                <form action="{{ route('dashboard.campaigns.changeStatus', $campaign->slug) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin mengaktifkan campaign ini?')">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                </form>
                                                @endif
                                                
                                                <form action="{{ route('dashboard.campaigns.destroy', $campaign->slug) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus campaign ini? Tindakan ini tidak dapat dibatalkan.')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            {{ $campaigns->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
