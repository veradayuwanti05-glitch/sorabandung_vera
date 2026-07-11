<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Warga - SuraBandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #87d6dd 0%, #fcfdfd 50%, #fdfdfd 30%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2d3748;
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(90deg, #99dfe9 0%, #ddfdff 50%, #ffffff 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 0.9rem 0;
        }
        
        .navbar-brand {
            font-weight: 800;
            color: #343232 !important;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            font-size: 1.35rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .navbar-brand img {
            height: 35px;
            margin-right: 12px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        
        .navbar .btn-dashboard {
            border-radius: 12px;
            padding: 8px 18px;
            font-size: 0.9rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 2px solid #3aceff;
            background: #2f94d7;
            color: #f4eeee;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(30, 58, 138, 0.2);
        }

        .navbar .btn-dashboard:hover {
            background: #059669;
            border-color: #059669;
            color: #050505;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(5, 150, 105, 0.3);
        }
        
        .container-main {
            margin-top: 3rem;
            margin-bottom: 6rem;
        }
        
        .page-header h3 {
            color: #0f172a;
            font-weight: 800;
            letter-spacing: -0.6px;
        }
        
        .card-main { 
            border: none; 
            border-radius: 24px; 
            box-shadow: 0 15px 35px rgba(30, 58, 138, 0.08);
            background-color: rgba(255, 254, 254, 0.9);
            backdrop-filter: blur(10px);
            padding: 2rem;
        }
        
        .card-header-custom {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-bottom: 1.5rem;
            border-bottom: 2.5px solid #0a0a0a;
            margin-bottom: 1.5rem;
        }
        
        .card-title-custom {
            font-weight: 800;
            color: #0f172a;
            font-size: 1.25rem;
            margin: 0;
        }
        
        .table-responsive {
            padding: 0 0.2rem;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 12px;
            background-color: transparent;
        }
        
        .table thead th {
            background-color: transparent;
            color: #64748b;
            font-weight: 800;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.5rem 1rem;
            border: none;
        }
        
        .table tbody tr {
            background-color: #171616;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .table tbody tr:hover {
            transform: translateY(-3px) scale(1.005);
            box-shadow: 0 12px 25px rgba(30, 58, 138, 0.08);
            background-color: #0c0c0c;
        }
        
        .table tbody td {
            padding: 1.3rem 1rem;
            border-top: 1px solid #1d2024;
            border-bottom: 1px solid #161719;
            font-size: 0.95rem;
        }

        .table tbody tr td:first-child {
            border-left: 1px solid #131313;
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
            padding-left: 1.5rem;
        }

        .table tbody tr td:last-child {
            border-right: 1px solid #0d0d0e;
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
            padding-right: 1.5rem;
        }
        
        /* Lingkaran Inisial Bergradasi */
        .avatar-circle {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            color: #191a1b;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .avatar-1 { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
        .avatar-2 { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .avatar-3 { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .avatar-4 { background: linear-gradient(135deg, #ec4899 0%, #c084fc 100%); }
        
        .badge-email {
            background: linear-gradient(135deg, #e6fffa 0%, #e0f2fe 100%);
            color: #0369a1;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #bae6fd;
        }

        .badge-date {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            color: #15803d;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #bbf7d0;
        }
        
        .btn-delete-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 0.6rem 1.4rem;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
            transition: all 0.2s;
        }
        
        .btn-delete-gradient:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4);
            background: linear-gradient(135deg, #f87171 0%, #b91c1c 100%);
        }
        
        .alert-custom {
            border-radius: 16px;
            border: none;
            background: linear-gradient(90deg, #dcfce7 0%, #f0fdf4 100%);
            color: #166534;
            border-left: 5px solid #16a34a;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(22, 163, 74, 0.05);
        }
        
        .icon-box-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #059669 100%);
            color: #fff;
            padding: 10px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
        }

        .text-number {
            font-weight: 800;
            color: #a5b1c2;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('image/logo-bandung.png') }}" alt="Logo"> SuraBandung
            </a>
            <div class="ms-auto">
                <a class="btn btn-dashboard" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-arrow-left-short fs-5"></i> Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container container-main">
        <div class="page-header mb-4">
            <h3 class="mb-1">Kelola Data Warga</h3>
            <p class="text-muted">Daftar masyarakat resmi yang memiliki hak akses akun aplikasi SuraBandung</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show alert-custom mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-main">
            <div class="card-header-custom">
                <div class="icon-box-gradient">
                    <i class="bi bi-people-fill fs-5"></i>
                </div>
                <h5 class="card-title-custom">Database Akun Warga Terdaftar</h5>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 8%">No</th>
                            <th style="width: 32%">Nama Lengkap</th>
                            <th style="width: 30%">Alamat Email</th>
                            <th style="width: 20%">Terdaftar Pada</th>
                            <th class="text-end pe-4" style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $index => $w)
                            <tr>
                                <td class="ps-4 text-number">{{ sprintf("%02d", $index + 1) }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- Warna lingkaran inisial otomatis bergantian -->
                                        <div class="avatar-circle avatar-{{ ($index % 4) + 1 }}">
                                            {{ strtoupper(substr($w->name, 0, 1)) }}
                                        </div>
                                        <div class="fw-bold text-dark fs-6">{{ $w->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge-email">
                                        <i class="bi bi-envelope-at-fill"></i>
                                        <span>{{ $w->email }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge-date">
                                        <i class="bi bi-calendar3-event"></i>
                                        <span>{{ $w->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <form action="{{ route('admin.warga.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Hapus akun warga ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete-gradient d-inline-flex align-items-center gap-2">
                                            <i class="bi bi-trash3-fill"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                    Belum ada data warga terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>