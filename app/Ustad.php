<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ustad extends Model
{
    protected $table = 'ustad';
    protected $primaryKey = 'id_ustad';
    public $timestamps = true;
    protected $fillable = [
        'nama_lengkap',
        'nip',
        'tmp_lahir',
        'tgl_lahir',
        'alamat_ustad',
        'jenis_kelamin',
        'thn_ajaran',
        'no_hp_ustad',
        'profile_img',
    ];
    // protected $hidden = ['password', 'rememberToken'];
    protected $hidden = ['password'];
}
