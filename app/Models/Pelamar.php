<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_kelamin',
        'ttl',
        'sekolah',
        'alamat',
        'tinggi',
        'no_hp',
        'jurusan_id',
        'user_id',
        'cv',
        'ktp',
        'transkip_nilai',
        'ijazah',
        'skil_id',
        'kota'
    ];

    // Definisikan relasi dengan tabel lain jika diperlukan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // Definisikan relasi dengan tabel lain jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Definisikan relasi dengan tabel lain jika diperlukan
    public function skil()
    {
        return $this->belongsTo(Skil::class);
    }
}
