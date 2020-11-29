<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $fillable = ['name', 'slug'];

    public function doctors()
    {
      	return $this->hasMany(Doctor::class);
    }
}
