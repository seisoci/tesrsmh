<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'name',
    'sector',
    'address',
    'position',
    'date_start',
    'date_end',
    'salary',
    'resign'
  ];

  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }

  public function getNameAttribute($value)
  {
      return ucwords($value);
  }

  public function getSectorAttribute($value)
  {
      return ucwords($value);
  }

  public function getAddressAttribute($value)
  {
      return ucwords($value);
  }

  public function getPositionAttribute($value)
  {
      return ucwords($value);
  }

  public function getSalaryAttribute($value)
  {
      return number_format($value, 2, '.', '');
  }
}
