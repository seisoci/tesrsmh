<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'institution_name',
    'city',
    'majors',
    'graduation_year',
    'gpa',
    'continue_education',
  ];


  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }

  public function getInstitutionNameAttribute($value)
  {
      return strtoupper($value);
  }

  public function getContinueEducationAttribute($value)
  {
    if($value){
      return 'Ya';
    }
    return 'Tidak';
  }

  public function getMajorsAttribute($value)
  {
      return strtoupper($value);
  }

  public function getCityAttribute($value)
  {
      return ucwords($value);
  }
}
