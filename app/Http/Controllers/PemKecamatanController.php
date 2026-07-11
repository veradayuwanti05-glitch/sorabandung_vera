<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemKecamatanController extends Controller
{
    /**
     * Dashboard Utama Wilayah Kecamatan
     */
    public function index()
    {
        // Mengunci ID kecamatan berdasarkan akun petugas yang login
        $districtId = Auth::user()->district_id;

        // Menghitung statistik data pengaduan khusus untuk yurisdiksi kecamatan ini
        $totalForwarded = Report::where('district_id', $districtId)->where('status', 'forwarded')->count();
        $totalProcess = Report::where('district_id', $districtId)->where('status', 'process')->count();
        $totalResolved = Report::where('district_id', $districtId)->where('status', 'resolved')->count();

        // Mengambil semua aduan yang ditujukan ke kecamatan ini beserta data pelapornya
        $reports = Report::where('district_id', $districtId)
            ->with('user')
            ->latest()
            ->get();

        return view('kecamatan.dashboard', compact('totalForwarded', 'totalProcess', 'totalResolved', 'reports'));
    }

    /**
     * Membuka Detail Berkas Pengaduan
     */
    public function show($id)
    {
        $districtId = Auth::user()->district_id;
        
        // Memastikan petugas tidak bisa mengintip berkas aduan dari kecamatan lain
        $report = Report::where('district_id', $districtId)->with('user')->findOrFail($id);

        return view('kecamatan.reports.show', compact('report'));
    }

    /**
     * Mengubah Status Laporan Menjadi Sedang Diproses
     */
    public function process($id)
    {
        $districtId = Auth::user()->district_id;
        $report = Report::where('district_id', $districtId)->findOrFail($id);
        
        $report->update(['status' => 'process']);

        return redirect()->back()->with('success', 'Status laporan berhasil diubah menjadi Sedang Diproses.');
    }

    /**
     * Cetak Laporan ke Dokumen View PDF
     */
    public function exportPdf($id)
    {
        $districtId = Auth::user()->district_id;
        $report = Report::where('district_id', $districtId)->with('user')->findOrFail($id);

        return view('kecamatan.reports.pdf', compact('report'));
    }

    /**
     * Menyelesaikan Laporan dengan Mengunggah Bukti Foto Lapangan
     */
    public function resolve(Request $request, $id)
    {
        $request->validate([
            'image_success' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $districtId = Auth::user()->district_id;
        $report = Report::where('district_id', $districtId)->findOrFail($id);

        if ($request->hasFile('image_success')) {
            $file = $request->file('image_success');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/reports_success'), $filename);
            
            $report->update([
                'status' => 'resolved',
                'image_success' => $filename
            ]);
        }

        return redirect()->route('kecamatan.dashboard')->with('success', 'Laporan telah diselesaikan dengan bukti foto lapangan!');
    }
}