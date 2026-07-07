<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuraBandung - Hub Pengaduan Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-dark: #0f172a;
            --brand-primary: #2563eb;
            --brand-gradient: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
            --surface-light: #f8fafc;
        }

        body {
            background-color: var(--surface-light);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(248, 250, 252, 0.8) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            background: var(--brand-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-btn-login {
            color: #475569;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-btn-login:hover {
            color: var(--brand-primary);
        }

        .hero-wrapper {
            position: relative;
            padding: 140px 0 100px 0;
            background: radial-gradient(100% 100% at 50% 0%, rgba(37, 99, 235, 0.05) 0%, rgba(248, 250, 252, 0) 100%);
        }

        .hero-badge {
            background: rgba(37, 99, 235, 0.08);
            color: var(--brand-primary);
            font-weight: 700;
            font-size: 0.8rem;
            padding: 8px 16px;
            border-radius: 100px;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.15;
            color: var(--brand-dark);
            letter-spacing: -1.5px;
        }

        .hero-title span {
            background: var(--brand-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: #64748b;
            line-height: 1.6;
            max-width: 680px;
            margin: 0 auto;
        }

        .btn-premium-solid {
            background: var(--brand-dark);
            color: white;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 14px;
            border: none;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
            transition: all 0.2s ease;
        }

        .btn-premium-solid:hover {
            background: var(--brand-primary);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
            color: white;
        }

        .btn-premium-outline {
            background: #ffffff;
            color: var(--brand-dark);
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .btn-premium-outline:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-2px);
            color: var(--brand-dark);
        }

        .section-title {
            font-weight: 800;
            font-size: 2.25rem;
            color: var(--brand-dark);
            letter-spacing: -1px;
        }

        .flow-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 60px;
        }

        @media (max-width: 991px) {
            .flow-grid {
                grid-template-columns: 1fr;
            }
            .hero-title {
                font-size: 2.5rem;
            }
        }

        .flow-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.7);
            border-radius: 24px;
            padding: 40px 30px;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .flow-card:hover {
            transform: translateY(-8px);
            border-color: rgba(37, 99, 235, 0.3);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04);
        }

        .flow-number {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: absolute;
            top: 30px;
            right: 30px;
        }

        .flow-icon {
            width: 56px;
            height: 56px;
            background: rgba(37, 99, 235, 0.06);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 24px;
        }

        .flow-card h5 {
            font-weight: 700;
            color: var(--brand-dark);
            margin-bottom: 12px;
        }

        .flow-card p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        footer {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 40px 0;
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="#">SuraBandung.</a>
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        @if(auth()->user()->role == 'admin_pusat')
                            <a href="{{ route('admin.dashboard') }}" class="btn-premium-solid py-2 px-4 fs-6">Dashboard Admin</a>
                        @elseif(auth()->user()->role == 'pem_kecamatan')
                            <a href="{{ route('kecamatan.dashboard') }}" class="btn-premium-solid py-2 px-4 fs-6">Dashboard Kecamatan</a>
                        @else
                            <a href="{{ route('warga.dashboard') }}" class="btn-premium-solid py-2 px-4 fs-6">Dashboard Warga</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link nav-btn-login text-decoration-none me-4">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-premium-solid py-2 px-4 fs-6">Daftar Akun</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <section class="hero-wrapper text-center">
        <div class="container">
            <div class="hero-badge mb-4">PLATFORM INTEGRASI ADUAN WARGA</div>
            <h1 class="hero-title mb-4">Satu Ruang Kawal<br><span>Pembangunan Kota</span></h1>
            <p class="hero-desc mb-5">SuraBandung mendistribusikan setiap aspirasi, kerusakan fasilitas umum, hingga kendala kebersihan langsung ke balaikota dan jajaran tim teknis kecamatan.</p>
            @guest
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn-premium-solid text-decoration-none">Buat Laporan Sekarang</a>
                    <a href="{{ route('login') }}" class="btn-premium-outline text-decoration-none">Pantau Progress</a>
                </div>
            @endguest
        </div>
    </section>

    <main class="container my-5 py-5">
        <div class="text-center">
            <h3 class="section-title mb-2">Alur Distribusi Laporan</h3>
            <p class="text-muted">Bagaimana sistem kami bekerja memastikan aduan Anda dieksekusi</p>
        </div>
        
        <div class="flow-grid">
            <div class="flow-card">
                <div class="flow-number">01</div>
                <div class="flow-icon">✍️</div>
                <h5>Sampaikan Aspirasi</h5>
                <p>Warga mengisi form laporan digital disertai penandaan lokasi wilayah dan bukti lampiran visual secara real-time.</p>
            </div>
            
            <div class="flow-card">
                <div class="flow-number">02</div>
                <div class="flow-icon">🏢</div>
                <h5>Tinjau & Validasi</h5>
                <p>Pemerintah Kota memverifikasi laporan, menyaring keabsahan data, lalu menentukan bobot tingkat kedaruratan kasus.</p>
            </div>

            <div class="flow-card">
                <div class="flow-number">03</div>
                <div class="flow-icon">🛠️</div>
                <h5>Eksekusi Wilayah</h5>
                <p>Aparatur kecamatan menerima delegasi tugas, memobilisasi tim lapangan, kemudian menutup berkas dengan bukti perbaikan.</p>
            </div>
        </div>
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2026 SuraBandung Core. Mengawal Pembenahan Ruang Publik Kota.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>