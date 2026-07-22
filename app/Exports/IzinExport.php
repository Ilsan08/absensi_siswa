<?php

namespace App\Exports;

use App\Models\Izin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IzinExport implements FromCollection, WithHeadings
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
        $query = Izin::with('siswa');

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

        return $query->get()->map(function($i){
            return [
                'Nama' => $i->siswa->nama ?? '-',
                'Kelas' => $i->siswa->kelas ?? '-',
                'Jenis' => $i->jenis,
                'Keterangan' => $i->keterangan,
                'Tanggal' => $i->tanggal,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kelas',
            'Jenis',
            'Keterangan',
            'Tanggal'
        ];
    }
}