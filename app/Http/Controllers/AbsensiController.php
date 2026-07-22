<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function scan($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return "Siswa tidak ditemukan";
        }

        $today = date('Y-m-d');

        $absen = Absensi::where('siswa_id', $siswa->id)
            ->where('tanggal', $today)
            ->first();

        $now = Carbon::now()->format('H:i:s');

        // ABSEN MASUK
        if (!$absen) {

            $status = ($now > '07:00:00') ? 'terlambat' : 'hadir';

            Absensi::create([
                'siswa_id' => $siswa->id,
                'tanggal' => $today,
                'waktu_masuk' => $now,
                'status' => $status
            ]);

            return "✅ Absen masuk berhasil";
        }

        // ABSEN PULANG
        if (!$absen->waktu_pulang) {
            $absen->update([
                'waktu_pulang' => $now
            ]);

            return "✅ Absen pulang berhasil";
        }

        return "❌ Kamu sudah absen hari ini";
    }
 public function dataKehadiran(Request $request)
{
    $query = Absensi::with('siswa');

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
    $absensi = $query->latest()
                     ->paginate(10)
                     ->withQueryString();

    return view('guru.kehadiran.index', compact('absensi'));
}
public function export(Request $request)
{
    return Excel::download(
        new AbsensiExport(
            $request->search,
            $request->kelas,
            $request->tanggal
        ),
        'data_kehadiran.xlsx'
    );
}
}