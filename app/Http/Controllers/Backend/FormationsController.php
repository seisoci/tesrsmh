<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class FormationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $config = array(
        "page_title"         => "Formations",
        "page_description"   => "Manage Formation Applicants list",
      );
      if ($request->ajax()) {
        $data = Formation::query();
        return Datatables::eloquent($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modalEdit" data-id="'. $row->id.'" data-name="'.$row->name.'" data-description="'.$row->description.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelete" data-id="'. $row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })->make(true);

      }
      return view('backend.formations.index', compact('config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name'        => 'required|string|unique:formations,name',
        'description' => 'required|string',
      ]);

      if($validator->passes()){
        Formation::create($request->except('_token'));
        $response = response()->json([
          'status'  => 'success',
          'message' => 'Data has been saved'
        ]);
      }else{
        $response = response()->json(['error'=>$validator->errors()->all()]);
      }
      return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'name'        => 'required|string',
        'description' => 'required|string',
      ]);

      if($validator->passes()){
        $data = Formation::find($id);
        $data->name        = $request->name;
        $data->description = $request->description;
        $data->save();
        if($data->save()){
          $response = response()->json([
            'status' => 'success',
            'message' => 'Data has been saved'
          ]);
        }
      }else{
        $response = response()->json(['error'=>$validator->errors()->all()]);
      }
      return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Formation::find($id);
      if($data->delete()){
          $response = response()->json([
              'status' => 'success',
              'message' => 'Data has been saved'
          ]);
      }
      return $response;
    }
}
