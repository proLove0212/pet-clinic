<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;
use App\Http\Requests\UserPwdResetRequest;
use Str;
use Hash;
use Auth;
use Carbon\Carbon;

class PasswordResetController extends Controller
{


    public function index(Request $request){


        if(Auth::user()->CustStatus == 1 || Auth::user()->CustStatus == 2){
            $now = Carbon::now();
            if($now->greaterThan(Auth::user()->PasswordExpiry)){

                $pwd = Hash::make(Str::random(8));
                Auth::user()->password = $pwd;
                Auth::user()->PasswordExpiry = Carbon::now()->addDays(3);
                Auth::user()->save();

                $receiver = Auth::user()->email;
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

            return view('auth.user.pwd_reset');

        }
        elseif(Auth::user()->CustStatus == 5){
            return redirect('/petcrew/search');
        }
        else{
            return redirect('/petcrew');
        }

    }

    public function reset(UserPwdResetRequest $request){

        $pwd = $request->input('password', Str::random(8));

        Auth::user()->Password = Hash::make($pwd);
        Auth::user()->LoginDateTime = Carbon::now();
        Auth::user()->CustStatus = 5;
        Auth::user()->save();
        return redirect('/petcrew/search');
    }

}
