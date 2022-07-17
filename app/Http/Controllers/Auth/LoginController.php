<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserHDDG;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        if(\Auth::guard('user')->check() || \Auth::guard('admin')->check()){
            return redirect()->route('home');
        }
        $this->middleware('guest')->except('logout');
    }

    use AuthenticatesUsers;

    public function show_login_form()
    {
        return view('auth.login');
    }

    public function show_login_form_admin()
    {
        return view('auth.login-admin');
    }

    public function process_login(Request $request)
    {
        $validator = $request->validate([
            'username' => 'required',
            'password' => 'required',
            "type_user"=>"required",
        ]);

        // $credentials = $request->except(['_token']);

        // $user = UserHDDG::where('username',$request->username)->first();
        // if (auth()->attempt($credentials)) {
        if($request->type_user == "admin"){

            if(\Auth::guard('admin')->attempt(['username'=>$request->username, 'password'=>$request->password])){
                $request->session()->regenerate();
                $this->clearLoginAttempts($request);

                return redirect()->route('home');
            }else{
                $err = [
                    'password' => 'Sai tài khoản hoặc mật khẩu',
                ];
            return redirect()->route('login-admin')->withErrors(
                $err
            );

        }
        }

        if($request->type_user == "user"){
            if(\Auth::guard('user')->attempt(['username'=>$request->username, 'password'=>$request->password])){
                // dd(\Auth::guard('user')->user());
                return redirect()->route('home');
            }else{
            // dd("error");
            // session()->flash('message', 'Invalid credentials');
            $err = [
                'password' => 'Sai tài khoản hoặc mật khẩu',
            ];
            return back()->withErrors(
                $err
            );
        }

        }
    }
    public function show_signup_form()
    {
        return view('auth.register');
    }
    public function process_signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = UserHDDG::create([
            'name' => trim($request->input('name')),
            'username' => strtolower($request->input('username')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        session()->flash('message', 'Your account is created');

        // return redirect()->route('login');
    }
    public function logout(Request $request)
    {

        $this->guard('admin')->logout();
        $this->guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect()->route('login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

}
