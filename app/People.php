<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordCustomNotification;

class People extends Model
{
	use Notifiable;

    protected $fillable = ['dni', 'verify_digit', 'name', 'first_lastname', 'second_lastname', 'phone', 'photo', 'slug', 'gender', 'email', 'password', 'type', 'celular', 'address', 'postal', 'commune_id', 'birthday', 'country_id'];

    protected $hidden = [
        'password'
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordCustomNotification($token));
    }

    public function commune() {
		return $this->belongsTo(Commune::class);
	}

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function patient() {
        return $this->hasOne(Patient::class);
    }

	public function doctor() {
		return $this->hasOne(Doctor::class);
	}

    public function doctor_service() {
        return $this->hasMany(DoctorService::class);
    }
}
