<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $kelas;

    public function __construct($search, $kelas)
    {
        $this->search = $search;
        $this->kelas = $kelas;
    }

    public function collection()
    {
        $query = Siswa::query();

        if ($this->search) {
            $query->where(function($q){
                $q->where('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('nis', 'like', '%'.$this->search.'%')
                  ->orWhere('kelas', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->kelas) {
            $query->where('kelas', $this->kelas);
        }

        return $query->select(
            'nis',
            'nama',
            'kelas'
        )->get();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Kelas'
        ];
    }
}