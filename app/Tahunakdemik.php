<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahunakdemik extends Model
{
    protected $table = 'tahun_akademik';
    protected $primaryKey = 'id_tahun_akademik';
    protected $fillable = ['nama', 'status'];
    public $timestamps = true;
}
