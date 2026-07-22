<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Siswa;
use App\Exports\IzinExport;
use Maatwebsite\Excel\Facades\Excel;


class IzinController extends Controller
{
    public function create()
{
    // ambil siswa dari session
    $siswa = \App\Models\Siswa::find(session('siswa_id'));

    return view('siswa.absensi', compact('siswa'));
}

public function store(Request $request)
{
    $siswa = \App\Models\Siswa::find(session('siswa_id'));

    if (!$siswa) {
        return redirect('/')->with('error', 'Silakan login dulu');
    }

    $request->validate([
        'jenis' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable|string',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:20480'
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('izin', 'public');
    }

    Izin::create([
        'siswa_id' => $siswa->id,
        'jenis' => $request->jenis,
        'keterangan' => $request->keterangan, // ✅ TEXT
        'tanggal' => $request->tanggal,
        'file' => $filePath // ✅ FILE MASUK SINI
    ]);

    return redirect('/dashboard-siswa')->with('success', 'Absensi berhasil dikirim');
}

public function dataIzin(Request $request)
{
    $query = Izin::with('siswa');

    // SEARCH
    if ($request->search) {
        $query->whereHas('siswa', function($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('nis', 'like', '%' . $request->search . '%')
              ->orWhere('kelas', 'like', '%' . $request->search . '%');
        });
    }

    // FILTER KELAS
    if ($request->kelas) {
        $query->whereHas('siswa', function($q) use ($request) {
            $q->where('kelas', $request->kelas);
        });
    }

    // FILTER TANGGAL
    if ($request->tanggal) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    // PAGINATION
    $izin = $query->latest()
                  ->paginate(10)
                  ->withQueryString();

    return view('guru.absensi.index', compact('izin'));
}

public function export(Request $request)
{
    return Excel::download(
        new IzinExport(
            $request->search,
            $request->kelas,
            $request->tanggal
        ),
        'data_tidak_hadir.xlsx'
    );
}
}