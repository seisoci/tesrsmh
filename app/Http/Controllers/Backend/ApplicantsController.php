<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Formation;
use Illuminate\Http\Request;
use DataTables;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $config = array(
        "page_title"         => "Applicants",
        "page_description"   => "Manage Applicants list",
      );
      if ($request->ajax()) {
        $formation = $request->formation;
        $data = Applicant::with('formation:id,name', 'others:id,applicant_id,answer_10')
        ->when($formation, function ($query, $formation) {
          return $query->where('formation_id', $formation);
        });
        return Datatables::eloquent($data)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="/uploads/'.$row->others->answer_10.'" class="btn btn-info btn-sm">CV</a>
            <a href="/backend/applicants/'.$row->id.'" class="edit btn btn-success btn-sm">Detail</a> <a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelete" data-id="'. $row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })->make(true);
      }
      return view('backend.applicants.index', compact('config'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $config = array(
        "page_title"         => "Applicant Details",
        "page_description"   => "Applicants Details",
      );
      $data = Applicant::with(['dependent', 'family', 'emergencycontact', 'education', 'organization', 'training', 'foreignlanguage', 'workexperience','others'])->where('id', $id)->firstOrFail();
      return view('backend.applicants.show', compact('data', 'config'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Applicant::find($id);
      if($data->delete()){
          $response = response()->json([
              'status' => 'success',
              'message' => 'Data has been saved'
          ]);
      }
      return $response;
    }

    public function select2(Request $request){
      $page = $request->page;
      $resultCount = 5;
      $offset = ($page - 1) * $resultCount;
      $data = Formation::where('name', 'LIKE', '%' . $request->q. '%')
          ->orderBy('name')
          ->skip($offset)
          ->take($resultCount)
          ->selectRaw('id, name as text')
          ->get();

      $count = Count(Formation::where('name', 'LIKE', '%' . $request->q. '%')
          ->orderBy('name')
          ->selectRaw('id, name as text')
                              ->get());

      $endCount = $offset + $resultCount;
      $morePages = $count > $endCount;

      $results = array(
        "results" => $data,
        "pagination" => array(
            "more" => $morePages
        )
      );

      return response()->json($results);
    }
}
