<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $primaryKey = 'id_penilaian';
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Ambil semua kolom kecuali id_penilaian
        $columns = Schema::getColumnListing($this->table);
        $this->fillable = array_diff($columns, [$this->primaryKey]);
    }

    public function karakter()
    {
        return $this->belongsTo(Karakter::class, 'karakter_id_karakter', 'id_karakter');
    }

    public function bobot()
    {
        return $this->belongsTo(Bobot::class, 'penilaian_id_bobot', 'id_bobot');
    }
}
