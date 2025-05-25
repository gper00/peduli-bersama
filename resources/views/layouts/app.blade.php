<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Peduli Bersama - Platform Donasi Online')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #1e40af; /* Blue-700 */
            --primary-color-light: #3b82f6; /* Blue-500 */
            --primary-color-dark: #1e3a8a; /* Blue-800 */
            --secondary-color: #64748b; /* Slate-500 */
            --accent-color: #3b82f6; /* Blue-500 */
        }
        
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f9fafb;
        }

        .hero-gradient {
            background: linear-gradient(135deg,
                    rgba(59, 130, 246, 0.8) 0%,
                    rgba(30, 64, 175, 0.6) 100%);
        }

        .progress-bar {
            height: 10px;
            border-radius: 5px;
            background-color: #e5e7eb;
        }

        .progress-fill {
            height: 100%;
            border-radius: 5px;
            background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
            transition: width 0.5s ease-in-out;
        }

        .floating-cta {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
    
    @yield('styles')
</head>

<body class="text-gray-700">
    @include('partials.navbar')
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 max-w-7xl mx-auto mt-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-7xl mx-auto mt-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
    
    @yield('content')
    
    @include('partials.footer')
    
    <!-- Floating CTA -->
    <div class="fixed bottom-8 right-8 z-50">
        <a href="{{ route('public.campaigns') }}" class="floating-cta flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-hand-holding-heart text-xl mr-2"></i>
            <span class="font-medium">Donasi Sekarang</span>
        </a>
    </div>
    
    @yield('scripts')
</body>
</html>
