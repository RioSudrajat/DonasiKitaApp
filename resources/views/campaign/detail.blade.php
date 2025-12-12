<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $campaign->title ?? 'Campaign' }} - DonasiKita</title>
    
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
        
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .campaign-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .campaign-main {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .campaign-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: white;
        }
        
        .campaign-tabs {
            display: flex;
            border-bottom: 2px solid #f0f0f0;
            background: white;
        }
        
        .tab-button {
            flex: 1;
            padding: 20px;
            border: none;
            background: none;
            font-size: 16px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }
        
        .tab-button.active {
            color: #667eea;
            border-bottom: 3px solid #667eea;
        }
        
        .tab-button:hover {
            color: #667eea;
        }
        
        .tab-content {
            display: none;
            padding: 30px;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .campaign-sidebar {
            position: sticky;
            top: 100px;
            height: fit-content;
        }
        
        .donation-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .donation-amount {
            margin-bottom: 20px;
        }
        
        .amount-raised {
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 5px;
        }
        
        .amount-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .progress-bar {
            background: #f0f0f0;
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 15px;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            height: 100%;
            transition: width 0.3s ease;
        }
        
        .target-amount {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .target-label {
            color: #666;
            font-size: 14px;
        }
        
        .target-value {
            font-weight: 600;
            color: #333;
        }
        
        .donate-button {
            width: 100%;
            padding: 15px;
            font-size: 16px;
        }
        
        .campaign-info {
            display: flex;
            gap: 30px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
        }
        
        .info-item i {
            color: #667eea;
        }
        
        .donatur-list {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .donatur-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .donatur-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
        
        .donatur-info {
            flex: 1;
        }
        
        .donatur-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }
        
        .donatur-date {
            font-size: 12px;
            color: #999;
        }
        
        .donatur-amount {
            font-weight: 600;
            color: #667eea;
        }
        
        .update-item {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .update-date {
            font-size: 12px;
            color: #999;
            margin-bottom: 10px;
        }
        
        .update-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .update-content {
            color: #666;
            line-height: 1.8;
        }
        
        @media (max-width: 768px) {
            .navbar-container {
                flex-wrap: wrap;
            }
            
            .navbar-brand {
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
            
            .campaign-layout {
                grid-template-columns: 1fr;
            }
            
            .campaign-sidebar {
                position: static;
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
            
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <div class="navbar-right" id="navMenu">
                <ul class="nav-links">
                    <li><a href="/#beranda">Beranda</a></li>
                    <li><a href="/#kampanye">Kampanye</a></li>
                    <li><a href="/#tentang">Tentang Kami</a></li>
                    <li><a href="/#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="campaign-layout">
            <!-- Main Content -->
            <div class="campaign-main">
                <!-- Campaign Image -->
                <div class="campaign-image">
                    @if(isset($campaign->image))
                        <img src="{{ str_starts_with($campaign->image, 'http') ? $campaign->image : asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-heart"></i>
                    @endif
                </div>

                <!-- Tabs -->
                <div class="campaign-tabs">
                    <button class="tab-button active" onclick="switchTab('tentang')">Tentang</button>
                    <button class="tab-button" onclick="switchTab('update')">Update</button>
                    <button class="tab-button" onclick="switchTab('donatur')">Donatur</button>
                </div>

                <!-- Tab Content: Tentang -->
                <div id="tentang" class="tab-content active">
                    <h2 style="margin-bottom: 20px; color: #333;">{{ $campaign->title ?? 'Judul Campaign' }}</h2>
                    <div style="color: #666; line-height: 1.8;">
                        {!! nl2br(e($campaign->description ?? 'Deskripsi campaign akan ditampilkan di sini. Admin dapat mengelola konten ini melalui dashboard admin.')) !!}
                    </div>
                </div>

                <!-- Tab Content: Update -->
                <div id="update" class="tab-content">
                    @if(isset($campaign->updates) && count($campaign->updates) > 0)
                        @foreach($campaign->updates as $update)
                            <div class="update-item">
                                <div class="update-date">{{ $update->created_at->format('d M Y') }}</div>
                                <div class="update-title">{{ $update->title }}</div>
                                <div class="update-content">{{ $update->content }}</div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 40px; color: #999;">
                            <i class="fas fa-newspaper" style="font-size: 48px; margin-bottom: 20px;"></i>
                            <p>Belum ada update untuk campaign ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Tab Content: Donatur -->
                <div id="donatur" class="tab-content">
                    <div class="donatur-list" id="donaturList">
                        @if(isset($campaign->donations) && count($campaign->donations) > 0)
                            @foreach($campaign->donations as $donation)
                                <div class="donatur-item">
                                    <div class="donatur-avatar">
                                        {{ strtoupper(substr($donation->donor_name, 0, 1)) }}
                                    </div>
                                    <div class="donatur-info">
                                        <div class="donatur-name">{{ $donation->donor_name }}</div>
                                        <div class="donatur-date">{{ $donation->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="donatur-amount">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="text-align: center; padding: 40px; color: #999;" id="noDonorsMessage">
                                <i class="fas fa-users" style="font-size: 48px; margin-bottom: 20px;"></i>
                                <p>Jadilah yang pertama berdonasi untuk campaign ini!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="campaign-sidebar">
                <div class="donation-card">
                    <div class="donation-amount">
                        <div class="amount-raised" id="currentAmount">
                            Rp {{ number_format($campaign->current_amount ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="amount-label">terkumpul dari target</div>
                        <div class="progress-bar">
                            <div class="progress-fill" id="progressBar" style="width: {{ $campaign->progress ?? 0 }}%;"></div>
                        </div>
                    </div>

                    <div class="target-amount">
                        <div>
                            <div class="target-label">Target Dana</div>
                            <div class="target-value">Rp {{ number_format($campaign->target_amount ?? 0, 0, ',', '.') }}</div>
                        </div>
                        <div>
                            <div class="target-label">Sisa Hari</div>
                            <div class="target-value">{{ isset($campaign->days_left) ? floor($campaign->days_left) : '-' }} Hari</div>
                        </div>
                    </div>

                    <button class="btn-primary donate-button" onclick="window.location.href='{{ route('donation.form', $campaign->id ?? 1) }}'">
                        <i class="fas fa-heart"></i> Donasi Sekarang
                    </button>

                    <div class="campaign-info">
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <span id="donorsCount">{{ $campaign->donors_count ?? 0 }} Donatur</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-share-alt"></i>
                            <span>Bagikan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Remove active from all buttons
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => button.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            
            // Add active to clicked button
            event.target.classList.add('active');
        }

        // Real-time update function
        console.log('Campaign detail script loaded');
        
        function updateCampaignData() {
            const campaignId = {{ $campaign->id }};
            console.log(`=== updateCampaignData called for campaign ${campaignId} ===`);
            
            fetch(`/campaign/${campaignId}/realtime`)
                .then(response => response.json())
                .then(data => {
                    console.log('Campaign realtime data:', data);
                    
                    const currentAmount = parseFloat(data.current_amount);
                    const progress = parseInt(data.progress);
                    const donorsCount = parseInt(data.donors_count);
                    
                    console.log(`Data parsed: amount=${currentAmount}, progress=${progress}%, donors=${donorsCount}`);
                    
                    // Update current amount
                    const formattedAmount = new Intl.NumberFormat('id-ID').format(Math.floor(currentAmount));
                    const currentAmountEl = document.getElementById('currentAmount');
                    if (currentAmountEl) {
                        currentAmountEl.textContent = 'Rp ' + formattedAmount;
                        console.log(`✓ Updated currentAmount: Rp ${formattedAmount}`);
                    } else {
                        console.error('✗ currentAmount element not found');
                    }
                    
                    // Update progress bar
                    const progressBar = document.getElementById('progressBar');
                    if (progressBar) {
                        progressBar.style.width = progress + '%';
                        console.log(`✓ Updated progressBar to ${progress}%`);
                    } else {
                        console.error('✗ progressBar element not found');
                    }
                    
                    // Update donors count
                    const donorsCountEl = document.getElementById('donorsCount');
                    if (donorsCountEl) {
                        donorsCountEl.textContent = donorsCount + ' Donatur';
                        console.log(`✓ Updated donorsCount to ${donorsCount}`);
                    } else {
                        console.error('✗ donorsCount element not found');
                    }
                    
                    // Update donors list
                    if (data.donations && data.donations.length > 0) {
                        const donaturList = document.getElementById('donaturList');
                        if (donaturList) {
                            // Remove "no donors" message if exists
                            const noMessage = document.getElementById('noDonorsMessage');
                            if (noMessage) {
                                noMessage.remove();
                            }
                            
                            // Build new donors HTML
                            let donorsHTML = '';
                            data.donations.forEach(donation => {
                                donorsHTML += `
                                    <div class="donatur-item">
                                        <div class="donatur-avatar">
                                            ${donation.avatar}
                                        </div>
                                        <div class="donatur-info">
                                            <div class="donatur-name">${donation.donor_name}</div>
                                            <div class="donatur-date">${donation.created_at}</div>
                                        </div>
                                        <div class="donatur-amount">
                                            Rp ${new Intl.NumberFormat('id-ID').format(parseInt(donation.amount))}
                                        </div>
                                    </div>
                                `;
                            });
                            
                            donaturList.innerHTML = donorsHTML;
                            console.log(`✓ Updated donors list with ${data.donations.length} donors`);
                        } else {
                            console.error('✗ donaturList element not found');
                        }
                    }
                })
                .catch(error => console.error('Error fetching real-time data:', error));
        }

        // Start updates - try multiple approaches
        if (document.readyState === 'loading') {
            console.log('DOM still loading, waiting for DOMContentLoaded');
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOMContentLoaded fired');
                updateCampaignData();
                setInterval(updateCampaignData, 5000);
            });
        } else {
            console.log('DOM already loaded');
            updateCampaignData();
            setInterval(updateCampaignData, 5000);
        }
        
        // Fallback timeout
        setTimeout(function() {
            console.log('Fallback timeout - ensuring updates are started');
            updateCampaignData();
        }, 100);
        
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
