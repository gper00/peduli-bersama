<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peduli Bersama - Wadah Kebaikan untuk Sesama</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6a3093;
            --secondary-color: #a044ff;
            --light-purple: #f3e5ff;
            --dark-purple: #4a1b6d;
            --accent-color: #ff6b6b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .bg-primary-purple {
            background-color: var(--primary-color);
        }

        .text-primary-purple {
            color: var(--primary-color);
        }

        .btn-primary-purple {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary-purple:hover {
            background-color: var(--dark-purple);
            border-color: var(--dark-purple);
        }

        .btn-outline-purple {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-purple:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 Q50,80 0,100 Z"></path></svg>');
            background-size: cover;
            background-position: center;
        }

        .feature-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .campaign-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .campaign-card:hover {
            transform: translateY(-5px);
        }

        .campaign-img {
            height: 200px;
            object-fit: cover;
        }

        .progress {
            height: 10px;
            border-radius: 5px;
        }

        .progress-bar {
            background-color: var(--primary-color);
        }

        .testimonial-card {
            border-left: 4px solid var(--primary-color);
            background-color: var(--light-purple);
        }

        .stats-item {
            text-align: center;
            padding: 1.5rem;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stats-label {
            font-size: 1rem;
            color: #666;
        }

        .footer {
            background-color: var(--dark-purple);
            color: white;
        }

        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: white;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.1);
            color: white;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .social-icon:hover {
            background-color: var(--accent-color);
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            color: #333;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }

        .navbar-brand span {
            color: var(--accent-color);
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0;
            }

            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-hands-helping me-2"></i>
                <span>Peduli</span>Bersama
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Campaign</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    <a href="#" class="btn btn-outline-purple me-2">Masuk</a>
                    <a href="#" class="btn btn-primary-purple">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title display-4 fw-bold mb-4">Bersama Peduli, Bersama Berbagi</h1>
                    <p class="lead mb-4">Jembatan antara kebaikan dan kebutuhan. Wadah untuk berdonasi dengan mudah, aman, dan transparan bagi mereka yang membutuhkan.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-light btn-lg px-4">Donasi Sekarang</a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://images.unsplash.com/photo-1521791055366-0d403872c6f6?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="People helping each other" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-item">
                        <div class="stats-number">1,250+</div>
                        <div class="stats-label">Campaign Aktif</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-item">
                        <div class="stats-number">25,000+</div>
                        <div class="stats-label">Donatur</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-item">
                        <div class="stats-number">Rp 12.5M+</div>
                        <div class="stats-label">Dana Terkumpul</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-item">
                        <div class="stats-number">98%</div>
                        <div class="stats-label">Kepuasan Donatur</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="About Peduli Bersama" class="img-fluid rounded-3 shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">Tentang Peduli Bersama</h2>
                    <p>Dalam kehidupan sosial sering kali ditemukan saudara kita yang kurang mampu, pasien penyakit parah, hingga anak-anak yatim piatu yang kehilangan kasih sayang orang tua. Selain itu di negara yang besar Indonesia ini, sering kali terjadi bencana alam yang mengakibatkan kerugian baik materi maupun non-materi.</p>
                    <p>Di sisi lain, banyak orang yang ingin membantu, namun tidak tahu bagaimana cara menyalurkannya dengan tepat. Oleh karena itu, Peduli Bersama hadir sebagai jembatan antara kebaikan dan kebutuhan.</p>
                    <p>Dengan sistem yang mudah, aman, dan transparan akan memudahkan siapa pun untuk berdonasi dan turut meringankan beban mereka yang membutuhkan.</p>
                    <a href="#" class="btn btn-primary-purple mt-3">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Kenapa Memilih Peduli Bersama?</h2>
            <p class="text-center mb-5">Kami memberikan pengalaman berdonasi yang mudah, aman, dan transparan</p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card p-4 h-100">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Aman & Terpercaya</h4>
                        <p>Setiap donasi dikelola dengan sistem yang aman dan transparan. Laporan pertanggungjawaban tersedia untuk setiap campaign.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-4 h-100">
                        <div class="feature-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4>Beragam Pilihan</h4>
                        <p>Berbagai kategori campaign tersedia mulai dari bencana alam, pendidikan anak yatim, bantuan medis, hingga pembangunan tempat ibadah.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-4 h-100">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Transparansi</h4>
                        <p>Pantau perkembangan setiap campaign yang Anda donasikan. Update berkala dan laporan penggunaan dana tersedia untuk donatur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campaigns Section -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title">Campaign Terbaru</h2>
                <a href="#" class="btn btn-outline-purple">Lihat Semua</a>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card campaign-card">
                        <img src="https://images.unsplash.com/photo-1577897113292-3b95936e5206?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top campaign-img" alt="Bantuan Pendidikan">
                        <div class="card-body">
                            <span class="badge bg-primary-purple mb-2">Pendidikan</span>
                            <h5 class="card-title">Beasiswa untuk Anak Yatim</h5>
                            <p class="card-text text-muted">Bantu pendidikan 50 anak yatim di daerah terpencil untuk melanjutkan sekolah.</p>
                            <div class="progress mb-3">
                                <div class="progress-bar" style="width: 65%"></div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Rp 32.5jt</span>
                                <span>65%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="fas fa-users me-1"></i> 120 Donatur</small>
                                <a href="#" class="btn btn-sm btn-primary-purple">Donasi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card campaign-card">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top campaign-img" alt="Bencana Alam">
                        <span class="badge bg-danger mb-2 position-absolute top-0 end-0 m-2">Mendesak</span>
                        <div class="card-body">
                            <span class="badge bg-warning text-dark mb-2">Bencana</span>
                            <h5 class="card-title">Banjir Bandang NTT</h5>
                            <p class="card-text text-muted">Bantuan darurat untuk korban banjir bandang di Nusa Tenggara Timur.</p>
                            <div class="progress mb-3">
                                <div class="progress-bar" style="width: 42%"></div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Rp 84jt</span>
                                <span>42%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="fas fa-users me-1"></i> 210 Donatur</small>
                                <a href="#" class="btn btn-sm btn-primary-purple">Donasi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card campaign-card">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top campaign-img" alt="Kesehatan">
                        <div class="card-body">
                            <span class="badge bg-info text-dark mb-2">Kesehatan</span>
                            <h5 class="card-title">Operasi Jantung untuk Rina</h5>
                            <p class="card-text text-muted">Bantu biaya operasi jantung bocor untuk Rina (8 tahun) dari keluarga kurang mampu.</p>
                            <div class="progress mb-3">
                                <div class="progress-bar" style="width: 78%"></div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Rp 117jt</span>
                                <span>78%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="fas fa-users me-1"></i> 340 Donatur</small>
                                <a href="#" class="btn btn-sm btn-primary-purple">Donasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Apa Kata Mereka?</h2>
            <p class="text-center mb-5">Testimoni dari donatur dan penerima manfaat</p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card testimonial-card p-4 h-100">
                        <div class="d-flex mb-3">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Testimoni" class="rounded-circle me-3" width="60">
                            <div>
                                <h5 class="mb-0">Sarah Wijaya</h5>
                                <small class="text-muted">Donatur</small>
                            </div>
                        </div>
                        <p>"Saya sangat puas dengan transparansi Peduli Bersama. Setiap donasi yang saya berikan selalu ada update perkembangannya. Terima kasih!"</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card testimonial-card p-4 h-100">
                        <div class="d-flex mb-3">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Testimoni" class="rounded-circle me-3" width="60">
                            <div>
                                <h5 class="mb-0">Budi Santoso</h5>
                                <small class="text-muted">Penerima Manfaat</small>
                            </div>
                        </div>
                        <p>"Atas nama keluarga, saya ucapkan terima kasih kepada semua donatur yang telah membantu biaya pengobatan anak saya melalui Peduli Bersama."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card testimonial-card p-4 h-100">
                        <div class="d-flex mb-3">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Testimoni" class="rounded-circle me-3" width="60">
                            <div>
                                <h5 class="mb-0">Dewi Rahayu</h5>
                                <small class="text-muted">Pengelola Campaign</small>
                            </div>
                        </div>
                        <p>"Sebagai pengelola panti asuhan, Peduli Bersama sangat membantu dalam menggalang dana untuk kebutuhan anak-anak yatim di panti kami."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary-purple text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-4">Siap Berdonasi Hari Ini?</h2>
                    <p class="lead mb-5">Bergabunglah dengan ribuan donatur lainnya untuk membantu mereka yang membutuhkan. Setiap donasi Anda sangat berarti.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#" class="btn btn-light btn-lg px-4">Donasi Sekarang</a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4">Pelajari Cara Berdonasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="text-white mb-4">
                        <i class="fas fa-hands-helping me-2"></i>
                        <span>Peduli</span>Bersama
                    </h4>
                    <p>Jembatan antara kebaikan dan kebutuhan. Wadah untuk berdonasi dengan mudah, aman, dan transparan bagi mereka yang membutuhkan.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="text-white mb-4">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Beranda</a></li>
                        <li class="mb-2"><a href="#">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#">Campaign</a></li>
                        <li class="mb-2"><a href="#">Cara Berdonasi</a></li>
                        <li class="mb-2"><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Kategori</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Bencana Alam</a></li>
                        <li class="mb-2"><a href="#">Pendidikan</a></li>
                        <li class="mb-2"><a href="#">Kesehatan</a></li>
                        <li class="mb-2"><a href="#">Anak Yatim</a></li>
                        <li class="mb-2"><a href="#">Tempat Ibadah</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Kemanusiaan No. 123, Jakarta</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (021) 1234-5678</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@pedulibersama.org</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2023 Peduli Bersama. Semua hak dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="me-3">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
