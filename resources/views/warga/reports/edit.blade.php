<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit & Kirim Ulang Aduan - SuraBandung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #e0f2fe 0%, #f8fafc 50%, #ffffff 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        .custom-navbar {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #bae6fd;
            padding: 1.2rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        .navbar-brand-text {
            font-weight: 800;
            color: #4fadfa;
            font-size: 1.4rem;
            letter-spacing: -0.02em;
        }
        .btn-back {
            color: #ffffff;
            background: linear-gradient(135deg, #46c8e5 0%, #6366f1 100%);
            font-weight: 700;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
            color: #ffffff;
        }

        .edit-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(30, 41, 59, 0.04);
            max-width: 750px;
            margin: 0 auto;
        }

        .alert-reason {
            background-color: #fef2f2;
            border: 1px dashed #fca5a5;
            border-radius: 14px;
            color: #991b1b;
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
        }

        .form-label {
            font-weight: 700;
            color: #334155;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .form-control {
            border: 2px solid #cbd5e1;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-weight: 500;
            color: #0f172a;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: #74dafd;
            box-shadow: 0 0 0 4px rgba(116, 218, 253, 0.25);
            background-color: #ffffff;
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            transition: all 0.2s ease;
        }
        .btn-submit:hover {
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
            transform: translateY(-1px);
            color: #ffffff;
        }
    </style>
</head>
<body>

    <nav class="navbar custom-navbar mb-5">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-white shadow-sm border p-1" style="width: 44px; height: 44px; border-color: #cbd5e1 !important;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Coat_of_arms_of_Bandung.svg/1200px-Face-Coat_of_arms_of_Bandung.svg.png" alt="Logo Bandung" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <span class="navbar-brand-text">SuraBandung Warga</span>
            </div>
            <div class="ms-auto">
                <a class="btn btn-back px-4 py-2" href="{{ route('warga.dashboard') }}">
                    <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="edit-container">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-warning bg-opacity-25 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-pencil-square fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">Perbaikan & Kirim Ulang Pengaduan</h4>
                    <p class="text-muted small mb-0">Silakan koreksi isian berkas aduan Anda di bawah ini</p>
                </div>
            </div>

            @if($report->tanggapan)
                <div class="alert-reason mb-4">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Catatan Penolakan Admin:</div>
                    <span class="fst-italic">"{{ $report->tanggapan }}"</span>
                </div>
            @endif

            <hr class="opacity-10 mb-4">
            <form action="{{ route('warga.reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4 text-center bg-light p-3 rounded-4 border border-dashed">
                    <label class="form-label d-block text-start mb-2"><i class="bi bi-image me-1"></i> Foto Bukti Laporan</label>
                    
                    @if($report->image)
                        <div class="mb-3">
                            <img src="{{ asset('assets/reports_entry/' . $report->image) }}" 
                                 alt="Foto Bukti Aduan" 
                                 class="img-fluid rounded-3 shadow-sm border" 
                                 style="max-height: 250px; object-fit: cover;">
                        </div>
                    @else
                        <div class="py-3 text-muted small">
                            <i class="bi bi-image-alt fs-3 d-block mb-1"></i> Tidak ada foto bukti yang dilampirkan sebelumnya.
                        </div>
                    @endif
                    <div class="mt-3 text-start">
                        <label for="image" class="form-label text-muted small mb-1">Unggah Foto Baru (Opsional)</label>
                        <input class="form-control form-control-sm @error('image') is-invalid @enderror" 
                               type="file" 
                               id="image" 
                               name="image" 
                               accept="image/png, image/jpeg, image/jpg">
                        @error('image')
                            <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="title" class="form-label">Judul / Subjek Aduan</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $report->title) }}" required placeholder="Contoh: Kerusakan Jalan Raya Merdeka">
                    @error('title')
                        <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Deskripsi Kronologi Masalah</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required placeholder="Tuliskan secara terperinci keluhan atau kekurangan data berkas berkas yang sebelumnya dipermasalahkan..." style="resize: none;">{{ old('description', $report->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-5 pt-3 border-top">
                    <button type="submit" class="btn-submit d-flex align-items-center gap-2">
                        <i class="bi bi-cloud-arrow-up-fill"></i> Simpan Perubahan & Ajukan Ulang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>