<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Absensi;
use App\Models\Siswa;

class KesiswaanController extends Controller
{
   
   public function absensi(Request $request)
{
    $query = Izin::with('siswa')->latest();

    // FILTER KELAS
    if ($request->kelas) {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('kelas', $request->kelas);
        });
    }

    // FILTER TANGGAL
    if ($request->tanggal) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    // SEARCH
    if ($request->search) {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('nis', 'like', '%' . $request->search . '%')
              ->orWhere('kelas', 'like', '%' . $request->search . '%');
        });
    }

$izin = $query->paginate(10)->withQueryString();

    return view('kesiswaan.absensi.index', compact('izin'));
}

public function kehadiran(Request $request)
{
    $query = Absensi::with('siswa')->latest();

    // FILTER KELAS
    if ($request->kelas) {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('kelas', $request->kelas);
        });
    }

    // FILTER TANGGAL
    if ($request->tanggal) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    // SEARCH
    if ($request->search) {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('nis', 'like', '%' . $request->search . '%')
              ->orWhere('kelas', 'like', '%' . $request->search . '%');
        });
    }

   $absensi = $query->paginate(10)->withQueryString();

    return view('kesiswaan.kehadiran.index', compact('absensi'));
}
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

   $siswa = $query->paginate(10)->withQueryString();

    return view('kesiswaan.siswa.index', compact('siswa'));
}
}