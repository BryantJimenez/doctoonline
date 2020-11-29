<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'slug'];

    public function exams()
    {
      	return $this->belongsToMany(Subcategory::class)->withPivot('slug')->withTimestamps();
    }
}
