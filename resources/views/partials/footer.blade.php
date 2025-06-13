<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Peduli Bersama</h3>
                <p class="text-gray-400 text-sm">
                    Platform donasi online yang menghubungkan para donatur dengan mereka yang membutuhkan bantuan.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm">Beranda</a></li>
                    <li><a href="{{ route('public.campaigns') }}" class="text-gray-400 hover:text-white text-sm">Galang Dana</a></li>
                    <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-white text-sm">Tentang Kami</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-white text-sm">Hubungi Kami</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        info@pedulibersama.com
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        +62 123 4567 890
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} Peduli Bersama. Hak Cipta Dilindungi.
                </p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
