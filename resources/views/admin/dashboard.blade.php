<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SuraBandung</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f6fa; 
            color: #1e293b;
        }
        
        /* 1. SIDEBAR - SOFT PASTEL LAVENDER BLUE */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #e0e7ff 0%, #eef2ff 100%);
            z-index: 1000;
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #c7d2fe;
        }
        
        /* Menu Navigasi di Sidebar */
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0.9rem 1.2rem;
            color: #4338ca;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 14px;
            margin-bottom: 0.5rem;
            transition: all 0.25s ease;
        }
        .sidebar .nav-link:hover {
            color: #312e81;
            background-color: rgba(255, 255, 255, 0.4);
            transform: translateX(4px);
        }
        .sidebar .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            font-weight: 700;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.25);
        }
        .sidebar .nav-link i {
            font-size: 1.25rem;
        }
        
        /* 2. MAIN CONTENT SPACE */
        .main-content {
            margin-left: 280px;
            padding: 2.5rem 3.5rem;
            min-height: 100vh;
        }

        /* 3. NAVBAR - SOFT MINT ICE */
        .top-nav {
            background: linear-gradient(90deg, #e0f2fe 0%, #f0fdf4 100%);
            border: 1px solid #bae6fd;
            border-radius: 24px;
            padding: 1.3rem 2rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        /* 4. SOLID VIBRANT CARDS */
        .stat-card {
            border: none;
            border-radius: 24px;
            padding: 1.8rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 30px -8px rgba(0, 0, 0, 0.12);
        }
        
        .card-total-aduan { background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); }
        .card-total-warga { background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%); }
        .card-selesai { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .card-diproses { background: linear-gradient(135deg, #f59e0b 0%, #eab308 100%); }
        
        .icon-box {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* 5. BLOK STATUS BAWAH */
        .status-box-pending {
            background: #ffffff;
            border-left: 6px solid #ef4444;
            border-radius: 20px;
            padding: 1.8rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        }
        .status-box-forwarded {
            background: #ffffff;
            border-left: 6px solid #06b6d4;
            border-radius: 20px;
            padding: 1.8rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        }

        .chart-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 24px;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.02);
        }
    </style>
</head>
<body>

    <!-- SIDEBAR NAVIGASI (SOFT PASTEL LAVENDER BLUE) -->
    <div class="sidebar">
        <!-- Logo & Brand Header (Menggunakan Aset Lokal) -->
        <div class="d-flex align-items-center gap-3 mb-4 px-2">
            <div class="rounded-3 d-flex align-items-center justify-content-center bg-white shadow-sm border p-1" style="width: 44px; height: 44px; border-color: #cbd5e1 !important;">
                <img src="{{ asset('image/logo-bandung.png') }}" alt="Logo Bandung" style="width: 100%; height: auto; object-fit: contain;">
            </div>
            <span class="fw-800 fs-4 tracking-tight" style="color: #1e1b4b;">SuraBandung</span>
        </div>
        
        <hr class="my-2 opacity-50" style="color: #c7d2fe;">
        
        <!-- Menu Items -->
        <div class="nav flex-column flex-grow-1 mt-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.reports.index') }}" class="nav-link">
                <i class="bi bi-chat-left-text-fill"></i> Kelola Laporan
            </a>
            <a href="{{ route('admin.petugas.index') }}" class="nav-link">
                <i class="bi bi-person-badge-fill"></i> Akun Kecamatan
            </a>
            <a href="{{ route('admin.warga.index') }}" class="nav-link">
                <i class="bi bi-people-fill"></i> Data Warga
            </a>
        </div>

        <!-- Logout Bottom Link -->
        <div class="mt-auto">
            <a class="nav-link" style="color: #4338ca;" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> <span>Keluar Sistem</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <!-- MAIN DASHBOARD CONTENT WORKSPACE -->
    <div class="main-content">
        
        <!-- TOP NAVIGATION BAR (SOFT MINT ICE) -->
        <div class="top-nav d-flex justify-content-between align-items-center">
            <div>
                <span class="small fw-bold text-uppercase tracking-wider" style="color: #4f46e5; font-size: 0.75rem;">Sistem Analitik</span>
                <h3 class="fw-800 mb-0" style="color: #0f172a;">Pusat Kendali Pemkot</h3>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <p class="small mb-0 fw-bold" style="color: #64748b;">Halaman Akun</p>
                    <h6 class="fw-800 mb-0" style="color: #1e1b4b;">Admin Pusat</h6>
                </div>
                <!-- PP Admin (Menggunakan Aset Lokal) -->
                <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm bg-white border border-2 border-white p-1" style="width: 46px; height: 46px;">
                    <img src="{{ asset('image/logo-bandung.png') }}" alt="PP Admin" style="width: 100%; height: auto; object-fit: contain;">
                </div>
            </div>
        </div>

        <!-- 4 METRIC CARDS -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-total-aduan d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase tracking-wider" style="font-size: 0.75rem;">Total Aduan</span>
                        <h1 class="fw-800 mt-1 mb-0">{{ $totalReports ?? 0 }}</h1>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-archive-fill"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-total-warga d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase tracking-wider" style="font-size: 0.75rem;">Total Warga</span>
                        <h1 class="fw-800 mt-1 mb-0">{{ $totalWarga ?? 0 }}</h1>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-selesai d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase tracking-wider" style="font-size: 0.75rem;">Selesai</span>
                        <h1 class="fw-800 mt-1 mb-0">{{ $totalResolved }}</h1>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-diproses d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase tracking-wider" style="font-size: 0.75rem;">Diproses</span>
                        <h1 class="fw-800 mt-1 mb-0">{{ $totalProcess }}</h1>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- DETAILS & CHART -->
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="status-box-pending">
                            <span class="small fw-bold text-uppercase tracking-wide text-secondary">Belum Diverifikasi</span>
                            <h2 class="fw-800 d-block mt-1 mb-0" style="color: #ef4444; font-size: 2.6rem;">{{ $totalPending }}</h2>
                            <p class="small mt-2 mb-0 fw-bold text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Validasi Pusat</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="status-box-forwarded">
                            <span class="small fw-bold text-uppercase tracking-wide text-secondary">Diteruskan</span>
                            <h2 class="fw-800 d-block mt-1 mb-0" style="color: #06b6d4; font-size: 2.6rem;">{{ $totalForwarded }}</h2>
                            <p class="small mt-2 mb-0 fw-bold" style="color: #0ea5e9;"><i class="bi bi-building-fill-check"></i> Posisi di Kecamatan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="chart-card d-flex flex-column align-items-center justify-content-center">
                    <h6 class="fw-800 mb-4 text-center" style="color: #0f172a; font-size: 0.95rem;">Rasio Distribusi Aduan Warga</h6>
                    <div style="width: 100%; max-width: 210px; height: 210px; position: relative;">
                        <canvas id="reportChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('reportChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diteruskan', 'Diproses', 'Selesai'],
                datasets: [{
                    data: [{{ $totalPending }}, {{ $totalForwarded }}, {{ $totalProcess }}, {{ $totalResolved }}],
                    backgroundColor: ['#ef4444', '#06b6d4', '#f59e0b', '#10b981'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            usePointStyle: true,
                            padding: 14,
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: 700 }
                        }
                    }
                },
                cutout: '74%'
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>