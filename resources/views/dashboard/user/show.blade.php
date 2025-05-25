@extends('dashboard.layout')

@section('page-content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">User Details</h4>
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
                    <a href="/dashboard/users">Kelola Pengguna</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">User Details</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $user->name }}'s Profile</h4>
                            <div class="ml-auto">
                                @if(auth()->user()->isAdmin() || auth()->id() === $user->id)
                                <a href="/dashboard/users/{{ $user->id }}/edit" class="btn btn-primary btn-round">
                                    <i class="fa fa-edit mr-2"></i> Edit Profile
                                </a>
                                @endif
                                
                                @if(auth()->user()->isAdmin() && auth()->id() !== $user->id)
                                    @if(auth()->user()->isSuperAdmin() || !$user->isAdmin())
                                    <form action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-round ml-2 delete-btn">
                                            <i class="fa fa-trash mr-2"></i> Delete User
                                        </button>
                                    </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ $user->image ? '/storage/' . $user->image : '/storage/default/user.jpg' }}" alt="{{ $user->name }}" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                                <h4 class="font-weight-bold">{{ $user->name }}</h4>
                                <div class="badge badge-primary">{{ ucfirst($user->role) }}</div>
                                @if($user->isSuperAdmin())
                                <div class="badge badge-danger mt-1">Super Admin</div>
                                @endif
                                <p class="mt-2">{{ $user->bio }}</p>
                                <div class="social-links mt-3">
                                    @if($user->facebook_url)
                                    <a href="{{ $user->facebook_url }}" target="_blank" class="btn btn-sm btn-round btn-primary mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    @endif
                                    
                                    @if($user->twitter_url)
                                    <a href="{{ $user->twitter_url }}" target="_blank" class="btn btn-sm btn-round btn-info mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    @endif
                                    
                                    @if($user->instagram_url)
                                    <a href="{{ $user->instagram_url }}" target="_blank" class="btn btn-sm btn-round btn-danger mx-1">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td width="200"><strong>Username</strong></td>
                                                <td>{{ $user->username }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone Number</strong></td>
                                                <td>{{ $user->phone_number ?: 'Not provided' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Address</strong></td>
                                                <td>{{ $user->address ?: 'Not provided' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Account Created</strong></td>
                                                <td>{{ $user->created_at->format('d F Y, H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Last Updated</strong></td>
                                                <td>{{ $user->updated_at->format('d F Y, H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email Verified</strong></td>
                                                <td>
                                                    @if($user->email_verified_at)
                                                        <span class="text-success">
                                                            <i class="fas fa-check-circle"></i> 
                                                            Verified ({{ $user->email_verified_at->format('d F Y, H:i') }})
                                                        </span>
                                                    @else
                                                        <span class="text-danger">
                                                            <i class="fas fa-times-circle"></i>
                                                            Not Verified
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Account Status</strong></td>
                                                <td>
                                                    @if($user->is_active)
                                                        <span class="text-success">
                                                            <i class="fas fa-check-circle"></i> Active
                                                        </span>
                                                    @else
                                                        <span class="text-danger">
                                                            <i class="fas fa-times-circle"></i> Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($user->isCreator())
                                <div class="mt-4">
                                    <h5 class="font-weight-bold">Campaigns Created</h5>
                                    @if($user->campaigns->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($user->campaigns as $campaign)
                                                <tr>
                                                    <td>{{ $campaign->title }}</td>
                                                    <td>{{ $campaign->category->name }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $campaign->status == 'active' ? 'success' : ($campaign->status == 'completed' ? 'info' : 'warning') }}">
                                                            {{ ucfirst($campaign->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($campaign->current_amount) }} / {{ number_format($campaign->target_amount) }}</td>
                                                    <td>
                                                        <a href="/dashboard/campaigns/{{ $campaign->id }}" class="btn btn-sm btn-primary">View</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <p class="text-muted">No campaigns created yet.</p>
                                    @endif
                                </div>
                                @endif
                                
                                @if($user->isDonor() || $user->isAdmin())
                                <div class="mt-4">
                                    <h5 class="font-weight-bold">Recent Donations</h5>
                                    @if($user->donations->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Campaign</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($user->donations->take(5) as $donation)
                                                <tr>
                                                    <td>{{ $donation->campaign->title }}</td>
                                                    <td>{{ number_format($donation->amount) }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $donation->status == 'success' ? 'success' : ($donation->status == 'pending' ? 'warning' : 'danger') }}">
                                                            {{ ucfirst($donation->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $donation->created_at->format('d M Y') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if($user->donations->count() > 5)
                                        <div class="text-center mt-3">
                                            <a href="/dashboard/donations?user={{ $user->id }}" class="btn btn-sm btn-primary">View All Donations</a>
                                        </div>
                                        @endif
                                    </div>
                                    @else
                                    <p class="text-muted">No donations made yet.</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
<script>
    // Confirmation for delete button
    $('.delete-btn').click(function(e){
        if(!confirm('Are you sure you want to delete this user? This action cannot be undone.')){
            e.preventDefault();
        }
    });
</script>
@endpush

@endsection