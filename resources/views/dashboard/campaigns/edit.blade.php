@extends('dashboard.layout')

@section('page-content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Edit Post</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/dashboard">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    Articles
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/posts">Posts</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <form action="/dashboard/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                    <div class="card-header">
                        <div class="card-title">Edit Post</div>
                    </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">

                                    <div class="form-group mb-4">
                                        <label for="title">
                                            <span>Title *</span>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            name="title"
                                            value="{{ old('title', $post->title) }}"
                                            autocomplete="off"
                                            required
                                        >
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="image">Image</label>
                                        <div class="col-12 p-0 mb-2">
                                            <img src="/storage/{{ $post->image ?? 'default/image.jpg' }}" height="150px" alt="" id="imgPreview" class="rounded">
                                            @if($post->image)
                                            <div class="card-img-overlay p-0">
                                                <a class="dropdown-toggle btn btn-default btn-sm" data-toggle="dropdown" href="#" aria-expanded="false">
                                                    Option
                                                </a>
                                                <ul class="dropdown-menu animated fadeIn">
                                                    <div class="scrollbar-outer">
                                                        <li>
                                                            <a class="dropdown-item delete-image" href="/dashboard/posts/{{ $post->id }}/delete-image" style="cursor: pointer">
                                                                Delete image
                                                            </a>
                                                        </li>
                                                    </div>
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                                        <input
                                            type="file"
                                            class="form-control @error('image') is-invalid @enderror"
                                            id="image"
                                            name="image"
                                            value=""
                                        >
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="category">
                                            <span>Category</span>
                                        </label>
                                        <select
                                            name="category"
                                            id="category"
                                            class="form-control @error('category') is-invalid @enderror"
                                        >
                                            @if(!$post->category_id)
                                            <option value="">-- Category --</option>
                                            @else
                                            <option value="">Clear Category</option>
                                            @endif
                                            @foreach($postCategories as $postCategory)
                                            <option value="{{ $postCategory->id }}" {{ $postCategory->id == old('category', $post->category_id) ? 'selected' : '' }}>{{ ucwords($postCategory->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @if(!$postCategories->count() && Auth::user()->role == 'super-admin')
                                        <small class="text-muted">Click <a href="/dashboard/post-categories/create">here</a> to create new category</small>
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="tags">
                                            <span>Topics (separate each topic with  ' , ')</span>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control @error('tags') is-invalid @enderror"
                                            id="tags"
                                            name="tags"
                                            value="{{ old('tags', $post->tags) }}"
                                        >
                                        @error('tags')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="froala-editor">
                                            <span>Content *</span>
                                        </label>
                                        <textarea name="content" class="form-control is-invalid" id="froala-editor">{{ old('content', $post->content) }}</textarea>
                                        @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <button class="btn btn-primary mr-2">Save</button>
                                    <a href="/dashboard/posts" class="btn btn-primary btn-border">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
