@extends('layouts.app')

@section('title', 'Tentang Kami | Peduli Bersama')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">
      Tentang Peduli Bersama
    </h1>
    <p class="text-xl max-w-3xl mx-auto">
      Menghubungkan hati yang dermawan dengan penyebab yang bermakna untuk menciptakan perubahan positif dalam masyarakat.
    </p>
  </div>
</div>

<!-- About Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    <div>
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Cerita Kami</h2>
      <p class="text-gray-700 mb-4">
        Didirikan pada tahun 2022, Peduli Bersama dimulai sebagai komunitas kecil yang peduli terhadap permasalahan sosial di Indonesia. Dengan semangat kebersamaan dan gotong royong, kami menciptakan platform penggalangan dana yang terpercaya dan transparan.
      </p>
      <p class="text-gray-700 mb-6">
        Kami percaya bahwa setiap orang memiliki kesempatan untuk berkontribusi pada perubahan yang mereka inginkan, tanpa memandang besarnya donasi. Platform kami memastikan bahwa 100% donasi Anda langsung disalurkan ke penyebab yang Anda pilih, tanpa biaya tersembunyi.
      </p>

      <div class="grid grid-cols-2 gap-4 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
          <div class="text-4xl font-bold text-blue-600 mb-2">100+</div>
          <div class="text-blue-600">Kampanye Sukses</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
          <div class="text-4xl font-bold text-blue-600 mb-2">500jt+</div>
          <div class="text-blue-600">Dana Terkumpul</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
          <div class="text-4xl font-bold text-blue-600 mb-2">10+</div>
          <div class="text-blue-600">Provinsi Terjangkau</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
          <div class="text-4xl font-bold text-blue-600 mb-2">100%</div>
          <div class="text-blue-600">Transparansi</div>
        </div>
      </div>

      <a href="{{ route('public.campaigns') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg inline-block">
        Lihat Kampanye Kami
      </a>
    </div>

    <div class="relative">
      <img
        src="{{ asset('storage/default/image.jpg') }}"
        alt="Peduli Bersama Volunteers"
        class="rounded-lg shadow-xl w-full h-auto"
      />
      <div
        class="absolute -bottom-4 -right-4 bg-white p-4 rounded-lg shadow-lg">
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
            <i class="fas fa-check text-blue-600 text-xl"></i>
          </div>
          <div>
            <div class="font-bold text-gray-800">Organisasi Terverifikasi</div>
            <div class="text-blue-600 text-sm">Semua kampanye diverifikasi dengan teliti</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Mission Section -->
<div class="bg-blue-50 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-800 mb-4">
        Misi & Nilai Kami
      </h2>
      <p class="text-blue-600 max-w-2xl mx-auto">
        Kami berkomitmen untuk menciptakan dunia di mana kedermawanan mudah diakses, berdampak, dan transparan.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-handshake text-blue-600 text-xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Transparansi</h3>
        <p class="text-gray-600 leading-relaxed">
          Kami beroperasi dengan transparansi penuh, memastikan setiap donasi dapat dilacak dan mencapai penerima manfaat yang dituju.
        </p>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-globe text-blue-600 text-xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Inklusivitas</h3>
        <p class="text-gray-600 leading-relaxed">
          Kami percaya dalam mendukung berbagai penyebab dan komunitas, tanpa memandang lokasi, latar belakang, atau ukuran.
        </p>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-heart text-blue-600 text-xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dampak</h3>
        <p class="text-gray-600 leading-relaxed">
          Kami mengukur keberhasilan berdasarkan perubahan nyata yang tercipta di masyarakat, selalu berusaha untuk solusi berkelanjutan jangka panjang.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Team Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
  <div class="text-center mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Tim Kami</h2>
    <p class="text-blue-600 max-w-2xl mx-auto">
      Para individu berdedikasi yang berkomitmen menjadikan filantropi mudah diakses oleh semua orang.
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
      <div class="p-6">
        <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-user text-blue-600 text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Pimpinan Yayasan</h3>
        <p class="text-blue-600 text-center mb-4">Founder & CEO</p>
        <p class="text-gray-600 text-center">
          Memiliki visi untuk membuat dunia menjadi tempat yang lebih baik melalui kekuatan donasi kolektif.
        </p>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
      <div class="p-6">
        <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-user text-blue-600 text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Manajer Program</h3>
        <p class="text-blue-600 text-center mb-4">Program & Operasional</p>
        <p class="text-gray-600 text-center">
          Memimpin upaya untuk mengidentifikasi dan mendukung kampanye yang berdampak signifikan.
        </p>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
      <div class="p-6">
        <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-user text-blue-600 text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Kepala Teknologi</h3>
        <p class="text-blue-600 text-center mb-4">IT & Pengembangan</p>
        <p class="text-gray-600 text-center">
          Menciptakan pengalaman digital yang mudah digunakan dan aman bagi pengguna platform.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Call to Action -->
<div class="bg-blue-600 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl font-bold text-white mb-4">Siap Membuat Perubahan?</h2>
    <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
      Bergabunglah dengan ribuan donatur yang telah membantu kampanye kami atau mulai kampanye penggalangan dana Anda sendiri.
    </p>
    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
      <a href="{{ route('public.campaigns') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-md text-base font-medium shadow-lg transition duration-300">
        Lihat Kampanye
      </a>
      @if(auth()->check())
        <a href="{{ route('dashboard.campaigns.create') }}" class="bg-blue-800 text-white hover:bg-blue-700 px-8 py-3 rounded-md text-base font-medium shadow-lg transition duration-300">
          Mulai Kampanye
        </a>
      @else
        <a href="{{ route('login') }}" class="bg-blue-800 text-white hover:bg-blue-700 px-8 py-3 rounded-md text-base font-medium shadow-lg transition duration-300">
          Login untuk Mulai Kampanye
        </a>
      @endif
    </div>
  </div>
</div>
@endsection
