<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\District;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        // Mengambil semua laporan milik warga yang sedang login
        $reports = Report::where('user_id', auth()->id())->with('district')->latest()->get();
        
        // PASTIKAN DI SINI: Diubah dari 'warga.reports.dashboard' atau 'warga.index' menjadi 'warga.dashboard'
        return view('warga.dashboard', compact('reports'));
    }

    public function create()
    {
        $districts = District::all();
        
        // Diubah menjadi 'warga.create' (tanpa sub-folder reports)
        return view('warga.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'description' => 'required|string',
            'image_before' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar ke folder storage/app/public/reports
        $imagePath = $request->file('image_before')->store('reports', 'public');

        Report::create([
            'user_id' => auth()->id(),
            'district_id' => $request->district_id,
            'title' => $request->title,
            'description' => $request->description,
            'image_before' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('warga.dashboard')->with('success', 'Laporan aduan Anda berhasil dikirim dan menunggu verifikasi.');
    }

    public function show($id)
    {
        $report = Report::where('user_id', auth()->id())
            ->with(['district', 'resolution'])
            ->findOrFail($id);

        // Diubah menjadi 'warga.show' (tanpa sub-folder reports)
        return view('warga.show', compact('report'));
    }
}