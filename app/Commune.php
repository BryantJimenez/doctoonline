<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
	protected $fillable = [
		'name', 
		'province_id'
	];

    public function people()
    {
      	return $this->hasMany(People::class);
    }

    public function province()
    {
      	return $this->belongsTo(Province::class);
    }
}
