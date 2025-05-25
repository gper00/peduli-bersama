<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">

        <a href="/" class="logo">
            {{-- <img src="/assets/dashboard/img/logo.svg" alt="navbar brand" class="navbar-brand"> --}}
            <h1 class="navbar-brand text-white">Peduli Bersama</h1>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

        <div class="container-fluid">
            <div class="collapse" id="search-nav">
                <div class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-calendar-day"></i>
                            </span>
                        </div>
                        <span class="form-control">
                            {{ \Carbon\Carbon::now()->format('l, j F Y') }}
                        </span>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                @if (auth()->user()->role == 'admin')
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>

                <li class="nav-item hidden-caret">
                    <a class="nav-link" href="/dashboard/mails" role="button">
                        <i class="fa fa-envelope"></i>
                    </a>
                </li>

                {{-- <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                        <li>
                            <div class="dropdown-title d-flex justify-content-between align-items-center">
                                Messages
                                <a href="#" class="small">Mark all as read</a>
                            </div>
                        </li>
                        <li>
                            <div class="message-notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="/assets/dashboard/img/jm_denis.jpg" alt="Img Profile">
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Jimmy Denis</span>
                                            <span class="block">
                                                How are you ?
                                            </span>
                                            <span class="time">5 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="/assets/dashboard/img/chadengle.jpg" alt="Img Profile">
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Chad</span>
                                            <span class="block">
                                                Ok, Thanks !
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="/assets/dashboard/img/mlane.jpg" alt="Img Profile">
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Jhon Doe</span>
                                            <span class="block">
                                                Ready for the meeting today...
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="/assets/dashboard/img/talha.jpg" alt="Img Profile">
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Talha</span>
                                            <span class="block">
                                                Hi, Apa Kabar ?
                                            </span>
                                            <span class="time">17 minutes ago</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">4</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">You have 4 new notification</div>
                        </li>
                        <li>
                            <div class="notif-center">
                                <a href="#">
                                    <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            New user registered
                                        </span>
                                        <span class="time">5 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            Rahmad commented on Admin
                                        </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="/assets/dashboard/img/profile2.jpg" alt="Img Profile">
                                    </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            Reza send messages to you
                                        </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            Farrah liked Admin
                                        </span>
                                        <span class="time">17 minutes ago</span>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                    </a>
                    <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="title mb-1">Quick Actions</span>
                            <span class="subtitle op-8">Create Data</span>
                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-4 p-0" href="/dashboard/users/create">
                                        <div class="quick-actions-item">
                                            <i class="fas fa-user"></i>
                                            <span class="text">New User</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="/dashboard/posts/create">
                                        <div class="quick-actions-item">
                                            <i class="fas fa-newspaper"></i>
                                            <span class="text">New Post</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="/dashboard/galleries/create">
                                        <div class="quick-actions-item">
                                            <i class="fas fa-image"></i>
                                            <span class="text">New Gallery</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="/dashboard/products/create">
                                        <div class="quick-actions-item">
                                            <i class="fas fa-shopping-bag"></i>
                                            <span class="text">New Product</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endif


                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if (auth()->user()->image)
                                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('storage/default/user.jpg') }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                {{-- <div class="user-box">
                                    <div class="avatar-lg"><img src="/storage/{{ Auth::user()->image ?? 'default/user.jpg' }}" alt="{{ Auth::user()->name }}" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4>{{ Str::ucfirst(Auth::user()->name) }}
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div> --}}
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="https://dummyimage.com/100x100/000/fff" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4>Umam Alfarizi
                                        <p class="text-muted">admin@gmail.com</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">My Profile</a>
                                <div class="dropdown-divider"></div>

                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="dropdown-item logout"  style="cursor: pointer">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
