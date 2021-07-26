<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $timestamps = true;
    protected $fillable = array('kode_kelas', 'nama', 'kapasitas', 'jenjang', 'wali_kelas');

    public function getUstad()
    {
        return $this->belongsTo('App\Ustad', 'wali_kelas');
    }
}
