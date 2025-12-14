<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Donasi - DonasiKita</title>
    
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
            max-width: 600px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .form-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .campaign-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .campaign-title {
            font-size: 18px;
            font-weight: 600;
        }
        
        .campaign-target {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }
        
        .step-indicator::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e0e0;
            z-index: 0;
        }
        
        .step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #666;
            margin: 0 auto 10px;
            transition: all 0.3s ease;
        }
        
        .step.active .step-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .step.completed .step-number {
            background: #4caf50;
            color: white;
        }
        
        .step-label {
            font-size: 12px;
            color: #666;
            font-weight: 500;
        }
        
        .step.active .step-label {
            color: #667eea;
            font-weight: 600;
        }
        
        .form-section {
            display: none;
        }
        
        .form-section.active {
            display: block;
        }
        
        .form-section h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        
        .form-label .required {
            color: #e74c3c;
        }
        
        .input-field {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .input-field.error {
            border-color: #e74c3c;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .nominal-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .nominal-btn {
            padding: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            color: #333;
            transition: all 0.3s ease;
        }
        
        .nominal-btn:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
        }
        
        .nominal-btn.selected {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
        }
        
        .custom-nominal {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .custom-nominal-input {
            flex: 1;
        }
        
        /* Remove spin buttons from number input */
        input[type=\"number\"]::-webkit-inner-spin-button,
        input[type=\"number\"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type=\"number\"] {
            -moz-appearance: textfield;
        }
        
        .custom-nominal-prefix {
            color: #666;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .slider {
            background-color: #667eea;
        }
        
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        
        .toggle-label {
            color: #666;
            font-size: 14px;
        }
        
        .form-buttons {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }
        
        .btn-back {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }
        
        .btn-back:hover {
            background: #667eea;
            color: white;
        }
        
        .btn-next {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }
        
        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .btn-next:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        .summary-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .summary-row:last-child {
            border-bottom: none;
        }
        
        .summary-label {
            color: #666;
            font-size: 14px;
        }
        
        .summary-value {
            font-weight: 600;
            color: #333;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 2px solid #667eea;
            margin-top: 10px;
            font-size: 18px;
        }
        
        .summary-total .summary-label {
            font-weight: 700;
            color: #333;
        }
        
        .summary-total .summary-value {
            color: #667eea;
            font-size: 20px;
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
            
            .form-card {
                padding: 20px;
            }
            
            .nominal-buttons {
                grid-template-columns: 1fr;
            }
            
            .step-label {
                font-size: 10px;
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
        <div class="form-card">
            <!-- Campaign Info -->
            <div class="campaign-info">
                <div>
                    <div class="campaign-title">{{ $campaign->title ?? 'Kampanye Donasi' }}</div>
                    <div class="campaign-target">Target: Rp {{ number_format($campaign->target_amount ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active" id="step-1-indicator">
                    <div class="step-number">1</div>
                    <div class="step-label">Nominal</div>
                </div>
                <div class="step" id="step-2-indicator">
                    <div class="step-number">2</div>
                    <div class="step-label">Data Donatur</div>
                </div>
                <div class="step" id="step-3-indicator">
                    <div class="step-number">3</div>
                    <div class="step-label">Konfirmasi</div>
                </div>
            </div>

            <form id="donationForm">
                <!-- Step 1: Nominal -->
                <div class="form-section active" id="step-1">
                    <h2>Pilih Nominal Donasi</h2>
                    
                    <div class="form-group">
                        <label class="form-label">Pilih Nominal yang Tersedia</label>
                        <div class="nominal-buttons">
                            <button type="button" class="nominal-btn" onclick="selectNominal(25000, this)">
                                Rp 25.000
                            </button>
                            <button type="button" class="nominal-btn" onclick="selectNominal(50000, this)">
                                Rp 50.000
                            </button>
                            <button type="button" class="nominal-btn" onclick="selectNominal(100000, this)">
                                Rp 100.000
                            </button>
                            <button type="button" class="nominal-btn" onclick="selectNominal(200000, this)">
                                Rp 200.000
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">atau Nominal Lainnya</label>
                        <div class="custom-nominal">
                            <span class="custom-nominal-prefix">Rp</span>
                            <input 
                                type="text" 
                                id="customNominal" 
                                class="input-field custom-nominal-input" 
                                placeholder="Minimal Rp 1.000"
                                oninput="handleCustomNominalInput(this)"
                            >
                        </div>
                        <div class="error-message" id="nominalError"></div>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="btn-next" onclick="nextStep()">
                            Selanjutnya <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Data Donatur -->
                <div class="form-section" id="step-2">
                    <h2>Data Donatur</h2>
                    
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="donorName" 
                            class="input-field" 
                            placeholder="Masukkan nama lengkap Anda"
                            required
                        >
                        <div class="error-message" id="nameError"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email <span class="required">*</span></label>
                        <input 
                            type="email" 
                            id="donorEmail" 
                            class="input-field" 
                            placeholder="Masukkan email Anda"
                            required
                        >
                        <div class="error-message" id="emailError"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">No. Telpon (Whatsapp) <span class="required">*</span></label>
                        <input 
                            type="tel" 
                            id="donorPhone" 
                            class="input-field" 
                            placeholder="Masukkan nomor WhatsApp Anda"
                            required
                        >
                        <div class="error-message" id="phoneError"></div>
                    </div>

                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="hideNameToggle">
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">Sembunyikan nama saya (Hamba Allah)</span>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="btn-back" onclick="prevStep()">
                            <i class="fas fa-arrow-left" style="margin-right: 10px;"></i> Kembali
                        </button>
                        <button type="button" class="btn-next" onclick="nextStep()">
                            Selanjutnya <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Konfirmasi -->
                <div class="form-section" id="step-3">
                    <h2>Konfirmasi Donasi</h2>
                    
                    <div class="summary-card">
                        <div class="summary-row">
                            <span class="summary-label">Kampanye</span>
                            <span class="summary-value">{{ $campaign->title ?? 'Kampanye' }}</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Nama Donatur</span>
                            <span class="summary-value" id="summaryName">-</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Email</span>
                            <span class="summary-value" id="summaryEmail">-</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">No. Telpon</span>
                            <span class="summary-value" id="summaryPhone">-</span>
                        </div>
                        <div class="summary-total">
                            <span class="summary-label">Total Donasi</span>
                            <span class="summary-value" id="summaryTotal">Rp 0</span>
                        </div>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="btn-back" onclick="prevStep()">
                            <i class="fas fa-arrow-left" style="margin-right: 10px;"></i> Kembali
                        </button>
                        <button type="button" class="btn-next" onclick="submitDonation()" id="submitBtn">
                            <i class="fas fa-check" style="margin-right: 10px;"></i> Konfirmasi & Bayar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let selectedNominal = 0;
        const campaignId = {{ $campaign->id ?? 1 }};

        function selectNominal(amount, button) {
            selectedNominal = amount;
            document.querySelectorAll('.nominal-btn').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            document.getElementById('nominalError').textContent = '';
            
            // Auto-fill custom input with formatted value
            const customInput = document.getElementById('customNominal');
            customInput.value = formatNumber(amount);
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function parseFormattedNumber(str) {
            return parseInt(str.replace(/\./g, '')) || 0;
        }

        function handleCustomNominalInput(input) {
            // Remove all non-digit characters
            let value = input.value.replace(/\D/g, '');
            
            // Format with dots
            if (value) {
                value = formatNumber(value);
                input.value = value;
                
                // Update selected nominal
                const numericValue = parseFormattedNumber(value);
                if (numericValue >= 1000) {
                    selectedNominal = numericValue;
                    document.getElementById('nominalError').textContent = '';
                } else {
                    selectedNominal = 0;
                }
            } else {
                selectedNominal = 0;
            }
            
            // Deselect all buttons when user types
            document.querySelectorAll('.nominal-btn').forEach(btn => btn.classList.remove('selected'));
        }

        function selectCustomNominal(value) {
            if (value && parseInt(value) >= 1000) {
                selectedNominal = parseInt(value);
                document.querySelectorAll('.nominal-btn').forEach(btn => btn.classList.remove('selected'));
                document.getElementById('nominalError').textContent = '';
            }
        }

        function validateStep() {
            if (currentStep === 1) {
                if (selectedNominal === 0) {
                    document.getElementById('nominalError').textContent = 'Silakan pilih nominal donasi';
                    return false;
                }
                return true;
            }
            if (currentStep === 2) {
                const name = document.getElementById('donorName').value.trim();
                const email = document.getElementById('donorEmail').value.trim();
                const phone = document.getElementById('donorPhone').value.trim();
                let valid = true;

                if (!name) {
                    document.getElementById('nameError').textContent = 'Nama harus diisi';
                    valid = false;
                }
                if (!email || !email.includes('@')) {
                    document.getElementById('emailError').textContent = 'Email tidak valid';
                    valid = false;
                }
                if (!phone || phone.length < 10) {
                    document.getElementById('phoneError').textContent = 'Nomor telpon harus valid';
                    valid = false;
                }
                return valid;
            }
            return true;
        }

        function nextStep() {
            if (!validateStep()) return;
            
            if (currentStep < 3) {
                document.getElementById(`step-${currentStep}`).classList.remove('active');
                document.getElementById(`step-${currentStep}-indicator`).classList.remove('active');
                if (currentStep < 3) {
                    document.getElementById(`step-${currentStep}-indicator`).classList.add('completed');
                }
                
                currentStep++;
                document.getElementById(`step-${currentStep}`).classList.add('active');
                document.getElementById(`step-${currentStep}-indicator`).classList.add('active');
                
                if (currentStep === 3) {
                    updateSummary();
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                document.getElementById(`step-${currentStep}`).classList.remove('active');
                document.getElementById(`step-${currentStep}-indicator`).classList.remove('active');
                
                currentStep--;
                document.getElementById(`step-${currentStep}`).classList.add('active');
                document.getElementById(`step-${currentStep}-indicator`).classList.remove('completed');
                document.getElementById(`step-${currentStep}-indicator`).classList.add('active');
            }
        }

        function updateSummary() {
            const name = document.getElementById('donorName').value || '-';
            const email = document.getElementById('donorEmail').value || '-';
            const phone = document.getElementById('donorPhone').value || '-';
            const hideName = document.getElementById('hideNameToggle').checked;

            document.getElementById('summaryName').textContent = hideName ? 'Hamba Allah' : name;
            document.getElementById('summaryEmail').textContent = email;
            document.getElementById('summaryPhone').textContent = phone;
            document.getElementById('summaryTotal').textContent = 'Rp ' + selectedNominal.toLocaleString('id-ID');
        }

        function submitDonation() {
            if (!validateStep()) return;

            const formData = {
                campaign_id: campaignId,
                donor_name: document.getElementById('donorName').value,
                donor_email: document.getElementById('donorEmail').value,
                donor_phone: document.getElementById('donorPhone').value,
                amount: selectedNominal,
                hide_name: document.getElementById('hideNameToggle').checked
            };

            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            fetch('{{ route("donation.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            window.location.href = '{{ route("donation.success") }}?order_id=' + result.order_id;
                        },
                        onPending: function(result) {
                            alert('Menunggu pembayaran...');
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal. Silakan coba lagi.');
                            document.getElementById('submitBtn').disabled = false;
                            document.getElementById('submitBtn').innerHTML = '<i class="fas fa-check"></i> Konfirmasi & Bayar';
                        }
                    });
                } else {
                    alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                    document.getElementById('submitBtn').disabled = false;
                    document.getElementById('submitBtn').innerHTML = '<i class="fas fa-check"></i> Konfirmasi & Bayar';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            document.getElementById('submitBtn').disabled = false;
            document.getElementById('submitBtn').innerHTML = '<i class="fas fa-check"></i> Konfirmasi & Bayar';
        });
    }
    
    // Toggle mobile menu
    function toggleMenu() {
        const menu = document.getElementById('navMenu');
        const hamburger = document.querySelector('.hamburger');
        menu.classList.toggle('active');
        hamburger.classList.toggle('active');
    }
    </script>    <!-- Midtrans Snap Script -->
    <script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</body>
</html>
