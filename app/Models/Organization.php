<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'name',
    'position',
    'year'
  ];

  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }

  public function getNameAttribute($value)
  {
      return ucwords($value);
  }

  public function getPositionAttribute($value)
  {
      return ucwords($value);
  }
}
