<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //untuk mengisi data
    protected $fillable = [
        'user_id',
        'nisn',
        'kelas',
        'jurusan',
    ];

    //relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relasi ke nilai
    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
}
