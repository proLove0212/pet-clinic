<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserPwdResetRequest;
use Str;
use Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Admin;
use App\Models\User;
use App\Models\MaintainLog;
use Carbon\Carbon;

class AuthController extends Controller
{
    //

    public function admin_login(Request $req){
        Validator::validate($req->input(), [
            'password' => 'required|min:8'
        ]);

        $user = Admin::whereEncrypted("name", "管理者")->first();
        if(Hash::check($req->input('password'), $user->password)){
            $req->session()->put('name', $user->name);
            $req->session()->put('role', 'admin');
            $req->session()->put('email', $user->email);

            return redirect('/petcrew/admin/users');
        }

        $data = [
            'password' => 'パスワードが正しくありません。'
        ];

        return view('auth.admin_login', $data)->withErrors($data);
    }

    public function user_login(UserLoginRequest $req){
        $id = $req->input('id');

        $user = User::where("ClinicID", $id)
        ->orWhere("MailAddress", $id)
        ->first();

        if($user){

            if(Hash::check($req->input('password'), $user->Password)){

                $req->session()->put('name', $user->ClinicName);
                $req->session()->put('role', 'user');
                $req->session()->put('email', $user->MailAddress);
                $req->session()->put('ClinicID', $user->ClinicID);

                if($user->CustStatus == 5){
                    $user->LoginDateTime = Carbon::now();
                    $user->save();

                    return redirect('/petcrew/home');
                }else{
                    return redirect("/petcrew/account/pwd_reset");
                }
            }

            $data = [
                'password' => 'パスワードが正しくありません。'
            ];
            return view('auth.user.login', $data)->withInput($req->input())->withErrors($data);
        }

        $data = [
            'id' => 'IDまたはEメールアドレスと病院の電話番号は存在しません。'
        ];

        return view('auth.user.login', $data)->withInput($req->input())->withErrors($data);
    }

    public function getPasswordResetPage(Request $request){

        $cid = $request->session()->get('ClinicID', 'default');
        $user = User::where("ClinicID", "=", $cid)
        ->first();

        if($user && $user->CustStatus != 5){
            $now = Carbon::now();
            if($now->greaterThan($user->PasswordExpiry)){

                $pwd = Hash::make(Str::random(8));
                $user->Password = $pwd;
                $user->PasswordExpiry = Carbon::now()->addDays(3);
                $user->save();

                $receiver = $request->input('MailAddress');
                $subject = "PetClinic";
                $content = "
                    <h1>Your Password is ".$pwd."</h1>
                ";
                Mail::to($receiver)->send(new CustomMail($subject, $content));

                $data = [
                    'password' => 'パスワードの有効期限が切れています。新しいパスワードが生成されます。'
                ];
                return redirect('/petcrew/login')->withErrors($data);
            }

            return view('auth.user.pwd_reset', ["ClinicID" => $user->ClinicID, "ClinicName" =>$user->ClinicName]);
        }else{
            return redirect('/petcrew/login');
        }

    }

    public function user_pwd_reset(UserPwdResetRequest $request){

        $pwd = $request->input('password', 'password');
        $cid = $request->session()->get('ClinicID', 'default');
        $user = User::where("ClinicID", "=", $cid)->first();

        if($user){
            $user->Password = Hash::make($pwd);
            $user->LoginDateTime = Carbon::now();
            $user->CustStatus = 5;
            $user->save();
            return redirect('/petcrew/home');
        }else{
            $request->session()->flush();
            return redirect('/petcrew/login');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }

    public function notification(Request $request){

        $maintain = MaintainLog::whereDate("from", "<=", Carbon::now())
        ->whereDate("to", ">=", Carbon::now())->first();

        if($maintain){
            $role = $request->session()->get('role', 'customer');
            if($role != "admin")
                $request->session()->flush();


            $data = [
                "from" => $maintain->from,
                "to" => $maintain->to
            ];
            return view('notification', $data);

        }else{
            return redirect('/');
        }
    }
}
