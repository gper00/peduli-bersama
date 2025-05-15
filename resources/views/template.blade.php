<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI Components | Helping Hands</title>
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
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        .component-section {
            scroll-margin-top: 100px;
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
                    <!-- Navigation -->
                    <nav class="mt-6">
                        <div class="space-y-2">
                            <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-home mr-3"></i>
                                Back to Dashboard
                            </a>
                            <a href="#cards" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-square mr-3"></i>
                                Cards
                            </a>
                            <a href="#buttons" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-hand-pointer mr-3"></i>
                                Buttons
                            </a>
                            <a href="#forms" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-edit mr-3"></i>
                                Form Elements
                            </a>
                            <a href="#tables" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-table mr-3"></i>
                                Tables
                            </a>
                            <a href="#alerts" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-exclamation-circle mr-3"></i>
                                Alerts & Badges
                            </a>
                            <a href="#navigation" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-bars mr-3"></i>
                                Navigation
                            </a>
                            <a href="#progress" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-spinner mr-3"></i>
                                Progress & Stats
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <div class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">UI Components Library</h1>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <input type="text" class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Search components...">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Components Content -->
            <div class="flex-1 overflow-auto p-6">
                <!-- Introduction -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Design System</h2>
                    <p class="text-gray-600 mb-4">This is the collection of reusable UI components for the Helping Hands charity platform. Use these building blocks to maintain visual consistency across the application.</p>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="p-4 bg-pink-500 rounded-lg text-white">
                            <p class="text-xs font-semibold">Primary Color</p>
                            <p class="font-medium">Pink-500</p>
                            <p class="text-xs">#EC4899</p>
                        </div>
                        <div class="p-4 bg-blue-500 rounded-lg text-white">
                            <p class="text-xs font-semibold">Secondary Color</p>
                            <p class="font-medium">Blue-500</p>
                            <p class="text-xs">#3B82F6</p>
                        </div>
                        <div class="p-4 bg-gray-800 rounded-lg text-white">
                            <p class="text-xs font-semibold">Dark Color</p>
                            <p class="font-medium">Gray-800</p>
                            <p class="text-xs">#1F2937</p>
                        </div>
                        <div class="p-4 bg-white border border-gray-200 rounded-lg">
                            <p class="text-xs font-semibold">Light Color</p>
                            <p class="font-medium">White</p>
                            <p class="text-xs">#FFFFFF</p>
                        </div>
                    </div>
                </div>

                <!-- Cards Section -->
                <section id="cards" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Cards</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Basic Card -->
                        <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Basic Card</h3>
                            <p class="text-sm text-gray-600 mb-4">Simple card with title and content</p>
                            <div class="bg-gray-100 p-4 rounded text-xs font-mono">
                                &lt;div class="bg-white p-6 rounded-lg shadow-sm"&gt;<br>
                                &nbsp;&nbsp;&lt;h3&gt;Card Title&lt;/h3&gt;<br>
                                &nbsp;&nbsp;&lt;p&gt;Card content&lt;/p&gt;<br>
                                &lt;/div&gt;
                            </div>
                        </div>

                        <!-- Stat Card -->
                        <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Stat Card</h3>
                            <p class="text-sm text-gray-600 mb-4">Card with icon and statistics</p>
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

                        <!-- Image Card -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Food donation" class="w-full h-32 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">Food Drive Campaign</h3>
                                <p class="text-sm text-gray-600 mb-3">Help feed 500 families this holiday season</p>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="progress-gradient h-2 rounded-full" style="width: 65%"></div>
                                </div>
                                <div class="flex justify-between mt-2 text-xs text-gray-500">
                                    <span>65% funded</span>
                                    <span>$6,500/$10,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Buttons Section -->
                <section id="buttons" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Buttons</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Button Variants</h3>

                            <div class="space-y-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                                        Primary
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg hover:bg-pink-100">
                                        Secondary
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Outline
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700">
                                        Dark
                                    </button>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                        Info
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-lg hover:bg-green-600">
                                        Success
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                        Warning
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600">
                                        Danger
                                    </button>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <button class="px-3 py-1 text-xs font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                                        Small
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                                        Medium
                                    </button>
                                    <button class="px-5 py-3 text-base font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                                        Large
                                    </button>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 flex items-center">
                                        <i class="fas fa-donate mr-2"></i>
                                        With Icon
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg hover:bg-pink-100 flex items-center">
                                        <i class="fas fa-share-alt mr-2"></i>
                                        Share
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Button States</h3>

                            <div class="space-y-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                        Focus
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-300 rounded-lg cursor-not-allowed">
                                        Disabled
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-150">
                                        Animated
                                    </button>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Processing
                                    </button>

                                    <button class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-lg flex items-center">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Success
                                    </button>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-full hover:bg-pink-600">
                                        Pill Button
                                    </button>
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-purple-500 rounded-lg hover:opacity-90">
                                        Gradient
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Form Elements Section -->
                <section id="forms" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Form Elements</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Input Fields</h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Default Input</label>
                                    <input type="text" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Enter your name">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">With Icon</label>
                                    <div class="relative">
                                        <input type="text" class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Search...">
                                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Disabled Input</label>
                                    <input type="text" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" placeholder="Disabled" disabled>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Textarea</label>
                                    <textarea rows="3" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Enter your message"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Select & Checkboxes</h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Dropdown</label>
                                    <select class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                                        <option>Select an option</option>
                                        <option>Disaster Relief</option>
                                        <option>Medical Fund</option>
                                        <option>Orphan Support</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Checkboxes</label>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-pink-500 focus:ring-pink-500 border-gray-300 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Option 1</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-pink-500 focus:ring-pink-500 border-gray-300 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Option 2</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Radio Buttons</label>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="radio" name="radio-group" class="h-4 w-4 text-pink-500 focus:ring-pink-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Option A</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="radio-group" class="h-4 w-4 text-pink-500 focus:ring-pink-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Option B</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Toggle Switch</label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                                        <span class="ml-3 text-sm text-gray-700">Enable notifications</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tables Section -->
                <section id="tables" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Tables</h2>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic Table</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/12.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Sarah Johnson</div>
                                                    <div class="text-sm text-gray-500">sarah@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Disaster Relief Fund</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">$250</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 15, 2023</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/42.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Michael Brown</div>
                                                    <div class="text-sm text-gray-500">michael@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Orphanage Support</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">$500</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 12, 2023</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Alerts & Badges Section -->
                <section id="alerts" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Alerts & Badges</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Alerts</h3>

                            <div class="space-y-4">
                                <div class="p-4 bg-pink-50 rounded-lg border border-pink-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-info-circle text-pink-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-pink-800">Information</h3>
                                            <div class="mt-2 text-sm text-pink-700">
                                                <p>This is an informational alert. You can use it to highlight important information.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 bg-green-50 rounded-lg border border-green-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check-circle text-green-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-green-800">Success</h3>
                                            <div class="mt-2 text-sm text-green-700">
                                                <p>Your donation has been successfully processed. Thank you for your generosity!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">Warning</h3>
                                            <div class="mt-2 text-sm text-yellow-700">
                                                <p>Your session will expire in 5 minutes. Please save your work.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 bg-red-50 rounded-lg border border-red-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-red-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-red-800">Error</h3>
                                            <div class="mt-2 text-sm text-red-700">
                                                <p>There was an error processing your request. Please try again later.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Badges</h3>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">Status Badges</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-pink-100 text-pink-800">New</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Active</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Completed</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Cancelled</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Archived</span>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">Category Badges</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Disaster</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Medical</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Orphans</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Worship</span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Education</span>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">With Icons</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-pink-100 text-pink-800 flex items-center">
                                            <i class="fas fa-heart mr-1"></i> Featured
                                        </span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 flex items-center">
                                            <i class="fas fa-check-circle mr-1"></i> Verified
                                        </span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 flex items-center">
                                            <i class="fas fa-star mr-1"></i> Popular
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">Pill Badges</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-pink-500 text-white">Urgent</span>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-500 text-white">Trending</span>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-500 text-white">Success</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Navigation Section -->
                <section id="navigation" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Navigation</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Sidebar Navigation</h3>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <nav class="space-y-1">
                                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg">
                                        <i class="fas fa-tachometer-alt mr-3"></i>
                                        Dashboard
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg hover:bg-pink-50">
                                        <i class="fas fa-users mr-3"></i>
                                        User Management
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg hover:bg-pink-50">
                                        <i class="fas fa-hand-holding-heart mr-3"></i>
                                        Campaigns
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg hover:bg-pink-50">
                                        <i class="fas fa-chart-pie mr-3"></i>
                                        Reports
                                    </a>
                                </nav>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tabs</h3>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex space-x-8">
                                        <a href="#" class="border-pink-500 text-pink-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                            Active Campaigns
                                        </a>
                                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                            Completed
                                        </a>
                                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                            Drafts
                                        </a>
                                    </nav>
                                </div>

                                <div class="mt-4">
                                    <div class="hidden" id="panel-1">
                                        <p class="text-sm text-gray-600">Active campaigns content</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Progress & Stats Section -->
                <section id="progress" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Progress & Stats</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Progress Bars</h3>

                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Campaign Progress</span>
                                        <span class="text-sm font-medium text-gray-500">75%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="progress-gradient h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Fundraising Goal</span>
                                        <span class="text-sm font-medium text-gray-500">$7,500/$10,000</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-green-500 h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Documentation</span>
                                        <span class="text-sm font-medium text-gray-500">3/5 files</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Small Progress</span>
                                        <span class="text-sm font-medium text-gray-500">42%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-yellow-500 h-1 rounded-full" style="width: 42%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Stats & Metrics</h3>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-pink-50 p-4 rounded-lg">
                                    <p class="text-sm font-medium text-pink-700">Total Donations</p>
                                    <p class="text-2xl font-bold text-pink-800">$24,589</p>
                                    <p class="text-xs text-pink-600 mt-1">+12% from last month</p>
                                </div>

                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-sm font-medium text-blue-700">Active Donors</p>
                                    <p class="text-2xl font-bold text-blue-800">1,245</p>
                                    <p class="text-xs text-blue-600 mt-1">+8% from last month</p>
                                </div>

                                <div class="bg-green-50 p-4 rounded-lg">
                                    <p class="text-sm font-medium text-green-700">Campaigns</p>
                                    <p class="text-2xl font-bold text-green-800">18</p>
                                    <p class="text-xs text-green-600 mt-1">5 completed</p>
                                </div>

                                <div class="bg-purple-50 p-4 rounded-lg">
                                    <p class="text-sm font-medium text-purple-700">Feedback</p>
                                    <p class="text-2xl font-bold text-purple-800">32</p>
                                    <p class="text-xs text-purple-600 mt-1">+5 new this week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <div class="mt-12 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500 text-center">Helping Hands Charity Platform - UI Components Library v1.0</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple script to handle anchor links with offset for fixed header
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
