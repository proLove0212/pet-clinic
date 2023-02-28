<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Customer;
use App\Models\MaintainLog;
use Carbon\Carbon;

class AuthController extends Controller
{
    //

    public function admin_login(Request $req){
        Validator::validate($req->input(), [
            'password' => 'required|min:8'
        ]);

        $user = DB::table('admin')->where("name", "administrator")->first();
        if(Hash::check($req->input('password'), $user->password)){
            $req->session()->put('name', $user->name);
            $req->session()->put('role', 'admin');
            $req->session()->put('email', $user->email);

            return redirect('/admin/users');
        }

        $data = [
            'password' => 'パスワードが正しくありません。'
        ];

        return view('auth.admin_login', $data)->withErrors($data);
    }

    public function user_login(UserLoginRequest $req){
        $id = $req->input('id');

        $user = User::where("PeaksUserNo", "=", $id)
        ->orWhere("MailAddress", "=", $id)
        ->orWhere("TelNo", "=", $id)
        ->orWhere("TelNum", "=", $id)
        ->first();

        if($user){

            if(Hash::check($req->input('Password'), $user->Password)){
                $req->session()->put('name', $user->ClinicName);
                $req->session()->put('role', 'user');
                $req->session()->put('email', $user->MailAddress);
                $req->session()->put('PeaksUserNo', $user->PeaksUserNo);

                return redirect('/dashboard');
            }

            $data = [
                'password' => 'パスワードが正しくありません。'
            ];
        }

        $data = [
            'id' => 'IDまたはEメールアドレスと病院の電話番号は存在しません。'
        ];

        return view('auth.user_login', $data)->withErrors($data);
    }

    public function customer_login(Request $req){

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
