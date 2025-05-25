<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <i class="fas fa-heart text-blue-500 text-2xl mr-2"></i>
                    <span class="text-xl font-semibold text-blue-600">Peduli Bersama</span>
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">
                    Beranda
                </a>
                <a href="{{ route('public.campaigns') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">
                    Galang Dana
                </a>
                <a href="{{ url('/about') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">
                    Tentang Kami
                </a>
                <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">
                    Hubungi Kami
                </a>
                
                @guest
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 border border-blue-500 hover:bg-blue-50 px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                        Daftar
                    </a>
                @else
                    @if(Auth::user()->role === 'admin')
                    <div class="relative" x-data="{ notificationOpen: false }" class="mr-4">
                        <button @click="notificationOpen = !notificationOpen" class="flex items-center text-gray-700 hover:text-blue-500 px-2 py-2 rounded-md text-sm font-medium focus:outline-none">
                            <div class="relative">
                                <i class="fas fa-bell text-gray-600 text-lg"></i>
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
                                <a href="{{ route('dashboard.messages.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua Pesan</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
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
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Buka menu utama</span>
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                Beranda
            </a>
            <a href="{{ route('public.campaigns') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                Galang Dana
            </a>
            <a href="#" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                Tentang Kami
            </a>
            
            @guest
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="block text-gray-700 hover:text-green-500 hover:bg-gray-50 px-3 py-2 rounded-md text-base font-medium">
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

<!-- Mobile menu toggle script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('.mobile-menu-button');
        const menu = document.querySelector('#mobile-menu');
        
        button.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
        
        // Notifikasi pesan masuk untuk admin
        if (document.getElementById('notification-badge')) {
            loadMessageNotifications();
            setInterval(loadMessageNotifications, 60000); // Refresh setiap 60 detik
        }
    });
    
    // Fungsi untuk memuat notifikasi pesan
    function loadMessageNotifications() {
        fetch('{{ route("dashboard.messages.unread-count") }}')
            .then(response => response.json())
            .then(data => {
                const notificationBadge = document.getElementById('notification-badge');
                const count = data.count;
                
                if (count > 0) {
                    notificationBadge.textContent = count;
                    notificationBadge.style.display = 'flex';
                    
                    // Ambil 5 pesan terbaru
                    return fetch('{{ route("dashboard.messages.index") }}?limit=5&format=json');
                } else {
                    notificationBadge.style.display = 'none';
                    
                    const noNotifications = document.getElementById('no-notifications');
                    if (noNotifications) {
                        noNotifications.textContent = 'Tidak ada pesan baru';
                    }
                }
            })
            .then(response => {
                if (response) return response.json();
                return null;
            })
            .then(data => {
                if (!data) return;
                
                const container = document.getElementById('notifications-container');
                if (!container) return;
                
                container.innerHTML = '';
                
                if (data.messages.length === 0) {
                    container.innerHTML = '<div class="text-center text-gray-500 py-4 text-sm">Tidak ada pesan baru</div>';
                    return;
                }
                
                data.messages.forEach(message => {
                    const item = document.createElement('a');
                    item.href = `/dashboard/messages/${message.id}`;
                    item.className = 'block p-3 hover:bg-gray-50 border-b border-gray-100';
                    
                    const content = `
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-medium text-gray-800">${message.subject}</p>
                            <span class="text-xs text-gray-500">${message.time_ago}</span>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">${message.name} - ${message.email}</p>
                    `;
                    
                    item.innerHTML = content;
                    container.appendChild(item);
                });
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
            });
    }
</script>
