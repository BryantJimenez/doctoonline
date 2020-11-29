<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['slug', 'reason', 'select_personal_history', 'personal_history', 'select_surgical_history', 'surgical_history', 'select_family_history', 'family_history', 'medicines', 'foods', 'others_allergies', 'tobacco', 'number_cigarettes', 'years_smoker', 'alcohol', 'number_liters', 'years_taker', 'drugs', 'years_consumption', 'indicate_drugs', 'disease_current', 'weight', 'height', 'temperature', 'pulse', 'systolic_pressure', 'dystolic_pressure', 'frequency', 'mucous', 'head_neck', 'respiratory', 'cardiovascular', 'abdomen', 'others_exams', 'order', 'recipe', 'report', 'phase', 'state', 'patient_id', 'doctor_id'];

    public function patient() {
		return $this->belongsTo(Patient::class);
	}

	public function doctor() {
		return $this->belongsTo(Doctor::class);
	}

    public function diseases() {
        return $this->hasMany(DiseaseReport::class);
    }

    public function operations() {
        return $this->belongsToMany(Operation::class)->withTimestamps();
    }

    public function familiars() {
        return $this->hasMany(FamiliarReport::class);
    }

	public function exams()
    {
      	return $this->hasMany(ExamReport::class);
    }

    public function images()
    {
        return $this->hasMany(ImageReport::class);
    }
}
