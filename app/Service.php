<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'banner', 'title', 'description', 'line', 'icon', 'diary_title', 'diary_description', 'app_title', 'app_description', 'feaured', 'type', 'state'];

    public function schedule_subcategory() {
        return $this->hasMany(ScheduleSubcategory::class);
    }

    public function schedule_doctor() {
        return $this->hasMany(DoctorSubcategory::class);
    }

    public function diary_services() {
        return $this->hasMany(DiaryService::class);
    }

    public function visits(){
        return $this->belongsToMany(Visit::class)->withTimestamps();
    }
}
