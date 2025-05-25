@extends('layouts.app')

@section('title', 'Beranda | Peduli Bersama - Platform Donasi Online')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-700 to-blue-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="md:flex md:items-center md:justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">
                    <span class="block">Bantu Wujudkan</span>
                    <span class="block text-blue-300">Perubahan Bersama</span>
                </h1>
                <p class="mt-4 text-xl text-blue-100 max-w-3xl">
                    Peduli Bersama menghubungkan Anda dengan mereka yang membutuhkan. Mari berdonasi dan berikan dampak nyata untuk perubahan.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row sm:gap-4">
                    <a href="{{ route('public.campaigns') }}" class="w-full sm:w-auto mb-4 sm:mb-0 flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-900 bg-white hover:bg-blue-50 md:py-4 md:text-lg md:px-10 transition duration-300">
                        <i class="fas fa-hand-holding-heart mr-2"></i> Donasi Sekarang
                    </a>
                    <a href="#how-it-works" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-blue-800 md:py-4 md:text-lg md:px-10 transition duration-300">
                        <i class="fas fa-info-circle mr-2"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
                <div class="mt-6 flex items-center text-blue-200">
                    <i class="fas fa-shield-alt text-2xl mr-2"></i>
                    <p>100% aman dan transparan</p>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1469571486292-b53601019a8a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="People helping each other" class="rounded-lg shadow-lg w-full object-cover h-96">
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="bg-white py-12 -mt-6 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-blue-50 rounded-lg shadow-md p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $totalCampaigns ?? '50+' }}</div>
                <p class="text-gray-600">Kampanye Aktif</p>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $totalDonations ?? 'Rp500 Jt+' }}</div>
                <p class="text-gray-600">Total Donasi</p>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $totalDonors ?? '1000+' }}</div>
                <p class="text-gray-600">Donatur</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Campaigns Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            <span class="border-b-4 border-blue-500 pb-2">Galang Dana Darurat</span>
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">
            Kampanye-kampanye berikut membutuhkan bantuan mendesak Anda
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($featuredCampaigns as $campaign)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="relative">
                <img src="{{ $campaign->featured_image }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover" />
                @if($campaign->featured)
                <div class="absolute top-2 left-2 bg-yellow-400 text-white text-xs font-bold px-2 py-1 rounded">
                    <i class="fas fa-star mr-1"></i> Unggulan
                </div>
                @endif
                <div class="absolute top-2 right-2 bg-white bg-opacity-90 text-gray-700 text-xs font-bold px-2 py-1 rounded-full">
                    <i class="fas fa-calendar-alt mr-1"></i> {{ $campaign->days_remaining }} hari lagi
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center text-xs text-gray-500 mb-2">
                    <span class="bg-{{ $campaign->category->color ?? 'gray-100' }} text-{{ $campaign->category->color ? $campaign->category->color . '-800' : 'gray-800' }} px-2 py-1 rounded">
                        {{ $campaign->category->name }}
                    </span>
                    <span class="mx-2">•</span>
                    <span>{{ $campaign->donor_count }} donatur</span>
                </div>
                
                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">
                    <a href="{{ route('public.campaign', $campaign->slug) }}" class="hover:text-blue-600">{{ $campaign->title }}</a>
                </h3>
                
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $campaign->short_description }}</p>
                
                <div class="mb-4">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ ($campaign->current_amount / $campaign->target_amount) * 100 }}%"></div>
                    </div>
                    <div class="flex justify-between items-center mt-2 text-xs text-gray-500">
                        <span>{{ round(($campaign->current_amount / $campaign->target_amount) * 100) }}% tercapai</span>
                        <span>{{ $campaign->formatted_end_date }}</span>
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <div>
                        <span class="block text-gray-900 font-bold">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span>
                        <span class="text-xs text-gray-500">dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('public.donate', $campaign->slug) }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-md shadow-sm transition duration-300">
                        Donasi
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-12">
        <a href="{{ route('public.campaigns') }}" class="border border-blue-500 text-blue-500 hover:bg-blue-50 px-6 py-3 rounded-full text-lg font-medium transition duration-300">
            Lihat Semua Kampanye
        </a>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="bg-blue-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Bagaimana Cara Kerjanya</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Proses sederhana untuk mulai membantu mereka yang membutuhkan
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mb-6 mx-auto">
                    <i class="fas fa-search text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Pilih Kampanye</h3>
                <p class="text-gray-600">
                    Telusuri kampanye dari berbagai kategori dan temukan yang sesuai dengan kepedulian Anda.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mb-6 mx-auto">
                    <i class="fas fa-hand-holding-heart text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Berikan Donasi</h3>
                <p class="text-gray-600">
                    Pilih nominal donasi dan metode pembayaran yang nyaman bagi Anda.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mb-6 mx-auto">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Lihat Dampaknya</h3>
                <p class="text-gray-600">
                    Dapatkan update tentang kampanye dan lihat bagaimana donasi Anda membuat perubahan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Cerita Inspirasi</h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            Dengarkan langsung dari donatur dan penerima manfaat tentang dampak yang kita buat bersama
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center mb-4">
                <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Sarah" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <h4 class="text-lg font-bold text-gray-800">Sarah J.</h4>
                    <p class="text-gray-500 text-sm">Donatur</p>
                </div>
            </div>
            <p class="text-gray-600 italic">
                "Saya sangat senang bisa berpartisipasi dalam kampanye ini. Melihat dampak langsung dari donasi saya membuat saya merasa bahwa setiap rupiah yang saya berikan benar-benar berarti."
            </p>
            <div class="mt-4 text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center mb-4">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Ahmad" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <h4 class="text-lg font-bold text-gray-800">Ahmad R.</h4>
                    <p class="text-gray-500 text-sm">Penerima Manfaat</p>
                </div>
            </div>
            <p class="text-gray-600 italic">
                "Bantuan yang diberikan melalui Peduli Bersama telah mengubah hidup keluarga kami. Anak-anak kami sekarang bisa bersekolah dengan peralatan yang layak. Terima kasih!"
            </p>
            <div class="mt-4 text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center mb-4">
                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Lina" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <h4 class="text-lg font-bold text-gray-800">Lina W.</h4>
                    <p class="text-gray-500 text-sm">Penggalang Dana</p>
                </div>
            </div>
            <p class="text-gray-600 italic">
                "Platform ini sangat mudah digunakan dan transparan. Saya bisa dengan mudah mengelola kampanye dan berinteraksi dengan para donatur. Sangat direkomendasikan!"
            </p>
            <div class="mt-4 text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
    </div>
