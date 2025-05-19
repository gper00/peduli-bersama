<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Campaign Details | Charity Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Poppins", sans-serif;
      }

      .hero-gradient {
        background: linear-gradient(
          135deg,
          rgba(173, 216, 230, 0.8) 0%,
          rgba(144, 238, 144, 0.6) 100%
        );
      }

      .progress-gradient {
        background: linear-gradient(90deg, #4f46e5 0%, #8b5cf6 100%);
      }

      .progress-animation {
        animation: progress 1.5s ease-out forwards;
      }

      @keyframes progress {
        from {
          width: 0;
        }
        to {
          width: var(--progress-width);
        }
      }

      .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
          0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }

      .float-animation {
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
    </style>
  </head>
  <body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0 flex items-center">
              <i class="fas fa-heart text-pink-500 text-2xl mr-2"></i>
              <span class="text-xl font-bold text-gray-800">CharityHub</span>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
              <a
                href="#"
                class="border-pink-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                >Home</a
              >
              <a
                href="#"
                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                >Campaigns</a
              >
              <a
                href="#"
                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                >About</a
              >
              <a
                href="#"
                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                >Contact</a
              >
            </div>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <button
              class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg"
            >
              Start a Campaign
            </button>
          </div>
          <div class="-mr-2 flex items-center sm:hidden">
            <button
              type="button"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pink-500"
            >
              <span class="sr-only">Open main menu</span>
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Campaign Hero Section -->
    <div class="hero-gradient">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div>
            <span
              class="bg-pink-100 text-pink-800 text-xs font-semibold px-2.5 py-0.5 rounded"
              >Education</span
            >
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mt-4 mb-6">
              Build a School for Underprivileged Children
            </h1>
            <p class="text-lg text-gray-700 mb-8">
              Help us construct a new school building in rural Indonesia to
              provide quality education for 200 children who currently study in
              makeshift bamboo classrooms.
            </p>
            <div class="flex space-x-4">
              <button
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg flex items-center"
              >
                <i class="fas fa-heart mr-2"></i> Donate Now
              </button>
              <button
                class="border border-gray-300 text-gray-700 hover:bg-gray-50 px-6 py-3 rounded-md text-sm font-medium transition duration-300 flex items-center"
              >
                <i class="fas fa-share-alt mr-2"></i> Share
              </button>
            </div>
          </div>
          <div class="relative">
            <img
              src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
              alt="School children"
              class="rounded-lg shadow-xl w-full h-auto"
            />
            <div
              class="absolute -bottom-4 -right-4 bg-white p-4 rounded-lg shadow-lg"
            >
              <div class="text-center">
                <div class="text-3xl font-bold text-pink-500">$42,580</div>
                <div class="text-gray-600 text-sm">Raised of $50,000</div>
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
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Story</h2>
            <p class="text-gray-700 mb-4">
              In the remote village of Sumba, Indonesia, children walk miles
              each day to attend school in temporary bamboo structures that
              offer little protection from the elements. During rainy season,
              classes are often canceled as water leaks through the roof and
              floods the dirt floors.
            </p>
            <p class="text-gray-700 mb-4">
              We've partnered with the local community to build a permanent
              school structure that will serve 200 children from kindergarten
              through 6th grade. The new building will have:
            </p>
            <ul class="list-disc pl-5 text-gray-700 mb-6 space-y-2">
              <li>6 proper classrooms with desks and chairs</li>
              <li>Concrete floors and proper roofing</li>
              <li>Electricity and ceiling fans</li>
              <li>Separate bathrooms for boys and girls</li>
              <li>A small library space</li>
            </ul>
            <img
              src="https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
              alt="Current school conditions"
              class="rounded-lg mb-4 w-full"
            />
            <p class="text-sm text-gray-500">
              Current school conditions in the village
            </p>
          </div>

          <!-- Updates Section -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Updates (3)</h2>

            <div class="border-l-4 border-pink-500 pl-4 mb-6">
              <div class="text-sm text-gray-500 mb-1">June 15, 2023</div>
              <h3 class="text-lg font-semibold text-gray-800 mb-2">
                Construction Begins!
              </h3>
              <p class="text-gray-700 mb-2">
                We're thrilled to share that construction has officially begun
                on the new school building! The foundation has been laid and the
                first walls are going up. The community has come together to
                help with the initial stages.
              </p>
              <div class="grid grid-cols-2 gap-2 mt-3">
                <img
                  src="https://images.unsplash.com/photo-1605106702734-205df224ecce?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                  alt="Construction update"
                  class="rounded"
                />
                <img
                  src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                  alt="Community helping"
                  class="rounded"
                />
              </div>
            </div>

            <div class="border-l-4 border-pink-500 pl-4 mb-6">
              <div class="text-sm text-gray-500 mb-1">May 28, 2023</div>
              <h3 class="text-lg font-semibold text-gray-800 mb-2">
                Materials Purchased
              </h3>
              <p class="text-gray-700 mb-2">
                Thanks to your generous donations, we've purchased all the
                necessary construction materials! The local builders have
                reviewed the plans and are ready to begin work next week.
              </p>
            </div>

            <div class="border-l-4 border-pink-500 pl-4">
              <div class="text-sm text-gray-500 mb-1">May 10, 2023</div>
              <h3 class="text-lg font-semibold text-gray-800 mb-2">
                Campaign Launched
              </h3>
              <p class="text-gray-700 mb-2">
                We're excited to launch this campaign to build a proper school
                for the children of Sumba village. Thank you to our early
                supporters who have already contributed!
              </p>
            </div>
          </div>

          <!-- Donors Section -->
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
              Recent Donors (127)
            </h2>

            <div class="space-y-4">
              <div class="flex items-center">
                <div
                  class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center mr-4"
                >
                  <i class="fas fa-user text-pink-500"></i>
                </div>
                <div>
                  <div class="font-medium text-gray-800">Anonymous</div>
                  <div class="text-sm text-gray-500">
                    Donated $500 - 2 hours ago
                  </div>
                </div>
              </div>

              <div class="flex items-center">
                <div
                  class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4"
                >
                  <i class="fas fa-user text-blue-500"></i>
                </div>
                <div>
                  <div class="font-medium text-gray-800">Sarah Johnson</div>
                  <div class="text-sm text-gray-500">
                    Donated $250 - 5 hours ago
                  </div>
                </div>
              </div>

              <div class="flex items-center">
                <div
                  class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4"
                >
                  <i class="fas fa-user text-green-500"></i>
                </div>
                <div>
                  <div class="font-medium text-gray-800">Michael Chen</div>
                  <div class="text-sm text-gray-500">
                    Donated $100 - 1 day ago
                  </div>
                </div>
              </div>

              <div class="flex items-center">
                <div
                  class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-4"
                >
                  <i class="fas fa-user text-purple-500"></i>
                </div>
                <div>
                  <div class="font-medium text-gray-800">Lisa Rodriguez</div>
                  <div class="text-sm text-gray-500">
                    Donated $75 - 2 days ago
                  </div>
                </div>
              </div>
            </div>

            <button
              class="mt-6 text-pink-500 hover:text-pink-600 font-medium flex items-center"
            >
              View all donors <i class="fas fa-chevron-right ml-2"></i>
            </button>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
          <!-- Progress Card -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">
              Campaign Progress
            </h3>

            <div class="mb-4">
              <div class="flex justify-between text-sm text-gray-600 mb-1">
                <span>Raised</span>
                <span>$42,580 of $50,000</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div
                  class="progress-gradient h-2.5 rounded-full progress-animation"
                  style="--progress-width: 85%"
                ></div>
              </div>
            </div>

            <div class="flex justify-between mb-6">
              <div class="text-center">
                <div class="text-2xl font-bold text-pink-500">127</div>
                <div class="text-sm text-gray-600">Donors</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-pink-500">42</div>
                <div class="text-sm text-gray-600">Days Left</div>
              </div>
            </div>

            <button
              class="w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-3 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg mb-4 flex items-center justify-center"
            >
              <i class="fas fa-heart mr-2"></i> Donate Now
            </button>

            <button
              class="w-full border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-3 rounded-md text-sm font-medium transition duration-300 flex items-center justify-center"
            >
              <i class="fas fa-share-alt mr-2"></i> Share Campaign
            </button>
          </div>

          <!-- Organizer Info -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Organizer</h3>

            <div class="flex items-center mb-4">
              <div
                class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mr-4"
              >
                <i class="fas fa-hands-helping text-blue-500 text-2xl"></i>
              </div>
              <div>
                <div class="font-bold text-gray-800">
                  Education for All Foundation
                </div>
                <div class="text-sm text-gray-500">Registered Non-Profit</div>
              </div>
            </div>

            <p class="text-gray-700 text-sm mb-4">
              We've been working in rural Indonesia since 2010, building schools
              and providing educational resources to underserved communities.
            </p>

            <div class="flex space-x-2">
              <a href="#" class="text-gray-400 hover:text-blue-500">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-400">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-pink-500">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-red-500">
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>

          <!-- FAQ -->
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">
              Frequently Asked Questions
            </h3>

            <div class="space-y-4">
              <div>
                <button
                  class="flex justify-between items-center w-full text-left font-medium text-gray-700"
                >
                  <span>When will construction be completed?</span>
                  <i class="fas fa-chevron-down text-pink-500"></i>
                </button>
                <div class="mt-2 text-sm text-gray-600 hidden">
                  We estimate the school will be completed by October 2023, in
                  time for the new academic year. Weather conditions may affect
                  this timeline.
                </div>
              </div>

              <div class="border-t border-gray-200 pt-4">
                <button
                  class="flex justify-between items-center w-full text-left font-medium text-gray-700"
                >
                  <span>How are funds being used?</span>
                  <i class="fas fa-chevron-down text-pink-500"></i>
                </button>
                <div class="mt-2 text-sm text-gray-600 hidden">
                  70% for construction materials, 20% for skilled labor, and 10%
                  for furniture and educational supplies. We provide full
                  financial transparency.
                </div>
              </div>

              <div class="border-t border-gray-200 pt-4">
                <button
                  class="flex justify-between items-center w-full text-left font-medium text-gray-700"
                >
                  <span>Can I visit the project site?</span>
                  <i class="fas fa-chevron-down text-pink-500"></i>
                </button>
                <div class="mt-2 text-sm text-gray-600 hidden">
                  Yes! We welcome donors to visit. Please contact us to arrange
                  a visit and we'll help coordinate your trip.
                </div>
              </div>
            </div>
          </div>
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
                class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded"
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
                    class="bg-green-500 h-2 rounded-full"
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
            class="border border-pink-500 text-pink-500 hover:bg-pink-50 px-6 py-3 rounded-md text-sm font-medium transition duration-300"
          >
            View All Campaigns
          </button>
        </div>
      </div>
    </div>

    <!-- Floating CTA Button -->
    <div class="fixed bottom-6 right-6 z-50 float-animation">
      <button
        class="bg-pink-500 hover:bg-pink-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl hover:shadow-2xl transition duration-300"
      >
        <i class="fas fa-heart text-xl"></i>
      </button>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-16 pb-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center mb-4">
              <i class="fas fa-heart text-pink-500 text-2xl mr-2"></i>
              <span class="text-xl font-bold">CharityHub</span>
            </div>
            <p class="text-gray-400 text-sm">
              Connecting generous hearts with meaningful causes since 2015.
            </p>
            <div class="flex space-x-4 mt-4">
              <a href="#" class="text-gray-400 hover:text-white"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="#" class="text-gray-400 hover:text-white"
                ><i class="fab fa-twitter"></i
              ></a>
              <a href="#" class="text-gray-400 hover:text-white"
                ><i class="fab fa-instagram"></i
              ></a>
              <a href="#" class="text-gray-400 hover:text-white"
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2">
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Home</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >About Us</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Campaigns</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Success Stories</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Contact</a
                >
              </li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Campaigns</h3>
            <ul class="space-y-2">
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Education</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Health</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Environment</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Animal Welfare</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-white text-sm"
                  >Community</a
                >
              </li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
            <p class="text-gray-400 text-sm mb-4">
              Subscribe to our newsletter for updates on new campaigns and
              success stories.
            </p>
            <form class="flex">
              <input
                type="email"
                placeholder="Your email"
                class="bg-gray-700 text-white px-4 py-2 rounded-l-md focus:outline-none focus:ring-2 focus:ring-pink-500 w-full"
              />
              <button
                type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-r-md"
              >
                <i class="fas fa-paper-plane"></i>
              </button>
            </form>
          </div>
        </div>

        <div
          class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center"
        >
          <p class="text-gray-400 text-sm mb-4 md:mb-0">
            © 2023 CharityHub. All rights reserved.
          </p>
          <div class="flex space-x-6">
            <a href="#" class="text-gray-400 hover:text-white text-sm"
              >Privacy Policy</a
            >
            <a href="#" class="text-gray-400 hover:text-white text-sm"
              >Terms of Service</a
            >
            <a href="#" class="text-gray-400 hover:text-white text-sm">FAQ</a>
          </div>
        </div>
      </div>
    </footer>

    <script>
      // Simple FAQ toggle functionality
      document
        .querySelectorAll(".bg-white.rounded-lg.shadow-md.p-6 button")
        .forEach((button) => {
          button.addEventListener("click", () => {
            const answer = button.nextElementSibling;
            const icon = button.querySelector("i");

            if (answer.classList.contains("hidden")) {
              answer.classList.remove("hidden");
              icon.classList.remove("fa-chevron-down");
              icon.classList.add("fa-chevron-up");
            } else {
              answer.classList.add("hidden");
              icon.classList.remove("fa-chevron-up");
              icon.classList.add("fa-chevron-down");
            }
          });
        });

      // Animate progress bars when they come into view
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("progress-animation");
              observer.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.1 }
      );

      document.querySelectorAll(".progress-gradient").forEach((bar) => {
        observer.observe(bar);
      });
    </script>
  </body>
</html>
