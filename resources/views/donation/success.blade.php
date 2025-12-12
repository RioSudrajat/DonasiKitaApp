<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donasi Berhasil - DonasiKita</title>
    
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .success-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: popIn 0.5s ease-out;
        }
        
        .success-icon i {
            font-size: 40px;
            color: white;
        }
        
        @keyframes popIn {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        
        h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
        }
        
        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
        }
        
        .receipt {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            text-align: left;
            margin-bottom: 30px;
        }
        
        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }
        
        .receipt-row:last-child {
            border-bottom: none;
        }
        
        .receipt-label {
            color: #666;
            font-weight: 500;
        }
        
        .receipt-value {
            font-weight: 600;
            color: #333;
        }
        
        .receipt-total {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 2px solid #667eea;
            margin-top: 10px;
            font-size: 16px;
        }
        
        .receipt-total .receipt-label {
            font-weight: 700;
        }
        
        .receipt-total .receipt-value {
            color: #667eea;
            font-size: 20px;
        }
        
        .message-box {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .message-box p {
            color: #2e7d32;
            font-size: 14px;
            margin: 0;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            flex-direction: column;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }
        
        .support-text {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
        
        @media (max-width: 600px) {
            .success-card {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .success-icon {
                width: 70px;
                height: 70px;
            }
            
            .success-icon i {
                font-size: 35px;
            }
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1>Donasi Berhasil!</h1>
        <p class="subtitle">Terima kasih atas kontribusi Anda yang luar biasa</p>
        
        <div class="receipt">
            <div class="receipt-row">
                <span class="receipt-label">Order ID</span>
                <span class="receipt-value">{{ $donation->order_id }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Kampanye</span>
                <span class="receipt-value">{{ $donation->campaign->title }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Nama Donatur</span>
                <span class="receipt-value">{{ $donation->donor_name }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Email</span>
                <span class="receipt-value">{{ $donation->donor_email }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Metode Bayar</span>
                <span class="receipt-value">{{ ucfirst($donation->payment_type) }}</span>
            </div>
            <div class="receipt-total">
                <span class="receipt-label">Total Donasi</span>
                <span class="receipt-value">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="message-box">
            <p>
                <i class="fas fa-info-circle"></i>
                Bukti pembayaran telah dikirimkan ke email Anda. Anda juga bisa melihat donasi Anda di halaman detail kampanye.
            </p>
        </div>
        
        <div class="actions">
            <a href="/" class="btn btn-primary">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
            <a href="/#kampanye" class="btn btn-secondary">
                <i class="fas fa-heart"></i> Lihat Kampanye Lain
            </a>
        </div>
        
        <p class="support-text">
            Jika ada pertanyaan, hubungi kami di support@donasiita.com
        </p>
    </div>
</body>
</html>
