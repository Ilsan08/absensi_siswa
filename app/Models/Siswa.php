<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'qr_code'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI (untuk nanti ke absensi)
    |--------------------------------------------------------------------------
    */
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'siswa_id');
    }
}