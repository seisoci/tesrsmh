<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
    'formation_id',
    'full_name',
    'nickname',
    'birthplace',
    'birthdate',
    'email',
    'gender',
    'religion',
    'status',
    'height',
    'no_identity',
    'address_ktp',
    'npwp',
    'address',
    'phone',
    'phone_2',
  ];

  // protected $casts = [
  //   'created_at' => 'date:Y-m-d H:i:s',
  // ];

  public function getCreatedAtAttribute($value){
    $date = Carbon::parse($value)->timezone('Asia/Jakarta');
    return $date->format('Y-m-d H:i:s');
  }

  public function formation()
  {
    return $this->belongsTo(Formation::class);
  }

      public function dependent()
    {
        return $this->hasOne(Dependent::class);
    }

    public function family()
    {
        return $this->hasMany(Family::class);
    }

    public function emergencycontact()
    {
        return $this->hasOne(EmergencyContact::class);
    }

    public function education()
    {
        return $this->hasOne(Education::class);
    }

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function training()
    {
        return $this->hasOne(Training::class);
    }

    public function foreignlanguage()
    {
        return $this->hasOne(ForeignLanguage::class);
    }

    public function workexperience()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function others()
    {
        return $this->hasOne(Others::class);
    }

    public function getFullNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getNicknameAttribute($value)
    {
        return ucwords($value);
    }

    public function getBirthplaceAttribute($value)
    {
        return ucwords($value);
    }

    public function getRelegionAttribute($value)
    {
        return ucwords($value);
    }

    public function getStatusAttribute($value)
    {
        return ucwords($value);
    }
}
