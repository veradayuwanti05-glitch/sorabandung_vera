<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuraBandung - Kelola Petugas Kecamatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #a0e8f5 0%, #ebedee 100%);
            font-family: 'Montserrat', sans-serif;
            color: #444;
        }
        .navbar {
            background: linear-gradient(135deg, #95f6ff 0%, #dffcff 100%);
            border-bottom: 3px solid #0acffe;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            color: #060708 !important;
            letter-spacing: 1px;
            font-size: 1.6rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-brand span {
            color: #0a0b0b;
        }
        .bandung-logo {
            height: 35px;
            width: auto;
        }
        .container-main {
            margin-top: 3rem;
            margin-bottom: 5rem;
        }
        .card { 
            border: none; 
            border-radius: 25px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            background: linear-gradient(135deg, #ffffff 0%, #f1f6f9 100%);
            padding: 2.5rem;
            border: 1px solid rgba(10, 11, 11, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header-custom {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding-bottom: 1.8rem;
            margin-bottom: 2.5rem;
            border-bottom: 3px solid #040404;
        }
        .card-title-custom {
            font-weight: 700;
            color: #1a1e29;
            font-size: 1.5rem;
            margin: 0;
        }
        .form-label {
            font-weight: 600;
            color: #000000;
            font-size: 0.95rem;
            margin-bottom: 0.7rem;
        }
        .input-group-custom {
            border-radius: 15px;
            border: 2px solid #070707;
            overflow: hidden;
            background-color: #fff;
            transition: all 0.2s ease;
        }
        .input-group-custom:focus-within {
            border-color: #090909;
            box-shadow: 0 0 0 5px rgba(10, 207, 254, 0.15);
        }
        .input-group-custom .input-group-text-custom {
            background-color: #f1f6f9;
            color: #4c9aad;
            border: none;
            font-size: 1.2rem;
            padding-left: 1rem;
        }
        .input-group-custom .form-control-custom,
        .input-group-custom .form-select-custom {
            border: none;
            padding: 1rem;
            font-size: 1rem;
            box-shadow: none !important;
        }
        .btn-primary-custom {
            background: linear-gradient(90deg, #0acffe 0%, #3a415a 100%);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 700;
            font-size: 1.2rem;
            color: #fff;
            transition: 0.3s ease;
            box-shadow: 0 5px 15px rgba(10, 207, 254, 0.3);
        }
        .btn-primary-custom:hover {
            box-shadow: 0 8px 20px rgba(10, 207, 254, 0.5);
            transform: translateY(-3px);
            color: #080808;
        }
        .btn-outline-light-custom {
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            font-weight: 600;
            border: 2px solid #0f0e0e;
            color: #0f0f0f;
            background: rgba(255, 255, 255, 0.1);
        }
        .btn-outline-light-custom:hover {
            background-color: #fff;
            color: #1a1e29;
        }
        .table {
            border-radius: 20px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #fff;
            border: 1px solid rgba(10, 207, 254, 0.1);
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(10, 207, 254, 0.03);
        }
        .table thead th {
            background-color: rgba(10, 207, 254, 0.05);
            color: #1a1e29;
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1.4rem;
            border-bottom: 2px solid rgba(10, 207, 254, 0.1);
        }
        .table tbody td {
            padding: 1.5rem 1.4rem;
            border-bottom: 1px solid rgba(10, 207, 254, 0.05);
            font-size: 1rem;
        }
        .table tbody tr:hover {
            background-color: rgba(10, 207, 254, 0.08);
        }
        .badge {
            font-size: 0.85rem;
            padding: 0.7rem 1.3rem;
            border-radius: 30px;
            font-weight: 600;
        }
        .bg-cyan-light {
            background-color: rgba(10, 207, 254, 0.1);
            color: #0c9abf;
        }
        .alert {
            border-radius: 20px;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .alert-success-custom {
            background-color: rgba(10, 207, 254, 0.1);
            color: #1b5e20;
            border: 2px solid rgba(10, 207, 254, 0.2);
        }
        .col-registrasi {
            max-width: 480px;
        }
        .op-70 {
            opacity: 0.7;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('image/logo-bandung.png') }}" alt="Logo Bandung" class="bandung-logo">
                <span>SuraBandung</span>
            </a>
            <div class="ms-auto">
                <a class="btn btn-sm btn-outline-light-custom d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container container-main">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show alert-success-custom" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5 justify-content-center">
            <div class="col-lg-4 col-registrasi mb-5">
                <div class="card p-4">
                    <div class="card-header-custom">
                        <i class="bi bi-person-plus-fill text-cyan-light fs-2"></i>
                        <h5 class="card-title-custom">Registrasi Petugas</h5>
                    </div>
                    <form action="{{ route('admin.petugas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap / Instansi</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text-custom"><i class="bi bi-person-bounding-box"></i></span>
                                <input type="text" name="name" class="form-control form-control-custom" placeholder="Bpk. Jajang / Kec. Bojong" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Login</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text-custom"><i class="bi bi-envelope-at"></i></span>
                                <input type="email" name="email" class="form-control form-control-custom" placeholder="petugas@bdg.go.id" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Kata Sandi (Password)</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text-custom"><i class="bi bi-shield-lock"></i></span>
                                <input type="password" name="password" class="form-control form-control-custom" placeholder="Minimal 8 karakter" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Wilayah Tugas Kecamatan</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text-custom"><i class="bi bi-map-fill"></i></span>
                                <select name="district_id" class="form-select form-select-custom" required>
                                    <option value="" selected disabled>-- Pilih Wilayah --</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-check-circle"></i>
                            Daftarkan Petugas
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="card-header-custom">
                        <i class="bi bi-people-fill text-dark fs-2"></i>
                        <h5 class="card-title-custom">Akun Kecamatan Aktif</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead>
                                <tr>
                                    <th class="ps-4">Nama Petugas/Instansi</th>
                                    <th>Alamat Email</th>
                                    <th>Wilayah Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($petugas as $p)
                                <tr>
                                    <td class="ps-4 fw-semibold text-dark">
                                        <i class="bi bi-person-vcard me-2 op-70 text-cyan-light"></i>
                                        {{ $p->name }}
                                    </td>
                                    <td class="text-secondary">
                                        <i class="bi bi-mailbox me-2 op-70 text-cyan-light"></i>
                                        {{ $p->email }}
                                    </td>
                                    <td>
                                        <span class="badge bg-cyan-light">
                                            Kec. {{ $p->district->name ?? 'Belum Terikat' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox-fill fs-1 d-block mb-3 text-cyan-light op-70"></i>
                                        Belum ada petugas kecamatan yang didaftarkan.
                                    </td>
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