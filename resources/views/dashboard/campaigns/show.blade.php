@extends('dashboard.layout')

@section('page-content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Post Detail</h4>
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
                    <div class="card-header">
                        <div class="card-title">Post Detail</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <img src="/storage/{{ $post->image ?? 'default/image.jpg' }}" alt="{{ $post->title }}" style="width: 100%; max-height: 400px;" class="rounded mb-4">
                                <h2 class="mb-3">{{ $post->title }}</h2>
                                <small class="text-muted">
                                    <i class="fas fa-user"></i> {{ Str::ucfirst($post->user->name) }}
                                        <span class="mx-2">|</span>
                                    <i class="fas fa-folder"></i> {{ $post->category ? Str::ucfirst($post->category->name) : '-' }}
                                        <span class="mx-2">|</span>
                                    <i class="fas fa-calendar-alt"></i> {{ $post->created_at->isoFormat('dddd, D MMMM Y') }} (last updated {{ $post->updated_at->diffForHumans() }})
                                </small>
                                <div class="text-justify mt-5">
                                    {!! $post->content !!}
                                </div>
                                {{-- <div class="row mt-5">
                                    <div class="col">
                                        <i class="fas fa-tag"></i>
                                        <span class="mx-1">Topics: {{ ($post->tags) ? $post->tags : '-' }}</span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <a href="/dashboard/posts/{{ $post->id }}/edit" class="btn btn-primary mr-2">Edit</a>
                                <form action="/dashboard/posts/{{ $post->id }}" method="POST" class="p-0 m-0 d-inline">
                                    @csrf
                                    @method('delete')
                                    <button  type="submit" style="cursor: pointer" class="btn btn-danger delete-post">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
