<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\Report;

class AdminPusatController extends Controller
{
    public function index()
    {
        $totalWarga = User::where('role', 'warga')->count();
        $totalReports = Report::count();
        
        $totalPending   = Report::where('status', 'pending')->count();
        $totalForwarded = Report::where('status', 'forwarded')->count();
        $totalProcess   = Report::where('status', 'process')->count();
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
    public function reports()
    {
        $reports = Report::with(['user', 'district'])->latest()->get();
        return view('admin.reports.index', compact('reports'));
    }
    public function show($id)
    {
        $report = Report::with(['user', 'district'])->findOrFail($id);
        
        return view('admin.reports.show', compact('report'));
    }

    public function kirimKeKecamatan($id)
    {
        $report = Report::findOrFail($id);
        $report->update([
            'status' => 'forwarded'
        ]);

        return redirect()->route('admin.reports.index')->with('success', 'Laporan valid dan berhasil diteruskan ke Kecamatan!');
    }

    public function tolakLaporan($id)
    {
        $report = Report::findOrFail($id);
        $report->update([
            'status' => 'rejected',
            'tanggapan' => 'Laporan ditolak oleh Admin Pusat karena data atau bukti yang dilampirkan tidak sesuai.'
        ]);

        return redirect()->route('admin.reports.index')->with('success', 'Laporan tidak sesuai telah berhasil ditolak.');
    }

    public function forward(Request $request, $id) 
    {
        $report = Report::findOrFail($id);
        
        $request->validate([
            'priority' => 'required|in:low,normal,urgent',
        ]);

        $report->update([
            'status' => 'forwarded',
            'priority' => $request->input('priority')
        ]);

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diteruskan ke Kecamatan dengan prioritas yang ditentukan.');
    }

    public function petugasIndex()
    {
        $petugas = User::where('role', 'pem_kecamatan')->latest()->get();
        $districts = \App\Models\District::all(); 
        
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

    public function wargaIndex()
    {
        $warga = User::where('role', 'warga')->latest()->get();
        return view('admin.reports.warga', compact('warga'));
    }

    public function wargaDestroy($id)
    {
        $user = User::where('role', 'warga')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil dihapus dari sistem.');
    }
}