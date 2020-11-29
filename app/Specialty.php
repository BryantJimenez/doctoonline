<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = ['name', 'slug'];
	
	public function doctors() {
		return $this->belongsToMany(Doctor::class)->withTimestamps();
	}

	public function doctor_service() {
		return $this->hasMany(DoctorService::class);
	}
}
