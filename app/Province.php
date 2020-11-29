<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
  protected $fillable = [
    'name',
    'region_id'
  ];

  public function communes()
  {
    return $this->hasMany(Commune::class);
  }

  public function region()
  {
    return $this->belongsTo(Region::class);
  }
}
