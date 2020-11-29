<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecialty extends Model
{
	protected $table = 'doctor_specialty';

    protected $fillable = ['doctor_id', 'specialty_id'];
}
