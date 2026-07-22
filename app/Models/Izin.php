<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $table = 'izin';

    protected $fillable = [
        'siswa_id',
        'jenis',
        'keterangan',
        'tanggal',
        'file' // ✅ TAMBAHKAN INI
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Siswa::class);
    }
}