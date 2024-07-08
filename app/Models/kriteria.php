<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias';
    protected $primaryKey = 'id_kriterias';
    public $timestamps = false; // Menonaktifkan timestamps otomatis

    protected $fillable = [
        'code', 'nama', 'type', 'bobot',
    ];
}
