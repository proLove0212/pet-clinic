<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;

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

    }

    public function customer_login(Request $req){

    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}
