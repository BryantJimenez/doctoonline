<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceVisit extends Model
{
    protected $table = 'service_visit';

    protected $fillable = ['service_id', 'visit_id'];
}
