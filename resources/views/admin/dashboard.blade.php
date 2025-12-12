<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - DonasiKita</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #1a1a2e;
            color: white;
            overflow-y: auto;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .sidebar-title {
            font-size: 16px;
            font-weight: 700;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 20px 0;
        }
        
        .sidebar-nav li {
            margin: 0;
        }
        
        .sidebar-nav a {
            color: #bbb;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-nav a:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border-left-color: #667eea;
        }
        
        .sidebar-nav a.active {
            background: rgba(102, 126, 234, 0.2);
            color: #667eea;
            border-left-color: #667eea;
            font-weight: 600;
        }
        
        .sidebar-nav i {
            width: 20px;
            margin-right: 10px;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }
        
        .user-name {
            font-size: 13px;
            color: #bbb;
        }
        
        .logout-btn {
            width: 100%;
            padding: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #c0392b;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 25px;
            min-height: 100vh;
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .page-title h1 {
            font-size: 28px;
            margin: 0;
        }
        
        .page-title p {
            color: #999;
            font-size: 14px;
            margin: 5px 0 0;
        }
        
        .top-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-top: 4px solid;
        }
        
        .stat-card.primary {
            border-top-color: #667eea;
        }
        
        .stat-card.success {
            border-top-color: #27ae60;
        }
        
        .stat-card.warning {
            border-top-color: #f39c12;
        }
        
        .stat-card.danger {
            border-top-color: #e74c3c;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .stat-card.primary .stat-icon {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }
        
        .stat-card.success .stat-icon {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
        }
        
        .stat-card.warning .stat-icon {
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
        }
        
        .stat-card.danger .stat-icon {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 13px;
            color: #999;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-title {
            font-size: 16px;
            font-weight: 700;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #666;
            font-size: 13px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .table td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }
        
        .table tr:hover {
            background: #f8f9fa;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .badge-success {
            background: #d5f4e6;
            color: #27ae60;
        }
        
        .badge-pending {
            background: #fef5e7;
            color: #f39c12;
        }
        
        .badge-danger {
            background: #fadbd8;
            color: #c0392b;
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-success {
            background: #d5f4e6;
            color: #27ae60;
            border: 1px solid #27ae60;
        }
        
        .alert-error {
            background: #fadbd8;
            color: #c0392b;
            border: 1px solid #e74c3c;
        }
        
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-heart"></i>
            </div>
            <div class="sidebar-title">DonasiKita</div>
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.campaigns.index') }}">
                    <i class="fas fa-list"></i> Kampanye
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donations.index') }}">
                    <i class="fas fa-credit-card"></i> Donasi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donors.index') }}">
                    <i class="fas fa-users"></i> Donatur
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-name">
                    {{ auth()->user()->name }}
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <h1>Dashboard</h1>
                <p>Selamat datang kembali, {{ auth()->user()->name }}!</p>
            </div>
            <div class="top-actions">
                <a href="{{ route('admin.campaigns.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i> Kampanye Baru
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-icon">
                    <i class="fas fa-list-check"></i>
                </div>
                <div class="stat-value">{{ $stats['total_campaigns'] }}</div>
                <div class="stat-label">Total Kampanye</div>
            </div>

            <div class="stat-card success">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $stats['active_campaigns'] }}</div>
                <div class="stat-label">Kampanye Aktif</div>
            </div>

            <div class="stat-card primary">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="stat-value">{{ $stats['total_donations'] }}</div>
                <div class="stat-label">Total Donasi</div>
            </div>

            <div class="stat-card success">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-value">Rp {{ number_format($stats['total_collected'], 0, ',', '.') }}</div>
                <div class="stat-label">Dana Terkumpul</div>
            </div>

            <div class="stat-card warning">
                <div class="stat-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-value">Rp {{ number_format($stats['pending_donations'], 0, ',', '.') }}</div>
                <div class="stat-label">Menunggu Bayar</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Donations -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-history"></i> Donasi Terbaru
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Donatur</th>
                                <th>Kampanye</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recent_donations as $donation)
                                <tr>
                                    <td>{{ Str::limit($donation->donor_name, 20) }}</td>
                                    <td>{{ Str::limit($donation->campaign->title, 20) }}</td>
                                    <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                    <td>{{ $donation->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; color: #999; padding: 20px;">
                                        Belum ada donasi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Campaigns -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-fire"></i> Kampanye Terpopuler
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kampanye</th>
                                <th>Terkumpul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($campaigns as $campaign)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.campaigns.show', $campaign->id) }}" style="color: #667eea; text-decoration: none; cursor: pointer;">
                                            {{ Str::limit($campaign->title, 20) }}
                                        </a>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" style="text-align: center; color: #999; padding: 20px;">
                                        Belum ada kampanye
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
