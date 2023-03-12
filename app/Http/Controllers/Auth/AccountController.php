<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordChangeRequest;
use Hash;
use Auth;

class AccountController extends Controller
{
    //
    public function get_admin_change(Request $request){

        return view('pages.admin.account');
    }

    public function admin_pwd_change(PasswordChangeRequest $request){

        try {
            Auth::user()->password = Hash::make($request->input('password', 'admin12345678'));
            Auth::user()->save();

            return redirect(route('admin.account'))->withInput([
                'success' => true,
                'message' => 'パスワードが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect(route('admin.account'))->withInput([
                'failed' => true,
                'message' => 'パスワードが変更に失敗しました。'
            ]);
        }

    }


    public function admin_email_change(Request $request){

        try {

            Auth::user()->email = $request->input('email');
            Auth::user()->save();

            return redirect(route('admin.account'))->withInput([
                'success' => true,
                'message' => 'メールアドレスが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect(route('admin.account'))->withInput([
                'failed' => true,
                'message' => 'メールアドレスの変更に失敗しました。'
            ]);
        }

    }

    public function get_user_change(Request $request){

        return view('pages.user.account');
    }

    public function user_pwd_change(PasswordChangeRequest $request){

        try {
            Auth::user()->password = Hash::make($request->input('password', 'admin12345678'));
            Auth::user()->save();

            return redirect(route('user.account'))->withInput([
                'success' => true,
                'message' => 'パスワードが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect(route('user.account'))->withInput([
                'failed' => true,
                'message' => 'パスワードが変更に失敗しました。'
            ]);
        }

    }

    public function user_email_change(PasswordChangeRequest $request){

        try {
            Auth::user()->email = $request->input('email');
            Auth::user()->save();

            return redirect(route('user.account'))->withInput([
                'success' => true,
                'message' => 'メールアドレスが変更されました。'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return redirect(route('user.account'))->withInput([
                'failed' => true,
                'message' => 'メールアドレスの変更に失敗しました。'
            ]);
        }

    }
}
