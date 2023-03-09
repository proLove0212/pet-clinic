<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForgotPwdRequest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Hash;
use Str;

use App\Mail\CustomMail;
use App\Models\User;

class UserForgotController extends Controller
{
    //

    public function index_pwd(Request $request){


        return view("auth.forgot_pwd");
    }

    public function reset_pwd(ForgotPwdRequest $request){
        $pwd = Hash::make(Str::random(8));
        $email = $request->input('email', 'default');

        $data = User::where("MailAddress", $email)->first();
        $data->Password = $pwd;
        $data->PasswordExpiry = Carbon::now()->addDays(3);
        $data->CustStatus = 1;
        $data->save();

        $subject = "PetClinic";
        $content = "
            <h1> パスワードがリセットされました。 </h1>
            <br/>
            <p> パスワード : {$pwd} </p>
        ";

        try {
            Mail::to($email)->send(new CustomMail($subject, $content));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/password_reset_requests/new')->withErrors([
                "email" => "電子メール転送失敗。 再試行してください。"
            ]);
        }

        return redirect('petcrew/login');
    }

    public function index_all(Request $request){


        return view("auth.forgot_all");
    }
    public function reset_all(ForgotPwdRequest $request){

        $pwd = Hash::make(Str::random(8));
        $email = $request->input('email', 'default');

        $data = User::where("MailAddress", $email)->first();
        $data->Password = $pwd;
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

        try {
            Mail::to($email)->send(new CustomMail($subject, $content));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/password_reset_requests/all')->withErrors([
                "email" => "電子メール転送失敗。 再試行してください。"
            ]);
        }

        return redirect('petcrew/login');
    }
}
