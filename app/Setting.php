<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['terms', 'banner', 'about', 'mission', 'vision', 'phone', 'email', 'address', 'facebook', 'twitter', 'instagram', 'interval'];
}
