<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorService extends Model
{
    protected $table = 'doctor_service';

    protected $fillable = ['service_id', 'specialty_id', 'people_id'];

    public function diary_service() {
        return $this->belongsTo(DiaryService::class, 'service_id');
    }

    public function specialty() {
        return $this->belongsTo(Specialty::class);
    }

    public function people() {
        return $this->belongsTo(People::class);
    }
}
