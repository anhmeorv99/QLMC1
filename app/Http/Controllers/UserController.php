<?php

namespace App\Http\Controllers;

use App\Models\UserHDDG;

use App\Models\UserDVBC;
use App\Models\DVBC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use DataTables;
use DB;


class UserController extends Controller
{
    // public function index_hddg()
    // {
    //     $query = DB::table("userhddg");
    //     $query = $query->select("*")->where("permission", "!=", "admin")->orderby("id");

    //     $data = $query->paginate(100); 
    //     return view('user.hddg.users',$data);
    // }

    public function index_hddg()
    {
        $data = [];
        $list = UserHDDG::where("permission", "!=", "admin")->orderby("id", "asc")->get();
        $data['list']= $list;
        return view('user.hddg.users_hddg', $data);
    }

    public function list_hddg(Request $request)
    {
        $data = DB::table("userhddg")->select("*")->where("permission", "!=", "admin")->orderby("id");
        // echo json_encode($data);
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                     
                    $actionBtn ='<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="bi bi-trash3"></i>
                  </button>
                  
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Xóa người dùng</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            Xác nhận xóa người dùng này?
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-success" data-dismiss="modal" href='.route('delete-user-hddg').'>Đồng Ý</a>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" >Hủy</button>
                        </div>
                      </div>
                    </div>
                  </div>'; 
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
  
    public function create_hddg(Request $request)
    {   

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            "username" => "required|string|max:255|unique:userhddg,username",
            'email' => 'required|string|email|max:255|unique:userhddg,email',
            'password' => 'required|string|min:6|confirmed',
            'permission' => 'required|string|max:255|in:admin,mod',
        ]);
        // if($request->isMethod('post')){
        if ($validator->fails()) {
            return new JsonResponse(['errors'=>$validator->getMessageBag()->toArray()], 406);
        }else{
                // $user = UserHDDG::where('username', '=', strtolower($request->input('username')))->first();
                // if ($user === null) {
                    $user = UserHDDG::create([
                        'name' => trim($request->input('name')),
                        'username' => strtolower($request->input('username')),
                        'email' => strtolower($request->input('email')),
                        'password' => bcrypt($request->input('password')),
                        'permission' => trim($request->permission),
                        'address' => trim($request->input('address')),
                        'phone' => trim($request->input('phone')),
                    ]);
                    // session()->flash('success', 'Your account is created');
                    // return Redirect::to("/users-hddg");
                // }
                // return redirect()->back()->with('error', 'username already exists'); 
                return new JsonResponse($user, 200);  
                
            
    
        }
        // else{
        //     return view('user.hddg.register');
        // }
       
    }

    public function update_hddg(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            "username" => "required|string|max:255",
            'email' => 'required|string|email|max:255',
            'permission' => 'required|string|max:255|in:admin,mod',
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['errors'=>$validator->getMessageBag()->toArray()], 406);
        }else{
            $user = UserHDDG::find($request->input('id'));
            if($user->username != $request->input('username')){
                $checkUserName = UserHDDG::where('username', '=', strtolower($request->input('username')))->count();
                if($checkUserName >0){
                    return new JsonResponse(['errors'=>['username'=>'username exists']], 406);
                }
            }
            if($user->email != $request->input('email')){
                $checkEmail = UserHDDG::where('email', '=', strtolower($request->input('email')))->count();
                if($checkEmail > 0){
                    return new JsonResponse(['errors'=>['email'=>'email exists']], 406);
                }
            }

            $user->name = trim($request->input('name'));
            $user->username = strtolower($request->input('username'));
            $user->email = strtolower($request->input('email'));
            $user->permission = trim($request->permission);
            $user->address = trim($request->input('address'));
            $user->phone = trim($request->input('phone'));
            $user->save();
            return new JsonResponse($user, 200);
        }
    }

    public function delete_hddg(Request $request)

    {
        $userDelete = UserHDDG::find($request->id);
        $userDelete->delete();

        return new JsonResponse(['status' => 'success', 'message' => 'Đã xóa thành công tài khoản hội đồng đánh giá'], 200);
    }


    public function index_dvbc()
    {
        $list = UserDVBC::orderby("id", "asc")->get();
        $listDVBC = DVBC::orderby("id", "asc")->get();
        return view('user.dvbc.users_dvbc', compact(['list', 'listDVBC']));
    }

    public function create_dvbc(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            "username" => "required|string|max:255|unique:userdvbc,username",
            'email' => 'required|string|email|max:255|unique:userdvbc,email',
            'password' => 'required|string|min:6|confirmed',
            'id_dvbc' => 'required|integer',
        ]);
        $dvbcRecord = DVBC::where('id', $request['id_dvbc'])->get();
        if ($validator->fails()) {
            return new JsonResponse(['errors'=>$validator->getMessageBag()->toArray()], 406);
        }else{
                    $user = UserDVBC::create([
                        'name' => trim($request->input('name')),
                        'username' => strtolower($request->input('username')),
                        'email' => strtolower($request->input('email')),
                        'password' => bcrypt($request->input('password')),
                        'address' => trim($request->input('address')),
                        'phone' => trim($request->input('phone')),
                        'id_dvbc' => trim($request->input('id_dvbc')),
                    ]);
                    return new JsonResponse(['user' => $user, 'ten_dvbc'=>$dvbcRecord[0]['ten_dvbc']], 200);  
        }
    }

    // id, name, username, password, email, phone, address, id_dvcbc, create_at, update_at
    public function update_dvbc(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            "username" => "required|string|max:255",
            'email' => 'required|string|email|max:255',
            'id_dvbc' => 'required|integer',
            'id' => 'required|integer',
        ]);
        $dvbcRecord = DVBC::where('id', $request['id_dvbc'])->get();
        if ($validator->fails()) {
            return new JsonResponse(['errors'=>$validator->getMessageBag()->toArray()], 406);
        }else{
            $user = UserDVBC::find($request->input('id'));
            if($user->username != $request->input('username')){
                $checkUserName = UserDVBC::where('username', '=', strtolower($request->input('username')))->count();
                if($checkUserName >0){
                    return new JsonResponse(['errors'=>['username'=>'username exists']], 406);
                }
            }
            if($user->email != $request->input('email')){
                $checkEmail = UserDVBC::where('email', '=', strtolower($request->input('email')))->count();
                if($checkEmail > 0){
                    return new JsonResponse(['errors'=>['email'=>'email exists']], 406);
                }
            }

            $user->name = trim($request->input('name'));
            $user->username = strtolower($request->input('username'));
            $user->email = strtolower($request->input('email'));
            $user->address = trim($request->input('address'));
            $user->phone = trim($request->input('phone'));
            $user->id_dvbc = trim($request->input('id_dvbc'));
            $user->save();
            return new JsonResponse(['user' => $user, 'ten_dvbc'=>$dvbcRecord[0]['ten_dvbc']], 200); 
        }
    }

    public function delete_dvbc(Request $request)
    {
        $userDelete = UserDVBC::find($request->id);
        $userDelete->delete();

        return new JsonResponse(['status' => 'success', 'message' => 'Đã xóa thành công tài khoản đơn vị báo cáo'], 200);
    }

}