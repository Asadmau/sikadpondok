<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santritpq extends Model
{
    protected $table = 'santritpq';
    protected $primaryKey = 'id_santri_tpq';
    public $timestamps = true;
    protected $fillable = array('nisn', 'nama', 'tmp_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'jenjang', 'alamat', 'nama_ayah', 'pekerjaan_ayah', 'photo_ayah', 'nama_ibu', 'pekerjaan_ibu', 'photo_ibu', 'hp_wa', 'photo_santri', 'tahun_akademik', 'status');

    public function getPekerjaanAyah()
    {
        return $this->belongsTo('App\Pekerjaan', 'pekerjaan_ayah');
    }

    public function getPekerjaanIbu()
    {
        return $this->belongsTo('App\Pekerjaan', 'pekerjaan_ibu');
    }

    public function getTahunAkademik()
    {
        return $this->belongsTo('App\Tahunakdemik', 'tahun_akademik');
    }
}
