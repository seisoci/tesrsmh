<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $config = array(
        "page_title"         => "Users",
        "page_description"   => "Manage Users list",
      );
      if ($request->ajax()) {
          $data = User::query();
          return Datatables::eloquent($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $actionBtn = '<a href="users/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelete" data-id="'. $row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                  return $actionBtn;
              })->make(true);

      }
      return view('backend.users.index', compact('config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $config = array(
        "page_title"    => "Create Users",
        "title"         => "Create Users",
      );
      return view('backend.users.create', compact('config'));
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
        'name'      => 'required',
        'email'     => 'required|email',
        'active'    => 'required|between:0,1',
        'password'  => 'required|string',
      ]);

      if($validator->passes()){
        $data             = new User();
        $data->name       = $request->name;
        if(!empty($request->password)){
          $data->password = Hash::make($request->password);
        }
        $data->email      = $request->email;
        $data->active     = $request->active;

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $config = array(
        "page_title"    => "Edit Users",
        "title"         => "Edit Users",
      );
      $data = User::findOrFail($id);

      return view('backend.users.edit',compact('config', 'data'));
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
        'name'      => 'required',
        'email'     => 'required|email',
        'active'    => 'required|between:0,1',
      ]);

      $data = User::find($id);
      if($validator->passes()){
        $data->name       = $request->name;
        if(!empty($request->password)){
          $data->password   = Hash::make($request->password);
        }
        $data->email      = $request->email;
        $data->active     = $request->active;

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
      $data = User::find($id);
      if($data->delete()){
          $response = response()->json([
              'status' => 'success',
              'message' => 'Data has been saved'
          ]);
      }
      return $response;
    }
}
