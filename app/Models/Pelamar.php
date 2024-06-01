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
        'dokumen_id',
        'skil_id',
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
    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class);
    }

    // Definisikan relasi dengan tabel lain jika diperlukan
    public function skil()
    {
        return $this->belongsTo(Skil::class);
    }
}
