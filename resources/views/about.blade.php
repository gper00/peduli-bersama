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
    <p class="text-lg text-blue-600 max-w-2xl mx-auto">
      Para individu berdedikasi yang berkomitmen menjadikan filantropi mudah diakses oleh semua orang.
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl group">
      <div class="aspect-w-4 aspect-h-3 relative overflow-hidden">
        <img src="{{ asset('img/umam.png') }}" alt="Founder & CEO"
             class="w-full h-full object-cover object-center transform group-hover:scale-110 transition duration-500 aspect-square">
      </div>
      <div class="p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-1">Umam Alparizi</h3>
        <p class="text-blue-600 font-medium mb-3">Founder & CEO</p>
        <p class="text-gray-600 text-sm mb-4">
          Memiliki visi untuk membuat dunia menjadi tempat yang lebih baik melalui kekuatan donasi kolektif dan teknologi yang inovatif.
        </p>
        <div class="flex space-x-3">
          <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
            <i class="fab fa-twitter"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl group">
      <div class="aspect-w-4 aspect-h-3 relative overflow-hidden">
        <img src="{{ asset('img/abdi.jpeg') }}" alt="Program Manager"
             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 aspect-square"
             style="ocject-postition: 50% 30%">
      </div>
      <div class="p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-1">Yusri Abdi</h3>
        <p class="text-blue-600 font-medium mb-3">Program Manager</p>
        <p class="text-gray-600 text-sm mb-4">
          Berpengalaman dalam manajemen program sosial dan pengembangan komunitas dengan fokus pada dampak berkelanjutan.
        </p>
        <div class="flex space-x-3">
          <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
            <i class="fab fa-twitter"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl group">
      <div class="aspect-w-4 aspect-h-3 relative overflow-hidden">
        <img src="{{ asset('img/fadila.jpeg') }}" alt="Tech Lead"
             class="w-full h-full object-cover object-center transform group-hover:scale-110 transition duration-500 aspect-square">
      </div>
      <div class="p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-1">Fadila Rahmania</h3>
        <p class="text-blue-600 font-medium mb-3">Tech Lead</p>
        <p class="text-gray-600 text-sm mb-4">
          Ahli teknologi dengan passion untuk membangun platform yang aman, scalable, dan user-friendly untuk impact sosial.
        </p>
        <div class="flex space-x-3">
          <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Impact Section -->
<div class="bg-gray-100 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-800 mb-4">Dampak Sosial Kami</h2>
      <p class="text-blue-600 max-w-2xl mx-auto">
        Setiap donasi membuat perbedaan nyata dalam kehidupan masyarakat Indonesia
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-home text-blue-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 text-center mb-2">500+</h3>
        <p class="text-gray-600 text-center">Rumah dibangun untuk korban bencana alam di seluruh Indonesia</p>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-graduation-cap text-blue-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 text-center mb-2">1,000+</h3>
        <p class="text-gray-600 text-center">Anak mendapatkan beasiswa pendidikan untuk masa depan yang lebih baik</p>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-hospital text-blue-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 text-center mb-2">750+</h3>
        <p class="text-gray-600 text-center">Pasien mendapatkan akses ke layanan kesehatan dan pengobatan yang diperlukan</p>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-hands-helping text-blue-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 text-center mb-2">250+</h3>
        <p class="text-gray-600 text-center">Komunitas diberdayakan melalui program-program pengembangan berkelanjutan</p>
      </div>
    </div>

    <div class="mt-12 text-center">
      <a href="{{ route('public.campaigns') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:text-lg transition duration-300">
        <i class="fas fa-chart-line mr-2"></i>
        Lihat Semua Dampak Kami
      </a>
    </div>
  </div>
</div>

<!-- Testimonials -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
  <div class="text-center mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Testimonial</h2>
    <p class="text-blue-600 max-w-2xl mx-auto">
      Apa kata mereka yang telah menggunakan platform Peduli Bersama
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-lg shadow-md relative">
      <div class="absolute -top-4 -left-4 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
        <i class="fas fa-quote-left text-blue-600 text-xl"></i>
      </div>
      <p class="text-gray-600 italic mb-6 pt-4">"Terima kasih Peduli Bersama telah membantu kampanye pengobatan anak saya. Berkat platform ini, kami mendapatkan dukungan dari berbagai pihak dan sekarang anak saya telah sembuh."</p>
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="fas fa-user text-blue-600"></i>
          </div>
        </div>
        <div class="ml-3">
          <h4 class="text-base font-semibold text-gray-900">Sarah Wijaya</h4>
          <p class="text-sm text-blue-600">Ibu dari Penerima Donasi</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md relative">
      <div class="absolute -top-4 -left-4 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
        <i class="fas fa-quote-left text-blue-600 text-xl"></i>
      </div>
      <p class="text-gray-600 italic mb-6 pt-4">"Sebagai penggalang dana untuk korban banjir di daerah kami, Peduli Bersama memberikan platform yang sangat mudah digunakan dan transparan. Kami berhasil mengumpulkan dana melebihi target!"</p>
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="fas fa-user text-blue-600"></i>
          </div>
        </div>
        <div class="ml-3">
          <h4 class="text-base font-semibold text-gray-900">Budi Santoso</h4>
          <p class="text-sm text-blue-600">Penggalang Dana Komunitas</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md relative">
      <div class="absolute -top-4 -left-4 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
        <i class="fas fa-quote-left text-blue-600 text-xl"></i>
      </div>
      <p class="text-gray-600 italic mb-6 pt-4">"Berdonasi melalui Peduli Bersama memberikan kepastian bahwa dana saya benar-benar tersalurkan kepada yang membutuhkan. Saya selalu mendapatkan update transparansi penggunaan dana."</p>
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="fas fa-user text-blue-600"></i>
          </div>
        </div>
        <div class="ml-3">
          <h4 class="text-base font-semibold text-gray-900">Amanda Putri</h4>
          <p class="text-sm text-blue-600">Donatur Reguler</p>
        </div>
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
