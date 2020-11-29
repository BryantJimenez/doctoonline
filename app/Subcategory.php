<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name', 'slug', 'code', 'category_id'];

    public function category() {
        return $this->belongsTo(CategoryExam::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class)->withPivot('slug')->withTimestamps();
    }
}
