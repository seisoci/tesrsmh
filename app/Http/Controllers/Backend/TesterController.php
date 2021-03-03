<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;

class TesterController extends Controller
{
  public function __invoke()
  {
    $response = Applicant::with(['dependent', 'family', 'emergencycontact', 'education', 'organization', 'training', 'foreignlanguage', 'workexperience','others'])->get();
    return response()->json($response);
  }
}
