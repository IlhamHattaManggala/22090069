<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $table = 'message';
    protected $primaryKey = 'id';
    public $timestamps = false; // Menonaktifkan timestamps otomatis

    protected $fillable = [
        'nama_lengkap', 'email', 'alamat', 'pesan',
    ];
}
