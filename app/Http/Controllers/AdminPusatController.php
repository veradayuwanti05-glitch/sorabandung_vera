<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
// Pastikan model District di-import di atas jika kamu punya modelnya
// use App\Models\District; 

class AdminPusatController extends Controller
{
    /**
     * Menampilkan Dashboard Admin Pusat
     */
    public function index()
    {
        $totalWarga = User::where('role', 'warga')->count();
        $totalReports = Report::count();
        
        $totalPending   = Report::where('status', 'pending')->count();
        $totalForwarded = Report::where('status', 'processed')->count();
        $totalProcess   = Report::where('status', 'action')->count();
        $totalResolved  = Report::where('status', 'resolved')->count();
        
        return view('admin.dashboard', compact(
            'totalWarga', 
            'totalReports', 
            'totalPending', 
            'totalForwarded', 
            'totalProcess', 
            'totalResolved'
        ));
    }

    /**
     * Menampilkan Semua Laporan Masuk
     */
    public function reports()
    {
        $reports = Report::with(['user', 'district'])->latest()->get();
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Meneruskan Laporan ke Kecamatan Terkait
     */
    public function forward($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'processed']);

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diteruskan ke Kecamatan.');
    }

    /**
     * Menampilkan Daftar Petugas Kecamatan
     */
    public function petugasIndex()
    {
        $petugas = User::where('role', 'pem_kecamatan')->latest()->get();
        
        // PERBAIKAN: Ambil data dari table/model districts agar tidak memicu Undefined Variable di modal
        // Jika nama model kamu bukan District, silakan sesuaikan (misal: \App\Models\Kecamatan::all())
        $districts = \App\Models\District::all(); 
        
        // Sesuai foto: petugas.blade.php ada di dalam folder admin/reports/[cite: 1]
        return view('admin.reports.petugas', compact('petugas', 'districts'));
    }

    /**
     * Menyimpan Data Petugas Kecamatan Baru
     */
    public function petugasStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'district_id' => 'required|exists:districts,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pem_kecamatan',
            'district_id' => $request->district_id,
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas Kecamatan berhasil ditambahkan.');
    }

    /**
     * Menampilkan Daftar Seluruh Warga
     */
    public function wargaIndex()
    {
        $warga = User::where('role', 'warga')->latest()->get();
        return view('admin.reports.warga', compact('warga'));
    }

    /**
     * Menghapus Data Warga dari Sistem
     */
    public function wargaDestroy($id)
    {
        $user = User::where('role', 'warga')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil dihapus dari sistem.');
    }
}