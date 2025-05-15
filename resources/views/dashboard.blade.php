<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Dashboard | Helping Hands</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, rgba(173, 216, 230, 0.8) 0%, rgba(144, 238, 144, 0.6) 100%);
        }

        .progress-gradient {
            background: linear-gradient(90deg, #4f46e5 0%, #8b5cf6 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .sidebar-item:hover {
            background-color: rgba(236, 72, 153, 0.1);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Main Layout -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-white border-r border-gray-200">
                <div class="flex items-center justify-center h-16 px-4 bg-pink-500">
                    <span class="text-white text-xl font-bold">Helping Hands</span>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <!-- User Profile -->
                    <div class="flex items-center px-2 py-4 border-b border-gray-200">
                        <img class="w-10 h-10 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg"
                            alt="User profile">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">Sarah Johnson</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="mt-6">
                        <div class="space-y-2">
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg sidebar-item">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-users mr-3"></i>
                                User Management
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-hand-holding-heart mr-3"></i>
                                Campaigns
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-chart-pie mr-3"></i>
                                Donation Stats
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-comment-alt mr-3"></i>
                                Feedback
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-tags mr-3"></i>
                                Categories
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-file-alt mr-3"></i>
                                Content Management
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="p-4 border-t border-gray-200">
                    <button
                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <div class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200">
                <div class="flex items-center md:hidden">
                    <button class="text-gray-500 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <input type="text"
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                            placeholder="Search...">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex items-center">
                    <button class="p-1 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none">
                        <i class="fas fa-bell"></i>
                    </button>
                    <div class="ml-4">
                        <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg"
                            alt="User profile">
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="flex-1 overflow-auto p-6">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                    <p class="text-gray-600">Welcome back! Here's what's happening with your charity today.</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-pink-100 text-pink-600">
                                <i class="fas fa-donate text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Donations</p>
                                <p class="text-2xl font-semibold text-gray-800">$24,589</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Donors</p>
                                <p class="text-2xl font-semibold text-gray-800">1,245</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-hand-holding-usd text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Campaigns</p>
                                <p class="text-2xl font-semibold text-gray-800">18</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-comments text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">New Feedback</p>
                                <p class="text-2xl font-semibold text-gray-800">32</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Donation by Category Chart -->
                    <div class="bg-white p-6 rounded-lg shadow-sm lg:col-span-2">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Donations by Category</h2>
                            <select
                                class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-pink-500">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option selected>Last 90 Days</option>
                                <option>This Year</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <!-- Chart Placeholder -->
                            <div class="flex items-center justify-center h-full bg-gray-50 rounded-lg">
                                <div class="text-center">
                                    <i class="fas fa-chart-pie text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-gray-500">Donation category chart will appear here</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-2 bg-green-100 rounded-full text-green-600">
                                        <i class="fas fa-donate"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">New donation of $250</p>
                                    <p class="text-xs text-gray-500">2 hours ago · Disaster Relief Fund</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-2 bg-blue-100 rounded-full text-blue-600">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">New donor registered</p>
                                    <p class="text-xs text-gray-500">5 hours ago · Michael Johnson</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-2 bg-purple-100 rounded-full text-purple-600">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">New feedback received</p>
                                    <p class="text-xs text-gray-500">1 day ago · "Great initiative!"</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-2 bg-pink-100 rounded-full text-pink-600">
                                        <i class="fas fa-hand-holding-heart"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">New campaign created</p>
                                    <p class="text-xs text-gray-500">2 days ago · Orphanage Support</p>
                                </div>
                            </div>
                        </div>
                        <button class="mt-4 text-sm font-medium text-pink-600 hover:text-pink-700">
                            View all activities <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>

                    <!-- Active Campaigns -->
                    <div class="bg-white p-6 rounded-lg shadow-sm lg:col-span-2">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Active Campaigns</h2>
                            <button class="text-sm font-medium text-pink-600 hover:text-pink-700">
                                View all <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Campaign</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Category</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Progress</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Raised</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Disaster Relief Fund
                                                    </div>
                                                    <div class="text-sm text-gray-500">For flood victims</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Disaster</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="progress-gradient h-2 rounded-full" style="width: 75%">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$7,500/$10,000
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://images.unsplash.com/photo-1573496359142-b8d87734a5cd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Orphanage Support
                                                    </div>
                                                    <div class="text-sm text-gray-500">Monthly supplies</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Orphans</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="progress-gradient h-2 rounded-full" style="width: 42%">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$2,100/$5,000
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Medical Fund</div>
                                                    <div class="text-sm text-gray-500">For cancer treatment</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Medical</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="progress-gradient h-2 rounded-full" style="width: 90%">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$9,000/$10,000
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Donors -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Donors</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full"
                                    src="https://randomuser.me/api/portraits/men/32.jpg" alt="Donor">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Robert Johnson</p>
                                    <p class="text-xs text-gray-500">$250 · 2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full"
                                    src="https://randomuser.me/api/portraits/women/63.jpg" alt="Donor">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Emily Davis</p>
                                    <p class="text-xs text-gray-500">$100 · 5 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full"
                                    src="https://randomuser.me/api/portraits/men/75.jpg" alt="Donor">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Michael Brown</p>
                                    <p class="text-xs text-gray-500">$500 · 1 day ago</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full"
                                    src="https://randomuser.me/api/portraits/women/28.jpg" alt="Donor">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Sarah Wilson</p>
                                    <p class="text-xs text-gray-500">$150 · 2 days ago</p>
                                </div>
                            </div>
                        </div>
                        <button class="mt-4 text-sm font-medium text-pink-600 hover:text-pink-700">
                            View all donors <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div class="md:hidden fixed inset-0 z-40 hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div class="fixed inset-y-0 left-0 flex flex-col w-5/6 max-w-sm bg-white">
            <div class="flex items-center justify-between h-16 px-4 bg-pink-500">
                <span class="text-white text-xl font-bold">Helping Hands</span>
                <button class="text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                <nav class="flex-1 space-y-2">
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg">
                        <i class="fas fa-users mr-3"></i>
                        User Management
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg">
                        <i class="fas fa-hand-holding-heart mr-3"></i>
                        Campaigns
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg">
                        <i class="fas fa-chart-pie mr-3"></i>
                        Donation Stats
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg">
                        <i class="fas fa-comment-alt mr-3"></i>
                        Feedback
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg">
                        <i class="fas fa-tags mr-3"></i>
                        Categories
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg">
                        <i class="fas fa-file-alt mr-3"></i>
                        Content Management
                    </a>
                </nav>
            </div>
            <div class="p-4 border-t border-gray-200">
                <button
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </div>
        </div>
    </div>

    <script>
        // Simple script to toggle mobile menu
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.md\\:hidden button');
            const mobileMenu = document.querySelector('.md\\:hidden.fixed');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });

                // Close button inside mobile menu
                const closeButton = mobileMenu.querySelector('button.text-white');
                closeButton.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            }

            // Simulate chart loading (in a real app, you'd use a charting library)
            setTimeout(() => {
                const chartPlaceholder = document.querySelector('.h-64 .bg-gray-50');
                if (chartPlaceholder) {
                    chartPlaceholder.innerHTML = `
                        <div class="flex items-end h-full p-4 space-x-2">
                            <div class="flex-1 bg-pink-500 rounded-t" style="height: 70%"></div>
                            <div class="flex-1 bg-blue-500 rounded-t" style="height: 45%"></div>
                            <div class="flex-1 bg-green-500 rounded-t" style="height: 60%"></div>
                            <div class="flex-1 bg-yellow-500 rounded-t" style="height: 30%"></div>
                            <div class="flex-1 bg-purple-500 rounded-t" style="height: 55%"></div>
                        </div>
                        <div class="flex justify-between px-4 pb-2 text-xs text-gray-500">
                            <span>Disaster</span>
                            <span>Medical</span>
                            <span>Orphans</span>
                            <span>Poor</span>
                            <span>Worship</span>
                        </div>
                    `;
                }
            }, 1500);
        });
    </script>
</body>

</html>
