<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About & Contact | Charity Platform</title>
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

      .map-container {
        height: 400px;
        border-radius: 0.5rem;
        overflow: hidden;
      }

      .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
          0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                >Home</a
              >
              <a
                href="#"
                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
                >Campaigns</a
              >
              <a
                href="#"
                class="border-pink-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
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

    <!-- Hero Section -->
    <div class="hero-gradient">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
          About CharityHub
        </h1>
        <p class="text-xl text-gray-700 max-w-3xl mx-auto">
          Connecting generous hearts with meaningful causes to create positive
          change in communities worldwide.
        </p>
      </div>
    </div>

    <!-- About Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Story</h2>
          <p class="text-gray-700 mb-4">
            Founded in 2015, CharityHub began as a small group of passionate
            individuals who wanted to make philanthropy more accessible and
            transparent. What started as a local initiative has grown into a
            global platform connecting donors with verified charitable projects.
          </p>
          <p class="text-gray-700 mb-6">
            We believe that everyone should have the opportunity to contribute
            to causes they care about, regardless of the size of their donation.
            Our platform ensures that 100% of your donation goes directly to the
            cause, with no hidden fees.
          </p>

          <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
              <div class="text-4xl font-bold text-pink-500 mb-2">250+</div>
              <div class="text-gray-600">Successful Campaigns</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
              <div class="text-4xl font-bold text-pink-500 mb-2">$5M+</div>
              <div class="text-gray-600">Raised for Causes</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
              <div class="text-4xl font-bold text-pink-500 mb-2">50+</div>
              <div class="text-gray-600">Countries Reached</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
              <div class="text-4xl font-bold text-pink-500 mb-2">100%</div>
              <div class="text-gray-600">Donation Transparency</div>
            </div>
          </div>

          <button
            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg"
          >
            Learn More About Our Work
          </button>
        </div>

        <div class="relative">
          <img
            src="https://images.unsplash.com/photo-1521791055366-0d553872125f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
            alt="Volunteers working together"
            class="rounded-lg shadow-xl w-full h-auto"
          />
          <div
            class="absolute -bottom-4 -right-4 bg-white p-4 rounded-lg shadow-lg w-3/4"
          >
            <div class="flex items-center">
              <div
                class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center mr-4"
              >
                <i class="fas fa-check text-pink-500 text-xl"></i>
              </div>
              <div>
                <div class="font-bold text-gray-800">Verified Nonprofits</div>
                <div class="text-gray-600 text-sm">
                  All organizations are thoroughly vetted
                </div>
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
            Our Mission & Values
          </h2>
          <p class="text-gray-600 max-w-2xl mx-auto">
            We're committed to creating a world where generosity is accessible,
            impactful, and transparent.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div
              class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4"
            >
              <i class="fas fa-globe text-pink-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Global Impact</h3>
            <p class="text-gray-600">
              We support causes across six continents, focusing on education,
              health, environment, and community development.
            </p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div
              class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4"
            >
              <i class="fas fa-lock text-blue-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">
              Full Transparency
            </h3>
            <p class="text-gray-600">
              Every dollar is accounted for with regular updates and financial
              reports from our partner organizations.
            </p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div
              class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4"
            >
              <i class="fas fa-hands-helping text-green-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">
              Community Focus
            </h3>
            <p class="text-gray-600">
              We work directly with local communities to identify needs and
              implement sustainable solutions.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Team Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Meet Our Team</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Passionate individuals dedicated to making philanthropy accessible to
          everyone.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div
          class="bg-white rounded-lg shadow-md overflow-hidden team-card transition duration-300"
        >
          <img
            src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
            alt="Team member"
            class="w-full h-64 object-cover"
          />
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-1">Sarah Johnson</h3>
            <p class="text-pink-500 text-sm font-medium mb-3">Founder & CEO</p>
            <p class="text-gray-600 text-sm">
              Former nonprofit director with 15 years of experience in
              international development.
            </p>
            <div class="flex space-x-3 mt-4">
              <a href="#" class="text-gray-400 hover:text-blue-500"
                ><i class="fab fa-linkedin-in"></i
              ></a>
              <a href="#" class="text-gray-400 hover:text-blue-400"
                ><i class="fab fa-twitter"></i
              ></a>
            </div>
          </div>
        </div>

        <div
          class="bg-white rounded-lg shadow-md overflow-hidden team-card transition duration-300"
        >
          <img
            src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
            alt="Team member"
            class="w-full h-64 object-cover"
          />
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-1">Michael Chen</h3>
            <p class="text-blue-500 text-sm font-medium mb-3">CTO</p>
            <p class="text-gray-600 text-sm">
              Tech entrepreneur focused on building platforms for social impact.
            </p>
            <div class="flex space-x-3 mt-4">
              <a href="#" class="text-gray-400 hover:text-blue-500"
                ><i class="fab fa-linkedin-in"></i
              ></a>
              <a href="#" class="text-gray-400 hover:text-blue-400"
                ><i class="fab fa-twitter"></i
              ></a>
            </div>
          </div>
        </div>

        <div
          class="bg-white rounded-lg shadow-md overflow-hidden team-card transition duration-300"
        >
          <img
            src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
            alt="Team member"
            class="w-full h-64 object-cover"
          />
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-1">Lisa Rodriguez</h3>
            <p class="text-green-500 text-sm font-medium mb-3">
              Partnership Director
            </p>
            <p class="text-gray-600 text-sm">
              Former UN consultant with expertise in nonprofit partnerships.
            </p>
            <div class="flex space-x-3 mt-4">
              <a href="#" class="text-gray-400 hover:text-blue-500"
                ><i class="fab fa-linkedin-in"></i
              ></a>
              <a href="#" class="text-gray-400 hover:text-blue-400"
                ><i class="fab fa-twitter"></i
              ></a>
            </div>
          </div>
        </div>

        <div
          class="bg-white rounded-lg shadow-md overflow-hidden team-card transition duration-300"
        >
          <img
            src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
            alt="Team member"
            class="w-full h-64 object-cover"
          />
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-1">David Kim</h3>
            <p class="text-purple-500 text-sm font-medium mb-3">
              Marketing Director
            </p>
            <p class="text-gray-600 text-sm">
              Digital marketing expert with a passion for cause-related
              campaigns.
            </p>
            <div class="flex space-x-3 mt-4">
              <a href="#" class="text-gray-400 hover:text-blue-500"
                ><i class="fab fa-linkedin-in"></i
              ></a>
              <a href="#" class="text-gray-400 hover:text-blue-400"
                ><i class="fab fa-twitter"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Section -->
    <div class="bg-gray-800 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <div>
            <h2 class="text-3xl font-bold mb-6">Contact Us</h2>
            <p class="text-gray-300 mb-8">
              Have questions or want to partner with us? Reach out through any
              of these channels or fill out the contact form.
            </p>

            <div class="space-y-6">
              <div class="flex items-start">
                <div class="flex-shrink-0 bg-pink-500 rounded-lg p-3 mr-4">
                  <i class="fas fa-map-marker-alt text-white"></i>
                </div>
                <div>
                  <h3 class="text-lg font-semibold mb-1">Our Office</h3>
                  <p class="text-gray-300">
                    123 Charity Street, Suite 456<br />San Francisco, CA 94107
                  </p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex-shrink-0 bg-blue-500 rounded-lg p-3 mr-4">
                  <i class="fas fa-envelope text-white"></i>
                </div>
                <div>
                  <h3 class="text-lg font-semibold mb-1">Email Us</h3>
                  <p class="text-gray-300">
                    info@charityhub.org<br />support@charityhub.org
                  </p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex-shrink-0 bg-green-500 rounded-lg p-3 mr-4">
                  <i class="fas fa-phone-alt text-white"></i>
                </div>
                <div>
                  <h3 class="text-lg font-semibold mb-1">Call Us</h3>
                  <p class="text-gray-300">
                    +1 (555) 123-4567<br />Mon-Fri, 9am-5pm PST
                  </p>
                </div>
              </div>
            </div>

            <div class="mt-8">
              <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
              <div class="flex space-x-4">
                <a
                  href="#"
                  class="bg-gray-700 hover:bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition duration-300"
                >
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a
                  href="#"
                  class="bg-gray-700 hover:bg-blue-400 text-white w-10 h-10 rounded-full flex items-center justify-center transition duration-300"
                >
                  <i class="fab fa-twitter"></i>
                </a>
                <a
                  href="#"
                  class="bg-gray-700 hover:bg-pink-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition duration-300"
                >
                  <i class="fab fa-instagram"></i>
                </a>
                <a
                  href="#"
                  class="bg-gray-700 hover:bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition duration-300"
                >
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow-xl p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">
              Send Us a Message
            </h3>
            <form>
              <div class="grid grid-cols-1 gap-6">
                <div>
                  <label
                    for="name"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Full Name</label
                  >
                  <input
                    type="text"
                    id="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    placeholder="Your name"
                  />
                </div>

                <div>
                  <label
                    for="email"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Email Address</label
                  >
                  <input
                    type="email"
                    id="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    placeholder="your.email@example.com"
                  />
                </div>

                <div>
                  <label
                    for="subject"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Subject</label
                  >
                  <select
                    id="subject"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                  >
                    <option>General Inquiry</option>
                    <option>Partnership Opportunity</option>
                    <option>Press Inquiry</option>
                    <option>Technical Support</option>
                    <option>Other</option>
                  </select>
                </div>

                <div>
                  <label
                    for="message"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Message</label
                  >
                  <textarea
                    id="message"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    placeholder="Your message here..."
                  ></textarea>
                </div>

                <div>
                  <button
                    type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg"
                  >
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="map-container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.158104741534!2d-122.4199066846821!3d37.77934597975845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus"
          width="100%"
          height="100%"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
        ></iframe>
      </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-blue-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-800 mb-4">
            Frequently Asked Questions
          </h2>
          <p class="text-gray-600 max-w-2xl mx-auto">
            Find answers to common questions about our platform and how you can
            get involved.
          </p>
        </div>

        <div class="max-w-3xl mx-auto">
          <div class="bg-white rounded-lg shadow-md p-6 mb-4">
            <button
              class="flex justify-between items-center w-full text-left font-medium text-gray-800 faq-toggle"
            >
              <span
                >How does CharityHub select the campaigns featured on your
                platform?</span
              >
              <i class="fas fa-chevron-down text-pink-500"></i>
            </button>
            <div class="mt-3 text-gray-600 hidden faq-answer">
              <p>
                We have a rigorous vetting process that includes background
                checks, financial audits, and impact assessments. All
                organizations must demonstrate a proven track record of
                effectively using funds to create measurable change in their
                communities.
              </p>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow-md p-6 mb-4">
            <button
              class="flex justify-between items-center w-full text-left font-medium text-gray-800 faq-toggle"
            >
              <span
                >What percentage of my donation goes directly to the
                cause?</span
              >
              <i class="fas fa-chevron-down text-pink-500"></i>
            </button>
            <div class="mt-3 text-gray-600 hidden faq-answer">
              <p>
                100% of your donation goes directly to the campaign you choose
                to support. Our operational costs are covered separately by
                corporate sponsors and grants, ensuring that every cent you
                donate reaches those in need.
              </p>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow-md p-6 mb-4">
            <button
              class="flex justify-between items-center w-full text-left font-medium text-gray-800 faq-toggle"
            >
              <span>Can I start a campaign on CharityHub?</span>
              <i class="fas fa-chevron-down text-pink-500"></i>
            </button>
            <div class="mt-3 text-gray-600 hidden faq-answer">
              <p>
                Yes! We welcome applications from registered nonprofits and
                social enterprises. After submitting an application, our team
                will review your organization and proposed project. The approval
                process typically takes 2-3 weeks.
              </p>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow-md p-6">
            <button
              class="flex justify-between items-center w-full text-left font-medium text-gray-800 faq-toggle"
            >
              <span>How can I get updates on campaigns I've supported?</span>
              <i class="fas fa-chevron-down text-pink-500"></i>
            </button>
            <div class="mt-3 text-gray-600 hidden faq-answer">
              <p>
                When you donate to a campaign, you'll automatically receive
                email updates from the organization running it. You can also log
                in to your CharityHub account to see progress reports, photos,
                and impact metrics for all the campaigns you've supported.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-pink-500 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
          Ready to Make a Difference?
        </h2>
        <p class="text-pink-100 text-xl mb-8 max-w-2xl mx-auto">
          Join thousands of donors who are creating positive change around the
          world.
        </p>
        <div
          class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4"
        >
          <button
            class="bg-white text-pink-500 hover:bg-gray-100 px-6 py-3 rounded-md text-sm font-medium transition duration-300 shadow-md hover:shadow-lg"
          >
            Browse Campaigns
          </button>
          <button
            class="border-2 border-white text-white hover:bg-pink-600 px-6 py-3 rounded-md text-sm font-medium transition duration-300"
          >
            Start a Campaign
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
                class="bg-gray-700 text-white px-4 py-2 rounded-l-md focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent w-full"
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
      // FAQ toggle functionality
      document.querySelectorAll(".faq-toggle").forEach((button) => {
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

      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();

          document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
          });
        });
      });
    </script>
  </body>
</html>
