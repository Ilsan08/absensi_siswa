<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;


class SiswaController extends Controller
{
   
  public function index(Request $request)
{
    $query = Siswa::query();

    // SEARCH
    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('nis', 'like', '%' . $request->search . '%')
              ->orWhere('kelas', 'like', '%' . $request->search . '%');
        });
    }

    // FILTER KELAS
    if ($request->kelas) {
        $query->where('kelas', $request->kelas);
    }

    // PAGINATION
    $siswa = $query->latest()
                   ->paginate(10)
                   ->withQueryString();

    return view('kesiswaan.siswa.index', compact('siswa'));
}

   
    public function create()
    {
        return view('kesiswaan.siswa.create');
    }

   
   public function store(Request $request)
{
    $request->validate([
        'nis' => 'required|unique:siswa,nis',
        'nama' => 'required',
        'kelas' => 'required'
    ]);

  
    $qrData = $request->nis; 

    Siswa::create([
        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'qr_code' => $qrData
    ]);

    return redirect('/kesiswaan/siswa')
        ->with('success', 'Data siswa + QR berhasil dibuat');
}

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('kesiswaan.siswa.edit', compact('siswa'));
    }

   
    public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $request->validate([
        'nis' => 'required|unique:siswa,nis,' . $id,
        'nama' => 'required',
        'kelas' => 'required'
    ]);

    $qrData = $request->nis;

    $siswa->update([
        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'qr_code' => $qrData
    ]);

    return redirect('/kesiswaan/siswa')
        ->with('success', 'Data siswa berhasil diupdate');
}

    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();

        return back()->with('success', 'Data siswa berhasil dihapus');
    }

    public function export(Request $request)
{
    return Excel::download(
        new SiswaExport(
            $request->search,
            $request->kelas
        ),
        'data_siswa.xlsx'
    );
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new SiswaImport, $request->file('file'));

    return back()->with('success', 'Data siswa berhasil diimport');
}
}