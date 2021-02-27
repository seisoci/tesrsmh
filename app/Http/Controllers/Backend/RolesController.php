<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index']]);
        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $config = array(
        "page_title"         => "Roles",
        "page_description"   => "Manage roles and permission every pages",
      );
        if ($request->ajax()) {
          $data = Role::query();
          return Datatables::eloquent($data)
          ->addIndexColumn()
          ->addColumn('action', function($row){
              $actionBtn = '<a href="roles/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelete" data-id="'. $row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
              return $actionBtn;
          })->make(true);

        }
      return view('backend.roles.index', compact('config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $breadcrumbs = [
      ['link'=>"/backend/post",'name'=>"Post"],['name'=>"Create"]
      ];
      $config = array(
        "page_title"    => "Create Roles",
        "title"         => "Create Roles",
      );
      $data = Permission::get();
      return view('backend.roles.create', compact('config', 'data'));
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
            'name'        => 'required|string|unique:roles,name',
            'permission'  => 'required|array',
        ]);

        if($validator->passes()){
          $role = Role::create(['name' => $request->input('name')]);
          $role->syncPermissions($request->input('permission'));
          $response = response()->json([
            'status' => 'success',
            'message' => 'Data has been saved'
          ]);
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
          "page_title"    => "Edit Roles",
          "title"         => "Edit Roles",
        );
        $data = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('backend.roles.edit',compact('config', 'data','permission','rolePermissions'));
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
          'permission'  => 'required|array',
        ]);

        if($validator->passes()){
          $data = Role::find($id);
          $data->name = $request->input('name');
          $data->save();
          $data->syncPermissions($request->input('permission'));
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
      $data = Role::find($id);
      if($data->delete()){
          $response = response()->json([
              'status' => 'success',
              'message' => 'Data has been saved'
          ]);
      }
      return $response;
    }
}
