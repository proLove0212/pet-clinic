<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HTTP\Requests\NewUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Str;

class AdminController extends Controller
{
    //

    public function all_users(Request $request){

        $data = [
            'title' => '全ユーザー',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.index', $data);
    }

    public function add_user(Request $request){

        $data = [
            'title' => 'ユーザー新規追加',
            'user' => $request->session()->all(),
            'user_no' => $request->query('user_no', ''),
            'name' => $request->query('name', ''),
            'phone' => $request->query('phone', ''),
            'email' => $request->query('email', ''),
        ];

        return view('pages.admin.new_user', $data);
    }

    public function create_user(NewUserRequest $request){
        $number = $request->input('user_no');
        $num_arr  = array_map('intval', str_split($number));
        $arr_sum = array_sum($num_arr);
        $temp_sum = $num_arr[2] + $num_arr[5];
        $pre = ($arr_sum % 10) * ($temp_sum % 10);

        if($pre == 0){
            $pre = $num_arr[4]*10 + $num_arr[2];
        }

        $pwd = Hash::make(Str::random(8));

        $data = new User;
        $data->user_no = $request->input('user_no');
        $data->clinic_name = $request->input('name');
        $data->clinic_id = $pre * 10000 + $num_arr[2]*1000+$num_arr[3]*100+$num_arr[4]*10+$num_arr[5];
        $data->tel_no_new = $request->input('phone');
        $data->tel_num_new = Str::replace('-', '', $request->input('phone'));
        $data->email = $request->input('email');
        $data->password = $pwd;
        $data->password_expired_at = Carbon::now()->addDays(3);
        $data->save();

        return json_encode($data);

    }

    public function search_user(Request $request){

        $data = [
            'title' => '高度な検索',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.search_user', $data);
    }

    public function mail(Request $request){

        $data = [
            'title' => 'メール連絡',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.mail', $data);
    }

    public function maintain(Request $request){

        $data = [
            'title' => 'サーバーメンテナンス',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.maintain', $data);
    }
}
