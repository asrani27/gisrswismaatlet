<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pasien()
    {
        return $this->hasMany(Pasien::class);
    }
}
