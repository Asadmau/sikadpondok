<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploadimg extends Model
{
    protected $table = 'uploadimg';
    protected $primaryKey = 'id_img';
    protected $fillable = ['nama_img', 'src_img'];

    public $timestamps = true;
}
