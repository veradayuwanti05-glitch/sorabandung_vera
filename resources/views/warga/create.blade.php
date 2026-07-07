<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Aduan Baru - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('warga.dashboard') }}">SuraBandung Warga</a>
            <div class="ms-auto d-flex align-items-center">
                <a class="btn btn-sm btn-light text-primary fw-bold" href="{{ route('warga.dashboard') }}">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mb-5">
                
                <h2 class="text-dark fw-bold mb-4">Buat Laporan Aduan Baru</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card p-4">
                    <form action="{{ route('warga.reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Input hidden GPS otomatis -->
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Judul Laporan / Keluhan</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Jalan Berlubang di Depan Pasar" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="district_id" class="form-label fw-bold">Lokasi Kecamatan</label>
                            <select class="form-select" id="district_id" name="district_id" required>
                                <option value="" selected disabled>-- Pilih Kecamatan Kejadian --</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Isi Detail Laporan</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Ceritakan kronologi atau detail fasilitas publik yang rusak..." required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image_before" class="form-label fw-bold">Foto Bukti Kejadian (Kondisi Awal)</label>
                            <input class="form-control" type="file" id="image_before" name="image_before" accept="image/*" required>
                            <div class="form-text text-muted">Format file wajib berupa gambar (jpg, jpeg, png) maks 2MB.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success fw-bold py-2.5">Kirim Laporan Pengaduan</button>
                        </div>
                    </form>
                </div>

            </div>
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