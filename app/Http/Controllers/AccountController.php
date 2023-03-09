<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\Admin;
use App\Models\User;
use Hash;

class AccountController extends Controller
{
    //
    public function get_admin_change(Request $request){

        $data = [
            'title' => $request->session()->get('name', 'default').'様のアカウント',
            'auth' => $request->session()->all(),

        ];

        return view('pages.admin.account', $data);
    }

    public function admin_change(PasswordChangeRequest $request){


        if($request->session()->get('role', 'default') != "admin"){
            $request->session()->flush();
            return redirect('/');
        }

        try {
            $admin = Admin::whereEncrypted("name", "管理者")->first();
            if(!Hash::check($request->input('password'), $admin->password)){
                return redirect('admin/account')->withInput($request->input())->withErrors([
                    'old_password' => "以前のパスワードが間違っています。"
                ]);
            }

            $admin->password = Hash::make($request->input('password', 'default'));
            $admin->save();

            return redirect("/admin/account");
        } catch (\Throwable $th) {
            //throw $th;

            return redirect('admin/account')->withInput($request->input())->withErrors([
                'old_password' => "以前のパスワードが間違っています。"
            ]);
        }

    }

    public function get_user_change(Request $request){

        $data = [
            'title' => $request->session()->get('name', 'default').'様のアカウント',
            'auth' => $request->session()->all(),

        ];

        return view('pages.user.account', $data);
    }

    public function user_change(PasswordChangeRequest $request){


        if($request->session()->get('role', 'default') != "user"){
            $request->session()->flush();
            return redirect('/');
        }

        try {
            $cid = $request->session()->get('ClinicID', 'default');
            $user = User::where("ClinicID", $cid)->first();
            if(!Hash::check($request->input('password'), $user->Password)){
                return redirect('/user/account')->withInput($request->input())->withErrors([
                    'old_password' => "以前のパスワードが間違っています。"
                ]);
            }

            $user->Password = Hash::make($request->input('password', 'default'));
            $user->save();

            return redirect("/user/account");
        } catch (\Throwable $th) {
            //throw $th;

            return redirect('/user/account')->withInput($request->input())->withErrors([
                'old_password' => "以前のパスワードが間違っています。"
            ]);
        }

    }
}