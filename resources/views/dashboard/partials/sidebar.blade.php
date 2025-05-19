<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ (isset($dashboardPage) ? 'active' : '') }}">
                    <a href="/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Content</h4>
                </li> --}}
                {{-- <li class="nav-item {{ isset($postPage) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#article">
                        <i class="fas fa-newspaper"></i>
                        <p>Articles / Posts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ isset($postPage) ? 'show' : '' }}" id="article">
                        <ul class="nav nav-collapse mb-0">
                            <li class="{{ isset($postPage) && !isset($postCategoryPage) ? 'active' : '' }}">
                                <a href="/dashboard/posts">
                                    <span class="sub-item">Posts</span>
                                </a>
                            </li>
                            <li class="{{ isset($postPage) && isset($postCategoryPage) ? 'active' : '' }}">
                                <a href="/dashboard/post-categories">
                                    <span class="sub-item">Post Categories</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-bullhorn"></i>
                        <p>Kelola Campaigns</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-layer-group"></i>
                        <p>Kelola Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <p>Dokumentasi & Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-comments"></i>
                        <p>Komentar Publik</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-money-check-alt"></i>
                        <p>Tarik Dana</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-history"></i>
                        <p>Riwayat Donasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-envelope-open"></i>
                        <p>Kritik & Saran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/campaigns">
                        <i class="fas fa-user"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis"></i>
                    </span>
                    <h4 class="text-section">Others</h4>
                </li>
                <li class="nav-item {{ isset($userPage) ? 'active' : '' }}">
                    <a href="/dashboard/users">
                        <i class="fas fa-user-lock"></i>
                        <p>Kelola Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/inbox">
                        <i class="fas fa-envelope"></i>
                        <p>Pesan Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/general">
                        <i class="fas fa-cog"></i>
                        <p>Pengaturan Konten</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
