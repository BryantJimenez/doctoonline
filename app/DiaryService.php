<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaryService extends Model
{
    protected $table = 'diary_service';

    protected $fillable = ['price', 'diary_id', 'service_id'];

    public function diary() {
        return $this->belongsTo(Diary::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function exam_service() {
        return $this->hasOne(ExamService::class, 'service_id');
    }

    public function doctor_service() {
        return $this->hasOne(DoctorService::class, 'service_id');
    }
}
