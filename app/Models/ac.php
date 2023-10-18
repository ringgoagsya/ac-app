<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ac extends Model
{
    use HasFactory;
    protected $fillable = ['id_ac','id_area','id_lokasi','status','alarm_service','type_lokasi'];
    public function lokasi()
    {
        return $this->belongsTo(lokasi::class, 'id_lokasi', 'id_lokasi');
    }
    public function area()
    {
        return $this->belongsTo(area::class, 'id_area', 'id_area');
    }

    public function tr_service()
    {
        return $this->hasMany(tr_service::class, 'id_ac', 'id_ac');
    }
}
