<?php

namespace App\Http\Controllers;

use App\Models\UserHDDG;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::table("userhddg");
        $query = $query->select("*")->where("permission", "!=", "admin")->orderby("id");

        $data = $query->paginate(100); 
    //    $tieuchuans = DB::table('tieuchuans')->get();
        return view('user.hddg.users',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
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
       
        // return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function delete($id)
    {
        $userDelete = UserHDDG::find($id);
        $userDelete->delete();

        return redirect('/users-hddg');
        alert('Đã xóa thành công minh chứng');
    }
    public function search(Request $request)
    {
        $query = DB::table("users");
        if($request->isMethod('post')){
            $name = $request->input("name");
            $email = $request->input("email");
            $query = $query ->where('name', 'like', '%' .  $name . '%')->where('email', 'like', '%' .  $email . '%');
                      
                            
        }
        $data =  $query->orderby("id")->select("*") -> get();
        return view('/user/timuser') -> with("data",$data);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
