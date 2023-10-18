<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;
    protected $fillable = ['id_area','nama_area'];
    public function lokasi()
    {
        return $this->hasMany(lokasi::class, 'id_lokasi', 'id_lokasi');
    }

}
