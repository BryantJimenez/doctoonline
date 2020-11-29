<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $fillable = ['number_doctor', 'inscription', 'signature', 'state', 'profession_id', 'people_id'];

	public function people() {
		return $this->belongsTo(People::class);
	}

	public function profession() {
		return $this->belongsTo(Profession::class);
	}

	public function specialties() {
		return $this->belongsToMany(Specialty::class)->withTimestamps();
	}

	public function reports() {
		return $this->hasMany(Report::class);
	}

	public function diary_doctor() {
		return $this->hasOne(DiaryDoctor::class);
	}
}
