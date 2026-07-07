<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wilayah - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-dark: #0f172a;
            --brand-primary: #3b82f6;
            --surface-light: #f4f7fe;
            --border-color: rgba(226, 232, 240, 0.9);
            
            --gradient-1: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --gradient-2: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            --gradient-3: linear-gradient(135deg, #10b981 0%, #047857 100%);
        }

        body {
            background-color: var(--surface-light);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid var(--border-color);
            padding: 35px 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 100;
        }

        .main-content {
            margin-left: 280px;
            padding: 45px 55px;
            min-height: 100vh;
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            color: var(--brand-dark);
            text-decoration: none;
            display: block;
            margin-bottom: 40px;
        }

        .brand-title span {
            color: var(--brand-primary);
        }

        .user-profile-box {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 18px;
            border-radius: 16px;
            border: 1px solid rgba(59, 130, 246, 0.1);
            margin-bottom: 20px;
        }

        .stat-card {
            border: none;
            border-radius: 24px;
            padding: 28px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            width: 130px;
            height: 130px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            top: -30px;
            right: -30px;
            transform: rotate(45deg);
        }

        .card-orange { background: var(--gradient-1); }
        .card-blue { background: var(--gradient-2); }
        .card-green { background: var(--gradient-3); }

        .stat-number {
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1.1;
            margin-top: 5px;
        }

        .table-container {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 28px;
            padding: 35px;
            box-shadow: 0 15px 40px rgba(15, 23, 42, 0.02);
        }

        .table thead th {
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.8px;
            padding: 18px 16px;
            border-bottom: 2px solid #f1f5f9;
        }

        .table tbody td {
            padding: 20px 16px;
            color: #475569;
            font-size: 0.95rem;
            border-bottom: 1px solid #f8fafc;
        }

        .badge-custom {
            font-weight: 800;
            font-size: 0.75rem;
            padding: 6px 14px;
            border-radius: 100px;
            display: inline-block;
        }

        .btn-action {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 10px 20px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-action:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-logout {
            background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
            color: #991b1b;
            font-weight: 700;
            width: 100%;
            border: none;
            padding: 14px;
            border-radius: 14px;
            transition: transform 0.2s;
        }

        .btn-logout:hover {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div>
            <a href="#" class="brand-title">SuraBandung<span>.</span></a>
            <div class="user-profile-box">
                <span class="d-block small text-primary fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">📍 Wilayah Tugas</span>
                <strong class="text-dark d-block text-truncate" style="max-width: 200px;">{{ Auth::user()->name }}</strong>
            </div>
        </div>
        
        <div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Keluar Sistem</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <div class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold text-dark mb-1" style="letter-spacing: -1.5px;">Panel Tugas Wilayah</h1>
                <p class="text-muted mb-0">Kelola penanganan pengaduan masyarakat di area yurisdiksi Anda</p>
            </div>
            <span class="fs-2">⚡</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-4 p-3 mb-4 shadow-sm fw-semibold" style="background-color: #ecfdf5; color: #065f46;">
                🎉 {{ session('success') }}
            </div>
        @endif

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card card-orange">
                    <span class="d-block small fw-bold text-uppercase opacity-75">📥 Aduan Masuk</span>
                    <div class="stat-number">{{ $totalForwarded }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card-blue">
                    <span class="d-block small fw-bold text-uppercase opacity-75">🛠️ Sedang Diproses</span>
                    <div class="stat-number">{{ $totalProcess }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card-green">
                    <span class="d-block small fw-bold text-uppercase opacity-75">✅ Tuntas Ditangani</span>
                    <div class="stat-number">{{ $totalResolved }}</div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0" style="letter-spacing: -0.5px;">Antrean Berkas Pengaduan</h5>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-bold text-muted small">Live Data</span>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Subjek Masalah</th>
                            <th>Identitas Pelapor</th>
                            <th>Bobot Prioritas</th>
                            <th>Status Kerja</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <td class="fw-bold text-dark">{{ $report->title }}</td>
                            <td class="fw-medium text-secondary">{{ $report->user->name }}</td>
                            <td>
                                @if($report->priority == 'low')
                                    <span class="badge-custom" style="background: #f1f5f9; color: #475569;">🟢 Low</span>
                                @elseif($report->priority == 'normal')
                                    <span class="badge-custom" style="background: #e0f2fe; color: #0369a1;">🔵 Normal</span>
                                @elseif($report->priority == 'urgent')
                                    <span class="badge-custom" style="background: #fee2e2; color: #b91c1c;">🔴 Urgent</span>
                                @endif
                            </td>
                            <td>
                                @if($report->status == 'forwarded')
                                    <span class="text-warning fw-bold d-flex align-items-center gap-1">⏰ Menunggu Aksi</span>
                                @elseif($report->status == 'process')
                                    <span class="text-primary fw-bold d-flex align-items-center gap-1">🏃 Penanganan Fisik</span>
                                @else
                                    <span class="text-success fw-bold d-flex align-items-center gap-1">✨ Selesai</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('kecamatan.reports.show', $report->id) }}" class="btn-action">
                                    Buka Berkas
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5 fw-medium">Tidak ada data operasional pengaduan saat ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>