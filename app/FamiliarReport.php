<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamiliarReport extends Model
{
    protected $table = 'familiar_report';

    protected $fillable = ['disease_id', 'report_id'];

    public function report() {
        return $this->belongsTo(Report::class);
    }

    public function disease() {
        return $this->belongsTo(Disease::class);
    }
}
