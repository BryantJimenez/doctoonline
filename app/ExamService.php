<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamService extends Model
{
    protected $table = 'exam_service';

    protected $fillable = ['service_id', 'subcategory_id'];

    public function diary_service() {
        return $this->belongsTo(DiaryService::class);
    }

    public function subcategory_diary() {
        return $this->belongsTo(SubcategoryDiary::class, 'subcategory_id');
    }
}