</section>

<!-- Impact Stats -->
<section class="bg-green-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                Dampak Kolektif Kita
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Bersama-sama, kita telah membuat perubahan nyata bagi banyak orang
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-blue-500 text-4xl font-bold mb-2">{{ $totalCampaigns }}</div>
                <p class="text-gray-700 font-medium">Kampanye Aktif</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-blue-500 text-4xl font-bold mb-2">{{ $totalDonors }}</div>
                <p class="text-gray-700 font-medium">Total Donatur</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-blue-500 text-4xl font-bold mb-2">Rp {{ number_format($totalDonations, 0, ',', '.') }}</div>
                <p class="text-gray-700 font-medium">Dana Terkumpul</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-blue-500 text-4xl font-bold mb-2">{{ $successfulCampaigns }}</div>
                <p class="text-gray-700 font-medium">Kampanye Berhasil</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:flex-1 p-8 md:p-12 flex flex-col justify-center text-white">
                <h2 class="text-3xl font-bold mb-4">Mulai Galang Dana Anda Sendiri</h2>
                <p class="mb-6 text-white text-opacity-90">
                    Punya ide untuk membantu orang lain? Mulai kampanye Anda sendiri sekarang dan kami akan membantu Anda mencapai tujuan.
                </p>
                <div>
                    <a href="#" class="inline-block bg-white text-blue-600 hover:bg-gray-100 font-medium py-3 px-6 rounded-md shadow-sm transition duration-300">
                        Mulai Kampanye
                    </a>
                </div>
            </div>
            <div class="md:flex-1 bg-white p-8 md:p-12 flex flex-col justify-center">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Bergabunglah dengan 1000+ Penggalang Dana</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                        <span class="text-gray-600">Platform yang mudah digunakan dan transparan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                        <span class="text-gray-600">Berbagai metode pembayaran untuk kemudahan donatur</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                        <span class="text-gray-600">Dukungan tim untuk membantu kampanye Anda berhasil</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                        <span class="text-gray-600">Biaya layanan yang rendah untuk memaksimalkan dana</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
