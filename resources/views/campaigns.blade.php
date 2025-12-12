<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Semua Kampanye - DonasiKita</title>
    <meta name="description" content="Lihat semua kampanye donasi yang tersedia di DonasiKita. Pilih kampanye favorit Anda dan mulai berdonasi sekarang.">
    
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
            background: #f8f9fa;
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
            text-decoration: none;
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
            gap: 30px;
            margin-left: auto;
        }
        
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
            padding: 5px;
        }
        
        .hamburger span {
            width: 25px;
            height: 3px;
            background: #667eea;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
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
        
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 50px 20px;
            text-align: center;
        }
        
        .header-section h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .header-section p {
            font-size: 18px;
            opacity: 0.95;
            margin-bottom: 20px;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
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
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            overflow: hidden;
        }
        
        .campaign-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .campaign-content {
            padding: 20px;
        }
        
        .campaign-header {
            display: flex;
            align-items: start;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .campaign-header h3 {
            font-weight: 600;
            color: #333;
            flex: 1;
            margin-right: 10px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-completed {
            background: #e2e3e5;
            color: #383d41;
        }
        
        .campaign-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }
        
        .campaign-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .stat {
            font-size: 13px;
            color: #666;
        }
        
        .stat-value {
            font-weight: 700;
            color: #333;
        }
        
        .progress-bar {
            background: #f0f0f0;
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 10px;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease;
        }
        
        .progress-text {
            font-size: 12px;
            color: #999;
            text-align: right;
            margin-bottom: 15px;
        }
        
        .campaign-btn {
            width: 100%;
            text-align: center;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }
        
        .pagination a,
        .pagination span {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            text-decoration: none;
            color: #667eea;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .pagination a:hover {
            background: #f0f0f0;
            border-color: #667eea;
        }
        
        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .pagination .disabled {
            color: #ccc;
            cursor: not-allowed;
        }
        
        .empty-state {
            background: white;
            border-radius: 12px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .empty-state i {
            font-size: 60px;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state h2 {
            color: #999;
            margin-bottom: 10px;
            font-size: 20px;
        }
        
        .empty-state p {
            color: #bbb;
            margin-bottom: 30px;
        }
        
        .footer {
            background: #1a1a2e;
            color: white;
            padding: 50px 20px 20px;
            margin-top: 60px;
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
        
        @media (max-width: 768px) {
            .navbar-container {
                padding: 0 15px;
                flex-wrap: wrap;
            }
            
            .navbar-brand {
                font-size: 20px;
                flex: 1;
            }
            
            .hamburger {
                display: flex;
            }
            
            .navbar-right {
                display: none;
                width: 100%;
                order: 3;
                margin-top: 15px;
            }
            
            .navbar-right.active {
                display: block;
            }
            
            .nav-links {
                flex-direction: column;
                gap: 10px;
                padding: 0;
            }
            
            .nav-links li {
                text-align: left;
                width: 100%;
            }
            
            .nav-links a {
                display: block;
                padding: 10px 0;
            }
            
            .header-section h1 {
                font-size: 28px;
            }
            
            .campaigns-grid {
                grid-template-columns: 1fr;
            }
            
            .filters-section {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group {
                flex-direction: column;
            }
            
            .filter-select {
                width: 100%;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand">
                <i class="fas fa-heart"></i>
                DonasiKita
            </a>
            
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <div class="navbar-right" id="navMenu">
                <ul class="nav-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/#kampanye">Kampanye</a></li>
                    <li><a href="/#tentang">Tentang Kami</a></li>
                    <li><a href="/#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="header-section">
        <div class="main-container">
            <h1>Semua Kampanye</h1>
            <p>Temukan kampanye yang sesuai dengan hati Anda dan mulai berdonasi untuk membuat perbedaan.</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Campaigns Grid -->
        @if($campaigns->count() > 0)
            <div class="campaigns-grid">
                @foreach($campaigns as $campaign)
                    <div class="campaign-card">
                        @if($campaign->image)
                            <div class="campaign-image">
                                <img src="{{ str_starts_with($campaign->image, 'http') ? $campaign->image : asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}">
                            </div>
                        @else
                            <div class="campaign-image">
                                <i class="fas fa-heart"></i>
                            </div>
                        @endif
                        <div class="campaign-content">
                            <div class="campaign-header">
                                <h3>{{ $campaign->title }}</h3>
                                @if($campaign->status === 'active')
                                    <span class="status-badge status-active">Aktif</span>
                                @elseif($campaign->status === 'inactive')
                                    <span class="status-badge status-inactive">Nonaktif</span>
                                @else
                                    <span class="status-badge status-completed">Selesai</span>
                                @endif
                            </div>
                            <p class="campaign-description">{{ $campaign->description }}</p>
                            
                            <div class="campaign-stats">
                                <div class="stat">
                                    Terkumpul: <div class="stat-value">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</div>
                                </div>
                                <div class="stat">
                                    Target: <div class="stat-value">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $campaign->progress }}%;"></div>
                            </div>
                            <div class="progress-text">{{ number_format($campaign->progress, 0) }}% dari target</div>
                            
                            <a href="{{ route('campaign.show', $campaign->id) }}" class="btn-primary campaign-btn">
                                Lihat Detail & Donasi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($campaigns->hasPages())
                <div class="pagination">
                    {{ $campaigns->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h2>Tidak Ada Kampanye</h2>
                <p>Saat ini belum ada kampanye yang tersedia. Silakan cek kembali nanti.</p>
                <a href="/" class="btn-primary">Kembali ke Beranda</a>
            </div>
        @endif
    </div>

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
        // Toggle mobile menu
        function toggleMenu() {
            const menu = document.getElementById('navMenu');
            const hamburger = document.querySelector('.hamburger');
            menu.classList.toggle('active');
            hamburger.classList.toggle('active');
        }
    </script>
</body>
</html>
