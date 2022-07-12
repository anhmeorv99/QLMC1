<?php

namespace App\Http\Controllers;

use App\Models\UserHDDG;

use App\Models\UserDVBC;
use App\Models\DVBC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;


class UserController extends Controller
{
    public function index_hddg()
    {
        $query = DB::table("userhddg");
        $query = $query->select("*")->where("permission", "!=", "admin")->orderby("id");

        $data = $query->paginate(100); 
        return view('user.hddg.users',$data);
    }
  
    public function create_hddg(Request $request)
    {   
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'permission' => 'required'
            ]);


            if ($request->permission == "admin" or $request->permission == "mod") {
                $user = UserHDDG::where('username', '=', strtolower($request->input('username')))->first();
                if ($user === null) {
                    $user = UserHDDG::create([
                        'name' => trim($request->input('name')),
                        'username' => strtolower($request->input('username')),
                        'email' => strtolower($request->input('email')),
                        'password' => bcrypt($request->input('password')),
                        'permission' => trim($request->permission),
                        'address' => trim($request->input('address')),
                        'phone' => trim($request->input('phone')),
                    ]);
                    session()->flash('success', 'Your account is created');
                    return Redirect::to("/users-hddg");

                }
                return redirect()->back()->with('error', 'username already exists');   
                
            }
            
    
        }
        else{
            return view('user.hddg.register');
        }
       
    }

    public function delete_hddg($id)
    {
        $userDelete = UserHDDG::find($id);
        $userDelete->delete();

        return redirect('/users-hddg');
        alert('Đã xóa thành công minh chứng');
    }


    public function index_dvbc()
    {
        $query = DB::table("userdvbc");
        $query = $query->select("*")->orderby("id");

        $data = $query->paginate(20); 
        return view('user.dvbc.users',$data);
    }


    public function create_dvbc(Request $request)
    {   
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);


                $user = UserDVBC::where('username', '=', strtolower($request->input('username')))->first();
                if ($user === null) {
                    $user = UserDVBC::create([
                        'name' => trim($request->input('name')),
                        'username' => strtolower($request->input('username')),
                        'email' => strtolower($request->input('email')),
                        'password' => bcrypt($request->input('password')),
                        'phone' => trim($request->input('phone')),
                        'address' => trim($request->input('address')),
                        'id_dvbc' => (int)trim($request->id_dvbc),
                    ]);
                    session()->flash('success', 'Your account is created');
                    return Redirect::to("/users-dvbc");

                }
                return redirect()->back()->with('error', 'username already exists');   
                
    
        }
        else{
            $dvbc = DVBC::all();
            return view('user.dvbc.register', compact('dvbc'));
        }
       
    }

    public function delete_dvbc($id)
    {
        $userDelete = UserDVBC::find($id);
        $userDelete->delete();

        return redirect('/users-dvbc');
        alert('Đã xóa thành công minh chứng');
    }

}