<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Wilayah - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .img-fluid { border-radius: 8px; max-height: 350px; object-fit: cover; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('kecamatan.dashboard') }}">SuraBandung Kecamatan</a>
            <div class="ms-auto">
                <a class="btn btn-sm btn-light text-secondary fw-bold" href="{{ route('kecamatan.dashboard') }}">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                
                <h3 class="fw-bold mb-4">Detail Pengaduan Warga</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small">Dilaporkan oleh: <strong>{{ $report->user->name }}</strong></span>
                        @if($report->status == 'forwarded')
                            <span class="badge bg-warning text-dark px-3 py-2">Menunggu Tindakan</span>
                        @elseif($report->status == 'process')
                            <span class="badge bg-primary px-3 py-2">Sedang Diproses</span>
                        @else
                            <span class="badge bg-success px-3 py-2">Selesai</span>
                        @endif
                    </div>

                    <h4 class="fw-bold text-dark">{{ $report->title }}</h4>
                    <p class="text-muted small">Lokasi: Kecamatan {{ $report->district->name }}</p>
                    <hr>

                    <h5 class="fw-bold mb-2">Deskripsi Keluhan:</h5>
                    <p class="text-secondary" style="white-space: pre-line;">{{ $report->description }}</p>

                    <h5 class="fw-bold mt-4 mb-2">Foto Bukti Awal:</h5>
                    <img src="{{ asset('storage/' . $report->image_before) }}" class="img-fluid mb-4" alt="Bukti Awal">

                    @if($report->status == 'forwarded')
                        <div class="bg-light p-3 rounded text-center">
                            <p class="mb-3 text-muted">Ambil tindakan terhadap laporan warga ini:</p>
                            <form action="{{ route('kecamatan.reports.process', $report->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary fw-bold px-4">Mulai Proses Penanganan</button>
                            </form>
                        </div>
                    @endif

                    @if($report->status == 'process')
                        <div class="bg-light p-4 rounded mt-2">
                            <h5 class="fw-bold mb-3 text-success">Form Penyelesaian Laporan</h5>
                            <form action="{{ route('kecamatan.reports.resolve', $report->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Tanggapan / Solusi Terpasang</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Tuliskan tindakan perbaikan yang telah dilakukan tim lapangan..." required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image_after" class="form-label fw-bold">Foto Bukti Hasil Akhir (Selesai)</label>
                                    <input class="form-control" type="file" id="image_after" name="image_after" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-success fw-bold w-100 py-2">Kirim & Selesaikan Aduan</button>
                            </form>
                        </div>
                    @endif
                </div>

                @if($report->status == 'resolved' && $report->resolution)
                    <div class="card p-4 border border-success bg-white">
                        <h5 class="fw-bold text-success mb-3">✓ Bukti Hasil Penyelesaian Tindakan</h5>
                        <p class="text-secondary"><strong>Hasil Penanganan:</strong><br>{{ $report->resolution->description }}</p>
                        <h6 class="fw-bold mt-3 mb-2">Foto Hasil Lapangan:</h6>
                        <img src="{{ asset('storage/' . $report->resolution->image_after) }}" class="img-fluid" alt="Hasil Akhir">
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>