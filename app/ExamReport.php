<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamReport extends Model
{
    protected $table = 'exam_reports';

    protected $fillable = ['results', 'report_id', 'exam_id'];

    public function report() {
        return $this->belongsTo(Report::class);
    }

    public function exam() {
        return $this->belongsTo(Exam::class);
    }
}
