@extends('layouts.app')

@section('title', $campaign->title . ' | Peduli Bersama')

@section('content')
    <!-- Campaign Hero Section -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div>
            <a href="{{ route('public.campaigns', ['category' => $campaign->category->slug]) }}" class="inline-block mb-4">
              <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-blue-200 transition">
                <i class="fas fa-tag mr-1"></i> {{ $campaign->category->name }}
              </span>
            </a>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
              {{ $campaign->title }}
            </h1>
            <p class="text-lg text-blue-100 mb-8">
              {{ $campaign->short_description ?? Str::limit($campaign->description, 150) }}
            </p>
            <div class="flex flex-wrap gap-4">
              <a href="{{ route('public.donate', $campaign->slug) }}" 
                class="bg-white hover:bg-blue-50 text-blue-800 px-6 py-3 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg flex items-center">
                <i class="fas fa-heart mr-2"></i> Donasi Sekarang
              </a>
              <button 
                onclick="navigator.share({title: '{{ $campaign->title }}', url: '{{ route('public.campaign', $campaign->slug) }}'})"
                class="border border-blue-300 text-white hover:bg-blue-800 px-6 py-3 rounded-md text-sm font-medium transition duration-300 flex items-center">
                <i class="fas fa-share-alt mr-2"></i> Bagikan
              </button>
            </div>
          </div>
          <div class="relative">
            <img
              src="{{ $campaign->featured_image ?? 'storage/default/image.jpg' }}"
              alt="{{ $campaign->title }}"
              class="rounded-lg shadow-xl w-full h-80 object-cover"
            />
            <div
              class="absolute -bottom-4 -right-4 bg-white p-4 rounded-lg shadow-lg"
            >
              <div class="text-center">
                <div class="text-3xl font-bold text-blue-600">Rp{{ number_format($campaign->current_amount, 0, ',', '.') }}</div>
                <div class="text-gray-600 text-sm">Dari target Rp{{ number_format($campaign->target_amount, 0, ',', '.') }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Campaign Details Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
          <!-- Story Section -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-2xl font-bold text-gray-800">Tentang Kampanye</h2>
              @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'creator' && auth()->id() === $campaign->user_id)))
              <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="flex items-center text-blue-600 hover:text-blue-800 transition">
                <i class="fas fa-edit mr-1"></i> Edit
              </a>
              @endif
            </div>
            
            <div class="prose max-w-none text-gray-700">
              {!! nl2br(e($campaign->description)) !!}
            </div>
            
            @if($campaign->images && count(json_decode($campaign->images)) > 0)
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
              @foreach(json_decode($campaign->images) as $image)
              <div>
                <img src="{{ $image }}" alt="{{ $campaign->title }}" class="rounded-lg w-full h-48 object-cover" />
              </div>
              @endforeach
            </div>
            @endif
            
            <div class="mt-6 flex items-center text-sm text-gray-500">
              <div class="flex items-center mr-6">
                <i class="fas fa-user-circle mr-1 text-blue-500"></i>
                <span>Oleh: {{ $campaign->user->name }}</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-1 text-blue-500"></i>
                <span>Dibuat: {{ $campaign->created_at->format('d M Y') }}</span>
              </div>
            </div>
          </div>

          <!-- Updates Section -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-2xl font-bold text-gray-800">Kabar Terbaru</h2>
              
              @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'creator' && auth()->id() === $campaign->user_id)))
              <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="flex items-center text-blue-600 hover:text-blue-800 transition">
                <i class="fas fa-plus-circle mr-1"></i> Kelola Kampanye
              </a>
              @endif
            </div>

            @forelse($campaign->updates ?? [] as $update)
            <div class="border-l-4 border-blue-600 pl-4 mb-6">
              <div class="text-sm text-gray-500 mb-1">{{ $update->created_at->format('d M Y') }}</div>
              <h3 class="text-lg font-semibold text-gray-800 mb-2">
                {{ $update->title }}
              </h3>
              <div class="text-gray-700 mb-2 prose max-w-none">
                {!! nl2br(e($update->content)) !!}
              </div>
              
              @if($update->images && count(json_decode($update->images)) > 0)
              <div class="grid grid-cols-2 gap-2 mt-3">
                @foreach(json_decode($update->images) as $image)
                <img src="{{ $image }}" alt="Update image" class="rounded w-full h-32 object-cover" />
                @endforeach
              </div>
              @endif
              
              @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'creator' && auth()->id() === $campaign->user_id)))
              <div class="mt-2 flex items-center space-x-2">
                <a href="{{ route('dashboard.campaigns.edit', $campaign->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                  <i class="fas fa-edit mr-1"></i> Edit Kampanye
                </a>
              </div>
              @endif
            </div>
            @empty
            <div class="text-center py-8">
              <i class="fas fa-newspaper text-4xl text-gray-300 mb-3"></i>
              <p class="text-gray-500">Belum ada update untuk kampanye ini.</p>
            </div>
            @endforelse
          </div>

          <!-- Donors Section -->
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
              Donatur Terbaru <span class="text-sm font-normal text-blue-600">({{ $campaign->donations_count ?? 0 }} total)</span>
            </h2>

            @if(isset($campaign->donations) && count($campaign->donations) > 0)
            <div class="space-y-4">
              @foreach($campaign->donations->take(5) as $donation)
              <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                  <i class="fas fa-user text-blue-600"></i>
                </div>
                <div>
                  <div class="font-medium text-gray-800">{{ $donation->is_anonymous ? 'Anonim' : $donation->user->name }}</div>
                  <div class="text-sm text-gray-500">
                    Donasi Rp{{ number_format($donation->amount, 0, ',', '.') }} - {{ $donation->created_at->diffForHumans() }}
                  </div>
                  @if($donation->message)
                  <div class="text-sm text-gray-600 mt-1 italic">"{{ Str::limit($donation->message, 50) }}"</div>
                  @endif
                </div>
              </div>
              @endforeach
            </div>
            @else
            <div class="text-center py-8">
              <i class="fas fa-hand-holding-heart text-4xl text-gray-300 mb-3"></i>
              <p class="text-gray-500">Belum ada donasi untuk kampanye ini.</p>
              <a href="{{ route('public.donate', $campaign->slug) }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                Jadilah Donatur Pertama
              </a>
            </div>
            @endif
            
            @if(isset($campaign->donations) && count($campaign->donations) > 5)
            <div class="mt-6 text-center">
              <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-chevron-down mr-1"></i> Lihat Semua Donatur
              </a>
            </div>
            @endif
          </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
          <!-- Progress Card -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">
              Progress Kampanye
            </h3>
            <div class="mb-3">
              <div class="flex justify-between mb-1">
                <span class="text-base font-medium text-gray-700">
                  Rp{{ number_format($campaign->current_amount, 0, ',', '.') }} terkumpul
                </span>
                <span class="text-sm font-medium text-gray-500">
                  dari Rp{{ number_format($campaign->target_amount, 0, ',', '.') }}
                </span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                @php
                  $percentFunded = $campaign->target_amount > 0 ? min(100, round(($campaign->current_amount / $campaign->target_amount) * 100)) : 0;
                @endphp
                <div
                  class="bg-blue-600 h-2.5 rounded-full"
                  style="width: {{ $percentFunded }}%"
                ></div>
              </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-6">
              <div class="text-center">
                <div class="text-2xl font-bold text-gray-800">{{ $percentFunded }}%</div>
                <div class="text-xs text-gray-500">Terdanai</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-gray-800">{{ $campaign->donations_count ?? 0 }}</div>
                <div class="text-xs text-gray-500">Donatur</div>
              </div>
              <div class="text-center">
                @php
                  $daysLeft = now()->diffInDays($campaign->end_date, false);
                @endphp
                <div class="text-2xl font-bold text-gray-800">{{ $daysLeft > 0 ? $daysLeft : 0 }}</div>
                <div class="text-xs text-gray-500">Hari Lagi</div>
              </div>
            </div>
            @if(auth()->check())
            <a
              href="{{ route('public.donate', $campaign->slug) }}"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md font-medium transition duration-300 block"
            >
              Donasi Sekarang
            </a>
            @else
            <a
              href="{{ route('login', ['redirect' => route('public.donate', $campaign->slug)]) }}"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md font-medium transition duration-300 block"
            >
              Login untuk Donasi
            </a>
            @endif
            <div class="mt-4 text-center">
              <button
                onclick="navigator.share({title: '{{ $campaign->title }}', url: '{{ route('public.campaign', $campaign->slug) }}'})"
                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex mx-auto items-center"
              >
                <i class="fas fa-share-alt mr-1"></i> Bagikan Kampanye Ini
              </button>
            </div>
          </div>

          <!-- Organizer Info -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Penggalang Dana</h3>
            <div class="flex items-center mb-4">
              <div
                class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4"
              >
                <i class="fas fa-user text-blue-600 text-xl"></i>
              </div>
              <div>
                <div class="font-medium text-gray-800">{{ $campaign->user->name }}</div>
                <div class="text-sm text-gray-500">{{ ucfirst($campaign->user->role) }}</div>
              </div>
            </div>
            @if($campaign->user->bio)
            <p class="text-gray-700 text-sm mb-4">
              {{ Str::limit($campaign->user->bio, 150) }}
            </p>
            @endif
            @if(auth()->check())
            <a
              href="mailto:{{ $campaign->user->email }}"
              class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center"
            >
              <i class="fas fa-envelope mr-1"></i> Hubungi Penggalang Dana
            </a>
            @else
            <a
              href="{{ route('login') }}"
              class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center"
            >
              <i class="fas fa-sign-in-alt mr-1"></i> Login untuk Menghubungi
            </a>
            @endif
            </div>
          </div>

          <!-- Campaign Info -->
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">
              Informasi Kampanye
            </h3>

            <div class="space-y-3">
              <div class="flex items-start">
                <div class="text-blue-500 mr-3"><i class="fas fa-tag"></i></div>
                <div>
                  <div class="text-sm font-medium text-gray-700">Kategori</div>
                  <div class="text-gray-600">{{ $campaign->category->name ?? 'Umum' }}</div>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="text-blue-500 mr-3"><i class="fas fa-calendar"></i></div>
                <div>
                  <div class="text-sm font-medium text-gray-700">Tanggal Mulai</div>
                  <div class="text-gray-600">{{ $campaign->start_date ? date('d F Y', strtotime($campaign->start_date)) : date('d F Y', strtotime($campaign->created_at)) }}</div>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="text-blue-500 mr-3"><i class="fas fa-hourglass-end"></i></div>
                <div>
                  <div class="text-sm font-medium text-gray-700">Tanggal Berakhir</div>
                  <div class="text-gray-600">{{ $campaign->end_date ? date('d F Y', strtotime($campaign->end_date)) : 'Tidak terbatas' }}</div>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="text-blue-500 mr-3"><i class="fas fa-hand-holding-heart"></i></div>
                <div>
                  <div class="text-sm font-medium text-gray-700">Status</div>
                  <div class="text-gray-600">
                    @if($campaign->status === 'active')
                      <span class="text-green-600">Aktif</span>
                    @elseif($campaign->status === 'completed')
                      <span class="text-blue-600">Selesai</span>
                    @elseif($campaign->status === 'pending')
                      <span class="text-yellow-600">Menunggu Persetujuan</span>
                    @else
                      <span class="text-red-600">Tidak Aktif</span>
                    @endif
                  </div>
                </div>
              </div>
              
              @if($campaign->location)
              <div class="flex items-start">
                <div class="text-blue-500 mr-3"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                  <div class="text-sm font-medium text-gray-700">Lokasi</div>
                  <div class="text-gray-600">{{ $campaign->location }}</div>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Comments Section -->
    <div id="comment-section" class="bg-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-12">Komentar <span class="text-sm font-normal text-blue-600">({{ $campaign->approved_comments_count ?? 0 }})</span></h2>
        
        <!-- Comment Form -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8 shadow-sm">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Tinggalkan Komentar</h3>
          
          @if(auth()->check())
          <form action="{{ route('comments.store', $campaign->slug) }}" method="POST" class="space-y-4">
            @csrf
            <div>
              <textarea 
                name="comment" 
                rows="4" 
                class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                placeholder="Bagikan pendapat atau dukungan Anda..."
                required
              ></textarea>
              @error('comment')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div class="flex items-center justify-between">
              <div class="text-sm text-gray-500">
                <span>Komentar akan dimoderasi sebelum ditampilkan</span>
              </div>
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                Kirim Komentar
              </button>
            </div>
          </form>
          @else
          <div class="text-center py-6">
            <p class="text-gray-600 mb-4">Login untuk meninggalkan komentar</p>
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-300 inline-block">
              Login
            </a>
          </div>
          @endif
        </div>
        
        <!-- Comments List -->
        <div class="space-y-6">
          @forelse($campaign->comments()->where('status', 'approved')->orderBy('is_pinned', 'desc')->orderBy('created_at', 'desc')->get() as $comment)
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 {{ $comment->is_pinned ? 'border-l-4 border-l-blue-500' : '' }}">
              <div class="flex justify-between items-start mb-4">
                <div class="flex items-start">
                  <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                    <i class="fas fa-user text-blue-600"></i>
                  </div>
                  <div>
                    <div class="font-medium text-gray-800">{{ $comment->user->name }}</div>
                    <div class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</div>
                  </div>
                </div>
                @if($comment->is_pinned)
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded flex items-center">
                  <i class="fas fa-thumbtack mr-1"></i> Dipin
                </span>
                @endif
              </div>
              
              <div class="text-gray-700 mb-3 prose max-w-none">
                {!! nl2br(e($comment->comment)) !!}
              </div>
              
              <div class="flex items-center text-sm">
                <button class="text-gray-500 hover:text-blue-600 flex items-center transition mr-4">
                  <i class="far fa-thumbs-up mr-1"></i>
                  <span>{{ $comment->likes ?? 0 }}</span>
                </button>
                @if(auth()->check())
                <button class="text-gray-500 hover:text-blue-600 transition" onclick="toggleReplyForm('{{ $comment->id }}')">
                  <i class="far fa-comment mr-1"></i> Balas
                </button>
                @else
                <a href="{{ route('login') }}?redirect={{ url()->current() }}#comment-section" class="text-gray-500 hover:text-blue-600 transition">
                  <i class="far fa-comment mr-1"></i> Login untuk balas
                </a>
                @endif
              </div>
              
              <!-- Reply Form (Hidden by default) -->
              @if(auth()->check())
              <div id="reply-form-{{ $comment->id }}" class="mt-3 pl-10 hidden">
                <form action="{{ route('comments.store', $campaign->slug) }}" method="POST">
                  @csrf
                  <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                  <div class="flex items-center space-x-2">
                    <input type="text" name="comment" class="flex-1 border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Tulis balasan..." required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded-md transition duration-300">
                      Balas
                    </button>
                  </div>
                </form>
              </div>
              @endif
              
              <!-- Replies -->
              @if(count($comment->replies) > 0)
              <div class="mt-4 pl-10 space-y-4">
                @foreach($comment->replies as $reply)
                <div class="bg-gray-50 p-4 rounded-lg">
                  <div class="flex items-start mb-2">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                      <i class="fas fa-user text-blue-600 text-sm"></i>
                    </div>
                    <div>
                      <div class="font-medium text-gray-800 text-sm">{{ $reply->user->name }}</div>
                      <div class="text-xs text-gray-500">{{ $reply->created_at->format('d M Y H:i') }}</div>
                    </div>
                  </div>
                  <div class="text-gray-700 text-sm ml-10">
                    {!! nl2br(e($reply->comment)) !!}
                  </div>
                </div>
                @endforeach
              </div>
              @endif
            </div>
          @empty
            <div class="text-center py-12 bg-gray-50 rounded-lg">
              <i class="far fa-comment-dots text-5xl text-gray-300 mb-4"></i>
              <p class="text-gray-500">Belum ada komentar untuk kampanye ini.</p>
              <p class="text-gray-500 text-sm mt-2">Jadilah yang pertama berkomentar!</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>

    <!-- Related Campaigns -->
    <div class="bg-blue-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
          Other Campaigns You Might Like
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Campaign 1 -->
          <div
            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300"
          >
            <img
              src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
              alt="Clean water"
              class="w-full h-48 object-cover"
            />
            <div class="p-6">
              <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded"
                >Health</span
              >
              <h3 class="text-xl font-bold text-gray-800 mt-3 mb-2">
                Clean Water for Rural Villages
              </h3>
              <p class="text-gray-600 text-sm mb-4">
                Install water filtration systems in 10 villages to provide
                access to clean drinking water.
              </p>

              <div class="mb-3">
                <div class="flex justify-between text-xs text-gray-600 mb-1">
                  <span>65% funded</span>
                  <span>$32,500 of $50,000</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div
                    class="bg-blue-500 h-2 rounded-full"
                    style="width: 65%"
                  ></div>
                </div>
              </div>

              <div class="flex justify-between text-sm">
                <div class="text-gray-600">
                  <i class="fas fa-users mr-1"></i> 84 donors
                </div>
                <div class="text-gray-600">
                  <i class="fas fa-clock mr-1"></i> 15 days left
                </div>
              </div>
            </div>
          </div>

          <!-- Campaign 2 -->
          <div
            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300"
          >
            <img
              src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
              alt="Medical supplies"
              class="w-full h-48 object-cover"
            />
            <div class="p-6">
              <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded"
                >Medical</span
              >
              <h3 class="text-xl font-bold text-gray-800 mt-3 mb-2">
                Emergency Medical Supplies
              </h3>
              <p class="text-gray-600 text-sm mb-4">
                Provide critical medical equipment to understaffed hospitals in
                disaster areas.
              </p>

              <div class="mb-3">
                <div class="flex justify-between text-xs text-gray-600 mb-1">
                  <span>92% funded</span>
                  <span>$46,000 of $50,000</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div
                    class="bg-blue-600 h-2 rounded-full"
                    style="width: 92%"
                  ></div>
                </div>
              </div>

              <div class="flex justify-between text-sm">
                <div class="text-gray-600">
                  <i class="fas fa-users mr-1"></i> 127 donors
                </div>
                <div class="text-gray-600">
                  <i class="fas fa-clock mr-1"></i> 5 days left
                </div>
              </div>
            </div>
          </div>

          <!-- Campaign 3 -->
          <div
            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300"
          >
            <img
              src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
              alt="Reforestation"
              class="w-full h-48 object-cover"
            />
            <div class="p-6">
              <span
                class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded"
                >Environment</span
              >
              <h3 class="text-xl font-bold text-gray-800 mt-3 mb-2">
                Reforestation Project
              </h3>
              <p class="text-gray-600 text-sm mb-4">
                Plant 10,000 trees in deforested areas to restore ecosystems and
                combat climate change.
              </p>

              <div class="mb-3">
                <div class="flex justify-between text-xs text-gray-600 mb-1">
                  <span>42% funded</span>
                  <span>$21,000 of $50,000</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div
                    class="bg-purple-500 h-2 rounded-full"
                    style="width: 42%"
                  ></div>
                </div>
              </div>

              <div class="flex justify-between text-sm">
                <div class="text-gray-600">
                  <i class="fas fa-users mr-1"></i> 63 donors
                </div>
                <div class="text-gray-600">
                  <i class="fas fa-clock mr-1"></i> 28 days left
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-10">
          <button
            class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-md text-sm font-medium transition duration-300"
          >
            View All Campaigns
          </button>
        </div>
      </div>
    </div>

    <!-- Donation Button -->
    <div class="fixed bottom-6 right-6 z-50 float-animation">
      <a href="{{ auth()->check() ? route('public.donate', $campaign->slug) : route('login', ['redirect' => route('public.donate', $campaign->slug)]) }}" class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 transform hover:scale-105">
        <i class="fas fa-hand-holding-heart text-xl"></i>
      </a>
    </div>

@endsection

@section('scripts')
<script>
  // Simple FAQ toggle functionality
  const faqButtons = document.querySelectorAll(
    '.bg-white.rounded-lg.shadow-md.p-6 .space-y-4 button'
  );

  faqButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const answer = button.nextElementSibling;
      const icon = button.querySelector('i');

      if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
      } else {
        answer.classList.add('hidden');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
      }
    });
  });
  
  // Toggle reply form for comments
  function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`reply-form-${commentId}`);
    if (replyForm) {
      if (replyForm.classList.contains('hidden')) {
        // Hide all other reply forms first
        const allReplyForms = document.querySelectorAll('[id^="reply-form-"]');
        allReplyForms.forEach(form => {
          form.classList.add('hidden');
        });
        // Show this reply form
        replyForm.classList.remove('hidden');
      } else {
        replyForm.classList.add('hidden');
      }
    }
  }

  // Set progress bar width for campaign
  const progressBar = document.querySelector(".progress-gradient");
  if (progressBar) {
    const percentage = {{ round(($campaign->current_amount / $campaign->target_amount) * 100) }};
    progressBar.style.width = percentage + '%';
  }
</script>
@endsection
