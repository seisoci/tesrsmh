<?php

namespace App\Http\Controllers\Backend;

use App\Facades\Fileupload;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Validator;

class UsersController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
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
            })->editColumn('image', function(User $user){
                return !empty($user->image) ? asset("storage/images/thumbnail/$user->image") : asset('media/users/blank.png');
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
      $data = array(
        'roles' => Role::select('name')->where('name', '!=', 'super-admin')->get()
      );
      return view('backend.users.create', compact('data', 'config'));
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
        'password'  => 'required|confirmed',
        'role'      => 'required|string',
        'profile_avatar'         => 'image|mimes:jpg,png,jpeg|max:2048',
        'profile_avatar_remove'  => 'between:0,1,NULL'
      ]);

      if($validator->passes()){
        $image = NULL;
        $dimensions = [array('300', '300', 'thumbnail')];
        DB::beginTransaction();
        try {
          if(isset($request->profile_avatar) && !empty($request->profile_avatar)){
            $image = Fileupload::uploadImagePublic('profile_avatar', $dimensions);
          }
          $user = User::create([
            'name'      => $request->input('name'),
            'password'  => Hash::make($request->password),
            'email'     => $request->input('email'),
            'active'    => $request->input('active'),
            'image'     => $image,
          ]);

          $user->assignRole($request->role);
          DB::commit();
          $response = response()->json([
              'status' => 'success',
              'message' => 'Data has been saved'
          ]);
        } catch (\Exception $e) {
          DB::rollback();
          $base_path = "public/images";
          Storage::delete(["$base_path/original/$image", "$base_path/thumbnail/$image"]);
          $response = response()->json([
              'status' => 'error',
              'error' => ['Email Already Exists']
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
      $user = User::findOrFail($id);
      $userRole = $user->roles->first();
      $roles = Role::query()->select('name');
      $roles->when($userRole->name == 'super-admin', function($q){
        return $q->where('name', '=', 'super-admin')->pluck('name','name');
      });
      $roles->when($userRole->name != 'super-admin', function($q){
        return $q->where('name', '!=', 'super-admin')->pluck('name','name');
      });
      $data = array(
        'user' => $user,
        'roles' => $roles->get(),
        'userRole' => $userRole
      );

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
        'password'  => 'confirmed',
        'role'      => 'required|string',
        'profile_avatar'         => 'image|mimes:jpg,png,jpeg|max:2048',
        'profile_avatar_remove'  => 'between:0,1,NULL'
      ]);

      $data = User::findOrFail($id);
      $userRole = $data->roles->first();
      $base_path = "public/images";
      if($validator->passes()){
        $image = NULL;
        $dimensions = [array('300', '300', 'thumbnail')];
        DB::beginTransaction();
        try {
          if(isset($request->profile_avatar) && !empty($request->profile_avatar)){
            $image = Fileupload::uploadImagePublic('profile_avatar', $dimensions);
            Storage::delete(["$base_path/original/$data->image", "$base_path/thumbnail/$data->image"]);
          }
          $data->update([
            'name'      => $request->input('name'),
            'password'  => Hash::make($request->password),
            'email'     => $request->input('email'),
            'active'    => $request->input('active'),
            'image'     => $image,
          ]);
          $data->removeRole($userRole->name);
          $data->assignRole($request->role);
          DB::commit();
          $response = response()->json([
              'status' => 'success',
              'message' => 'Data has been saved'
          ]);
        } catch (\Exception $e) {
          DB::rollback();
          Storage::delete(["$base_path/original/$image", "$base_path/thumbnail/$image"]);
          $response = response()->json([
              'status' => 'error',
              'error' => ['Email Already Exists']
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

  public function resetpassword(Request $request){
    $validator = Validator::make($request->all(), [
      'id'        => 'required|integer',
    ]);

    if($validator->passes()){
      $data = User::find($request->id);
      $data->password = Hash::make($data->username);
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

  public function changepassword(Request $request, $id){
    $validator = Validator::make($request->all(), [
      'old_password' => ['required', new MatchOldPassword($id)],
      'password'     => 'required|between:6,255|confirmed',
    ]);


    if($validator->passes()){
      $data = User::find($id);
      $data->password = Hash::make($request->password);
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
}
