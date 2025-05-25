<footer class="bg-gray-800 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <i class="fas fa-heart text-blue-500 text-2xl mr-2"></i>
                    <span class="text-xl font-semibold">Peduli Bersama</span>
                </div>
                <p class="text-gray-400 mb-4">
                    Platform donasi online yang menghubungkan orang-orang yang membutuhkan dengan para donatur yang ingin membantu.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Tentang Kami</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Visi & Misi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Tim Kami
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Cara Kerja
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Karir
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Bergabung</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('public.campaigns') }}" class="text-gray-400 hover:text-white transition duration-300">
                            Mulai Galang Dana
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Cara Berdonasi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Program Corporate
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Jadi Relawan
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-gray-400 mt-1 mr-2"></i>
                        <span class="text-gray-400">
                            Jl. Peduli No. 123, Jakarta Selatan, Indonesia
                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope text-gray-400 mt-1 mr-2"></i>
                        <span class="text-gray-400">info@pedulibersama.org</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone text-gray-400 mt-1 mr-2"></i>
                        <span class="text-gray-400">+62 21 1234 5678</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Peduli Bersama. Hak Cipta Dilindungi.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">
                        Syarat & Ketentuan
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">
                        Kebijakan Privasi
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">
                        FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
