<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseReport extends Model
{
    protected $table = 'disease_report';

    protected $fillable = ['disease_id', 'report_id'];

    public function report() {
        return $this->belongsTo(Report::class);
    }

    public function disease() {
        return $this->belongsTo(Disease::class);
    }
}
