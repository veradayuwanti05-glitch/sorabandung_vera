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
            --pastel-blue: #e0f2fe;
            --soft-white: #f8fafc;
            --brand-blue: #38bdf8;
            --brand-dark: #0f172a;
        }

        body {
             background: linear-gradient(135deg, #87cbf9 0%, #f6f8fa 50%, #ffffff 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(186, 230, 253, 0.5);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--brand-blue);
        }

        .hero-wrapper {
            padding: 120px 0;
        }

        .hero-badge {
            background: #ffffff;
            color: var(--brand-blue);
            font-weight: 700;
            font-size: 0.75rem;
            padding: 8px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.1);
            display: inline-block;
            margin-bottom: 20px;
        }

        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            color: var(--brand-dark);
            letter-spacing: -2px;
        }

        .hero-title span {
            color: var(--brand-blue);
        }

        .btn-custom-solid {
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            color: white;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 16px;
            border: none;
            transition: 0.3s;
        }

        .btn-custom-solid:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(56, 189, 248, 0.3);
            color: white;
        }

        .flow-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            padding: 40px;
            transition: 0.3s;
        }

        .flow-card:hover {
            transform: translateY(-10px);
            background: #ffffff;
        }

        .flow-icon {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        footer {
            padding: 40px 0;
            color: #94a3b8;
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
                        <a href="{{ auth()->user()->role == 'admin_pusat' ? route('admin.dashboard') : (auth()->user()->role == 'pem_kecamatan' ? route('kecamatan.dashboard') : route('warga.dashboard')) }}" class="btn-custom-solid py-2 px-4 fs-6">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn text-secondary fw-bold me-3">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-custom-solid py-2 px-4 fs-6">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <section class="hero-wrapper text-center">
        <div class="container">
            <div class="hero-badge">PLATFORM INTEGRASI ADUAN WARGA</div>
            <h1 class="hero-title mb-4">Satu Ruang Kawal<br><span>Pembangunan Kota</span></h1>
            <p class="hero-desc mb-5 text-secondary">SuraBandung mendistribusikan setiap aspirasi secara real-time langsung ke balaikota dan jajaran tim teknis kecamatan.</p>
            @guest
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn-custom-solid">Buat Laporan Sekarang</a>
                </div>
            @endguest
        </div>
    </section>

    <main class="container my-5">
        <div class="flow-grid row g-4">
            <div class="col-md-4">
                <div class="flow-card text-center">
                    <div class="flow-icon">✍️</div>
                    <h5 class="fw-bold">Sampaikan Aspirasi</h5>
                    <p class="small text-muted">Warga mengisi form laporan digital dengan bukti lampiran visual.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="flow-card text-center">
                    <div class="flow-icon">🏢</div>
                    <h5 class="fw-bold">Tinjau & Validasi</h5>
                    <p class="small text-muted">Pemerintah Kota memverifikasi laporan dan menentukan tingkat kedaruratan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="flow-card text-center">
                    <div class="flow-icon">🛠️</div>
                    <h5 class="fw-bold">Eksekusi Wilayah</h5>
                    <p class="small text-muted">Aparatur kecamatan memobilisasi tim lapangan hingga perbaikan tuntas.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="small">&copy; Mengawal Pembenahan Ruang Publik Kota.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>