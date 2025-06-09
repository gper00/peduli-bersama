@extends('layouts.app')

@section('title', 'Beranda | Peduli Bersama - Platform Donasi Online')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-700 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:16px]"></div>
    <div class="absolute h-full w-full bg-gradient-to-t from-blue-900/50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative">
        <div class="md:flex md:items-center md:justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl">
                    <span class="block mb-2">Bantu Wujudkan</span>
                    <span class="block text-blue-300">Perubahan Bersama</span>
                </h1>
                <p class="mt-6 text-lg leading-relaxed text-blue-100 max-w-2xl">
                    Platform donasi yang terpercaya untuk membantu sesama. Bergabunglah dengan ribuan orang yang telah
                    memberikan dampak positif bagi masyarakat.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-base font-medium rounded-lg bg-white text-blue-700 hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Mulai Donasi
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="{{ route('public.campaigns') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-base font-medium rounded-lg border-2 border-white text-white hover:bg-white hover:text-blue-700 transition-all duration-200">
                        Lihat Kampanye
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 relative">
                <img src="{{ asset('img/hero.jpg') }}" alt="Hero Image"
                     class="rounded-2xl shadow-2xl w-full transform hover:scale-105 transition-transform duration-500 ease-out">
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
                @if($campaign->cover_image)
                <img src="{{ asset('storage/' . $campaign->cover_image) }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover">
                @else
                <img src="{{ asset('storage/default/image.jpg') }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover">
                @endif
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
