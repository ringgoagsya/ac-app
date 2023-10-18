<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    use HasFactory;
    protected $fillable = ['id_lokasi','nama_lokasi'];

    public function ac()
    {
        return $this->hasMany(ac::class, 'id_ac', 'id_ac');
    }
}
