<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{
    protected $table = 'category_news';

    protected $fillable = ['news_id', 'category_id'];
}
