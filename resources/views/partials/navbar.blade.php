<nav x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10; $el.classList.toggle('scrolled', scrolled); })" class="fixed w-full z-50 transition-all duration-300 {{ (isset($hasHero) && $hasHero) ? 'bg-transparent shadow-lg/10' : 'bg-white shadow' }}" id="main-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 transition-all duration-300" id="nav-container">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    {{-- <i class="fas fa-heart text-blue-500 text-2xl mr-2"></i> --}}
                    <span :class="scrolled ? 'text-blue-600' : '{{ (isset($hasHero) && $hasHero) ? 'text-white' : 'text-blue-600' }}'" class="text-xl font-semibold transition-colors duration-300" id="logo-text">Peduli Bersama</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 {{ request()->routeIs('home') ? 'font-bold underline' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('public.campaigns') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 {{ request()->is('campaigns*') ? 'font-bold underline' : '' }}">
                    Galang Dana
                </a>
                <a href="{{ url('/about') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 {{ request()->is('about') ? 'font-bold underline' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ url('/contact') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 {{ request()->is('contact') ? 'font-bold underline' : '' }}">
                    Hubungi Kami
                </a>

                @guest
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="btn-masuk px-4 py-2 rounded-md text-sm font-medium transition duration-300 {{ (isset($hasHero) && $hasHero) ? '' : 'bg-blue-600 text-white hover:bg-blue-700' }} {{ (isset($hasHero) && $hasHero) ? 'text-blue-600 hover:text-blue-700' : '' }}">
                        Masuk
                    </a>
                    <a href="{{ route('register', ['redirect' => url()->current()]) }}" class="{{ (isset($hasHero) && $hasHero) ? 'bg-white text-blue-600 hover:bg-blue-50' : 'bg-blue-100 text-blue-700 hover:bg-blue-200' }} px-4 py-2 rounded-md text-sm font-medium transition duration-300 ml-2">
                        Daftar
                    </a>
                @else
                    <div class="relative" x-data="{ notificationOpen: false }" class="mr-4">
                        <button @click="notificationOpen = !notificationOpen" class="flex items-center px-2 py-2 rounded-md text-sm font-medium focus:outline-none"
                            :class="scrolled ? 'text-gray-700 hover:text-blue-500' : '{{ (isset($hasHero) && $hasHero) ? 'text-white hover:text-blue-200' : 'text-gray-700 hover:text-blue-500' }}'">
                            <div class="relative">
                                <i :class="scrolled ? 'text-gray-700' : '{{ (isset($hasHero) && $hasHero) ? 'text-white' : 'text-gray-600' }}'" class="fas fa-bell text-lg"></i>
                                <span id="notification-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">0</span>
                            </div>
                        </button>

                        <div x-show="notificationOpen" @click.away="notificationOpen = false" class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-10">
                            <div class="p-3 border-b border-gray-100">
                                <h3 class="text-sm font-semibold text-gray-700">Notifikasi</h3>
                            </div>
                            <div id="notifications-container" class="max-h-64 overflow-y-auto">
                                <div class="text-center text-gray-500 py-4 text-sm" id="no-notifications">Memuat notifikasi...</div>
                            </div>
                            <div class="p-2 border-t border-gray-100 text-center">
                                <a href="{{ route('dashboard.notifications.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua Notifikasi</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center px-3 py-2 rounded-md text-sm font-medium focus:outline-none"
                            :class="scrolled ? 'text-gray-700 hover:text-blue-500' : '{{ (isset($hasHero) && $hasHero) ? 'text-white hover:text-blue-200' : 'text-gray-700 hover:text-blue-500' }}'">
                            <span>{{ Auth::user()->name }}</span>
                            <i :class="scrolled ? 'text-gray-700' : '{{ (isset($hasHero) && $hasHero) ? 'text-white' : 'text-gray-700' }}'" class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            <a href="{{ route('dashboard.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profil
                            </a>

                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('dashboard.users.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Admin Dashboard
                                </a>
                            @endif

                            @if(Auth::user()->isDonor())
                                <a href="{{ route('dashboard.donations.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Donasi Saya
                                </a>
                            @endif

                            @if(Auth::user()->isCreator())
                                <a href="{{ route('dashboard.campaigns.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Campaign Saya
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Buka menu utama</span>
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'font-bold underline' : '' }}">
                Beranda
            </a>
            <a href="{{ route('public.campaigns') }}" class="nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->is('campaigns*') ? 'font-bold underline' : '' }}">
                Galang Dana
            </a>
            <a href="{{ url('/about') }}" class="nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->is('about') ? 'font-bold underline' : '' }}">
                Tentang Kami
            </a>
            <a href="{{ url('/contact') }}" class="nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->is('contact') ? 'font-bold underline' : '' }}">
                Hubungi Kami
            </a>

            @guest
                <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="nav-link block px-3 py-2 rounded-md text-base font-medium">
                    Masuk
                </a>
                <a href="{{ route('register', ['redirect' => url()->current()]) }}" class="nav-link block px-3 py-2 rounded-md text-base font-medium">
                    Daftar
                </a>
            @else
                <a href="{{ route('dashboard.profile.index') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                    Profil
                </a>

                @if(Auth::user()->isAdmin())
                    <a href="{{ route('dashboard.users.index') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                        Admin Dashboard
                    </a>
                @endif

                @if(Auth::user()->isDonor())
                    <a href="{{ route('dashboard.donations.my') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                        Donasi Saya
                    </a>
                @endif

                @if(Auth::user()->isCreator())
                    <a href="{{ route('dashboard.campaigns.my') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                        Campaign Saya
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                        Keluar
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- Alpine.js for dropdown functionality -->
<script src="//unpkg.com/alpinejs" defer></script>

<style>
    .nav-link {
        color: {{ (isset($hasHero) && $hasHero) ? 'white' : '#374151' }};
        transition: color 0.2s;
    }
    .nav-link:hover {
        color: {{ (isset($hasHero) && $hasHero) ? '#fff' : '#2563eb' }};
        text-decoration: underline;
    }
    .scrolled {
        background: #fff !important;
        box-shadow: 0 2px 16px 0 rgba(30,64,175,0.07) !important;
    }
    .scrolled .nav-link {
        color: #374151 !important;
    }
    .scrolled .nav-link:hover {
        color: #2563eb !important;
    }
    .scrolled #logo-text {
        color: #2563eb !important;
    }
    .scrolled .btn-masuk {
        background: #2563eb !important;
        color: #fff !important;
        border: none !important;
    }
    .scrolled .btn-masuk:hover {
        background: #1d4ed8 !important;
        color: #fff !important;
    }
