<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Verifikasi Laporan - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #f8fafc 50%, #ffffff 100%);
            min-height: 100vh;
            padding: 40px;
            font-family: system-ui, -apple-system, sans-serif;
        }
        .detail-container {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(30, 41, 59, 0.03);
            max-width: 800px;
            margin: 0 auto;
        }
        .badge-status {
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .btn-valid {
            background: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
            color: #065f46;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            transition: all 0.2s ease;
        }
        .btn-invalid {
            background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
            color: #991b1b;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            transition: all 0.2s ease;
        }
        .btn-valid:hover, .btn-invalid:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="detail-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">🔍 Verifikasi Berkas Pengaduan</h4>
        <span class="badge-status bg-warning text-dark">Status: {{ ucfirst($report->status) }}</span>
    </div>
    
    <hr class="opacity-10 mb-4">

    <div class="mb-4">
        <label class="small text-muted fw-bold text-uppercase d-block mb-1">Subjek Masalah</label>
        <h5 class="text-dark fw-semibold">{{ $report->title }}</h5>
    </div>

    <div class="mb-4">
        <label class="small text-muted fw-bold text-uppercase d-block mb-1">Identitas Pelapor</label>
        <p class="text-dark fw-medium"><i class="bi bi-person me-2 text-secondary"></i>{{ $report->user->name }}</p>
    </div>

    <div class="mb-4">
        <label class="small text-muted fw-bold text-uppercase d-block mb-1">Deskripsi Laporan</label>
        <div class="p-3 bg-white rounded-3 border border-light text-secondary">
            {{ $report->description }}
        </div>
    </div>

    <!-- Tombol Aksi Keputusan Admin -->
    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-light rounded-3 fw-medium text-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        
        <div class="d-flex gap-3">
            <!-- Form Jika Laporan TIDAK SESUAI (Tolak) -->
            <form action="{{ route('admin.reports.tolak', $report->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn-invalid shadow-sm" onclick="return confirm('Apakah Anda yakin laporan ini tidak sesuai?')">
                    <i class="bi bi-x-circle me-1"></i> Tidak Sesuai (Tolak)
                </button>
            </form>

            <!-- Form Jika Laporan BENAR (Kirim ke Kecamatan) -->
            <form action="{{ route('admin.reports.kirim', $report->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn-valid shadow-sm">
                    <i class="bi bi-check2-circle me-1"></i> Laporan Benar (Kirim)
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>