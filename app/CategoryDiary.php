<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDiary extends Model
{
    protected $table = 'category_diary';

    protected $fillable = ['name', 'slug'];

    public function subcategories()
    {
      	return $this->hasMany(SubcategoryDiary::class, 'category_id');
    }
}
