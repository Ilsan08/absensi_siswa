<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $kelas;
    protected $tanggal;

    public function __construct($search, $kelas, $tanggal)
    {
        $this->search = $search;
        $this->kelas = $kelas;
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = Absensi::with('siswa');

        if ($this->search) {
            $query->whereHas('siswa', function($q){
                $q->where('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('nis', 'like', '%'.$this->search.'%')
                  ->orWhere('kelas', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->kelas) {
            $query->whereHas('siswa', function($q){
                $q->where('kelas', $this->kelas);
            });
        }

        if ($this->tanggal) {
            $query->whereDate('tanggal', $this->tanggal);
        }

        return $query->get()->map(function($a){
            return [
                'Nama' => $a->siswa->nama ?? '-',
                'Kelas' => $a->siswa->kelas ?? '-',
                'Tanggal' => $a->tanggal,
                'Jam Masuk' => $a->waktu_masuk,
                'Jam Pulang' => $a->waktu_pulang,
                'Status' => $a->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kelas',
            'Tanggal',
            'Jam Masuk',
            'Jam Pulang',
            'Status'
        ];
    }
}