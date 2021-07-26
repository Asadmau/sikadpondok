<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regiskelas extends Model
{
    protected $table = 'regis_kelas';
    protected $primaryKey = 'id_regis_kelas';
    protected $fillable = ['nama', 'kelas'];
    public $timeetamps = true;

    public function getSantri()
    {
        return $this->belongsTo('App\Santritpq', 'nama');
    }

    public function getTahunAkademik()
    {
        return $this->belongsTo('App\Tahunakdemik', 'tahun_akademik');
    }

    public function getKelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas');
    }
}
