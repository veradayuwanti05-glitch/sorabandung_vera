<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Semua Laporan - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">SuraBandung Admin</a>
            <div class="ms-auto">
                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.dashboard') }}">← Kembali</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <h3 class="fw-bold mb-4">Daftar Seluruh Pengaduan Warga</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Judul Aduan</th>
                            <th>Kecamatan</th>
                            <th>Status</th>
                            <th>Tingkat Prioritas</th>
                            <th class="text-center" style="width: 280px;">Tindakan Admin Pemkot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <td class="fw-semibold">{{ $report->title }}</td>
                            <td>{{ $report->district->name }}</td>
                            <td>
                                @if($report->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($report->status == 'forwarded')
                                    <span class="badge bg-info text-dark">Diteruskan</span>
                                @elseif($report->status == 'process')
                                    <span class="badge bg-primary">Diproses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($report->priority == 'low')
                                    <span class="text-secondary fw-bold">🟢 Rendah</span>
                                @elseif($report->priority == 'normal')
                                    <span class="text-primary fw-bold">🔵 Normal</span>
                                @elseif($report->priority == 'urgent')
                                    <span class="text-danger fw-bold">🔴 Darurat</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($report->status == 'pending')
                                    <!-- Form Meneruskan dengan Opsi Prioritas -->
                                    <form action="{{ route('admin.reports.forward', $report->id) }}" method="POST" class="d-flex gap-2 justify-content-center">
                                        @csrf
                                        <select name="priority" class="form-select form-select-sm" style="width: 120px;" required>
                                            <option value="low">Rendah</option>
                                            <option value="normal" selected>Normal</option>
                                            <option value="urgent">Darurat</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-success fw-bold text-nowrap">✓ Setujui & Kirim</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Sudah Diproses Wilayah</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data aduan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>