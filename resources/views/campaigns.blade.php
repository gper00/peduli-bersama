@extends('layouts.app')

@section('title', 'Daftar Kampanye | Peduli Bersama')

@section('content')
<!-- Hero Banner -->
<div class="bg-gradient-to-r from-blue-800 to-blue-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Kampanye Penggalangan Dana</h1>
                <p class="text-blue-100 text-lg mb-6">Temukan kampanye yang sesuai dengan kepedulian Anda. Setiap donasi kecil dapat membawa perubahan besar bagi mereka yang membutuhkan.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="bg-white text-blue-800 hover:bg-blue-100 font-medium py-2 px-6 rounded-md shadow-sm transition duration-300 flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Mulai Galang Dana
                    </a>
                    <a href="#filter-section" class="bg-blue-700 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md shadow-sm transition duration-300 flex items-center">
                        <i class="fas fa-filter mr-2"></i> Filter Kampanye
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-end">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="People helping each other" class="rounded-lg shadow-lg w-full md:max-w-md h-64 object-cover">
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Category Tabs -->
        <div class="mb-8 bg-white rounded-lg shadow-md p-4 overflow-x-auto">
            <div class="flex space-x-2 min-w-max">
                <a href="{{ route('public.campaigns') }}" class="{{ !request()->has('category') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} px-4 py-2 rounded-md font-medium transition">
                    Semua Kategori
                </a>
                @foreach($categories ?? [] as $category)
                <a href="{{ route('public.campaigns', ['category' => $category->slug]) }}" class="{{ request('category') == $category->slug ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} px-4 py-2 rounded-md font-medium transition">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>

        <!-- Filter Section -->
        <div id="filter-section" class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-sliders-h mr-2 text-blue-600"></i> Filter Kampanye
            </h3>
            <form action="{{ route('public.campaigns') }}" method="GET" class="space-y-6">
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="q" id="search" value="{{ request('q') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari kampanye...">
                        </div>
                    </div>

                    <div class="flex-1">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category" id="category" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                        <select name="sort" id="sort" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="most_funded" {{ request('sort') == 'most_funded' ? 'selected' : '' }}>Dana Terbanyak</option>
                            <option value="most_urgent" {{ request('sort') == 'most_urgent' ? 'selected' : '' }}>Paling Mendesak</option>
                            <option value="almost_funded" {{ request('sort') == 'almost_funded' ? 'selected' : '' }}>Hampir Mencapai Target</option>
                            <option value="all" {{ request('sort') == 'all' ? 'selected' : '' }}>Tampilkan Semua (Termasuk Berakhir)</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <input id="only_featured" name="featured" type="checkbox" {{ request('featured') ? 'checked' : '' }} value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="only_featured" class="ml-2 block text-sm text-gray-700">Hanya Tampilkan Kampanye Unggulan</label>
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition duration-300">
                            <i class="fas fa-filter mr-2"></i>Filter
                        </button>
                        <a href="{{ route('public.campaigns') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-times-circle"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Kampanye ({{ $campaigns->total() }})</h2>
                <p class="text-gray-600">Menampilkan {{ $campaigns->firstItem() ?? 0 }}-{{ $campaigns->lastItem() ?? 0 }} dari {{ $campaigns->total() }} kampanye</p>
            </div>

            @if($campaigns->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="inline-flex items-center justify-center h-24 w-24 rounded-full bg-gray-100 text-gray-400 mb-6">
                        <i class="fas fa-search text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">Tidak Ada Kampanye Ditemukan</h3>
                    <p class="text-gray-600 mb-6">Tidak ada kampanye yang sesuai dengan filter Anda. Silakan coba kriteria pencarian yang berbeda.</p>
                    <a href="{{ route('public.campaigns') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition duration-300">
                        Lihat Semua Kampanye
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($campaigns as $campaign)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="relative">
                            @if($campaign->cover_image && Storage::disk('public')->exists($campaign->cover_image))
                                <img src="{{ Storage::url($campaign->cover_image) }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover object-center">
                            @else
                                <img src="{{ asset('storage/default/campaign.jpg') }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover object-center">
                            @endif
                            @if($campaign->featured)
                            <div class="absolute top-2 left-2 bg-yellow-400 text-white text-xs font-bold px-2 py-1 rounded">
                                <i class="fas fa-star mr-1"></i> Unggulan
                            </div>
                            @endif
                            <span class="absolute top-2 right-2 bg-white bg-opacity-90 text-gray-700 text-xs font-bold px-2 py-1 rounded-full">
                                <i class="fas fa-calendar-alt mr-1"></i> {{ $campaign->end_date && $campaign->end_date->gt(now()) ? $campaign->end_date->diffInDays(now()) : 0 }} hari lagi
                            </span>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center text-xs text-gray-500 mb-2">
                                @if($campaign->category)
                                <span class="bg-{{ $campaign->category->color ?? 'gray-100' }} text-{{ $campaign->category->color ? $campaign->category->color . '-800' : 'gray-800' }} px-2 py-1 rounded">
                                    {{ $campaign->category->name }}
                                </span>
                                @else
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">
                                    Tidak Berkategori
                                </span>
                                @endif
                                <span class="mx-2">•</span>
                                <span>{{ $campaign->donor_count ?? 0 }} donatur</span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">
                                <a href="{{ route('public.campaign', $campaign->slug) }}" class="hover:text-blue-600">{{ $campaign->title }}</a>
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $campaign->short_description }}</p>

                            <div class="mb-4">
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                                    <div style="width: {{ $campaign->target_amount > 0 ? ($campaign->current_amount / $campaign->target_amount) * 100 : 0 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600"></div>
                                </div>
                                <div class="flex justify-between items-center mt-2 text-xs text-gray-500">
                                    <span>{{ $campaign->target_amount > 0 ? round(($campaign->current_amount / $campaign->target_amount) * 100) : 0 }}% tercapai</span>
                                    <span>{{ $campaign->end_date ? $campaign->end_date->format('d M Y') : 'Tidak ada batas' }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="block text-gray-900 font-bold">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-500">dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('public.campaign', $campaign->slug) }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-md shadow-sm transition duration-300">
                                    Donasi
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $campaigns->withQueryString()->links() }}
                </div>
            @endif
        </div>

        <!-- Call to Action -->
        <div class="bg-blue-50 rounded-lg shadow-md p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ingin Menjadi Campaign Creator?</h2>
            <p class="text-gray-600 mb-6 max-w-3xl mx-auto">Anda dapat memulai kampanye sendiri untuk membantu orang-orang di sekitar Anda. Hubungi kami untuk mendaftar sebagai campaign creator dan mulai mengumpulkan donasi untuk kegiatan sosial.</p>
            <a href="{{ route('public.contact') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md shadow-sm transition duration-300 inline-flex items-center">
                <i class="fas fa-paper-plane mr-2"></i>
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
