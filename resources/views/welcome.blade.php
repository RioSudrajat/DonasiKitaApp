<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DonasiKita - Platform Donasi Terpercaya untuk Perubahan Sosial</title>
    <meta name="description" content="DonasiKita adalah platform donasi online yang memudahkan Anda berkontribusi untuk berbagai program sosial dan kemanusiaan.">
    
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#667eea">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="DonasiKita">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/images/icon-192x192.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }
        
        .nav-links a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-links a:hover {
            color: #667eea;
        }
        
        .navbar-right {
            display: flex;
            gap: 15px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: #667eea;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #667eea;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-install {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            display: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
            align-items: center;
            gap: 8px;
        }
        
        .btn-install:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }
        
        .btn-install.show {
            display: inline-flex;
        }
        
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
        }
        
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }
        
        .hero-text h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero-text p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.95;
            line-height: 1.8;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .hero-icon {
            text-align: center;
            font-size: 120px;
            opacity: 0.9;
        }
        
        .stats-section {
            background: white;
            padding: 60px 20px;
        }
        
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 50px;
            color: #333;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        
        .stat-box {
            text-align: center;
            padding: 30px;
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        
        .features-section {
            background: #f8f9fa;
            padding: 60px 20px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .feature-icon-1 {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }
        
        .feature-icon-2 {
            background: rgba(118, 75, 162, 0.1);
            color: #764ba2;
        }
        
        .feature-card h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feature-card p {
            color: #666;
            line-height: 1.8;
        }
        
        .campaigns-section {
            background: white;
            padding: 60px 20px;
        }
        
        .campaigns-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .campaign-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .campaign-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .campaign-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
        }
        
        .campaign-image.img2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .campaign-image.img3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .campaign-content {
            padding: 20px;
        }
        
        .campaign-content h3 {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .campaign-content p {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .progress-bar {
            background: #f0f0f0;
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            margin: 15px 0;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease;
        }
        
        .campaign-meta {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #999;
            margin-bottom: 15px;
        }
        
        .campaign-btn {
            width: 100%;
            text-align: center;
        }
        
        .testimonials-section {
            background: #f8f9fa;
            padding: 60px 20px;
        }
        
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        
        .testimonial-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stars {
            color: #ffc107;
            margin-bottom: 10px;
        }
        
        .testimonial-text {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.8;
        }
        
        .testimonial-name {
            font-weight: 600;
            color: #333;
            margin-top: 15px;
        }
        
        .testimonial-role {
            color: #999;
            font-size: 13px;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .cta-section p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.95;
        }
        
        .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .contact-section {
            background: white;
            padding: 60px 20px;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        
        .contact-box {
            text-align: center;
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: rgba(102, 126, 234, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
            color: #667eea;
        }
        
        .contact-box h3 {
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        
        .contact-box p {
            color: #666;
        }
        
        .footer {
            background: #1a1a2e;
            color: white;
            padding: 50px 20px 20px;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-section h4 {
            margin-bottom: 15px;
            color: #667eea;
        }
        
        .footer-link {
            color: #bbb;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }
        
        .footer-link:hover {
            color: #667eea;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(102, 126, 234, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            text-align: center;
        }
        
        .footer-bottom p {
            color: #999;
            font-size: 14px;
        }
        
        .carousel-container {
            position: relative;
            margin-bottom: 40px;
        }
        
        .carousel-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }
        
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        
        .carousel-slide {
            min-width: 33.333%;
            padding: 0 15px;
            box-sizing: border-box;
        }
        
        .carousel-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
        }
        
        .carousel-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #667eea;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .carousel-btn:hover {
            background: #764ba2;
            transform: scale(1.1);
        }
        
        .carousel-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }
        
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ddd;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dot.active {
            background: #667eea;
            width: 30px;
            border-radius: 5px;
        }
        
        @media (max-width: 1024px) {
            .carousel-slide {
                min-width: 50%;
            }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero-content {
                grid-template-columns: 1fr;
            }
            
            .hero-text h1 {
                font-size: 32px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .features-grid,
            .testimonials-grid,
            .contact-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }
            
            .carousel-slide {
                min-width: 100%;
            }
            
            .stat-number {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand" style="text-decoration: none;">
                <i class="fas fa-heart"></i>
                DonasiKita
            </a>
            
            <ul class="nav-links">
                <li><a href="/#beranda">Beranda</a></li>
                <li><a href="/#kampanye">Kampanye</a></li>
                <li><a href="/#tentang">Tentang Kami</a></li>
                <li><a href="/#kontak">Kontak</a></li>
            </ul>
            
            <div class="navbar-right">
                <button id="installBtn" class="btn-install">
                    <i class="fas fa-download"></i>
                    Install App
                </button>
                <a href="/#kampanye" class="btn-secondary">Lihat Kampanye</a>
                <a href="/#kampanye" class="btn-primary">Mulai Donasi</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Berbagi Kebaikan, Ubah Dunia</h1>
                <p>DonasiKita adalah platform terpercaya yang menghubungkan Anda dengan berbagai program sosial. Setiap donasi Anda memiliki dampak nyata untuk mereka yang membutuhkan.</p>
                <div class="hero-buttons">
                    <a href="#kampanye" class="btn-primary">Mulai Berdonasi</a>
                    <a href="#kampanye" class="btn-secondary">Lihat Kampanye</a>
                </div>
            </div>
            <div class="hero-icon">
                <i class="fas fa-hands-helping"></i>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="section-container">
            <h2 class="section-title">Dampak DonasiKita</h2>
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-number">15K+</div>
                    <div class="stat-label">Donatur Aktif</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">2.5B</div>
                    <div class="stat-label">Dana Terkumpul</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">150+</div>
                    <div class="stat-label">Kampanye Sukses</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">100K+</div>
                    <div class="stat-label">Orang Terbantu</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="section-container">
            <h2 class="section-title">Mengapa Memilih DonasiKita?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon feature-icon-1">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Semua transaksi dilindungi dengan enkripsi tingkat bank dan verifikasi berlapis untuk keamanan maksimal.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon feature-icon-2">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Transparansi Penuh</h3>
                    <p>Lacak setiap donasi Anda dan lihat bagaimana dana digunakan untuk membantu mereka yang membutuhkan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon feature-icon-1">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Dampak Nyata</h3>
                    <p>Setiap rupiah yang Anda donasikan langsung membantu program-program sosial yang terbukti efektif.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Campaigns Section -->
    <section class="campaigns-section" id="kampanye">
        <div class="section-container">
            <h2 class="section-title">Kampanye Terbaru</h2>
            
            @if($campaigns->count() > 0)
                <div class="carousel-container">
                    <div class="carousel-wrapper">
                        <div class="carousel-track" id="carouselTrack">
                            @foreach($campaigns as $campaign)
                            <div class="carousel-slide">
                                <!-- Campaign Card -->
                                <div class="campaign-card">
                                    @if($campaign->image)
                                        <div class="campaign-image">
                                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @else
                                        <div class="campaign-image">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                    @endif
                                    <div class="campaign-content">
                                        <h3>{{ $campaign->title }}</h3>
                                        <p>{{ Str::limit($campaign->description, 100) }}</p>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: {{ $campaign->progress }}%;"></div>
                                        </div>
                                        <div class="campaign-meta">
                                            <span>Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span>
                                            <span>{{ number_format($campaign->progress, 0) }}% Terkumpul</span>
                                        </div>
                                        <a href="{{ route('campaign.show', $campaign->id) }}" class="btn-primary campaign-btn">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Carousel Controls -->
                    <div class="carousel-controls">
                        <button class="carousel-btn" id="prevBtn" onclick="moveCarousel(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="carousel-dots" id="dotsContainer"></div>
                        <button class="carousel-btn" id="nextBtn" onclick="moveCarousel(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @else
                <!-- Fallback if no campaigns -->
                <div style="text-align: center; padding: 40px;">
                    <p style="color: #999;">Tidak ada kampanye tersedia saat ini.</p>
                </div>
            @endif
            
            <div style="text-align: center;">
                <a href="{{ route('campaigns.index') }}" class="btn-primary">Lihat Semua Kampanye</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="tentang">
        <div class="section-container">
            <h2 class="section-title">Apa Kata Mereka?</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"DonasiKita membuat saya merasa bahwa setiap kontribusi saya benar-benar membantu. Transparansi dan kemudahannya luar biasa!"</p>
                    <div class="testimonial-name">Budi Santoso</div>
                    <div class="testimonial-role">Donatur Reguler</div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Platform yang sangat user-friendly dan sistem keamanan yang terjamin. Saya percaya untuk terus berdonasi di sini."</p>
                    <div class="testimonial-name">Siti Nurhaliza</div>
                    <div class="testimonial-role">Pengusaha Muda</div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"DonasiKita membantu kami mencapai target program sosial lebih cepat. Terima kasih atas dukungan yang luar biasa!"</p>
                    <div class="testimonial-name">Ahmad Wijaya</div>
                    <div class="testimonial-role">Ketua Lembaga Amal</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="section-container">
            <h2>Siap Membuat Perubahan?</h2>
            <p>Bergabunglah dengan ribuan donatur yang telah membantu mengubah kehidupan orang lain.</p>
            <div class="cta-buttons">
                <a href="#kampanye" class="btn-primary">Mulai Berdonasi</a>
                <a href="#kontak" class="btn-secondary">Hubungi Kami</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="kontak">
        <div class="section-container">
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="contact-grid">
                <div class="contact-box">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Lokasi</h3>
                    <p>Jl. Kesejahteraan No. 123<br>Jakarta Selatan 12345</p>
                </div>
                <div class="contact-box">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Telepon</h3>
                    <p>+62 21 123 4567<br>+62 812 3456 7890</p>
                </div>
                <div class="contact-box">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p>info@donasiita.com<br>support@donasiita.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div>
                    <h4>Tentang Kami</h4>
                    <p style="color: #bbb; font-size: 14px; margin-bottom: 15px;">DonasiKita adalah platform donasi online yang memudahkan Anda berkontribusi untuk berbagai program sosial.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h4>Fitur</h4>
                    <a href="#" class="footer-link">Donasi Mudah</a>
                    <a href="#" class="footer-link">Kampanye Sosial</a>
                    <a href="#" class="footer-link">Transparansi Dana</a>
                    <a href="#" class="footer-link">Laporan Donasi</a>
                </div>
                <div>
                    <h4>Perusahaan</h4>
                    <a href="#" class="footer-link">Blog</a>
                    <a href="#" class="footer-link">Karir</a>
                    <a href="#" class="footer-link">Berita</a>
                    <a href="#" class="footer-link">Media Partner</a>
                </div>
                <div>
                    <h4>Legal</h4>
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <a href="#" class="footer-link">Syarat Layanan</a>
                    <a href="#" class="footer-link">Pusat Bantuan</a>
                    <a href="#" class="footer-link">Hubungi Kami</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 DonasiKita. Semua hak dilindungi. Dibuat dengan <i class="fas fa-heart" style="color: #667eea;"></i> untuk kebaikan.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Carousel functionality
        let currentSlide = 0;
        let slidesPerView = 3; // Default for desktop
        const track = document.getElementById('carouselTrack');
        const dotsContainer = document.getElementById('dotsContainer');
        const slides = document.querySelectorAll('.carousel-slide');
        const totalSlides = slides.length;

        // Initialize carousel
        function initCarousel() {
            if (totalSlides > 0) {
                updateSlidesPerView();
                currentSlide = 0;
                updateDotsContainer();
                updateCarousel();
                updateButtons();
            }
        }

        function updateSlidesPerView() {
            const width = window.innerWidth;
            if (width <= 1024) {
                slidesPerView = 2;
            } else if (width <= 768) {
                slidesPerView = 1;
            } else {
                slidesPerView = 3;
            }
        }

        function updateDotsContainer() {
            dotsContainer.innerHTML = '';
            const numDots = Math.ceil(totalSlides / slidesPerView);
            
            for (let i = 0; i < numDots; i++) {
                const dot = document.createElement('div');
                dot.className = 'dot' + (i === currentSlide ? ' active' : '');
                dot.onclick = () => {
                    currentSlide = i;
                    updateCarousel();
                    updateButtons();
                };
                dotsContainer.appendChild(dot);
            }
        }

        function updateCarousel() {
            const slideWidth = 100 / slidesPerView;
            const offset = -currentSlide * (slideWidth * slidesPerView);
            track.style.transform = `translateX(${offset}%)`;
            
            // Update dots
            document.querySelectorAll('.dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function updateButtons() {
            const numDots = Math.ceil(totalSlides / slidesPerView);
            document.getElementById('prevBtn').disabled = currentSlide === 0;
            document.getElementById('nextBtn').disabled = currentSlide >= numDots - 1;
        }

        function moveCarousel(direction) {
            const numDots = Math.ceil(totalSlides / slidesPerView);
            currentSlide = Math.max(0, Math.min(currentSlide + direction, numDots - 1));
            updateCarousel();
            updateButtons();
        }

        // Handle responsive breakpoints
        function handleResponsive() {
            const oldSlidesPerView = slidesPerView;
            updateSlidesPerView();
            
            if (oldSlidesPerView !== slidesPerView) {
                currentSlide = 0;
                initCarousel();
            }
        }

        window.addEventListener('resize', handleResponsive);
        
        // Initialize on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCarousel);
        } else {
            initCarousel();
        }
    </script>
    
    <!-- PWA Install Prompt -->
    <script>
        let deferredPrompt;
        const installBtn = document.getElementById('installBtn');

        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent the mini-infobar from appearing on mobile
            e.preventDefault();
            // Stash the event so it can be triggered later
            deferredPrompt = e;
            // Show install button
            installBtn.classList.add('show');
        });

        installBtn.addEventListener('click', async () => {
            if (!deferredPrompt) {
                return;
            }
            // Show the install prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            const { outcome } = await deferredPrompt.userChoice;
            console.log(`User response to the install prompt: ${outcome}`);
            // Clear the deferredPrompt
            deferredPrompt = null;
            // Hide install button
            installBtn.classList.remove('show');
        });

        window.addEventListener('appinstalled', () => {
            console.log('PWA was installed');
            // Hide install button
            installBtn.classList.remove('show');
            deferredPrompt = null;
        });
    </script>

    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('Service Worker registered successfully:', registration);
                    })
                    .catch((error) => {
                        console.log('Service Worker registration failed:', error);
                    });
            });
        }
    </script>
</body>
</html>
