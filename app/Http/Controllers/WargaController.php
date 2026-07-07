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
            'description' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'image_before' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        $filename = null;
        if ($request->hasFile('image_before')) {
            $file = $request->file('image_before');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/reports_entry'), $filename);
        }

        Report::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'district_id' => $request->district_id,
            'image_before' => $filename, // Selesai! Mengubah 'image' menjadi 'image_before' agar pas dengan database
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'pending',
        ]);

        return redirect()->route('warga.dashboard')->with('success', 'Laporan Anda berhasil dikirim!');
    }
    public function show($id)
    {
        $report = Report::where('user_id', auth()->id())
            ->with(['district', 'resolution'])
            ->findOrFail($id);

        return view('warga.reports.show', compact('report'));
    }
}