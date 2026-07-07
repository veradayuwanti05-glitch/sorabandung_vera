<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga - SuraBandung</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .table-responsive { background: white; border-radius: 12px; padding: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <!-- Navbar Minimalis -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">SuraBandung Warga</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3">Halo, <strong>Warga Bandung</strong></span>
                <a class="btn btn-sm btn-light text-primary fw-bold" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark fw-bold">Dashboard Pengaduan Warga</h2>
                    <a href="{{ route('warga.reports.create') }}" class="btn btn-success fw-semibold px-4">
                        + Buat Aduan Baru
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Tabel Riwayat Laporan -->
                <div class="table-responsive">
                    <h5 class="fw-bold mb-3 text-muted">Riwayat Laporan Anda</h5>
                    @if($reports->isEmpty())
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">Anda belum pernah membuat laporan aduan.</p>
                        </div>
                    @else
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul Laporan</th>
                                    <th>Kecamatan</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <td class="fw-semibold">{{ $report->title }}</td>
                                    <td>{{ $report->district->name }}</td>
                                    <td>
                                        @if($report->status == 'pending')
                                            <span class="badge bg-warning text-dark px-2 py-2">Menunggu Verifikasi</span>
                                        @elseif($report->status == 'forwarded')
                                            <span class="badge bg-info text-dark px-2 py-2">Diteruskan ke Kecamatan</span>
                                        @elseif($report->status == 'process')
                                            <span class="badge bg-primary px-2 py-2">Sedang Diproses</span>
                                        @else
                                            <span class="badge bg-success px-2 py-2">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('warga.reports.show', $report->id) }}" class="btn btn-sm btn-outline-secondary px-3">
                                            Detail
                                        </a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>