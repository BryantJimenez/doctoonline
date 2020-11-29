<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	protected $table = 'countries';
    public $timestamps = false;

    protected $fillable = [
		'name', 
		'code'
	];

    public function people()
	{
	  	return $this->HasMany(People::class);
	}
}
