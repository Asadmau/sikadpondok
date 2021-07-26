<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    protected $fillable = ['nama', 'kapasitas', 'ketua_id', 'kategori'];
    public $timestamps = true;

    public function getKetua()
    {
        return $this->belongsTo('App\Pengurus', 'ketua_id');
    }
}
