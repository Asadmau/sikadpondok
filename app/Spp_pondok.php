<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spp_pondok extends Model
{
    protected $table = 'spp_pondok';
    protected $primaryKey = 'id_spp';
    // protected $fillable = array('total');
    protected $fillable = ['nama', 'total'];
    public $timestamps = true;
}
