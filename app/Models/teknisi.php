<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teknisi extends Model
{
    use HasFactory;
    protected $fillable = ['id_teknisi','nama_teknisi','type_teknisi'];
    public function tr_service()
    {
        return $this->hasMany(tr_service::class, 'id_teknisi', 'id_teknisi');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id_teknisi', 'id_teknisi');
    }
}
