<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regiskamar extends Model
{
    protected $table = 'regis_kamar';
    protected $primaryKey = 'id_regis_kamar';
    protected $fillable = ['kamar', 'nama'];
    public $timestamps = true;


    public function getKamar()
    {
        return $this->belongsTo('App\Kamar', 'kamar');
    }

    public function getSantri()
    {
        return $this->belongsTo('App\Santri', 'nama');
    }
    public function getTahunAkademik()
    {
        return $this->belongsTo('App\Tahunakdemik', 'tahun_akademik');
    }
}
