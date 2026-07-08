<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SuraBandung</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f7fc; 
            color: #334155;
        }
        /* Sidebar Styles - Playful White with Vibrant Touch */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid #eef2f6;
            z-index: 1000;
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem 1.2rem;
            color: #64748b;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 14px;
            margin-bottom: 0.4rem;
            transition: all 0.25s ease;
        }
        .sidebar .nav-link:hover {
            color: #6366f1;
            background-color: #f0f2ff;
        }
        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: #6366f1;
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.25);
            font-weight: 700;
        }
        .sidebar .nav-link i {
            font-size: 1.2rem;
        }
        
        /* Main Content Workspace */
        .main-content {
            margin-left: 280px;
            padding: 2.5rem 3.5rem;
            min-height: 100vh;
        }

        /* Topbar / Toolbar - Vibrant Aurora Pastel Gradient */
        .top-nav {
            background: linear-gradient(135deg, #e0e7ff 0%, #f0fdf4 50%, #fce7f3 100%);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 22px;
            padding: 1.3rem 1.8rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.15);
        }

        /* Vibrant Pastel Cards Layout */
        .stat-card {
            border: none;
            border-radius: 22px;
            padding: 1.6rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 10px rgba(0,0,0,0.01);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -5px rgba(0, 0, 0, 0.06);
        }
        
        /* Specific Pastel Card Themes */
        .card-purple { background-color: #eef2ff; border-left: 5px solid #818cf8; }
        .card-teal { background-color: #f0fdfa; border-left: 5px solid #2dd4bf; }
        .card-emerald { background-color: #ecfdf5; border-left: 5px solid #34d399; }
        .card-orange { background-color: #fff7ed; border-left: 5px solid #fb923c; }
        
        .icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }
        
        /* Lower Level Blocks */
        .status-box-pending {
            background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
            border: 1px solid #fecdd3;
            border-radius: 22px;
            padding: 1.8rem;
        }
        .status-box-forwarded {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1px solid #bae6fd;
            border-radius: 22px;
            padding: 1.8rem;
        }

        /* Chart Section Container */
        .chart-card {
            background: #ffffff;
            border: 1px solid #eef2f6;
            border-radius: 22px;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.01);
        }
    </style>
</head>
<body>

    <!-- SIDEBAR NAVIGASI -->
    <div class="sidebar">
        <div class="d-flex align-items-center gap-2 mb-4 px-2">
            <div class="text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: linear-gradient(135deg, #6366f1 0%, #ec4899 100%);">
                <i class="bi bi-shield-check-fill fs-5"></i>
            </div>
            <span class="fw-bold fs-5 tracking-tight" style="background: linear-gradient(135deg, #4f46e5 0%, #db2777 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">SuraBandung</span>
        </div>
        <hr class="my-3" style="color: #e2e8f0;">
        
        <div class="nav flex-column flex-grow-1">
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

        <div class="mt-auto">
            <a class="nav-link text-danger opacity-75" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> Keluar Sistem
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <!-- MAIN DASHBOARD APP CONTENT -->
    <div class="main-content">
        
        <!-- TOP NAVIGATION BAR (TOOLBAR BERWARNA) -->
        <div class="top-nav d-flex justify-content-between align-items-center">
            <div>
                <span class="small fw-bold text-uppercase tracking-wider" style="color: #4f46e5; font-size: 0.75rem;">Overview Sistem</span>
                <h4 class="fw-bold mb-0" style="color: #1e1b4b;">Pusat Kendali Pemkot</h4>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <p class="small mb-0 fw-semibold" style="color: #64748b;">Halaman Akun</p>
                    <h6 class="fw-bold mb-0" style="color: #4f46e5;">Admin Pusat</h6>
                </div>
                <!-- Profile Pill Berwarna -->
                <div class="rounded-circle d-flex align-items-center justify-content-center border border-white shadow-sm" style="width: 44px; height: 44px; background: linear-gradient(135deg, #ffedd5 0%, #fbcfe8 100%);">
                    <i class="bi bi-person-fill" style="color: #db2777; font-size: 1.2rem;"></i>
                </div>
            </div>
        </div>

        <!-- 4 TOP VIBRANT PASTEL CARDS -->
        <div class="row g-4 mb-4">
            <!-- Total Laporan -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-purple d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase tracking-wider" style="color: #4f46e5; font-size: 0.75rem;">Total Aduan</span>
                        <h2 class="fw-bold mt-1 mb-0" style="color: #1e1b4b;">{{ $totalReports ?? 0 }}</h2>
                    </div>
                    <div class="icon-box" style="color: #6366f1;">
                        <i class="bi bi-archive-fill"></i>
                    </div>
                </div>
            </div>
            <!-- Total Warga Terdaftar -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-teal d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase tracking-wider" style="color: #0d9488; font-size: 0.75rem;">Total Warga</span>
                        <h2 class="fw-bold mt-1 mb-0" style="color: #115e59;">{{ $totalWarga ?? 0 }}</h2>
                    </div>
                    <div class="icon-box" style="color: #0d9488;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
            <!-- Laporan Beres -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-emerald d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase tracking-wider" style="color: #059669; font-size: 0.75rem;">Selesai</span>
                        <h2 class="fw-bold mt-1 mb-0" style="color: #064e3b;">{{ $totalResolved }}</h2>
                    </div>
                    <div class="icon-box" style="color: #10b981;">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                </div>
            </div>
            <!-- Laporan Sedang Berjalan -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card card-orange d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase tracking-wider" style="color: #ea580c; font-size: 0.75rem;">Diproses</span>
                        <h2 class="fw-bold mt-1 mb-0" style="color: #7c2d12;">{{ $totalProcess }}</h2>
                    </div>
                    <div class="icon-box" style="color: #f97316;">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- DETAILS & CHART DIAGRAM DATA -->
        <div class="row g-4">
            <!-- Grid Kiri: Gradasi Blok Info Status -->
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="status-box-pending">
                            <span class="small fw-bold text-uppercase tracking-wide" style="color: #e11d48;">Belum Diverifikasi</span>
                            <h1 class="fw-bold mt-2 mb-0" style="color: #9f1239;">{{ $totalPending }}</h1>
                            <p class="small mt-2 mb-0 fw-medium" style="color: #f43f5e;">Perlu validasi admin pusat segera</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="status-box-forwarded">
                            <span class="small fw-bold text-uppercase tracking-wide" style="color: #0284c7;">Diteruskan</span>
                            <h1 class="fw-bold mt-2 mb-0" style="color: #0c4a6e;">{{ $totalForwarded }}</h1>
                            <p class="small mt-2 mb-0 fw-medium" style="color: #0ea5e9;">Telah didelegasikan ke kecamatan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Kanan: Grafik Diagram Lingkaran Doughnut -->
            <div class="col-lg-5">
                <div class="chart-card d-flex flex-column align-items-center justify-content-center">
                    <h6 class="fw-bold mb-4 text-center" style="color: #0f172a; font-size: 0.9rem;">Rasio Distribusi Aduan</h6>
                    <div style="width: 100%; max-width: 220px; height: 220px; position: relative;">
                        <canvas id="reportChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Script Chart.js & Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('reportChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diteruskan', 'Diproses', 'Selesai'],
                datasets: [{
                    data: [{{ $totalPending }}, {{ $totalForwarded }}, {{ $totalProcess }}, {{ $totalResolved }}],
                    backgroundColor: ['#fb7185', '#38bdf8', '#fb923c', '#34d399'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: {
                            boxWidth: 8,
                            usePointStyle: true,
                            padding: 14,
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: 600 }
                        }
                    }
                },
                cutout: '75%'
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>