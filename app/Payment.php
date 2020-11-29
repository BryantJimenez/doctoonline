<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['slug', 'subject', 'method', 'currency', 'amount', 'fee', 'taxes', 'balance'];

    public function flows() {
        return $this->hasMany(Flow::class);
    }

    public function diary() {
        return $this->hasOne(Diary::class);
    }
}
