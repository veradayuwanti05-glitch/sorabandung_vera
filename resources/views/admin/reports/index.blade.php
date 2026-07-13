<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Semua Laporan - SuraBandung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f6fa; 
            color: #1e293b;
        }

        /* NAVBAR - SOFT MINT ICE WITH INDIGO ACCENT */
        .custom-navbar {
            background: linear-gradient(90deg, #e0f2fe 0%, #f0fdf4 100%);
            border-bottom: 2px solid #bae6fd;
            padding: 1.2rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
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
        .custom-card { 
            border: none; 
            border-radius: 12px; 
            background-color: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); 
            padding: 2rem;
            border: 1px solid #cbd5e1;
        }

        .table-bordered {
            border: 2px solid #64748b !important;
        }
        .table-bordered th {
            background-color: #74dafd !important;
            color: #4a4848 !important;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            padding: 1rem !important;
            border: 2px solid #27303d !important;
            vertical-align: middle;
        }
        .table-bordered td {
            padding: 1rem !important;
            border: 1px solid #53565a !important;
            vertical-align: middle;
        }
        .table-hover tbody tr:nth-of-type(even) {
            background-color: #f8fafc;
        }
        .table-hover tbody tr:hover {
            background-color: #f0fdf4 !important;
        }
        .district-badge {
            background-color: #eff6ff;
            color: #009cf0;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.85rem;
            border: 1px solid #bfdbfe;
            display: inline-block;
        }
        .badge-pending { background-color: #ef4444; }
        .badge-forwarded { background-color: #06b6d4; }
        .badge-process { background-color: #f59e0b; }
        .badge-success { background-color: #10b981; }
        .badge-rejected { background-color: #991b1b; } /* Ditambahkan untuk status ditolak */
        .custom-badge {
            padding: 0.5rem 0.85rem;
            font-weight: 800;
            border-radius: 6px;
            font-size: 0.75rem;
            letter-spacing: 0.02em;
            color: white !important;
            display: inline-block;
        }
        .custom-select {
            border-radius: 8px;
            padding: 0.4rem 0.6rem;
            font-size: 0.875rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .select-normal {
            background-color: #eff6ff !important;
            color: #1d4ed8 !important;
            border: 2px solid #bfdbfe !important;
        }
        .select-low {
            background-color: #f3f4f6 !important;
            color: #4b5563 !important;
            border: 2px solid #d1d5db !important;
        }
        .select-urgent {
            background-color: #fef2f2 !important;
            color: #b91c1c !important;
            border: 2px solid #fec2c2 !important;
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 0.4rem 1.2rem;
            font-size: 0.875rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            transition: all 0.2s ease;
        }
        .btn-submit:hover {
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
            color: #ffffff;
        }
        .btn-view {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 0.4rem 1.2rem;
            font-size: 0.875rem;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
            transition: all 0.2s ease;
        }
        .btn-view:hover {
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.4);
            color: #ffffff;
        }
        .priority-box {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
        }
        .p-low { background-color: #f3f4f6; color: #4b5563; border: 1px solid #e5e7eb; }
        .p-normal { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #dbeafe; }
        .p-urgent { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
        .custom-alert {
            border: none;
            border-radius: 12px;
            background: linear-gradient(90deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            font-weight: 700;
            padding: 1.2rem 1.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar custom-navbar mb-5">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-white shadow-sm border p-1" style="width: 44px; height: 44px; border-color: #cbd5e1 !important;">
                    <img src="{{ asset('image/logo-bandung.png') }}" alt="Logo Bandung" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <span class="navbar-brand-text">SuraBandung Admin</span>
            </div>
            <div class="ms-auto">
                <a class="btn btn-back px-4 py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <h3 class="mb-4" style="color: #0f172a; font-weight: 800; letter-spacing: -0.02em;">Daftar Seluruh Pengaduan Warga</h3>

        @if(session('success'))
            <div class="alert custom-alert mb-4 d-flex align-items-center"><i class="bi bi-check-circle-fill fs-5 me-3"></i> {{ session('success') }}</div>
        @endif

        <div class="custom-card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No.</th>
                            <th>Judul Aduan</th>
                            <th>Kecamatan</th>
                            <th>Status Laporan</th>
                            <th>Tingkat Prioritas</th>
                            <th class="text-center" style="width: 310px;">Tindakan Admin Pemkot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $index => $report)
                        <tr>
                            <td class="text-center fw-bold text-secondary">{{ $index + 1 }}</td>
                            <td class="fw-bold" style="color: #0f172a; font-size: 0.95rem;">{{ $report->title }}</td>
                            <td>
                                <span class="district-badge">
                                    <i class="bi bi-geo-alt-fill me-1"></i>{{ $report->district->name }}
                                </span>
                            </td>
                            <td>
                                @if($report->status == 'pending')
                                    <span class="badge custom-badge badge-pending">PENDING</span>
                                @elseif($report->status == 'forwarded')
                                    <span class="badge custom-badge badge-forwarded">DITERUSKAN</span>
                                @elseif($report->status == 'process')
                                    <span class="badge custom-badge badge-process">DIPROSES</span>
                                @elseif($report->status == 'rejected')
                                    <span class="badge custom-badge badge-rejected">DITOLAK</span>
                                @else
                                    <span class="badge custom-badge badge-success">SELESAI</span>
                                @endif
                            </td>
                            <td>
                                @if($report->priority == 'low')
                                    <div class="priority-box p-low">🟢 Rendah</div>
                                @elseif($report->priority == 'normal')
                                    <div class="priority-box p-normal">🔵 Normal</div>
                                @elseif($report->priority == 'urgent')
                                    <div class="priority-box p-urgent">🔴 Darurat</div>
                                @else
                                    <div class="priority-box p-low">◽ Belum Set</div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($report->status == 'pending')
                                    <div class="d-flex gap-2 justify-content-center align-items-center">
                                        <!-- Tombol Baru: Lihat Berkas untuk Verifikasi Awal Laporan Warga -->
                                        <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-sm btn-view text-nowrap">
                                            <i class="bi bi-eye-fill me-1"></i> Lihat Berkas
                                        </a>

                                        <div class="vr bg-secondary opacity-25" style="height: 24px;"></div>

                                        <form action="{{ route('admin.reports.forward', $report->id) }}" method="POST" class="d-flex gap-2">
                                            @csrf
                                            <select name="priority" class="form-select form-select-sm custom-select select-normal" style="width: 110px;" onchange="updateSelectColor(this)" required>
                                                <option value="low">Rendah</option>
                                                <option value="normal" selected>Normal</option>
                                                <option value="urgent">Darurat</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-submit text-nowrap"><i class="bi bi-cloud-arrow-up-fill me-1"></i> Kirim</button>
                                        </form>
                                    </div>
                                @elseif($report->status == 'rejected')
                                    <span class="badge bg-danger-subtle text-danger border px-3 py-2 fw-bold" style="border-radius: 6px; font-size: 0.8rem; border-color: #fca5a5 !important; display: inline-block;">
                                        <i class="bi bi-x-circle-fill me-1"></i> Berkas Tidak Sesuai
                                    </span>
                                @else
                                    <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="border-radius: 6px; font-size: 0.8rem; border-color: #cbd5e1 !important; display: inline-block;">
                                        <i class="bi bi-check2-all text-success me-1"></i> Selesai Diproses Wilayah
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-folder-x text-danger d-block mb-2" style="font-size: 2.5rem;"></i>
                                <span class="fw-bold">Belum ada data aduan masuk.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateSelectColor(element) {
            element.classList.remove('select-low', 'select-normal', 'select-urgent');
            
            if (element.value === 'low') {
                element.classList.add('select-low');
            } else if (element.value === 'normal') {
                element.classList.add('select-normal');
            } else if (element.value === 'urgent') {
                element.classList.add('select-urgent');
            }
        }

        document.querySelectorAll('.custom-select').forEach(function(selectEl) {
            updateSelectColor(selectEl);
        });
    </script>
</body>
</html>