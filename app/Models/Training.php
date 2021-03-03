<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'name',
    'year',
    'expired'
  ];

  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }

  public function getNameAttribute($value)
  {
      return ucwords($value);
  }
}
