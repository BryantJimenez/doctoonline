<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryExam extends Model
{
    protected $table = 'category_exams';

    protected $fillable = ['name', 'slug'];

    public function subcategories()
    {
      	return $this->hasMany(Subcategory::class);
    }
}
