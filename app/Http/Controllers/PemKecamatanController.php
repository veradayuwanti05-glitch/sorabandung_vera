<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Resolution;
use Illuminate\Http\Request;

class PemKecamatanController extends Controller
{
    public function index()
    {
        // KUNCI UTAMA: Mengambil ID Kecamatan dari petugas yang sedang login
        $districtId = auth()->user()->district_id;

        // Menampilkan laporan yang berstatus 'forwarded', 'process', atau 'resolved' KHUSUS di kecamatan petugas tersebut
        $reports = Report::where('district_id', $districtId)
            ->whereIn('status', ['forwarded', 'process', 'resolved'])
            ->with('user')
            ->latest()
            ->get();

        // Cari tahu nama kecamatan untuk judul halaman (opsional)
        $districtName = auth()->user()->district ? auth()->user()->district->name : 'Kecamatan';

        return view('kecamatan.dashboard', compact('reports', 'districtName'));
    }

public function show($id)
    {
        $districtId = auth()->user()->district_id;

        // Memastikan petugas tidak bisa mengintip laporan dari kecamatan lain
        $report = Report::where('district_id', $districtId)
            ->with(['user', 'district', 'resolution'])
            ->findOrFail($id);

        // UBAH BARIS INI: tambahkan .reports. sebelum nama file show
        return view('kecamatan.reports.show', compact('report'));
    }

    public function process($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'process']);

        return redirect()->back()->with('success', 'Status laporan berhasil diubah menjadi Sedang Diproses.');
    }

    public function resolve(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'image_after' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $report = Report::findOrFail($id);

        // Simpan foto bukti penyelesaian
        $imagePath = $request->file('image_after')->store('resolutions', 'public');

        // Buat data resolusi baru
        Resolution::create([
            'report_id' => $report->id,
            'description' => $request->description,
            'image_after' => $imagePath,
        ]);

        // Update status laporan menjadi selesai
        $report->update(['status' => 'resolved']);

        return redirect()->route('kecamatan.dashboard')->with('success', 'Laporan aduan warga telah selesai ditangani.');
    }
}