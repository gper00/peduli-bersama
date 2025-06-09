@extends('dashboard.layout')

@section('title', 'Tarik Dana | Peduli Bersama')

@section('page-content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Tarik Dana</h4>
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
                    <a href="{{ route('dashboard.withdrawals.index') }}">Penarikan Dana</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.withdrawals.create') }}">Tarik Dana</a>
                </li>
            </ul>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('dashboard.withdrawals.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Withdrawal Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Penarikan Dana</h4>
                    </div>
                    <div class="card-body">
                        @if($campaigns->isEmpty())
                        <div class="text-center py-4">
                            <i class="fa fa-wallet fa-4x mb-3 text-muted"></i>
                            <h5>Tidak Ada Dana Tersedia</h5>
                            <p class="text-muted">Saat ini tidak ada dana yang tersedia untuk ditarik dari kampanye Anda.</p>
                        </div>
                        @else
                        <form action="{{ route('dashboard.withdrawals.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="campaign_id">Pilih Kampanye</label>
                        <select name="campaign_id" id="campaign_id" class="form-control" required>
                            <option value="">-- Pilih Kampanye --</option>
                            @foreach($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" data-available="{{ $campaign->available_funds }}">
                                {{ $campaign->title }} (Tersedia: Rp {{ number_format($campaign->available_funds, 0, ',', '.') }})
                            </option>
                            @endforeach
                        </select>
                        @error('campaign_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="amount">Jumlah Penarikan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="amount" id="amount" min="10000" step="1000" class="form-control" placeholder="0" required>
                        </div>
                        <small class="text-muted">Minimal penarikan: Rp 10.000</small>
                        <p id="available-message" class="text-primary small mt-1 d-none">Dana tersedia: <span id="available-amount">0</span></p>
                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="bank_name">Nama Bank</label>
                        <select name="bank_name" id="bank_name" class="form-control" required>
                            <option value="">-- Pilih Bank --</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BRI">BRI</option>
                            <option value="BNI">BNI</option>
                            <option value="CIMB Niaga">CIMB Niaga</option>
                            <option value="BSI">BSI</option>
                            <option value="BTN">BTN</option>
                            <option value="Permata">Permata</option>
                            <option value="Danamon">Danamon</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('bank_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="account_number">Nomor Rekening</label>
                        <input type="text" name="account_number" id="account_number" class="form-control" required>
                        @error('account_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="account_name">Nama Pemilik Rekening</label>
                        <input type="text" name="account_name" id="account_name" class="form-control" required>
                        <small class="text-muted">Harus sesuai dengan nama di buku tabungan/rekening</small>
                        @error('account_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="note">Catatan (Opsional)</label>
                        <textarea name="note" id="note" rows="3" class="form-control"></textarea>
                        @error('note')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div>
                            <h5>Informasi Penarikan</h5>
                            <ul>
                                <li>Biaya administrasi sebesar Rp 5.000 akan dikenakan untuk setiap penarikan.</li>
                                <li>Proses penarikan akan membutuhkan waktu 1-3 hari kerja setelah disetujui.</li>
                                <li>Pastikan data rekening yang Anda masukkan sudah benar.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        Saya menyetujui <a href="#" class="text-primary">syarat dan ketentuan</a> penarikan dana di Peduli Bersama
                    </label>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-money-bill-wave mr-2"></i> Tarik Dana
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>

    <!-- Withdrawal Info -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Panduan Penarikan Dana</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-sm bg-primary mr-3 d-flex align-items-center justify-content-center">
                                    <span class="font-weight-bold">1</span>
                                </div>
                                <div>
                                    <h5>Pilih Kampanye</h5>
                                    <p>
                                        Pilih kampanye yang memiliki dana tersedia untuk ditarik. Dana yang tersedia adalah total donasi 
                                        yang sudah berhasil dikurangi dengan total penarikan sebelumnya.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-sm bg-primary mr-3 d-flex align-items-center justify-content-center">
                                    <span class="font-weight-bold">2</span>
                                </div>
                                <div>
                                    <h5>Tentukan Jumlah</h5>
                                    <p>
                                        Masukkan jumlah dana yang ingin ditarik. Minimal penarikan adalah Rp 10.000 dan tidak boleh melebihi
                                        dana yang tersedia di kampanye tersebut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-sm bg-primary mr-3 d-flex align-items-center justify-content-center">
                                    <span class="font-weight-bold">3</span>
                                </div>
                                <div>
                                    <h5>Masukkan Data Rekening</h5>
                                    <p>
                                        Masukkan data rekening bank yang akan digunakan untuk menerima dana. Pastikan nama pemilik rekening
                                        sesuai dengan nama yang terdaftar di akun Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-sm bg-primary mr-3 d-flex align-items-center justify-content-center">
                                    <span class="font-weight-bold">4</span>
                                </div>
                                <div>
                                    <h5>Tunggu Persetujuan</h5>
                                    <p>
                                        Setelah mengajukan penarikan dana, permintaan Anda akan ditinjau oleh admin. Proses ini biasanya
                                        membutuhkan waktu 1-2 hari kerja. Anda akan mendapatkan notifikasi jika ada perubahan status.
                                    </p>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const campaignSelect = document.getElementById('campaign_id');
        const amountInput = document.getElementById('amount');
        const availableMessage = document.getElementById('available-message');
        const availableAmount = document.getElementById('available-amount');
        
        // Tampilkan dana tersedia saat kampanye dipilih
        campaignSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const available = parseInt(selectedOption.getAttribute('data-available'));
                availableAmount.textContent = 'Rp ' + available.toLocaleString('id-ID');
                availableMessage.classList.remove('hidden');
                
                // Set maksimum jumlah penarikan
                amountInput.setAttribute('max', available);
            } else {
                availableMessage.classList.add('hidden');
                amountInput.removeAttribute('max');
            }
        });
        
        // Validasi jumlah penarikan tidak melebihi dana tersedia
        amountInput.addEventListener('input', function() {
            const selectedOption = campaignSelect.options[campaignSelect.selectedIndex];
            if (selectedOption.value) {
                const available = parseInt(selectedOption.getAttribute('data-available'));
                if (parseInt(this.value) > available) {
                    this.setCustomValidity('Jumlah penarikan tidak boleh melebihi dana tersedia');
                } else {
                    this.setCustomValidity('');
                }
            }
        });
    });
</script>
@endsection
