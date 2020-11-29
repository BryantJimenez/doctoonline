<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubcategoryDiary extends Model
{
	protected $table = 'subcategory_diary';

    protected $fillable = ['name', 'slug', 'code', 'state', 'category_id'];

    public function category() {
        return $this->belongsTo(CategoryDiary::class);
    }

    public function schedules() {
        return $this->hasMany(ScheduleSubcategory::class, 'subcategory_id');
    }

    public function exam_services() {
        return $this->hasMany(ExamService::class, 'subcategory_id');
    }
}
