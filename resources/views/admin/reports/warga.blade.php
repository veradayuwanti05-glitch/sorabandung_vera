<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Warga - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="mb-4">
            <h3 class="fw-bold text-dark mb-1">Kelola Data Warga</h3>
            <p class="text-muted small">Daftar masyarakat yang memiliki akun di aplikasi SuraBandung</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✨ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-uppercase fw-bold">
                            <tr>
                                <th class="py-3 ps-4" style="width: 8%">No</th>
                                <th class="py-3">Nama Lengkap</th>
                                <th class="py-3">Alamat Email</th>
                                <th class="py-3">Terdaftar Pada</th>
                                <th class="py-3 text-end pe-4" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($warga as $index => $w)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                    <td><div class="fw-bold text-dark">{{ $w->name }}</div></td>
                                    <td><span class="text-muted">{{ $w->email }}</span></td>
                                    <td><span class="small text-secondary">{{ $w->created_at->format('d M Y, H:i') }}</span></td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('admin.warga.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Hapus akun warga ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-3">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">Belum ada data warga terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>