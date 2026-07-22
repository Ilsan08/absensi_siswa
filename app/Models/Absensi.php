<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
   protected $table = 'absensi';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'waktu_masuk',
        'waktu_pulang',
        'status'
    ];

public function siswa()
{
    return $this->belongsTo(\App\Models\Siswa::class);
}

}
