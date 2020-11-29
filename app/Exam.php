<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['slug', 'subcategory_id', 'type_id'];

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function report_exams()
    {
        return $this->hasMany(ExamReport::class);
    }

    public function images()
    {
        return $this->hasMany(ImageReport::class);
    }
}
