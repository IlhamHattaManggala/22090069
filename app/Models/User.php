<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyEmail;

    protected $table = 'users'; // Pastikan nama tabel benar

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verification_token',
        'email_verified_at',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getBase64ImageAttribute()
    {
        $avatarUrl = $this->attributes['avatar'];

        // Memeriksa apakah avatar adalah URL
        if (filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
            // Mengunduh gambar dari URL
            $imageContent = Http::get($avatarUrl)->body();
            $base64Image = base64_encode($imageContent);
            return 'data:image/jpeg;base64,' . $base64Image;
        }

        // Jika avatar sudah dalam format base64
        return 'data:image/jpeg;base64,' . base64_encode($this->attributes['avatar']);
    }
}
