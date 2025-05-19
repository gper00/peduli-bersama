<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Campaigns | Charity Platform</title>
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
        .progress-bar {
            transition: width 1.5s ease-in-out;
        }
        .campaign-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .category-badge {
            transition: all 0.3s ease;
        }
        .category-badge:hover {
            transform: scale(1.05);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('navbar')

    <!-- Hero Section -->
    <div class="hero-gradient">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Make a Difference</span>
                    <span class="block text-pink-600">Support a Cause Today</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-700 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Browse through our active campaigns and find a cause that resonates with you. Every donation counts!
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-pink-500 hover:bg-pink-600 md:py-4 md:text-lg md:px-10 transition duration-300">
                            Donate Now
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-pink-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition duration-300">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaign Filters -->
    <div class="bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 md:mb-0">All Campaigns</h2>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 w-full md:w-auto">
                    <div class="relative">
                        <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            <option>All Categories</option>
                            <option>Education</option>
                            <option>Healthcare</option>
                            <option>Environment</option>
                            <option>Animals</option>
                            <option>Disaster Relief</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            <option>Sort By</option>
                            <option>Newest</option>
                            <option>Most Popular</option>
                            <option>Ending Soon</option>
                            <option>Most Funded</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <button class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-filter mr-2"></i> Apply Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaign Grid -->
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Campaign Card 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 campaign-card">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Education for All">
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full category-badge">Education</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Education for All</h3>
                            <span class="text-xs text-gray-500">3 days left</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Help us provide school supplies and uniforms for 500 underprivileged children in rural areas.</p>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Raised: $8,250</span>
                                <span>Goal: $15,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-purple-400 h-2 rounded-full progress-bar" style="width: 55%"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-500 mr-1"></i>
                                <span class="text-xs text-gray-600">142 supporters</span>
                            </div>
                            <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 shadow-sm hover:shadow-md">
                                Donate
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 campaign-card">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Clean Water Initiative">
                        <div class="absolute top-4 left-4">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full category-badge">Environment</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Clean Water Initiative</h3>
                            <span class="text-xs text-gray-500">12 days left</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Building water wells in drought-affected regions to provide clean drinking water for communities.</p>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Raised: $23,400</span>
                                <span>Goal: $30,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-purple-400 h-2 rounded-full progress-bar" style="width: 78%"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-500 mr-1"></i>
                                <span class="text-xs text-gray-600">289 supporters</span>
                            </div>
                            <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 shadow-sm hover:shadow-md">
                                Donate
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 campaign-card">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Animal Shelter Support">
                        <div class="absolute top-4 left-4">
                            <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded-full category-badge">Animals</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Animal Shelter Support</h3>
                            <span class="text-xs text-gray-500">5 days left</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Help us feed and provide medical care for abandoned animals at our no-kill shelter.</p>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Raised: $4,200</span>
                                <span>Goal: $10,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-purple-400 h-2 rounded-full progress-bar" style="width: 42%"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-500 mr-1"></i>
                                <span class="text-xs text-gray-600">87 supporters</span>
                            </div>
                            <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 shadow-sm hover:shadow-md">
                                Donate
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 campaign-card">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Medical Aid for Refugees">
                        <div class="absolute top-4 left-4">
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full category-badge">Healthcare</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Medical Aid for Refugees</h3>
                            <span class="text-xs text-gray-500">15 days left</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Providing essential medicines and medical care for refugee families in crisis situations.</p>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Raised: $18,750</span>
                                <span>Goal: $25,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-purple-400 h-2 rounded-full progress-bar" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-500 mr-1"></i>
                                <span class="text-xs text-gray-600">203 supporters</span>
                            </div>
                            <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 shadow-sm hover:shadow-md">
                                Donate
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 5 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 campaign-card">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1500382018108-a7b1e4caa6d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Disaster Relief Fund">
                        <div class="absolute top-4 left-4">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full category-badge">Disaster Relief</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Disaster Relief Fund</h3>
                            <span class="text-xs text-gray-500">Urgent</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Emergency response to recent floods, providing food, shelter and medical supplies to affected families.</p>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Raised: $56,300</span>
                                <span>Goal: $100,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-purple-400 h-2 rounded-full progress-bar" style="width: 56%"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-500 mr-1"></i>
                                <span class="text-xs text-gray-600">421 supporters</span>
                            </div>
                            <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 shadow-sm hover:shadow-md">
                                Donate
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Campaign Card 6 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 campaign-card">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Women's Empowerment">
                        <div class="absolute top-4 left-4">
                            <span class="bg-pink-100 text-pink-800 text-xs font-semibold px-2.5 py-0.5 rounded-full category-badge">Community</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Women's Empowerment</h3>
                            <span class="text-xs text-gray-500">21 days left</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Vocational training and micro-loans for women in developing countries to start their own businesses.</p>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Raised: $12,100</span>
                                <span>Goal: $20,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-purple-400 h-2 rounded-full progress-bar" style="width: 60%"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-500 mr-1"></i>
                                <span class="text-xs text-gray-600">178 supporters</span>
                            </div>
                            <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 shadow-sm hover:shadow-md">
                                Donate
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <a href="#" class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-pink-600 hover:bg-gray-50">
                        1
                    </a>
                    <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        2
                    </a>
                    <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        3
                    </a>
                    <span class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">
                        ...
                    </span>
                    <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        8
                    </a>
                    <a href="#" class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-50 to-green-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                <span class="block">Want to start your own campaign?</span>
                <span class="block text-pink-600">We'll help you every step of the way</span>
            </h2>
            <p class="mt-4 max-w-2xl text-xl text-gray-600 mx-auto">
                Join thousands of people who are making a difference in their communities.
            </p>
            <div class="mt-8">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-pink-500 hover:bg-pink-600 transition duration-300">
                        Start a Campaign
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
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

    <!-- Floating Donate Button -->
    <div class="fixed bottom-6 right-6 z-50 floating">
        <a href="#" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-full shadow-lg flex items-center justify-center transition duration-300">
            <i class="fas fa-heart mr-2"></i>
            <span>Donate Now</span>
        </a>
    </div>

    <script>
        // Progress bar animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-bar');

            const animateProgressBars = () => {
                progressBars.forEach(bar => {
                    const rect = bar.getBoundingClientRect();
                    if (rect.top < window.innerHeight - 100) {
                        bar.style.width = bar.style.width;
                    }
                });
            };

            window.addEventListener('scroll', animateProgressBars);
            animateProgressBars(); // Run once on load
        });
    </script>
</body>
</html>
