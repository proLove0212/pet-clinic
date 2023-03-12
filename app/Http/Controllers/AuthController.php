<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserPwdResetRequest;
use Str;
use Hash;
use Auth;

use App\Models\Admin;
use App\Models\User;
use App\Models\MaintainLog;
use Carbon\Carbon;

class AuthController extends Controller
{
    //

    public function logout(Request $request){
        Auth::logout();
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
