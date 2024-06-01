<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];
    
    public function lowongans()
    {
        return $this->belongsToMany(Lowongan::class);
    }
}
