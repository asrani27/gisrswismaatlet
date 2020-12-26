<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = 'marker';
    protected $guarded = ['id'];
    public $timestamps = false;
}
