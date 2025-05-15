<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CharityHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, rgba(173, 216, 230, 0.8) 0%, rgba(144, 238, 144, 0.6) 100%);
        }
        .auth-card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .auth-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 2px rgba(236, 72, 153, 0.2);
        }
        .toggle-forms {
            color: #ec4899;
            cursor: pointer;
        }
        .toggle-forms:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-hands-helping text-pink-500 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">CharityHub</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="index.html" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                        <a href="campaigns.html" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Campaigns</a>
                        <a href="about.html" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">About</a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="register.html" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                    <a href="login.html" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg ml-4">
                        Login
                    </a>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pink-500">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Welcome Back!</span>
                    <span class="block text-pink-600">Login to Your Account</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-700 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Access your dashboard, track your donations, and manage your campaigns.
                </p>
            </div>
        </div>
    </div>

    <!-- Auth Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-center">
            <!-- Login Form -->
            <div class="w-full max-w-md bg-white rounded-lg overflow-hidden auth-card transition duration-300" id="login-form">
                <div class="px-10 py-12">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Sign In</h2>
                        <p class="text-gray-600 mb-8">Enter your credentials to access your account</p>
                    </div>

                    <form class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required class="py-3 pl-10 block w-full border border-gray-300 rounded-md input-field focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="py-3 pl-10 block w-full border border-gray-300 rounded-md input-field focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-pink-600 hover:text-pink-500">Forgot password?</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                                Sign In
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or continue with</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-3 gap-3">
                            <div>
                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Sign in with Facebook</span>
                                    <i class="fab fa-facebook-f text-blue-600"></i>
                                </a>
                            </div>

                            <div>
                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Sign in with Google</span>
                                    <i class="fab fa-google text-red-600"></i>
                                </a>
                            </div>

                            <div>
                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Sign in with Twitter</span>
                                    <i class="fab fa-twitter text-blue-400"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <span class="toggle-forms font-medium" onclick="showRegister()">Register here</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Register Form (Hidden by default) -->
            <div class="w-full max-w-md bg-white rounded-lg overflow-hidden auth-card transition duration-300 hidden" id="register-form">
                <div class="px-10 py-12">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                        <p class="text-gray-600 mb-8">Join our community of donors and campaigners</p>
                    </div>

                    <form class="space-y-6">
                        <div>
                            <label for="full-name" class="block text-sm font-medium text-gray-700">Full name</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input id="full-name" name="full-name" type="text" autocomplete="name" required class="py-3 pl-10 block w-full border border-gray-300 rounded-md input-field focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <div>
                            <label for="register-email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="register-email" name="register-email" type="email" autocomplete="email" required class="py-3 pl-10 block w-full border border-gray-300 rounded-md input-field focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <div>
                            <label for="register-password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="register-password" name="register-password" type="password" autocomplete="new-password" required class="py-3 pl-10 block w-full border border-gray-300 rounded-md input-field focus:ring-pink-500 focus:border-pink-500">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Must be at least 8 characters long</p>
                        </div>

                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="confirm-password" name="confirm-password" type="password" autocomplete="new-password" required class="py-3 pl-10 block w-full border border-gray-300 rounded-md input-field focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-700">
                                I agree to the <a href="#" class="text-pink-600 hover:text-pink-500">Terms of Service</a> and <a href="#" class="text-pink-600 hover:text-pink-500">Privacy Policy</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or sign up with</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-3 gap-3">
                            <div>
                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Sign up with Facebook</span>
                                    <i class="fab fa-facebook-f text-blue-600"></i>
                                </a>
                            </div>

                            <div>
                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Sign up with Google</span>
                                    <i class="fab fa-google text-red-600"></i>
                                </a>
                            </div>

                            <div>
                                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Sign up with Twitter</span>
                                    <i class="fab fa-twitter text-blue-400"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <span class="toggle-forms font-medium" onclick="showLogin()">Sign in here</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase mb-4">About Us</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Our Mission</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Team</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Partners</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Impact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase mb-4">Campaigns</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">All Campaigns</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Education</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Healthcare</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Environment</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Donation Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase mb-4">Connect</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-400 text-sm">Subscribe to our newsletter</p>
                        <div class="mt-2 flex">
                            <input type="email" placeholder="Your email" class="px-3 py-2 text-sm rounded-l-md w-full focus:outline-none">
                            <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-2 rounded-r-md text-sm">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between">
                <p class="text-gray-400 text-sm">
                    &copy; 2023 CharityHub. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle between login and register forms
        function showRegister() {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('register-form').classList.remove('hidden');
            document.title = "Register | CharityHub";
        }

        function showLogin() {
            document.getElementById('register-form').classList.add('hidden');
            document.getElementById('login-form').classList.remove('hidden');
            document.title = "Login | CharityHub";
        }

        // Check if URL has #register hash
        window.onload = function() {
            if (window.location.hash === '#register') {
                showRegister();
            }
        };
    </script>
</body>
</html>
