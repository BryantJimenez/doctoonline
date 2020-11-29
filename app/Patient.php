<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['civil_state', 'children', 'laboral', 'state', 'study_id', 'insurer_id', 'people_id'];

    public function study() {
		return $this->belongsTo(Study::class);
	}

	public function insurer() {
		return $this->belongsTo(Insurer::class);
	}

    public function people() {
		return $this->belongsTo(People::class);
	}

	public function reports() {
		return $this->hasMany(Report::class);
	}
}
