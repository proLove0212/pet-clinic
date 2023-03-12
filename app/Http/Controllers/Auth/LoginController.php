<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }

    public function adminLogin(AdminLoginRequest $request)
    {

        if (\Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect()->intended('/petcrew/admin');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'password' => "パスワードが正しくありません。"
        ]);
    }

    public function showUserLoginForm()
    {
        return view('auth.user.login');
    }

    public function userLogin(UserLoginRequest $request)
    {

        $email = $request->input('email');

        $user = User::where("ClinicID", $email)
        ->orWhere("email", $email)
        ->first();

        if($user){

            $cred = [
                'email' => $user->email,
                'password' =>$request->input('password')
            ];

            if (\Auth::attempt( $request->only(['email','password']), $request->get('remember'))){

                if($user->CustStatus == 5){
                    $user->LoginDateTime = Carbon::now();
                    $user->save();

                    return redirect()->intended(route('user.search'));
                }else if($user->CustStatus == 0){
                    return redirect()->intended('/petcrew');
                }
                else{
                    return redirect()->intended(route('user.password.reset'));
                }

            }

            return back()->withInput($request->only('email'))->withErrors([
                'password' => "パスワードが正しくありません。"
            ]);
        }
        return back()->withErrors([
            'email' => "メールアドレスを確認してください。",
            'password' => "パスワードが正しくありません。"
        ]);
    }
}
