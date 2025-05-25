@extends('dashboard.layout')

@section('page-content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Tambah Kategori</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.categories.index') }}">Kategori</a>
            </li>
            <li class="separator">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tambah</a>
            </li>
        </ul>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Tambah Kategori</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="icon">Icon (FontAwesome Class)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                </div>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}" placeholder="fa-heart">
                            </div>
                            <small class="form-text text-muted">Masukkan nama kelas FontAwesome, contoh: fa-heart, fa-home, dll.</small>
                            @error('icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="color">Warna</label>
                            <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', '#3498db') }}">
                            @error('color')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="sort_order">Urutan</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                            <small class="form-text text-muted">Angka lebih kecil akan ditampilkan lebih dulu.</small>
                            @error('sort_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                            <small class="form-text text-muted">Jika diaktifkan, kategori ini akan ditampilkan di aplikasi.</small>
                        </div>
                        
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Preview icon when user types in the icon field
        $('#icon').on('input', function() {
            var iconClass = $(this).val();
            if (iconClass) {
                $(this).closest('.input-group').find('.input-group-text i').attr('class', 'fas ' + iconClass);
            } else {
                $(this).closest('.input-group').find('.input-group-text i').attr('class', 'fas fa-icons');
            }
        });
    });
</script>
@endsection
