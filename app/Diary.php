<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $fillable = ['slug', 'dni', 'verify_digit', 'name', 'lastname', 'email', 'gender', 'birthday', 'phone', 'date', 'time', 'amount', 'state', 'payment_id'];

    public function diary_service() {
        return $this->hasOne(DiaryService::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
