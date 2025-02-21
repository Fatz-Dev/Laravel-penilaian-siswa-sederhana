<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    //untuk mengisi data
    protected $fillable = [
        'siswa_id',
        'nilai',
        'catatan',
    ];

    //relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
