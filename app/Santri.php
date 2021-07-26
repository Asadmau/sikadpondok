<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santri';
    protected $primaryKey = 'id_santri';
    protected $fillable = ['nis', 'nama', 'tmp_lahir', 'tgl_lahir', 'jenis_kelamin', 'jenjang', 'alamat', 'tahun_akademik', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'foto_santri', 'foto_wali', 'nope', 'status', 'kategori'];
    public $timestamps = true;

    public function getTahunAkademik()
    {
        return $this->belongsTo('App\Tahunakdemik', 'tahun_akademik');
    }

    public function getPekerjaanAyah()
    {
        return $this->belongsTo('App\Pekerjaan', 'pekerjaan_ayah');
    }
    public function getPekerjaanIbu()
    {
        return $this->belongsTo('App\Pekerjaan', 'pekerjaan_ibu');
    }
}
