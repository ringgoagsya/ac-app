<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tr_service extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_ac','tanggal_service','start_time','stop_time','keterangan','id_teknisi'];
    public function ac()
    {
        return $this->belongsTo(ac::class, 'id_ac', 'id_ac');
    }
    public function teknisi()
    {
        return $this->belongsTo(teknisi::class, 'id_teknisi', 'id_teknisi');
    }
}