</style>

<!-- Mobile menu toggle script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('.mobile-menu-button');
        const menu = document.querySelector('#mobile-menu');
        const nav = document.getElementById('main-nav');
        const navContainer = document.getElementById('nav-container');
        const logoText = document.getElementById('logo-text');

        // Mobile menu toggle
        button.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });

        // Navbar scroll effect only if $hasHero is true
        if (@json($hasHero)) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    nav.classList.add('bg-white', 'shadow-md', 'scrolled');
                    nav.classList.remove('bg-transparent');
                    navContainer.classList.remove('h-20');
                    navContainer.classList.add('h-16');
                    logoText.classList.remove('text-white');
                    logoText.classList.add('text-blue-600');
                } else {
                    nav.classList.remove('bg-white', 'shadow-md', 'scrolled');
                    nav.classList.add('bg-transparent');
                    navContainer.classList.remove('h-16');
                    navContainer.classList.add('h-20');
                    logoText.classList.add('text-white');
                    logoText.classList.remove('text-blue-600');
                }
            });
        }

        // Notifikasi pesan masuk untuk admin
        if (document.getElementById('notification-badge')) {
            loadMessageNotifications();
            setInterval(loadMessageNotifications, 60000); // Refresh setiap 60 detik
        }
    });

    // Fungsi untuk memuat notifikasi
    function loadMessageNotifications() {
        fetch('{{ route("dashboard.notifications.unread-count") }}')
            .then(response => response.json())
            .then(data => {
                const notificationBadge = document.getElementById('notification-badge');
                const count = data.count;

                if (count > 0) {
                    notificationBadge.textContent = count;
                    notificationBadge.style.display = 'flex';

                    // Ambil notifikasi terbaru
                    return fetch('{{ route("dashboard.notifications.latest") }}');
                } else {
                    notificationBadge.style.display = 'none';

                    const noNotifications = document.getElementById('no-notifications');
                    if (noNotifications) {
                        noNotifications.textContent = 'Tidak ada notifikasi baru';
                    }
                }
            })
            .then(response => {
                if (response) return response.json();
                return null;
            })
            .then(data => {
                if (data && data.notifications && data.notifications.length > 0) {
                    const container = document.getElementById('notifications-container');
                    container.innerHTML = '';

                    data.notifications.forEach(notification => {
                        let icon = 'bell';
                        let iconColor = 'text-yellow-500';

                        if (notification.type === 'donation') {
                            icon = 'donate';
                            iconColor = 'text-green-500';
                        } else if (notification.type === 'feedback') {
                            icon = 'comment-alt';
                            iconColor = 'text-blue-500';
                        }

                        const timeAgo = new Date(notification.created_at).toLocaleString('id-ID');

                        container.innerHTML += `
                            <div class="p-3 border-b border-gray-100 hover:bg-gray-50">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-${icon} ${iconColor}"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">${notification.title}</p>
                                        <p class="text-sm text-gray-500">${notification.message}</p>
                                        <p class="text-xs text-gray-400 mt-1">${timeAgo}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                }
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
            });
    }
</script>
