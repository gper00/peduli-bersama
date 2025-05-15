<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete UI Components | Helping Hands</title>
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
        .modal {
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .file-input-label {
            transition: all 0.3s ease;
        }
        .file-input-label:hover {
            border-color: #ec4899;
        }
        .dropdown-content {
            display: none;
            transition: all 0.3s ease;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .tooltip {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .has-tooltip:hover .tooltip {
            visibility: visible;
            opacity: 1;
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
                            <a href="#modals" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-window-maximize mr-3"></i>
                                Modals & Popups
                            </a>
                            <a href="#user" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-user mr-3"></i>
                                User Components
                            </a>
                            <a href="#misc" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg sidebar-item">
                                <i class="fas fa-ellipsis-h mr-3"></i>
                                Miscellaneous
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
                    <h1 class="text-xl font-bold text-gray-800">Complete UI Components Library</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Search components...">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                    <button id="theme-toggle" class="p-2 text-gray-500 rounded-full hover:bg-gray-100">
                        <i class="fas fa-moon"></i>
                    </button>
                </div>
            </div>

            <!-- Components Content -->
            <div class="flex-1 overflow-auto p-6">
                <!-- Introduction -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Complete Design System</h2>
                    <p class="text-gray-600 mb-4">This is the comprehensive collection of reusable UI components for the Helping Hands charity platform. Use these building blocks to maintain visual consistency across the application.</p>

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

                        <!-- Action Card -->
                        <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Action Card</h3>
                            <p class="text-sm text-gray-600 mb-4">Card with action buttons</p>
                            <div class="bg-gray-100 p-4 rounded">
                                <div class="mb-4">
                                    <h4 class="font-medium text-gray-800">Volunteer Opportunity</h4>
                                    <p class="text-sm text-gray-600">Help distribute food packages this weekend</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 text-sm font-medium text-white bg-pink-500 rounded hover:bg-pink-600">
                                        Sign Up
                                    </button>
                                    <button class="px-3 py-1 text-sm font-medium text-pink-600 bg-pink-50 rounded hover:bg-pink-100">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial Card -->
                        <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Testimonial Card</h3>
                            <p class="text-sm text-gray-600 mb-4">Card with user testimonial</p>
                            <div class="bg-gray-100 p-4 rounded">
                                <div class="flex items-center mb-3">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="w-10 h-10 rounded-full">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-800">Sarah Johnson</p>
                                        <p class="text-xs text-gray-500">Donor since 2020</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 italic">"Helping Hands made it so easy to support causes I care about. Their transparency is unmatched."</p>
                                <div class="flex mt-3 text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Card -->
                        <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pricing Card</h3>
                            <p class="text-sm text-gray-600 mb-4">Card for donation tiers</p>
                            <div class="bg-gray-100 p-4 rounded">
                                <div class="text-center mb-4">
                                    <h4 class="font-bold text-lg text-gray-800">Gold Sponsor</h4>
                                    <p class="text-3xl font-bold text-pink-600">$500</p>
                                    <p class="text-sm text-gray-500">per month</p>
                                </div>
                                <ul class="space-y-2 text-sm text-gray-600 mb-4">
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        Logo on all materials
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        VIP event invitations
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        Annual impact report
                                    </li>
                                </ul>
                                <button class="w-full py-2 text-sm font-medium text-white bg-pink-500 rounded hover:bg-pink-600">
                                    Become a Sponsor
                                </button>
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
                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 has-tooltip relative">
                                        With Tooltip
                                        <span class="tooltip absolute bottom-full mb-2 px-2 py-1 text-xs text-white bg-gray-800 rounded whitespace-nowrap">This is a tooltip</span>
                                    </button>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <div class="dropdown relative">
                                        <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 flex items-center">
                                            Dropdown
                                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                                        </button>
                                        <div class="dropdown-content absolute z-10 mt-1 w-48 bg-white rounded-md shadow-lg py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">Action 1</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">Action 2</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">Action 3</a>
                                        </div>
                                    </div>

                                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 group relative">
                                        Button Group
                                        <div class="absolute left-full ml-1 top-0 flex flex-col rounded-lg overflow-hidden opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button class="px-3 py-1 text-xs bg-pink-400 hover:bg-pink-500">Option 1</button>
                                            <button class="px-3 py-1 text-xs bg-pink-400 hover:bg-pink-500">Option 2</button>
                                            <button class="px-3 py-1 text-xs bg-pink-400 hover:bg-pink-500">Option 3</button>
                                        </div>
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

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">File Input</label>
                                    <label class="file-input-label flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500">PNG, JPG, PDF (MAX. 5MB)</p>
                                        </div>
                                        <input id="dropzone-file" type="file" class="hidden" />
                                    </label>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Input with Validation</label>
                                    <input type="email" class="w-full px-4 py-2 text-sm border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Enter valid email" value="invalid-email">
                                    <p class="mt-1 text-xs text-red-600">Please enter a valid email address</p>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Multi-select</label>
                                    <select multiple class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent h-auto">
                                        <option>Education</option>
                                        <option>Healthcare</option>
                                        <option>Food Security</option>
                                        <option>Shelter</option>
                                        <option>Clean Water</option>
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

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Range Slider</label>
                                    <input type="range" min="0" max="100" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>$0</span>
                                        <span>$50</span>
                                        <span>$100</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tables Section -->
                <section id="tables" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Tables</h2>

                    <div class="space-y-6">
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

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Table with Actions</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Raised</th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Flood Relief</div>
                                                <div class="text-sm text-gray-500">Disaster</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: 45%"></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                $4,500/$10,000
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-pink-600 hover:text-pink-900 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-900">Delete</button>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">School Supplies</div>
                                                <div class="text-sm text-gray-500">Education</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: 15%"></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                $750/$5,000
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-pink-600 hover:text-pink-900 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-900">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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

                                <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                                    <div class="flex justify-between items-start">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-bell text-blue-500"></i>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-blue-800">Notification</h3>
                                                <div class="mt-2 text-sm text-blue-700">
                                                    <p>You have 3 new messages in your inbox.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-times"></i>
                                        </button>
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

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">Badge Sizes</p>
                                    <div class="flex flex-wrap gap-2 items-center">
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-pink-100 text-pink-800">Small</span>
                                        <span class="px-2.5 py-1 text-sm font-medium rounded-full bg-pink-100 text-pink-800">Medium</span>
                                        <span class="px-3 py-1.5 text-base font-medium rounded-full bg-pink-100 text-pink-800">Large</span>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">Avatar Badges</p>
                                    <div class="flex flex-wrap gap-4 items-center">
                                        <div class="relative">
                                            <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/12.jpg" alt="">
                                            <span class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                                        </div>
                                        <div class="relative">
                                            <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/42.jpg" alt="">
                                            <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">3</span>
                                        </div>
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

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pagination</h3>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <nav class="flex items-center justify-between" aria-label="Pagination">
                                    <div class="flex-1 flex justify-between">
                                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Previous
                                        </a>
                                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Next
                                        </a>
                                    </div>
                                </nav>

                                <nav class="mt-4 flex items-center justify-between">
                                    <div class="hidden sm:block">
                                        <p class="text-sm text-gray-700">
                                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
                                        </p>
                                    </div>
                                    <div class="flex-1 flex justify-between sm:justify-end">
                                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Previous</span>
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                        <a href="#" class="bg-pink-50 border-pink-500 text-pink-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            1
                                        </a>
                                        <a href="#" class="border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            2
                                        </a>
                                        <a href="#" class="border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            3
                                        </a>
                                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Next</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Breadcrumbs</h3>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <nav class="flex" aria-label="Breadcrumb">
                                    <ol class="flex items-center space-x-4">
                                        <li>
                                            <div>
                                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                                    <i class="fas fa-home"></i>
                                                    <span class="sr-only">Home</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                                <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Campaigns</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                                <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">Disaster Relief</a>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>

                                <nav class="mt-4 flex" aria-label="Breadcrumb">
                                    <ol class="flex items-center space-x-4">
                                        <li>
                                            <div>
                                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                                    <i class="fas fa-home"></i>
                                                    <span class="sr-only">Home</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                                <a href="#" class="ml-4 text-sm font-medium text-pink-600 hover:text-pink-700">Dashboard</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                                <span class="ml-4 text-sm font-medium text-gray-500">Reports</span>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
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

                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">With Steps</span>
                                        <span class="text-sm font-medium text-gray-500">Step 3 of 5</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-purple-500 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                    <div class="flex justify-between mt-1 text-xs text-gray-500">
                                        <span>Started</span>
                                        <span>In Progress</span>
                                        <span>Review</span>
                                        <span>Testing</span>
                                        <span>Complete</span>
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

                                <div class="bg-yellow-50 p-4 rounded-lg">
                                    <p class="text-sm font-medium text-yellow-700">Volunteers</p>
                                    <p class="text-2xl font-bold text-yellow-800">87</p>
                                    <p class="text-xs text-yellow-600 mt-1">+15 this month</p>
                                </div>

                                <div class="bg-red-50 p-4 rounded-lg">
                                    <p class="text-sm font-medium text-red-700">Urgent Needs</p>
                                    <p class="text-2xl font-bold text-red-800">3</p>
                                    <p class="text-xs text-red-600 mt-1">Require attention</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Modals Section -->
                <section id="modals" class="component-section mb-12">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Modals & Popups</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic Modal</h3>

                            <button onclick="document.getElementById('basic-modal').classList.remove('hidden')" class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                                Open Modal
                            </button>

                            <!-- Basic Modal -->
                            <div id="basic-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>

                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-pink-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <i class="fas fa-exclamation text-pink-600"></i>
                                                </div>
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Modal Title</h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="button" onclick="document.getElementById('basic-modal').classList.add('hidden')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-pink-500 text-base font-medium text-white hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Confirm
                                            </button>
                                            <button type="button" onclick="document.getElementById('basic-modal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:mt-0 sm:w-auto sm:text-sm">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Form Modal</h3>

                            <button onclick="document.getElementById('form-modal').classList.remove('hidden')" class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                                Open Form Modal
                            </button>

                            <!-- Form Modal -->
                            {{-- <div id="form-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>

                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Create New Campaign</h3>
                                                    <div class="mt-2 space-y-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Campaign Name</label>
                                                            <input type="text" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Enter campaign name">
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                                            <textarea rows="3" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Enter campaign description"></textarea>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Target Amount</label>
                                                            <input type="number" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline --}}


</html>
