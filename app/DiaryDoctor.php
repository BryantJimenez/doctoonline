<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaryDoctor extends Model
{
    protected $table = 'diary_doctor';

    protected $fillable = ['description', 'rating', 'url', 'state', 'doctor_id'];

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function schedules() {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }
}
