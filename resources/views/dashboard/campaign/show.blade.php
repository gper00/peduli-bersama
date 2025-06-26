@extends('dashboard.layout')

@section('page-content')

<div class="d-none" id="success-message">{{ session('success') }}</div>
<div class="d-none" id="error-message">{{ session('error') }}</div>

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Detail Kampanye</h4>
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
                    <a href="{{ route('dashboard.campaigns.index') }}">Kampanye</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    Detail
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Informasi Kampanye</h4>
                            <div class="ml-auto">
                                <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4" style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; border-radius: 0.25rem;">
                            @if($campaign->cover_image)
                                <img src="{{ asset('storage/' . $campaign->cover_image) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" alt="{{ $campaign->title }}">
                            @else
                                <img src="{{ asset('storage/default/image.jpg') }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" alt="{{ $campaign->title }}">
                            @endif
                        </div>

                        <h2>{{ $campaign->title }}</h2>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Kategori</p>
                                <p class="font-weight-bold">{{ $campaign->category->name ?? '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Status</p>
                                <p>
                                    @if($campaign->status == 'active')
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif($campaign->status == 'completed')
                                        <span class="badge badge-info">Selesai</span>
                                    @elseif($campaign->status == 'rejected')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">Draft</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Dibuat Oleh</p>
                                <p class="font-weight-bold">{{ $campaign->user->name ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal Mulai</p>
                                <p class="font-weight-bold">{{ \Carbon\Carbon::parse($campaign->start_date)->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal Selesai</p>
                                <p class="font-weight-bold">{{ \Carbon\Carbon::parse($campaign->end_date)->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <p class="text-muted mb-1">Progres Fundraising</p>
                                <div class="progress mb-2" style="height: 10px">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $campaign->progress_percentage }}%"
                                         aria-valuenow="{{ $campaign->progress_percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="font-weight-bold">Rp {{ number_format($campaign->current_amount) }}</p>
                                    <p>{{ $campaign->progress_percentage }}%</p>
                                    <p class="font-weight-bold">Rp {{ number_format($campaign->target_amount) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Sisa Hari</p>
                                <p class="font-weight-bold">
                                    @if($campaign->days_remaining > 0)
                                        {{ $campaign->days_remaining }} hari
                                    @else
                                        <span class="text-danger">Berakhir</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Donatur</p>
                                <p class="font-weight-bold">{{ $campaign->donor_count }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Donasi</p>
                                <p class="font-weight-bold">{{ $campaign->donations->count() }}</p>
                            </div>
                        </div>

                        <div class="separator-solid mt-3 mb-4"></div>

                        <h4>Deskripsi</h4>
                        <div class="campaign-description mt-3">
                            {!! $campaign->description !!}
                        </div>
                    </div>
                </div>

                @if($campaign->updates->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pembaruan Kampanye</h4>
                    </div>
                    <div class="card-body">
                        @foreach($campaign->updates as $update)
                        <div class="campaign-update mb-4">
                            <h5>{{ $update->title }}</h5>
                            <p class="text-muted">{{ $update->created_at->diffForHumans() }}</p>
                            <div class="update-content">
                                {!! $update->content !!}
                            </div>
                        </div>
                        @if(!$loop->last)
                        <div class="separator-dashed my-3"></div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Feedback (Kritik & Saran) Section -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Kritik & Saran dari Donatur</h4>
                    </div>
                    <div class="card-body">
                        @php
                        $feedbacks = $campaign->feedbacks->sortByDesc('created_at');
                        @endphp

                        @if($feedbacks->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Donatur</th>
                                            <th>Subjek</th>
                                            <th>Tanggal</th>
                                            <th>Pesan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td>
                                                @if($feedback->user)
                                                    <a href="{{ route('dashboard.users.show', ['user' => $feedback->user_id]) }}">
                                                        {{ $feedback->user->name }}
                                                    </a>
                                                @else
                                                    {{ $feedback->name ?? '-' }}
                                                @endif
                                            </td>
                                            <td>{{ $feedback->subject ?? '-' }}</td>
                                            <td>{{ $feedback->created_at->format('d M Y') }}</td>
                                            <td>
                                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                                    <span class="font-weight-bold">{{ $feedback->subject ? '['.$feedback->subject.'] ' : '' }}</span>{{ Str::limit($feedback->message, 100) }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($feedback->status == 'unread')
                                                    <span class="badge badge-warning">Belum Dibaca</span>
                                                @elseif($feedback->status == 'in_progress')
                                                    <span class="badge badge-info">Sedang Diproses</span>
                                                @elseif($feedback->status == 'responded')
                                                    <span class="badge badge-success">Sudah Direspon</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.feedbacks.show', $feedback->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p class="mb-0">Belum ada kritik atau saran untuk kampanye ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="btn btn-primary mb-2">
                                <i class="fa fa-edit"></i> Edit Campaign
                            </a>

                            @if(auth()->user()->role === 'admin' && $campaign->user->role !== 'admin')
                            <!-- Botón de verificación (solo visible para administradores) -->
                            <div class="verification-status mb-3">
                                <h6 class="font-weight-bold">Verification Status:</h6>
                                @if($campaign->verification_status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                    <form action="{{ route('dashboard.campaigns.verify', $campaign->slug) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="verification_status" value="verified">
                                        <button type="submit" class="btn btn-success btn-block btn-sm">
                                            <i class="fa fa-check-circle"></i> Verify Campaign
                                        </button>
                                    </form>
                                    <form action="{{ route('dashboard.campaigns.verify', $campaign->slug) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="verification_status" value="rejected">
                                        <div class="form-group">
                                            <textarea name="rejection_reason" class="form-control form-control-sm" rows="2" placeholder="Reason for rejection" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-block btn-sm">
                                            <i class="fa fa-times-circle"></i> Reject Campaign
                                        </button>
                                    </form>
                                @elseif($campaign->verification_status == 'verified')
                                    <span class="badge badge-success">Verified</span>
                                    <form action="{{ route('dashboard.campaigns.verify', $campaign->slug) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="verification_status" value="rejected">
                                        <div class="form-group">
                                            <textarea name="rejection_reason" class="form-control form-control-sm" rows="2" placeholder="Reason for rejection" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-block btn-sm">
                                            <i class="fa fa-times-circle"></i> Reject Campaign
                                        </button>
                                    </form>
                                @elseif($campaign->verification_status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                    <p class="text-muted small mt-1">Reason: {{ $campaign->rejection_reason ?: 'No reason provided' }}</p>
                                    <form action="{{ route('dashboard.campaigns.verify', $campaign->slug) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="verification_status" value="verified">
                                        <button type="submit" class="btn btn-success btn-block btn-sm">
                                            <i class="fa fa-check-circle"></i> Verify Campaign
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="separator-solid mt-2 mb-3"></div>
                            @endif

                            @if($campaign->status == 'draft')
                            <form action="{{ route('dashboard.campaigns.change-status', $campaign->slug) }}" method="POST" class="mb-2" id="publish-form">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="active">
                                <button type="button" class="btn btn-success btn-block" id="publish-btn">
                                    <i class="fa fa-check-circle"></i> Publish Campaign
                                </button>
                            </form>
                            @elseif($campaign->status == 'active')
                            <form action="{{ route('dashboard.campaigns.change-status', $campaign->slug) }}" method="POST" class="mb-2" id="complete-form">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button type="button" class="btn btn-info btn-block" id="complete-btn">
                                    <i class="fa fa-flag-checkered"></i> Mark as Completed
                                </button>
                            </form>
                            @endif

                            @if($campaign->verification_status == 'verified' && $campaign->status == 'active')
                                <a href="{{ route('public.campaign', $campaign->slug) }}" target="_blank" class="btn btn-secondary mb-2">
                                    <i class="fa fa-eye"></i> View Public Page
                                </a>
                            @else
                                <button type="button" class="btn btn-secondary mb-2" disabled title="Campaign must be verified and active to be viewed publicly">
                                    <i class="fa fa-eye"></i> Public Page Not Available
                                </button>
                                <small class="d-block text-muted mb-2">Campaign must be verified and active to be viewed publicly</small>
                            @endif

                            <form id="delete-form" action="{{ route('dashboard.campaigns.destroy', $campaign->slug) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-block" id="delete-campaign-btn">
                                    <i class="fa fa-trash"></i> Delete Campaign
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Recent Donations</h4>
                            @if($campaign->donations->count() > 0)
                            <div class="ml-auto">
                                <a href="{{ route('dashboard.index') }}?campaign={{ $campaign->id }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-list"></i> View All
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Donor</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campaign->donations()->latest()->take(5)->get() as $donation)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="{{ $donation->user && $donation->user->image ? asset('storage/'. $donation->user->image) : asset('storage/default/user.jpg') }}" alt="" class="avatar-img rounded-circle">
                                                </div>
                                                <div>{{ $donation->user ? $donation->user->name : 'Anonymous' }}</div>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($donation->amount) }}</td>
                                        <td>{{ $donation->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3">Belum ada donasi</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Comments</h4>
                            @if($campaign->comments->count() > 0)
                            <div class="ml-auto">
                                <a href="{{ route('dashboard.campaigns.index') }}?slug={{ $campaign->slug }}&view=comments" class="btn btn-sm btn-primary">
                                    <i class="fa fa-list"></i> View All
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>r
                                        <th>Comment</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campaign->comments()->latest()->take(5)->get() as $comment)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="{{ $comment->user && $comment->user->image ? asset('storage/'. $comment->user->image) : asset('storage/default/user.jpg') }}" alt="" class="avatar-img rounded-circle">
                                                </div>
                                                <div>{{ $comment->user ? $comment->user->name : 'Anonymous' }}</div>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($comment->comment, 30) }}</td>
                                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3">Belum ada komentar</td>
                                    </tr>
                                    @endforelse
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
        // Handle success messages with SweetAlert
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

        // Handle error messages with SweetAlert
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

        // SweetAlert for delete button
        $('#delete-campaign-btn').on('click', function(e) {
            e.preventDefault();
            const deleteForm = document.getElementById('delete-form');

            confirmDelete("Anda akan menghapus kampanye ini. Tindakan ini tidak dapat dibatalkan!")
                .then((willDelete) => {
                if (willDelete) {
                    deleteForm.submit();
                }
            });
        });

        // SweetAlert for publish campaign button
        $('#publish-btn').on('click', function(e) {
            e.preventDefault();
            const publishForm = document.getElementById('publish-form');

            confirmPublish()
                .then((willPublish) => {
                if (willPublish) {
                    publishForm.submit();
                }
            });
        });

        // SweetAlert for mark as completed button
        $('#complete-btn').on('click', function(e) {
            e.preventDefault();
            const completeForm = document.getElementById('complete-form');

            confirmComplete()
                .then((willComplete) => {
                if (willComplete) {
                    completeForm.submit();
                }
            });
        });
    });
</script>
@endsection
