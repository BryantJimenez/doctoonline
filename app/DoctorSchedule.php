<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $table = 'doctor_schedule';

    protected $fillable = ['day', 'start', 'end', 'service_id', 'price', 'doctor_id'];

    public function doctor() {
        return $this->belongsTo(DiaryDoctor::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
