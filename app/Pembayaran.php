<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = array('nama', 'kamar', 'spp');
    public $timestamps = true;

    public function getSantri()
    {
        return $this->belongsTo('App\Santri', 'nama');
    }

    public function getKamar()
    {
        return $this->belongsTo('App\Kamar', 'kamar');
    }
    public function getSpp()
    {
        return $this->belongsTo('App\Spp_pondok', 'spp');
    }
    public function getRegisKamar()
    {
        return $this->belongsToMany('');
    }
}
