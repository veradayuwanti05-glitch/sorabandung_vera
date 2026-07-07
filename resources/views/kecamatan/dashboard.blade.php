@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="mb-4 text-white">Dashboard Petugas Kecamatan</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">Daftar Tugas Perbaikan Jalan Masuk</div>
                <div class="card-body text-dark">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Lokasi / Judul</th>
                                <th>Pelapor</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->title }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td>
                                    @if($report->status == 'forwarded')
                                        <span class="badge bg-warning text-dark">Menunggu Tindakan</span>
                                    @elseif($report->status == 'process')
                                        <span class="badge bg-primary">Sedang Diproses</span>
                                    @else
                                        <span class="badge bg-success">Selesai Diperbaiki</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('kecamatan.reports.show', $report->id) }}" class="btn btn-sm btn-info text-dark">Buka Dokumen</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection