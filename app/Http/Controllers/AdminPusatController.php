<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\District;
use Illuminate\Http\Request;

class AdminPusatController extends Controller
{
    public function index()
    {
        $totalPending = Report::where('status', 'pending')->count();
        $totalForwarded = Report::where('status', 'forwarded')->count();
        $totalProcess = Report::where('status', 'process')->count();
        $totalResolved = Report::where('status', 'resolved')->count();

        return view('admin.dashboard', compact('totalPending', 'totalForwarded', 'totalProcess', 'totalResolved'));
    }

    public function reports()
    {
        $reports = Report::with(['user', 'district'])->latest()->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function forward(Request $request, $id)
    {
        $request->validate([
            'priority' => 'required|in:low,normal,urgent'
        ]);

        $report = Report::findOrFail($id);
        
        // Memastikan kolom district_id tetap terjaga sesuai kecamatan tempat kejadian yang dilaporkan warga
        $report->update([
            'status' => 'forwarded',
            'priority' => $request->priority,
            'district_id' => $report->district_id // Menegaskan kembali agar district_id terisi dengan benar di database
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil disetujui dan diteruskan ke Kecamatan tujuan.');
    }

    public function petugasIndex()
    {
        $petugas = User::where('role', 'pem_kecamatan')->with('district')->get();
        $districts = District::all();

        // UBAH BARIS INI: Dari 'admin.petugas.index' menjadi 'admin.reports.petugas'
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

        return redirect()->back()->with('success', 'Akun Petugas Kecamatan baru berhasil didaftarkan langsung!');
    }
}