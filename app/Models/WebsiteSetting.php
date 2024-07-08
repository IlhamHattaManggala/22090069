<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;
    protected $table = 'webs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama', 'logo',
    ];
    public function getBase64ImageAttribute()
    {
        return 'data:image/jpeg;base64,' . base64_encode($this->attributes['logo']);
    }
}

