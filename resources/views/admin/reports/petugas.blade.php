<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Petugas Kecamatan - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">SuraBandung Admin</a>
            <div class="ms-auto">
                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Form Registrasi Petugas -->
            <div class="col-md-4 mb-4">
                <div class="card p-4">
                    <h5 class="fw-bold mb-3 text-dark">Registrasi Petugas Baru</h5>
                    <form action="{{ route('admin.petugas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Petugas / Instansi</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Petugas Bandung Kulon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Login</label>
                            <input type="email" name="email" class="form-control" placeholder="kecamatan@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Wilayah Tugas Kecamatan</label>
                            <select name="district_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Wilayah --</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Daftarkan Petugas</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Daftar Petugas Aktif -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h5 class="fw-bold mb-3 text-dark">Daftar Akun Kecamatan Aktif</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Instansi</th>
                                    <th>Email Akun</th>
                                    <th>Wilayah Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($petugas as $p)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $p->name }}</td>
                                    <td class="text-secondary">{{ $p->email }}</td>
                                    <td>
                                        <span class="badge bg-secondary px-2.5 py-1.5">
                                            Kec. {{ $p->district->name ?? 'Tidak Terikat' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada akun petugas kecamatan yang terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>