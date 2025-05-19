@extends('dashboard.layout')

@section('page-content')

{{-- Flash Data --}}
<div class="flash-data" data-message="{{ session('success') }}"></div>

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Posts</h4>
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
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Posts</h4>
                            <a href="/dashboard/posts/create" class="btn btn-primary btn-round ml-auto" >
                                <i class="fa fa-plus"></i> New
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <table id="add-row" class="table-responsive display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created at</th>
                                        @if(Auth::user()->role == 'super-admin')
                                        <th>Created by</th>
                                        @endif
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created at</th>
                                        @if(Auth::user()->role == 'super-admin')
                                        <th>Created by</th>
                                        @endif
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="avatar avatar-lg my-3">
                                                <img src="/storage/{{ $post->image ?? 'default/image.jpg' }}" alt="{{ $post->title }}" class="avatar-img rounded-circle">
                                            </div>
                                        </td>
                                        <td>{{ strlen($post->title) <= 30 ? $post->title : substr($post->title, 0, 30).'..' }}</td>
                                        <td>
                                            @if($post->category)
                                            {{ Str::ucfirst($post->category->name) }}
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->created_at->isoFormat('D MMM YY') }}</td>
                                        @if(Auth::user()->role == 'super-admin')
                                        <td>{{ Str::ucfirst($post->user->name) }}</td>
                                        @endif
                                        <td>
                                            <div class="form-button-action">
                                                <a href="/dashboard/posts/{{ $post->id }}" data-toggle="tooltip" title="" class="text-info p-2" data-original-title="Post detail">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                                <a href="/dashboard/posts/{{ $post->id }}/edit" data-toggle="tooltip" title="" class="text-primary p-2" data-original-title="Edit post">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="/dashboard/posts/{{ $post->id }}" method="POST" class="p-0 m-0 d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" data-toggle="tooltip" title="" class="text-danger delete-post border-0 p-2 m-0" data-original-title="Delete post" style="background:none; cursor: pointer">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
