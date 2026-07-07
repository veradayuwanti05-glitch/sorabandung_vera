<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">SuraBandung Admin</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3">Halo, <strong>Admin Pemkot</strong></span>
                <a class="btn btn-sm btn-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-11 mx-auto">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark fw-bold">Dashboard Admin Pusat (Pemkot)</h2>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.petugas.index') }}" class="btn btn-outline-dark fw-semibold px-4">
                            👤 Kelola Akun Kecamatan
                        </a>
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-primary fw-semibold px-4">
                            Kelola Semua Laporan →
                        </a>
                    </div>
                </div>

                <div class="row">
                    <!-- Kolom Angka Statistik Box -->
                    <div class="col-md-7">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="card bg-warning text-dark py-3">
                                    <h5 class="card-title text-uppercase small fw-bold text-muted mb-0">Belum Diverifikasi</h5>
                                    <h1 class="fw-bold my-2">{{ $totalPending }}</h1>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card bg-info text-dark py-3">
                                    <h5 class="card-title text-uppercase small fw-bold text-muted mb-0">Diteruskan</h5>
                                    <h1 class="fw-bold my-2">{{ $totalForwarded }}</h1>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card bg-primary text-white py-3">
                                    <h5 class="card-title text-uppercase small fw-bold text-light mb-0">Sedang Diproses</h5>
                                    <h1 class="fw-bold my-2">{{ $totalProcess }}</h1>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card bg-success text-white py-3">
                                    <h5 class="card-title text-uppercase small fw-bold text-light mb-0">Laporan Selesai</h5>
                                    <h1 class="fw-bold my-2">{{ $totalResolved }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Visual Grafik Chart.js -->
                    <div class="col-md-5 mb-3">
                        <div class="card p-3 h-100 d-flex flex-column align-items-center justify-content-center">
                            <h6 class="fw-bold text-muted mb-3 text-center">Persentase Status Aduan Kota</h6>
                            <div style="width: 220px; height: 220px;">
                                <canvas id="reportChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Script Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('reportChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Diteruskan', 'Diproses', 'Selesai'],
                datasets: [{
                    data: [{{ $totalPending }}, {{ $totalForwarded }}, {{ $totalProcess }}, {{ $totalResolved }}],
                    backgroundColor: ['#ffc107', '#0dcaf0', '#0d6efd', '#198754'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>