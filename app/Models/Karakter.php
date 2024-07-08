<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;

class Karakter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'karakter';
    protected $primaryKey = 'id_karakter';
    public $timestamps = false; // Menonaktifkan timestamps otomatis

    protected $fillable = [
        'nama', 'element', 'region', 'rarity', 'gambar',
    ];

    // Accessor untuk gambar dalam format base64
    public function getBase64Image1Attribute()
    {
        $avatarUrl = $this->attributes['gambar'];

        // Memeriksa apakah avatar adalah URL
        if (filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
            // Mengunduh gambar dari URL
            $imageContent = Http::get($avatarUrl)->body();
            $base64Image = base64_encode($imageContent);
            return 'data:image/jpeg;base64,' . $base64Image;
        }

        // Jika avatar sudah dalam format base64
        return 'data:image/jpeg;base64,' . base64_encode($this->attributes['gambar']);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'karakter_id_karakter', 'id_karakter');
    }
}
