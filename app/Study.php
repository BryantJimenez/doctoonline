<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = ['name', 'slug'];

    public function patients()
    {
      	return $this->hasMany(Patient::class);
    }
}
