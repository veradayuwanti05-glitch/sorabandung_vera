<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wilayah - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --brand-dark: #2d3748;
            --surface-light: #f8fafc;
            --border-color: #f1f5f9;
            --pastel-orange: linear-gradient(135deg, #d2fdff 0%, #6df5fc 100%);
            --pastel-blue: linear-gradient(135deg, #e0c3fc 0%, #8ef3fc 100%);
            --pastel-green: linear-gradient(135deg, #7dd0f4 0%, #cdefff 100%);
            
            --text-orange: #1373d9;
            --text-blue: #2b6cb0;
            --text-green: #335dc1;
        }

        body {
            background: linear-gradient(135deg, #98c5e3 0%, #f8fafc 50%, #ffffff 100%);
            background-attachment: fixed;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #4a5568;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #cce2f0a6;
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.4);
            padding: 40px 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 100;
            box-shadow: 10px 0 30px rgba(30, 41, 59, 0.02);
        }

        .main-content {
            margin-left: 280px;
            padding: 50px 60px;
            min-height: 100vh;
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            color: var(--brand-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .brand-title img {
            height: 32px;
            opacity: 0.9;
        }

        .brand-title span {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-profile-box {
            background: rgba(255, 255, 255, 0.7);
            padding: 16px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
        }

        .avatar-box {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
            color: #0369a1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .stat-card {
            border: none;
            border-radius: 24px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(30, 41, 59, 0.03);
            transition: transform 0.3s cubic-bezier(0.215, 0.610, 0.355, 1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(30, 41, 59, 0.06);
        }

        .card-orange { background: var(--pastel-orange); color: var(--text-orange); }
        .card-blue { background: var(--pastel-blue); color: var(--text-blue); }
        .card-green { background: var(--pastel-green); color: var(--text-green); }

        .stat-card .icon-bg {
            position: absolute;
            font-size: 5rem;
            opacity: 0.22;
            right: 20px;
            bottom: -10px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.1;
            margin-top: 5px;
            letter-spacing: -1px;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 26px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(30, 41, 59, 0.03);
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
            background-color: transparent;
        }

        .table thead th {
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 10px 16px;
            border: none;
        }

        .table tbody tr {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
            transition: all 0.25s ease;
        }
        
        .table tbody tr:hover {
            transform: translateY(-2px);
            background-color: #ffffff;
            box-shadow: 0 8px 25px rgba(30, 41, 59, 0.04);
        }

        .table tbody td {
            padding: 20px 16px;
            color: #4a5568;
            font-size: 0.95rem;
            border-top: 1px solid rgba(241, 245, 249, 0.8);
            border-bottom: 1px solid rgba(241, 245, 249, 0.8);
        }

        .table tbody tr td:first-child {
            border-left: 1px solid rgba(241, 245, 249, 0.8);
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
            padding-left: 20px;
        }

        .table tbody tr td:last-child {
            border-right: 1px solid rgba(241, 245, 249, 0.8);
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
            padding-right: 20px;
        }
        .badge-custom {
            font-weight: 600;
            font-size: 0.8rem;
            padding: 6px 14px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-status {
            font-weight: 600;
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-orange { background: var(--pastel-orange); color: var(--text-orange); }
        .status-primary { background: var(--pastel-blue); color: var(--text-blue); }
        .status-green { background: var(--pastel-green); color: var(--text-green); }

        .btn-action {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 16px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 10px rgba(71, 85, 105, 0.15);
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action:hover {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-logout {
            background: linear-gradient(135deg, #96d1fd 0%, hsl(188, 94%, 67%) 100%);
            color: #f3fbff;
            font-weight: 600;
            width: 100%;
            border: none;
            padding: 12px;
            border-radius: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
        }

        .alert-custom {
            border-radius: 16px;
            border: none;
            background: var(--pastel-green);
            color: var(--text-green);
            font-weight: 600;
        }
        
        .icon-header-box {
            background: rgba(255, 255, 255, 0.8);
            color: #64748b;
            padding: 10px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div>
            <a href="#" class="brand-title">
                <img src="{{ asset('image/logo-bandung.png') }}" alt="Logo">
                SuraBandung<span>.</span>
            </a>
            <div class="user-profile-box">
                <div class="avatar-box">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <div class="text-truncate" style="max-width: 170px;">
                    <span class="d-block small text-muted fw-bold text-uppercase mb-0" style="letter-spacing: 0.5px; font-size: 0.65rem;">📍 Wilayah Tugas</span>
                    <strong class="text-dark d-block text-truncate" style="font-size: 0.9rem;">{{ Auth::user()->name }}</strong>
                </div>
            </div>
        </div>
        
        <div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <div class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold text-dark mb-1" style="letter-spacing: -1.5px;">Panel Tugas Wilayah</h1>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">Kelola penanganan pengaduan masyarakat di area yurisdiksi Anda</p>
            </div>
            <div class="icon-header-box fs-5 shadow-sm">
                <i class="bi bi-lightning-charge text-warning"></i>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show alert-custom mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle me-2 fs-5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card card-orange">
                    <span class="d-block small fw-bold text-uppercase opacity-75" style="font-size: 0.75rem;">📥 Aduan Masuk</span>
                    <div class="stat-number">{{ $totalForwarded }}</div>
                    <i class="bi bi-inbox icon-bg"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card-blue">
                    <span class="d-block small fw-bold text-uppercase opacity-75" style="font-size: 0.75rem;">🛠️ Sedang Diproses</span>
                    <div class="stat-number">{{ $totalProcess }}</div>
                    <i class="bi bi-arrow-repeat icon-bg"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card-green">
                    <span class="d-block small fw-bold text-uppercase opacity-75" style="font-size: 0.75rem;">✅ Tuntas Ditangani</span>
                    <div class="stat-number">{{ $totalResolved }}</div>
                    <i class="bi bi-check2-circle icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="icon-header-box p-2 bg-light text-dark rounded-3 border-0">
                        <i class="bi bi-layers text-secondary"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" style="letter-spacing: -0.5px; font-size: 1.1rem;">Antrean Berkas Pengaduan</h5>
                </div>
                <span class="badge bg-white text-muted border px-3 py-2 rounded-pill fw-medium small d-flex align-items-center gap-2" style="font-size: 0.75rem;">
                    <span class="spinner-grow spinner-grow-sm text-secondary" role="status" style="width: 6px; height: 6px;"></span> Terbarui Otomatis
                </span>
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
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-file-earmark-text text-muted"></i>
                                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $report->title }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <span class="fw-medium text-secondary" style="font-size: 0.9rem;">{{ $report->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                @if($report->priority == 'low')
                                    <span class="badge-custom" style="background: #f1f5f9; color: #64748b;"><i class="bi bi-circle-fill text-secondary" style="font-size: 6px;"></i> Low</span>
                                @elseif($report->priority == 'normal')
                                    <span class="badge-custom" style="background: #e0f2fe; color: var(--text-blue);"><i class="bi bi-circle-fill text-primary" style="font-size: 6px;"></i> Normal</span>
                                @elseif($report->priority == 'urgent')
                                    <span class="badge-custom" style="background: #fee2e2; color: #b91c1c;"><i class="bi bi-circle-fill text-danger" style="font-size: 6px;"></i> Urgent</span>
                                @endif
                            </td>
                            <td>
                                @if($report->status == 'forwarded')
                                    <span class="badge-status status-orange"><i class="bi bi-clock"></i> Menunggu</span>
                                @elseif($report->status == 'process')
                                    <span class="badge-status status-primary"><i class="bi bi-arrow-repeat"></i> Diproses</span>
                                @else
                                    <span class="badge-status status-green"><i class="bi bi-check2"></i> Selesai</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('kecamatan.reports.show', $report->id) }}" class="btn-action">
                                    Lihat Berkas <i class="bi bi-chevron-right" style="font-size: 0.75rem;"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5 fw-medium">
                                <i class="bi bi-inbox fs-2 d-block mb-2 opacity-40"></i>
                                Tidak ada data operasional pengaduan saat ini.
                            </td>
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