<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'full_name',
    'gender',
    'relationship',
    'last_education',
    'birthplace',
    'birthdate',
  ];

  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }

  public function getFullNameAttribute($value)
  {
      return ucwords($value);
  }

  public function getGenderAttribute($value)
  {
    if($value == 'M'){
      return 'Laki-laki';
    }
    return 'Perempuan';
  }

  public function getRelationshipAttribute($value)
  {
      return ucwords($value);
  }

  public function getBirthplaceAttribute($value)
  {
      return ucwords($value);
  }

  public function getLastEducationAttribute($value)
  {
      return strtoupper($value);
  }


}
