<?php

namespace App\Http\Controllers;

// PERBAIKAN: Request di-import agar fungsinya bisa digunakan[cite: 1]
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
     * METODE YANG DIPERBAIKI:
     * Meneruskan Laporan ke Kecamatan Terkait + Menyimpan Skala Prioritas
     */
    // PERBAIKAN: Menambahkan parameter Request $request agar menangkap data input form[cite: 1]
    public function forward(Request $request, $id) 
    {
        // 1. Cari data laporan berdasarkan ID
        $report = Report::findOrFail($id);
        
        // 2. Validasi tingkat prioritas yang dikirim dari form (low, normal, urgent)
        $request->validate([
            'priority' => 'required|in:low,normal,urgent',
        ]);

        // 3. Update status menjadi 'forwarded' DAN menangkap nilai 'priority' langsung dari input form select admin
        $report->update([
            'status' => 'forwarded',
            'priority' => $request->input('priority') // <-- Prioritas tersimpan otomatis ke DB
        ]);

        // 4. Kembali ke halaman utama admin dengan pesan sukses
        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diteruskan ke Kecamatan dengan prioritas yang ditentukan.');
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
        
        // Sesuai foto: petugas.blade.php ada di dalam folder admin/reports/
        return view('admin.reports.petugas', compact('petugas', 'districts'));
    }

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