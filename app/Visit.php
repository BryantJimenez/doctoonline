<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['visitor', 'device'];

    public function services(){
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
}
