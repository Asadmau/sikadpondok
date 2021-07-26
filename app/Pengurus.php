<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';
    protected $primaryKey = 'id_pengurus';
    protected $fillable = ['nik', 'nama_pengurus', 'tmp_lahir', 'tgl_lahir', 'jk', 'alamat', 'thn_akademik', 'foto_pengurus'];

    public $timestamps = true;
}
