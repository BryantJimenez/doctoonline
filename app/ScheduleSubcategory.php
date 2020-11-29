<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleSubcategory extends Model
{
    protected $table = 'schedule_subcategory';

    protected $fillable = ['day', 'start', 'end', 'service_id', 'price', 'subcategory_id'];

    public function subcategory() {
        return $this->belongsTo(SubcategoryDiary::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
