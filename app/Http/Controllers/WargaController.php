<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\District;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', auth()->id())->with('district')->latest()->get();
        
        return view('warga.dashboard', compact('reports'));
    }

    public function create()
    {
        $districts = District::all();
        
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
            'image_before' => $filename, 
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'pending',
        ]);

        return redirect()->route('warga.dashboard')->with('success', 'Laporan Anda berhasil dikirim!');
    }
    public function edit($id)
{
    $report = Report::where('user_id', auth()->id())->findOrFail($id);

    if ($report->status !== 'rejected') {
        return redirect()->route('warga.dashboard')->with('error', 'Laporan ini tidak dapat diedit.');
    }

    return view('warga.reports.edit', compact('report'));
}

public function update(Request $request, $id)
{
    $report = Report::where('user_id', auth()->id())->findOrFail($id);

    if ($report->status !== 'rejected') {
        return redirect()->route('warga.dashboard')->with('error', 'Laporan ini tidak dapat diedit.');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    $report->update([
        'title' => $request->title,
        'description' => $request->description,
        'status' => 'pending', 
        'tanggapan' => null,   
    ]);

    return redirect()->route('warga.dashboard')->with('success', 'Laporan berhasil diperbaiki dan dikirim ulang!');
}
    public function show($id)
    {
        $report = Report::where('user_id', auth()->id())
            ->with(['district', 'resolution'])
            ->findOrFail($id);

        return view('warga.reports.show', compact('report'));
    }
}