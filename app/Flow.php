<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    protected $fillable = ['method', 'flow_order', 'token', 'payment_id'];
	
	public function payment() {
		return $this->belongsTo(Payment::class);
	}
}
