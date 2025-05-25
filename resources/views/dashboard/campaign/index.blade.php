@extends('dashboard.layout')

@section('page-content')

<div class="d-none" id="success-message">{{ session('success') }}</div>
<div class="d-none" id="error-message">{{ session('error') }}</div>

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kelola Campaign</h4>
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
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Daftar Campaign</h4>
                            <div class="ml-auto">
                                <a href="{{ route('dashboard.campaigns.create') }}" class="btn btn-primary btn-round" >
                                    <i class="fa fa-plus"></i> Buat Campaign Baru
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cover Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Target</th>
                                        <th>Status</th>
                                        <th>End Date</th>
                                        @if(Auth::user()->isAdmin())
                                        <th>Created by</th>
                                        @endif
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Cover Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Target</th>
                                        <th>Status</th>
                                        <th>End Date</th>
                                        @if(Auth::user()->isAdmin())
                                        <th>Created by</th>
                                        @endif
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($campaigns as $campaign)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="avatar avatar-lg my-3">
                                                @if($campaign->cover_image)
                                                <img src="/storage/{{ $campaign->cover_image }}" alt="{{ $campaign->title }}" class="rounded" style="width: 70px; height: calc(70px * 3 / 4); object-fit: cover;">
                                                @else
                                                <img src="/storage/default/image.jpg" alt="{{ $campaign->title }}" class="rounded" style="width: 70px; height: calc(70px * 3 / 4); object-fit: cover;">
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ strlen($campaign->title) <= 30 ? $campaign->title : substr($campaign->title, 0, 30).'..' }}</td>
                                        <td>
                                            @if($campaign->category)
                                            {{ Str::ucfirst($campaign->category->name) }}
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($campaign->target_amount) }}</td>
                                        <td>
                                            @if($campaign->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($campaign->status == 'completed')
                                                <span class="badge badge-info">Completed</span>
                                            @elseif($campaign->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($campaign->end_date)->isoFormat('D MMM YY') }}</td>
                                        @if(Auth::user()->isAdmin())
                                        <td>{{ Str::ucfirst($campaign->user->name) }}</td>
                                        @endif
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('dashboard.campaigns.show', $campaign->slug) }}" data-toggle="tooltip" title="" class="text-info p-2" data-original-title="Lihat Detail">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                                <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" data-toggle="tooltip" title="" class="text-primary p-2" data-original-title="Edit Campaign">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                @if(auth()->user()->isAdmin())
                                                <a href="#" onclick="event.preventDefault(); document.getElementById('verify-form-{{ $campaign->id }}').submit();" data-toggle="tooltip" title="" class="text-success p-2" data-original-title="Verifikasi Campaign">
                                                    <i class="fa fa-check-circle"></i>
                                                </a>
                                                <form id="verify-form-{{ $campaign->id }}" action="{{ route('dashboard.campaigns.verify', $campaign->slug) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="verification_status" value="verified">
                                                </form>

                                                <a href="#" onclick="event.preventDefault(); document.getElementById('feature-form-{{ $campaign->id }}').submit();" data-toggle="tooltip" title="" class="{{ $campaign->featured ? 'text-warning' : 'text-secondary' }} p-2" data-original-title="{{ $campaign->featured ? 'Remove from Featured' : 'Add to Featured' }}">
                                                    <i class="fa fa-star"></i>
                                                </a>
                                                <form id="feature-form-{{ $campaign->id }}" action="{{ route('dashboard.campaigns.toggleFeatured', $campaign->slug) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('PATCH')
                                                </form>
                                                @endif

                                                <button type="button" data-toggle="tooltip" title="" class="text-danger delete-campaign border-0 p-2 m-0" data-original-title="Hapus Campaign" style="background:none; cursor: pointer" data-slug="{{ $campaign->slug }}" data-title="{{ $campaign->title }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $campaign->slug }}" action="{{ route('dashboard.campaigns.destroy', $campaign->slug) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
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

@section('scripts')
<script>
    $(document).ready(function() {

        // Delete campaign button functionality
        $('.delete-campaign').on('click', function(e) {
            e.preventDefault();
            var slug = $(this).data('slug');
            var title = $(this).data('title');
            var deleteForm = document.getElementById('delete-form-' + slug);

            swal({
                title: "Apakah Anda yakin?",
                text: "Anda akan menghapus campaign '" + title + "'. Tindakan ini tidak dapat dibatalkan!",
                type: "warning",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Ya, hapus!",
                        className: "btn btn-primary",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    deleteForm.submit();
                }
            });
        });

        // Handle success message with SweetAlert if present
        var successMessage = $('#success-message').text();
        if (successMessage && successMessage.trim() !== '') {
            swal({
                title: "Berhasil!",
                text: successMessage,
                icon: "success",
                buttons: {
                    confirm: {
                        text: "OK",
                        className: "btn btn-success",
                    },
                },
            });
        }

        // Handle error message with SweetAlert if present
        var errorMessage = $('#error-message').text();
        if (errorMessage && errorMessage.trim() !== '') {
            swal({
                title: "Error!",
                text: errorMessage,
                icon: "error",
                buttons: {
                    confirm: {
                        text: "OK",
                        className: "btn btn-danger",
                    },
                },
            });
        }
    });
</script>
@endsection
