<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covenant extends Model
{
    protected $fillable = ['name', 'slug', 'email', 'address'];
}
