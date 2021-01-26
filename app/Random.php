<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Random extends Model
{
    protected $fillable = ['values'];
    public $timestamps = false;

    public function breakdowns()
    {
        return $this->hasMany('App\Breakdown');
    }
}
