<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignLanguage extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'language',
    'listening',
    'speaking',
    'writing'
  ];


  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }

  public function getLanguageAttribute($value)
  {
      return strtoupper($value);
  }

  public function getListeningAttribute($value)
  {
    if($value){
      return 'Ya';
    }
    return 'Tidak';
  }

  public function getSpeakingAttribute($value)
  {
    if($value){
      return 'Ya';
    }
    return 'Tidak';
  }

  public function getWritingAttribute($value)
  {
    if($value){
      return 'Ya';
    }
    return 'Tidak';
  }
}
