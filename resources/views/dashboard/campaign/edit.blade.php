@extends('dashboard.layout')

@section('page-content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Edit Campaign</h4>
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
                    <a href="{{ route('dashboard.campaigns.index') }}">Campaign</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    Edit Campaign
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <form action="{{ route('dashboard.campaigns.update', $campaign->slug) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                    <div class="card-header">
                        <div class="card-title">Edit Campaign</div>
                    </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Campaign Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $campaign->title) }}" required>
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="short_description">Short Description <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" value="{{ old('short_description', $campaign->short_description) }}" required maxlength="255">
                                        @error('short_description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <small class="form-text text-muted">Brief summary of your campaign (max 255 characters)</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ (old('category_id', $campaign->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="target_amount">Target Amount <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="number" class="form-control @error('target_amount') is-invalid @enderror" id="target_amount" name="target_amount" value="{{ old('target_amount', $campaign->target_amount) }}" min="1000" required>
                                                </div>
                                                @error('target_amount')
                                                <div class="text-danger small mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <small class="form-text text-muted">Minimum amount: Rp 1,000</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                    <option value="draft" {{ old('status', $campaign->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="completed" {{ old('status', $campaign->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="rejected" {{ old('status', $campaign->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $campaign->start_date ? $campaign->start_date->format('Y-m-d') : '') }}" required>
                                                @error('start_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}" required>
                                                @error('end_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" required>{{ old('description', $campaign->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <small class="form-text text-muted">Minimum 100 characters</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cover_image">Cover Image</label>
                                        <div class="mb-3">
                                            <img id="image-preview" class="img-fluid rounded" src="/storage/{{ $campaign->cover_image ?? 'default/campaign.jpg' }}" alt="{{ $campaign->title }}">
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" onchange="previewImage()">
                                            <label class="custom-file-label" for="cover_image">Choose new image</label>
                                        </div>
                                        @error('cover_image')
                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <small class="form-text text-muted">Max size: 2MB</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Update Campaign</button>
                                <a href="{{ route('dashboard.campaigns.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#cover_image');
        const imagePreview = document.querySelector('#image-preview');
        const fileLabel = document.querySelector('.custom-file-label');

        fileLabel.textContent = image.files[0].name;

        const reader = new FileReader();
        reader.readAsDataURL(image.files[0]);
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
        }
    }

    // Initialize rich text editor for description (if available)
    if(typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    }
</script>

@endsection
