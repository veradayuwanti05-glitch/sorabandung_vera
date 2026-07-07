<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penanganan Laporan - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .foto-bukti { width: 100%; max-height: 350px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('kecamatan.dashboard') }}">SuraBandung Kecamatan</a>
            <div class="ms-auto">
                <a class="btn btn-sm btn-outline-light" href="{{ route('kecamatan.dashboard') }}">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <div class="row text-dark">
            <!-- Kolom Kiri: Informasi Detail Laporan -->
            <div class="col-md-7 mb-4">
                <div class="card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="fw-bold text-primary mb-0">{{ $report->title }}</h3>
                        <div>
                            @if($report->status == 'forwarded')
                                <span class="badge bg-warning text-dark px-2.5 py-1.5 fw-bold text-uppercase">⏰ Menunggu Tindakan</span>
                            @elseif($report->status == 'process')
                                <span class="badge bg-info text-white px-2.5 py-1.5 fw-bold text-uppercase">⚙️ Sedang Diproses</span>
                            @else
                                <span class="badge bg-success text-white px-2.5 py-1.5 fw-bold text-uppercase">✨ Selesai</span>
                            @endif
                        </div>
                    </div>

                    <p class="text-muted small">
                        👤 Pelapor: <strong>{{ $report->user->name ?? 'Warga Anonim' }}</strong> | 
                        📅 Masuk: {{ $report->created_at->format('d M Y H:i') }}
                    </p>
                    
                    <hr>
                    
                    <h6 class="fw-bold mb-2">Isi Keluhan/Aduan:</h6>
                    <p class="text-secondary mb-4" style="white-space: pre-line;">{{ $report->description }}</p>

                    @if($report->latitude && $report->longitude)
                        <div class="p-3 bg-light rounded border mb-4">
                            <span class="text-muted small d-block">📍 Koordinat Lokasi (GPS):</span>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $report->latitude }},{{ $report->longitude }}" target="_blank" class="fw-bold text-decoration-none small">
                                {{ $report->latitude }}, {{ $report->longitude }} 🌐 (Buka di Google Maps)
                            </a>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-sm-6 text-center">
                            <span class="d-block small fw-bold text-muted mb-2">FOTO KONDISI AWAL</span>
                            @if($report->image_before)
                                <img src="{{ asset('assets/reports_entry/' . $report->image_before) }}" class="foto-bukti border" alt="Foto Awal">
                            @else
                                <div class="py-5 bg-light text-muted border rounded small">Tidak ada foto awal</div>
                            @endif
                        </div>

                        <div class="col-sm-6 text-center">
                            <span class="d-block small fw-bold text-muted mb-2">FOTO BUKTI SELESAI</span>
                            @if($report->image_success)
                                <img src="{{ asset('assets/reports_success/' . $report->image_success) }}" class="foto-bukti border" alt="Foto Selesai">
                            @else
                                <div class="py-5 bg-light text-muted border rounded small d-flex align-items-center justify-content-center h-100" style="min-height: 150px;">
                                    <span>Belum rampung dikerjakan</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Panel Aksi Penanganan Petugas -->
            <div class="col-md-5 mb-4">
                <div class="card p-4">
                    <h5 class="fw-bold mb-3">Panel Penanganan Petugas</h5>
                    <hr>

                    @if($report->status == 'forwarded')
                        <!-- Langkah 1: Ubah status ke proses -->
                        <p class="text-muted small">Laporan ini baru saja diteruskan dari pusat. Silakan konfirmasi ke sistem bahwa tim kecamatan bersiap meninjau lapangan.</p>
                        <form action="{{ route('kecamatan.reports.process', $report->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2.5">⚙️ Ambil & Proses Laporan</button>
                        </form>

                    @elseif($report->status == 'process')
                        <!-- Langkah 2: Upload bukti penanganan jika sudah selesai -->
                        <p class="text-muted small">Laporan dalam penanganan tim lapangan. Jika perbaikan fasilitas publik telah tuntas, upload foto bukti penyelesaian di bawah ini:</p>
                        
                        <form action="{{ route('kecamatan.reports.resolve', $report->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="image_success" class="form-label small fw-bold">Foto Bukti Hasil Lapangan</label>
                                <input type="file" class="form-control" id="image_success" name="image_success" accept="image/*" required>
                                <div class="form-text text-muted small">Wajib menyertakan foto hasil akhir penanganan (Format: jpg, jpeg, png, maks 2MB).</div>
                            </div>
                            <button type="submit" class="btn btn-success w-100 fw-bold py-2.5">✓ Laporkan Penyelesaian Akhir</button>
                        </form>

                    @else
                        <!-- Selesai -->
                        <div class="alert alert-success mb-0 text-center py-3">
                            <h5 class="alert-heading fw-bold mb-1">✨ Tugas Tuntas!</h5>
                            <p class="small mb-2">Laporan pengaduan ini telah berhasil ditangani oleh pihak kecamatan dan statusnya ditutup.</p>
                            <a href="{{ route('kecamatan.reports.pdf', $report->id) }}" target="_blank" class="btn btn-sm btn-outline-success fw-bold px-3">
                                🖨️ Cetak Dokumen PDF
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