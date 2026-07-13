<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Aduan Baru - SuraBandung</title>
    <!-- Google Fonts & Bootstrap 5 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #79c3f5 0%, #a0caf4 50%, #ffffff 100%);
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
        .navbar-brand-text {
            font-weight: 800;
            color: #38bdf8;
            font-size: 1.4rem;
            letter-spacing: -0.02em;
        }
        .btn-back {
            color: #ffffff;
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            font-weight: 700;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(56, 189, 248, 0.35);
            color: #ffffff;
        }

        .create-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(30, 41, 59, 0.04);
            max-width: 750px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: 700;
            color: #334155;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .form-control, .form-select {
            border: 2px solid #cbd5e1;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-weight: 500;
            color: #0f172a;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.2);
            background-color: #ffffff;
        }

        .btn-submit {
            background: linear-gradient(135deg, #50e1f1 0%, #c2f3e3 100%);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.85rem 2rem;
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

    <!-- Navbar Minimalis Pastel -->
    <nav class="navbar custom-navbar mb-5">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-white shadow-sm border p-1" style="width: 44px; height: 44px; border-color: #cbd5e1 !important;">
                    <img src="{{ asset('image/logo-bandung.png') }}" alt="Logo Bandung" style="width: 100%; height: auto; object-fit: contain;">
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

    <!-- Konten Utama Form Input -->
    <div class="container mb-5">
        <div class="create-container">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-chat-square-text-fill fs-4 text-info"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">Buat Laporan Aduan Baru</h4>
                    <p class="text-muted small mb-0">Laporkan keluhan fasilitas atau masalah di wilayah Anda secara rinci</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                    <ul class="mb-0 small fw-semibold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <hr class="opacity-10 mb-4">

            <form action="{{ route('warga.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Input hidden GPS otomatis -->
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <div class="mb-4">
                    <label for="title" class="form-label"><i class="bi bi-bookmark-fill text-muted me-1"></i> Judul Laporan / Keluhan</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Jalan Berlubang di Depan Pasar" value="{{ old('title') }}" required>
                </div>

                <div class="mb-4">
                    <label for="district_id" class="form-label"><i class="bi bi-geo-alt-fill text-muted me-1"></i> Lokasi Kecamatan</label>
                    <select class="form-select" id="district_id" name="district_id" required>
                        <option value="" selected disabled>-- Pilih Kecamatan Kejadian --</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label"><i class="bi bi-text-paragraph text-muted me-1"></i> Isi Detail Laporan</label>
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Ceritakan kronologi kejadian atau rincian kerusakan fasilitas publik sertakan link gmaps lokasi kejadian..." style="resize: none;" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-5 text-center bg-light p-4 rounded-4 border border-dashed">
                    <div class="text-start mb-2">
                        <label for="image_before" class="form-label mb-0"><i class="bi bi-image-fill text-muted me-1"></i> Foto Bukti Kejadian (Kondisi Awal)</label>
                    </div>
                    <input class="form-control" type="file" id="image_before" name="image_before" accept="image/*" required>
                    <div class="form-text text-start text-muted mt-2 small"><i class="bi bi-info-circle me-1"></i>Format berkas wajib berupa gambar (jpg, jpeg, png) dengan ukuran maksimal 2MB.</div>
                </div>

                <div class="d-flex justify-content-end pt-3 border-top">
                    <button type="submit" class="btn-submit d-flex align-items-center gap-2">
                        <i class="bi bi-send-fill"></i> Kirim Laporan Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                }, function(error) {
                    console.log("Izin lokasi ditolak atau tidak didukung.");
                });
            }
        });
    </script>
</body>
</html>