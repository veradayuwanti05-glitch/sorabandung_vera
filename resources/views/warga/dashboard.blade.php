<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga - SuraBandung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #87cbf9 0%, #b6d8f9 50%, #ffffff 100%);
            min-height: 100vh;rgb(101, 180, 232)rgb(117, 190, 239)
            color: #1e293b;
        }

        .custom-navbar {
            background: linear-gradient(135deg, #87cbf9 0%, #b6d8f9 50%, #ffffff 100%);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #bae6fd;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        .navbar-brand-text {
            font-weight: 800;
            color: #091013;
            font-size: 1.4rem;
            letter-spacing: -0.02em;
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(30, 41, 59, 0.04);
            margin-bottom: 3rem;
        }

        .btn-create-aduan {
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
            transition: all 0.2s ease;
        }
        .btn-create-aduan:hover {
            box-shadow: 0 6px 18px rgba(56, 189, 248, 0.45);
            transform: translateY(-1px);
            color: #ffffff;
        }

        .table-responsive-custom {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
        }

        .table thead th {
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1.2rem 1rem;
            color: #334155;
            font-weight: 500;
        }

        .text-reason { 
            font-size: 0.85rem; 
            color: #b91c1c; 
            margin-top: 6px; 
            font-weight: 600;
            background-color: #fef2f2;
            padding: 6px 12px;
            border-radius: 8px;
            border-left: 3px solid #f87171;
            display: inline-block;
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <nav class="navbar custom-navbar mb-5">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-white shadow-sm border p-1" style="width: 44px; height: 44px; border-color: #cbd5e1 !important;">
                    <img src="{{ asset('image/logo-bandung.png') }}" alt="Logo Bandung" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <span class="navbar-brand-text">SuraBandung Warga</span>
            </div>
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-secondary small d-none d-sm-inline">Halo, <strong class="text-dark">Warga Bandung</strong></span>
                <a class="btn btn-sm btn-outline-danger fw-bold px-3 py-2" style="border-radius: 10px;" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-11 mx-auto">
                
                <div class="dashboard-container">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                        <div>
                            <h3 class="text-dark fw-bold mb-1">Dashboard Pengaduan Warga</h3>
                            <p class="text-muted small mb-0">Pantau dan kelola laporan aspirasi Anda dengan mudah</p>
                        </div>
                        <div>
                            <a href="{{ route('warga.reports.create') }}" class="btn btn-create-aduan d-inline-flex align-items-center gap-2">
                                <i class="bi bi-plus-circle-fill"></i> Buat Aduan Baru
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive-custom">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-clock-history text-primary fs-5"></i>
                            <h5 class="fw-bold mb-0 text-dark">Riwayat Laporan Anda</h5>
                        </div>
                        
                        @if($reports->isEmpty())
                            <div class="text-center py-5 border rounded-3 bg-light bg-opacity-50">
                                <i class="bi bi-chat-left-text text-muted opacity-50 fs-1 d-block mb-2"></i>
                                <p class="text-muted mb-0">Anda belum pernah membuat laporan aduan.</p>
                            </div>
                        @else
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Judul Laporan</th>
                                        <th>Kecamatan</th>
                                        <th>Status Laporan</th>
                                        <th class="text-center" style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $report->title }}</div>
                                            @if($report->status == 'rejected' && $report->tanggapan)
                                                <div class="text-reason shadow-sm">
                                                    <i class="bi bi-exclamation-circle-fill me-1"></i> Alasan ditolak: "{{ $report->tanggapan }}"
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-secondary border border-secondary-subtle px-2 py-1">
                                                <i class="bi bi-geo-alt-fill me-1 text-danger"></i>{{ $report->district->name }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($report->status == 'pending')
                                                <span class="badge-custom bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Menunggu Verifikasi</span>
                                            @elseif($report->status == 'forwarded')
                                                <span class="badge-custom bg-info text-dark"><i class="bi bi-arrow-right-short me-1"></i>Diteruskan</span>
                                            @elseif($report->status == 'process')
                                                <span class="badge-custom bg-primary text-white"><i class="bi bi-gear-fill me-1"></i>Diproses</span>                                       
                                            @elseif($report->status == 'rejected')
                                                <span class="badge-custom bg-danger text-white"><i class="bi bi-x-circle-fill me-1"></i>Ditolak Pemkot</span>
                                            @else    
                                                <span class="badge-custom bg-success text-white"><i class="bi bi-check-all me-1"></i>Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('warga.reports.show', $report->id) }}" class="btn btn-sm btn-outline-secondary px-3" style="border-radius: 8px;">
                                                    Detail
                                                </a>
                                                
                                                @if($report->status == 'rejected')
                                                    <a href="{{ route('warga.reports.edit', $report->id) }}" class="btn btn-sm btn-warning fw-bold px-3" style="border-radius: 8px;">
                                                        <i class="bi bi-pencil-square me-1"></i>Perbaiki
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>