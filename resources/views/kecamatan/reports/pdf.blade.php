<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Bukti Penanganan Laporan #{{ $report->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #ffffff; font-family: 'Times New Roman', Times, serif; color: #000000; }
        .kop-surat { border-bottom: 4px double #000000; padding-bottom: 10px; margin-bottom: 30px; }
        .table-info td { padding: 8px 4px; font-size: 1.1rem; }
        .foto-bukti { max-width: 300px; max-height: 200px; object-fit: cover; border: 1px solid #000; }
        @media print {
            .no-print { display: none; }
            body { padding: 20px; }
        }
    </style>
</head>
<body>

    <div class="container my-4" style="max-width: 800px;">
        <div class="no-print mb-4 text-end">
            <button onclick="window.print()" class="btn btn-dark fw-bold px-4">🖨️ Cetak / Simpan Ke PDF</button>
            <a href="{{ route('kecamatan.dashboard') }}" class="btn btn-outline-secondary fw-semibold">Kembali</a>
        </div>

        <div class="kop-surat text-center">
            <h4 class="fw-bold text-uppercase mb-1">PEMERINTAH KOTA BANDUNG</h4>
            <h5 class="fw-bold text-uppercase mb-1">KANTOR OPERASIONAL SATUAN WILAYAH</h5>
            <p class="mb-0 small text-muted">Jl. Wastukencana No.2, Babakan Ciamis, Kec. Sumur Bandung, Kota Bandung, Jawa Barat</p>
        </div>

        <div class="text-center mb-4">
            <h5 class="fw-bold text-uppercase text-decoration-underline">SURAT BUKTI SELESAI PENANGANAN ADUAN</h5>
            <p class="text-muted">Nomor Berkas: REG/SRBDG/{{ $report->id }}/2026</p>
        </div>

        <table class="table table-borderless table-info w-100 mb-4">
            <tr>
                <td style="width: 25%;"><strong>Subjek Aduan</strong></td>
                <td style="width: 2%;">:</td>
                <td>{{ $report->title }}</td>
            </tr>
            <tr>
                <td><strong>Nama Pelapor</strong></td>
                <td>:</td>
                <td>{{ $report->user->name }}</td>
            </tr>
            <tr>
                <td><strong>Status Terakhir</strong></td>
                <td>:</td>
                <td class="text-uppercase fw-bold text-success">{{ $report->status }}</td>
            </tr>
            <tr>
                <td><strong>Koordinat Lokasi</strong></td>
                <td>:</td>
                <td>{{ $report->latitude ?? '-' }}, {{ $report->longitude ?? '-' }}</td>
            </tr>
            <tr>
                <td class="align-top"><strong>Deskripsi Masalah</strong></td>
                <td class="align-top">:</td>
                <td style="white-space: pre-line;">{{ $report->description }}</td>
            </tr>
        </table>

        <div class="row g-4 my-4">
            @if($report->image_success)
            <div class="col-6 text-center">
                <p class="fw-bold mb-2">Dokumentasi Hasil Lapangan (Sesudah):</p>
                <img src="{{ asset('assets/reports_success/' . $report->image_success) }}" class="foto-bukti rounded">
            </div>
            @endif
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-7"></div>
            <div class="col-5 text-center">
                <p class="mb-1">Bandung, {{ date('d F Y') }}</p>
                <p class="fw-bold mb-5">Petugas Operasional Wilayah,</p>
                <br>
                <p class="fw-bold text-decoration-underline mb-0">{{ Auth::user()->name }}</p>
                <p class="text-muted small">NIP. SYSTEM-GENERATED</p>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>