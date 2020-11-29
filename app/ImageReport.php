<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageReport extends Model
{
	protected $table = 'image_report';

    protected $fillable = ['image', 'report_id', 'exam_id'];
	
	public function report() {
		return $this->belongsTo(Report::class);
	}

	public function exam() {
		return $this->belongsTo(Exam::class);
	}
}
