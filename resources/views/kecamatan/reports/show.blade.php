<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penanganan Laporan - SuraBandung</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #84cbfb 0%, #a9cff4 50%, #ffffff 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        .custom-navbar {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #bae6fd;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        
        .card { 
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5); 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); 
        }

        .foto-bukti { width: 100%; max-height: 250px; object-fit: cover; border-radius: 12px; }
        
        .badge-status { padding: 8px 16px; border-radius: 12px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; }
        
        .btn-action { border-radius: 12px; font-weight: 700; padding: 0.75rem 1rem; transition: all 0.2s; }
    </style>
</head>
<body>

    <nav class="navbar custom-navbar mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('kecamatan.dashboard') }}">
                <i class="bi bi-building-fill me-2"></i>SuraBandung Kecamatan
            </a>
            <a class="btn btn-sm btn-outline-secondary px-3" style="border-radius: 10px;" href="{{ route('kecamatan.dashboard') }}">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <h4 class="fw-bold text-dark">{{ $report->title }}</h4>
                        <div>
                            @if($report->status == 'forwarded')
                                <span class="badge-status bg-warning text-dark">⏰ Menunggu</span>
                            @elseif($report->status == 'process')
                                <span class="badge-status bg-info text-white">⚙️ Diproses</span>
                            @else
                                <span class="badge-status bg-success text-white">✨ Selesai</span>
                            @endif
                        </div>
                    </div>

                    <p class="text-muted small mb-4">
                        <i class="bi bi-person-fill"></i> {{ $report->user->name ?? 'Warga Anonim' }} | 
                        <i class="bi bi-calendar-event"></i> {{ $report->created_at->format('d M Y, H:i') }}
                    </p>
                    
                    <div class="bg-light p-3 rounded-3 mb-4 border border-light-subtle">
                        <h6 class="fw-bold text-muted small text-uppercase mb-2">Isi Aduan:</h6>
                        <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $report->description }}</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-6 text-center">
                            <label class="small fw-bold text-muted d-block mb-2">KONDISI AWAL</label>
                            <img src="{{ asset('assets/reports_entry/' . $report->image_before) }}" class="foto-bukti shadow-sm" alt="Foto Awal">
                        </div>
                        <div class="col-6 text-center">
                            <label class="small fw-bold text-muted d-block mb-2">HASIL PENANGANAN</label>
                            @if($report->image_success)
                                <img src="{{ asset('assets/reports_success/' . $report->image_success) }}" class="foto-bukti shadow-sm" alt="Foto Selesai">
                            @else
                                <div class="foto-bukti bg-light d-flex align-items-center justify-content-center text-muted border border-dashed">
                                    <small>Menunggu pengerjaan</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-4">
                <div class="card p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-tools me-2 text-primary"></i>Panel Penanganan</h5>
                    <hr>

                    @if($report->status == 'forwarded')
                        <p class="text-muted small">Laporan telah diterima. Tekan tombol di bawah untuk memulai proses perbaikan.</p>
                        <form action="{{ route('kecamatan.reports.process', $report->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 btn-action">⚙️ Ambil & Proses Laporan</button>
                        </form>
                    @elseif($report->status == 'process')
                        <p class="text-muted small">Laporan sedang ditangani. Upload foto hasil akhir setelah perbaikan selesai.</p>
                        <form action="{{ route('kecamatan.reports.resolve', $report->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Unggah Foto Hasil Akhir</label>
                                <input type="file" class="form-control" name="image_success" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100 btn-action">✓ Laporkan Selesai</button>
                        </form>
                    @else
                        <div class="text-center py-3 bg-success bg-opacity-10 rounded-3">
                            <h6 class="text-success fw-bold">✨ Tugas Tuntas!</h6>
                            <a href="{{ route('kecamatan.reports.pdf', $report->id) }}" target="_blank" class="btn btn-sm btn-success mt-2">
                                <i class="bi bi-printer-fill me-1"></i> Cetak PDF
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>