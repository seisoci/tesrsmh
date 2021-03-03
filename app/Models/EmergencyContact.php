<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'full_name',
    'relationship',
    'phone',
    'address'
  ];

  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }

  public function getFullNameAttribute($value)
  {
      return ucwords($value);
  }

  public function getRelationshipAttribute($value)
  {
      return ucwords($value);
  }

  public function getAddressAttribute($value)
  {
      return ucwords($value);
  }
}
