<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;

use Hash;
use Str;
use Carbon\Carbon;

use App\Models\User;

use App\Http\Requests\ForgotPwdRequest;

class ForgotPasswordController extends Controller
{
    //
    public function index_pwd(Request $request){


        return view("auth.user.forgot_pwd");
    }

    public function reset_pwd(ForgotPwdRequest $request){

        try {
            $pwd = Hash::make(Str::random(8));
            $email = $request->input('email', 'default');

            $data = User::where("email", $email)->first();
            $data->password = $pwd;
            $data->PasswordExpiry = Carbon::now()->addDays(3);
            $data->CustStatus = 2;
            $data->save();

            $subject = "PetClinic";
            $content = "
                <h1> パスワードがリセットされました。 </h1>
                <br/>
                <p> パスワード : {$pwd} </p>
            ";

            Mail::to($email)->send(new CustomMail($subject, $content));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect( route('user.forgot.type1') )->withErrors([
                "email" => "電子メール転送失敗。 再試行してください。"
            ]);
        }

        return redirect(route('login'));
    }

    public function index_all(Request $request){


        return view("auth.user.forgot_all");
    }
    public function reset_all(ForgotPwdRequest $request){

        try {
            $pwd = Hash::make(Str::random(8));
            $email = $request->input('email', 'default');

            $data = User::where("email", $email)->first();
            $data->password = $pwd;
            $data->PasswordExpiry = Carbon::now()->addDays(3);
            $data->CustStatus = 2;
            $data->save();

            $subject = "PetClinic";
            $content = "
                <h1> パスワードがリセットされました。 </h1>
                <br/>
                <p> 病院ID : {$data->ClinicID} </p>
                <p> パスワード : {$pwd} </p>
            ";

            Mail::to($email)->send(new CustomMail($subject, $content));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('user.forgot.type2'))->withErrors([
                "email" => "メールサービスが応答しません。"
            ]);
        }

        return redirect(route('login'));
    }
}
