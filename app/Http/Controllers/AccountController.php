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

    public function admin_pwd_change(PasswordChangeRequest $request){


        if($request->session()->get('role', 'default') != "admin"){
            $request->session()->flush();
            return redirect('/');
        }

        try {
            $admin = Admin::whereEncrypted("name", "管理者")->first();
            if(!Hash::check($request->input('password'), $admin->password)){
                return redirect('/petcrew/admin/account')->withInput($request->input())->withErrors([
                    'old_password' => "以前のパスワードが間違っています。"
                ]);
            }

            $admin->password = Hash::make($request->input('password', 'default'));
            $admin->save();

            return redirect("/petcrew/admin/account")->withInput([
                'success' => true,
                'message' => 'パスワードが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect("/petcrew/admin/account")->withInput([
                'failed' => true,
                'message' => 'パスワードが変更に失敗しました。'
            ]);
        }

    }


    public function admin_email_change(Request $request){


        if($request->session()->get('role', 'default') != "admin"){
            $request->session()->flush();
            return redirect('/');
        }

        try {
            $admin = Admin::whereEncrypted("name", "管理者")->first();
            if(!Hash::check($request->input('password_email'), $admin->password)){
                return redirect('/petcrew/admin/account')->withInput($request->input())->withErrors([
                    'password_email' => "パスワードが間違っています。"
                ]);
            }

            if($request->input('email', 'default') != 'default')
                $admin->email = $request->input('email');
            $admin->save();

            return redirect("/petcrew/admin/account")->withInput([
                'success' => true,
                'message' => 'メールアドレスが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect("/petcrew/admin/account")->withInput([
                'failed' => true,
                'message' => 'メールアドレスの変更に失敗しました。'
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

    public function user_pwd_change(PasswordChangeRequest $request){


        if($request->session()->get('role', 'default') != "user"){
            $request->session()->flush();
            return redirect('/');
        }

        try {
            $cid = $request->session()->get('ClinicID', 'default');
            $user = User::where("ClinicID", $cid)->first();
            if(!Hash::check($request->input('password'), $user->Password)){
                return redirect('/petcrew/account')->withInput($request->input())->withErrors([
                    'old_password' => "以前のパスワードが間違っています。"
                ]);
            }

            $user->Password = Hash::make($request->input('password', 'default'));
            $user->save();

            return redirect("/petcrew/account")->withInput([
                'success' => true,
                'message' => 'パスワードが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect("/petcrew/admin/account")->withInput([
                'failed' => true,
                'message' => 'パスワードが変更に失敗しました。'
            ]);
        }

    }

    public function user_email_change(PasswordChangeRequest $request){


        if($request->session()->get('role', 'default') != "user"){
            $request->session()->flush();
            return redirect('/');
        }

        try {
            $cid = $request->session()->get('ClinicID', 'default');
            $user = User::where("ClinicID", $cid)->first();
            if(!Hash::check($request->input('password_email'), $user->Password)){
                return redirect('/petcrew/account')->withInput($request->input())->withErrors([
                    'password_email' => "パスワードが間違っています。"
                ]);
            }

            if($request->input('email', 'default') != 'default')
                $user->email = $request->input('email');
            $user->save();

            return redirect("/petcrew/account")->withInput([
                'success' => true,
                'message' => 'メールアドレスが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect("/petcrew/account")->withInput([
                'failed' => true,
                'message' => 'メールアドレスの変更に失敗しました。'
            ]);
        }

    }
}
