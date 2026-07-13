<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aduan - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .badge-status { padding: 6px 12px; font-weight: bold; border-radius: 20px; text-transform: uppercase; font-size: 0.85rem; }
        .foto-bukti { width: 100%; max-height: 350px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('warga.dashboard') }}">SuraBandung Warga</a>
            <div class="ms-auto">
                <a class="btn btn-sm btn-light text-primary fw-bold" href="{{ route('warga.dashboard') }}">
                    ← Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark fw-bold mb-0">Detail Laporan #{{ $report->id }}</h2>
                    <div>
                        @if($report->status == 'pending')
                            <span class="badge-status bg-warning text-dark">⏰ Menunggu</span>
                        @elseif($report->status == 'process')
                            <span class="badge-status bg-info text-white">⚙️ Diproses</span>
                        @else
                            <span class="badge-status bg-success text-white">✨ Selesai</span>
                        @endif
                    </div>
                </div>

                <div class="card p-4 mb-4">
                    <h4 class="fw-bold text-primary mb-3">{{ $report->title }}</h4>
                    <p class="text-muted small mb-3">
                        📍 Kecamatan: <strong>{{ $report->district->name ?? '-' }}</strong> | 
                        🗓️ Tanggal: {{ $report->created_at->format('d M Y H:i') }}
                    </p>
                    
                    <hr>

                    <h6 class="fw-bold text-dark mb-2">Deskripsi Laporan:</h6>
                    <p class="text-secondary" style="white-space: pre-line;">{{ $report->description }}</p>

                    @if($report->latitude && $report->longitude)
                        <div class="mt-3 p-3 bg-light rounded border">
                            <span class="text-muted small d-block">📌 Koordinat GPS Terdeteksi:</span>
                            <strong class="text-dark small">{{ $report->latitude }}, {{ $report->longitude }}</strong>
                        </div>
                    @endif
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card p-3 text-center">
                            <h6 class="fw-bold text-danger mb-3">📸 Kondisi Awal (Laporan)</h6>
                            @if($report->image_before)
                                <img src="{{ asset('assets/reports_entry/' . $report->image_before) }}" class="foto-bukti" alt="Foto Kondisi Awal">
                            @else
                                <div class="py-5 text-muted bg-light rounded">Tidak ada foto bukti awal</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card p-3 text-center">
                            <h6 class="fw-bold text-success mb-3">📸 Hasil Penanganan (Kecamatan)</h6>
                            @if($report->image_success)
                                <img src="{{ asset('assets/reports_success/' . $report->image_success) }}" class="foto-bukti" alt="Foto Hasil Lapangan">
                            @else
                                <div class="py-5 text-muted bg-light rounded d-flex align-items-center justify-content-center" style="min-height: 200px;">
                                    <span>⏳ Belum ada bukti pengerjaan lapangan.</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>