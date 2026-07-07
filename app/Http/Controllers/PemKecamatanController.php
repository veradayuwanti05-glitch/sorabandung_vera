<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemKecamatanController extends Controller
{
    public function index()
    {
        $districtId = Auth::user()->district_id;

        $totalForwarded = Report::where('district_id', $districtId)->where('status', 'forwarded')->count();
        $totalProcess = Report::where('district_id', $districtId)->where('status', 'process')->count();
        $totalResolved = Report::where('district_id', $districtId)->where('status', 'resolved')->count();

        $reports = Report::where('district_id', $districtId)
            ->with('user')
            ->latest()
            ->get();

        return view('kecamatan.dashboard', compact('totalForwarded', 'totalProcess', 'totalResolved', 'reports'));
    }

    public function show($id)
    {
        $districtId = Auth::user()->district_id;
        $report = Report::where('district_id', $districtId)->with('user')->findOrFail($id);

        return view('kecamatan.reports.show', compact('report'));
    }

    public function process($id)
    {
        $districtId = Auth::user()->district_id;
        $report = Report::where('district_id', $districtId)->findOrFail($id);
        
        $report->update(['status' => 'process']);

        return redirect()->back()->with('success', 'Status laporan berhasil diubah menjadi Sedang Diproses.');
    }
public function exportPdf($id)
    {
        $districtId = Auth::user()->district_id;
        $report = Report::where('district_id', $districtId)->with('user')->findOrFail($id);

        return view('kecamatan.reports.pdf', compact('report'));
    }
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