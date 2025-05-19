<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Benar</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f9fafb;
        }

        .hero-gradient {
            background: linear-gradient(135deg,
                    rgba(173, 216, 230, 0.8) 0%,
                    rgba(144, 238, 144, 0.6) 100%);
        }

        .progress-bar {
            height: 10px;
            border-radius: 5px;
            background-color: #e5e7eb;
        }

        .progress-fill {
            height: 100%;
            border-radius: 5px;
            background: linear-gradient(90deg, #4f46e5 0%, #8b5cf6 100%);
            transition: width 0.5s ease-in-out;
        }

        .floating-cta {
            animation: float 3s ease-in-out infinite;
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

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="text-gray-700">
    @include('navbar')

    <!-- Hero Section -->
    <section class="hero-gradient ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Bring Hope to Those in Need
                    </h1>
                    <p class="text-lg text-gray-700 mb-8">
                        Join our community of compassionate donors and help change lives
                        with just a few clicks. Every donation makes a difference.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <button
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full text-lg font-semibold shadow-lg transition duration-300">
                            Donate Now
                        </button>
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 px-6 py-3 rounded-full text-lg font-semibold shadow-md transition duration-300">
                            Learn More
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80"
                        alt="People helping each other" class="rounded-xl shadow-xl w-full h-auto" />
                    <div class="absolute -bottom-4 -right-4 bg-white p-4 rounded-xl shadow-lg hidden md:block">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-full mr-3">
                                <i class="fas fa-hands-helping text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Lives Impacted
                                </p>
                                <p class="text-xl font-bold text-gray-800">10,000+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Campaigns -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                Galang Dana Darurat
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Telusuri penyebab paling mendesak kami dan buat dampak hari ini
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Campaign Card 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Education for children" class="w-full h-48 object-cover" />
                    <div class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        URGENT
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Education</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        Build a School in Rural Kenya
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Help us construct a primary school for 200 children who currently
                        walk 10km daily to attend classes.
                    </p>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Raised: $12,450</span>
                            <span>Goal: $25,000</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 50%"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-users text-gray-400 mr-1"></i>
                            <span class="text-sm text-gray-500">42 donors</span>
                        </div>
                        <button
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium">
                            Donate
                        </button>
                    </div>
                </div>
            </div>

            <!-- Campaign Card 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1577897113292-3b95936e5206?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1588&q=80"
                        alt="Medical supplies" class="w-full h-48 object-cover" />
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Healthcare</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        Medical Aid for Earthquake Victims
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Provide emergency medical supplies and care for families affected
                        by the recent devastating earthquake.
                    </p>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Raised: $8,720</span>
                            <span>Goal: $15,000</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 58%"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-users text-gray-400 mr-1"></i>
                            <span class="text-sm text-gray-500">28 donors</span>
                        </div>
                        <button
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium">
                            Donate
                        </button>
                    </div>
                </div>
            </div>

            <!-- Campaign Card 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1542816417-098367509469?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1587&q=80"
                        alt="Clean water" class="w-full h-48 object-cover" />
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span
                            class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded">Water</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        Clean Water Wells for 5 Villages
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Install sustainable water wells to provide clean drinking water
                        for communities in drought-stricken regions.
                    </p>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Raised: $19,300</span>
                            <span>Goal: $30,000</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 64%"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-users text-gray-400 mr-1"></i>
                            <span class="text-sm text-gray-500">76 donors</span>
                        </div>
                        <button
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium">
                            Donate
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <button
                class="border border-blue-500 text-blue-500 hover:bg-blue-50 px-6 py-3 rounded-full text-lg font-medium transition duration-300">
                View All Campaigns
            </button>
        </div>
    </section>

    <!-- How It Works -->
    <section class="bg-blue-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">How It Works</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Making a difference has never been easier. Here's how you can help
                    in just three simple steps.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-blue-500 text-2xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        Choose a Cause
                    </h3>
                    <p class="text-gray-600">
                        Browse our verified campaigns and select one that resonates with
                        you.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-sm text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-blue-500 text-2xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        Make Your Donation
                    </h3>
                    <p class="text-gray-600">
                        Give any amount securely through our trusted payment partners.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-sm text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-blue-500 text-2xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        See the Impact
                    </h3>
                    <p class="text-gray-600">
                        Receive updates on how your contribution is making a real
                        difference.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Stories of Hope</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Hear from donors and beneficiaries about the impact we're making
                together.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-sm testimonial-card transition duration-300">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Sarah J."
                        class="w-12 h-12 rounded-full object-cover mr-4" />
                    <div>
                        <h4 class="font-semibold text-gray-800">Sarah J.</h4>
                        <p class="text-sm text-gray-500">Donor since 2020</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6">
                    "Seeing the photos of the children in the school we helped build
                    brought tears to my eyes. HeartHope makes it so easy to support
                    causes I care about."
                </p>
                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm testimonial-card transition duration-300">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael T."
                        class="w-12 h-12 rounded-full object-cover mr-4" />
                    <div>
                        <h4 class="font-semibold text-gray-800">Michael T.</h4>
                        <p class="text-sm text-gray-500">Campaign Organizer</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6">
                    "When my community was hit by floods, HeartHope helped me raise
                    funds quickly. Their platform is transparent and donor-friendly."
                </p>
                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm testimonial-card transition duration-300">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Priya K."
                        class="w-12 h-12 rounded-full object-cover mr-4" />
                    <div>
                        <h4 class="font-semibold text-gray-800">Priya K.</h4>
                        <p class="text-sm text-gray-500">Monthly Donor</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6">
                    "I love that I can set up recurring donations. The impact reports
                    show exactly where my money goes, which gives me confidence in
                    giving."
                </p>
                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats -->
    <section class="bg-green-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Our Collective Impact
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Numbers that tell the story of lives changed through generosity
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-500 mb-2">1,200+</div>
                    <p class="text-gray-600">Campaigns Funded</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-500 mb-2">$5.8M+</div>
                    <p class="text-gray-600">Raised</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-500 mb-2">250K+</div>
                    <p class="text-gray-600">Lives Impacted</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-500 mb-2">98%</div>
                    <p class="text-gray-600">Donor Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-10 bg-gradient-to-r from-blue-50 to-green-50">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">
                        Stay Connected
                    </h3>
                    <p class="text-gray-600 mb-6">
                        Subscribe to our newsletter to receive inspiring stories, campaign
                        updates, and see the impact of your support.
                    </p>
                    <form class="space-y-4">
                        <div>
                            <input type="email" placeholder="Your email address"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium transition duration-300">
                            Subscribe
                        </button>
                    </form>
                </div>
                <div class="hidden md:block">
                    <img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                        alt="Newsletter" class="w-full h-full object-cover" />
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-heart text-blue-500 text-2xl mr-2"></i>
                        <span class="text-xl font-semibold">HeartHope</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Making giving simple, transparent, and impactful.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">Home</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">Campaigns</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">How It Works</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">Success Stories</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">FAQ</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">Terms of Service</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">Contact Us</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white">Trust & Safety</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <span>123 Charity Lane, Hope City, HC 12345</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3"></i>
                            <span>(123) 456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>hello@hearthope.org</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">
                    © 2023 HeartHope. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg"
                        alt="Visa" class="h-8" />
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mastercard/mastercard-original.svg"
                        alt="Mastercard" class="h-8" />
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/paypal/paypal-original.svg"
                        alt="PayPal" class="h-8" />
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/apple/apple-original.svg"
                        alt="Apple Pay" class="h-8" />
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating CTA -->
    <div class="fixed bottom-8 right-8 z-50">
        <button
            class="floating-cta bg-blue-500 hover:bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-xl transition duration-300">
            <i class="fas fa-heart text-2xl"></i>
        </button>
    </div>

    <script>
        // Simple animation for progress bars on scroll
        document.addEventListener("DOMContentLoaded", function() {
            const progressBars = document.querySelectorAll(".progress-fill");

            const animateOnScroll = function() {
                progressBars.forEach((bar) => {
                    const rect = bar.parentElement.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom >= 0) {
                        const width = bar.style.width;
                        bar.style.width = "0%";
                        setTimeout(() => {
                            bar.style.width = width;
                        }, 100);
                    }
                });
            };

            window.addEventListener("scroll", animateOnScroll);
            animateOnScroll(); // Run once on load
        });
    </script>
</body>

</html>
