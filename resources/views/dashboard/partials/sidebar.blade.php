<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle">
                    @else
                        <img src="{{ asset('storage/default/user.jpg') }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ auth()->user()->name }}
                            <span class="user-level">{{ ucfirst(auth()->user()->role) }}</span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                {{-- Dashboard - Available to all roles --}}
                <li class="nav-item {{ (isset($dashboardPage) ? 'active' : '') }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ADMIN & CREATOR MENU ITEMS --}}
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'creator')
                    {{-- Kelola Campaigns --}}
                    <li class="nav-item {{ request()->is('dashboard/campaigns*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.campaigns.index') }}">
                            <i class="fas fa-bullhorn"></i>
                            <p>Kelola Campaigns</p>
                        </a>
                    </li>

                    {{-- Dokumentasi & Laporan --}}
                    <li class="nav-item {{ request()->is('dashboard/reports*') ? 'active' : '' }}">
                        <a href="{{ route('reports.index') }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>Dokumentasi & Laporan</p>
                        </a>
                    </li>

                    {{-- Komentar Publik --}}
                    <li class="nav-item {{ request()->is('dashboard/comments*') ? 'active' : '' }}">
                        <a href="/dashboard/comments">
                            <i class="fas fa-comments"></i>
                            <p>Komentar Publik</p>
                        </a>
                    </li>

                    {{-- Tarik Dana --}}
                    <li class="nav-item {{ request()->is('dashboard/withdrawals*') ? 'active' : '' }}">
                        <a href="{{ route('withdrawals.index') }}">
                            <i class="fas fa-money-check-alt"></i>
                            <p>Tarik Dana</p>
                        </a>
                    </li>

                    {{-- Kelola Donasi --}}
                    <li class="nav-item {{ request()->is('dashboard/donations*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.donations.index') }}">
                            <i class="fas fa-hand-holding-heart"></i>
                            <p>Kelola Donasi</p>
                        </a>
                    </li>

                    {{-- Kritik & Saran --}}
                    <li class="nav-item {{ request()->is('dashboard/feedback*') ? 'active' : '' }}">
                        <a href="/dashboard/feedback">
                            <i class="fas fa-envelope-open"></i>
                            <p>Kritik & Saran</p>
                        </a>
                    </li>
                @endif

                {{-- ADMIN-ONLY MENU ITEMS --}}
                @if(auth()->user()->role == 'admin')
                    {{-- Kelola Kategori --}}
                    <li class="nav-item {{ request()->is('dashboard/categories*') ? 'active' : '' }}">
                        <a href="/dashboard/categories">
                            <i class="fas fa-layer-group"></i>
                            <p>Kelola Kategori</p>
                        </a>
                    </li>

                    {{-- Admin section header --}}
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis"></i>
                        </span>
                        <h4 class="text-section">Admin Menu</h4>
                    </li>

                    {{-- Kelola Pengguna --}}
                    <li class="nav-item {{ request()->is('dashboard/users*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.users.index') }}">
                            <i class="fas fa-user-lock"></i>
                            <p>Kelola Pengguna</p>
                        </a>
                    </li>

                    {{-- Kelola Pesan Masuk --}}
                    <li class="nav-item {{ request()->is('dashboard/messages*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.messages.index') }}">
                            <i class="fas fa-envelope"></i>
                            <p>Kelola Pesan Masuk</p>
                            @php
                                $unreadMessagesCount = \App\Models\Message::unread()->count();
                            @endphp
                            @if($unreadMessagesCount > 0)
                                <span class="badge badge-danger">{{ $unreadMessagesCount }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- Pengaturan Konten --}}
                    <li class="nav-item {{ request()->is('dashboard/general*') ? 'active' : '' }}">
                        <a href="/dashboard/general">
                            <i class="fas fa-cog"></i>
                            <p>Pengaturan Konten</p>
                        </a>
                    </li>
                @endif

                {{-- DONOR-ONLY MENU ITEMS --}}
                @if(auth()->user()->role == 'donor')
                    {{-- Riwayat Donasi --}}
                    <li class="nav-item {{ request()->is('dashboard/donations*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.donations.my') }}">
                            <i class="fas fa-history"></i>
                            <p>Riwayat Donasi</p>
                        </a>
                    </li>
                @endif

                {{-- MENU ITEMS FOR ALL ROLES --}}
                {{-- Profil Saya --}}
                <li class="nav-item {{ request()->is('dashboard/profile*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.profile.index') }}">
                        <i class="fas fa-user"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>

                {{-- Logout with danger color --}}
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" id="logout-btn" class="text-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
