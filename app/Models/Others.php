<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Others extends Model
{
  use HasFactory;

  protected $fillable = [
    'applicant_id',
    'answer_1',
    'answer_2',
    'answer_3',
    'answer_4',
    'answer_5',
    'answer_6',
    'answer_7',
    'answer_8',
    'answer_9',
    'answer_10'
  ];

  public function applicant()
  {
    return $this->belongsTo(Applicant::class);
  }
}
