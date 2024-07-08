<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';
    
    // Tentukan nama kolom kunci primer
    protected $primaryKey = 'id_alternatif';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'gambar',
    ];

    // Jika kunci primer bukan bilangan bulat auto-increment, tentukan tipe data kuncinya
    public $incrementing = true;
    protected $keyType = 'int';
}
