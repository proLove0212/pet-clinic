<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\HTTP\Requests\NewUserRequest;
use App\HTTP\Requests\UpdateUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Str;

use App\Mail\UserCreated;

class AdminController extends Controller
{
    //

    public function all_users(Request $request){

        $key = $request->query('key', '');

        $users = User::where('clinic_name', 'like', '%'.$key.'%')
            ->orWhere('user_no', 'like', '%'.$key.'%')
            ->orWhere('clinic_id', 'like', '%'.$key.'%')
            ->orWhere('tel_num_new', 'like', '%'.$key.'%')
            ->orWhere('tel_no_new', 'like', '%'.$key.'%')
            // ->orWhere('email', 'like', '%'.$key.'%')
            ->leftJoin('customers', 'customers.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->orderBy('users.created_at', 'desc')
            ->selectRaw('users.*, count(customers.id) as customer_cnt')
            ->paginate(10);

        $data = [
            'title' => '全ユーザー',
            'auth' => $request->session()->all(),
            'key' => $key,
            'users' => $users,
            'links' => json_decode(json_encode($users))->links
        ];

        // return json_encode($users);

        return view('pages.admin.index', $data);
    }

    public function add_user(Request $request){

        $data = [
            'title' => 'ユーザー新規追加',
            'auth' => $request->session()->all(),
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

        Mail::to($data->email)->send(new UserCreated($pwd));

        return redirect('admin/users');

    }

    public function edit_user(Request $request, $id){

        $sel_user = User::where('id', '=', $id)->first();

        $data = [
            'title' => 'ユーザーアップデート',
            'auth' => $request->session()->all(),
            'user' => $sel_user
        ];

        return view('pages.admin.edit_user', $data);
    }

    public function update_user(UpdateUserRequest $request, $id){
        $number = $request->input('user_no');
        $num_arr  = array_map('intval', str_split($number));
        $arr_sum = array_sum($num_arr);
        $temp_sum = $num_arr[2] + $num_arr[5];
        $pre = ($arr_sum % 10) * ($temp_sum % 10);

        if($pre == 0){
            $pre = $num_arr[4]*10 + $num_arr[2];
        }


        $data = User::where('id', '=', $id)->first();
        $data->user_no = $request->input('user_no');
        $data->clinic_name = $request->input('name');
        $data->clinic_id = $pre * 10000 + $num_arr[2]*1000+$num_arr[3]*100+$num_arr[4]*10+$num_arr[5];
        $data->tel_no_new = $request->input('phone');
        $data->tel_num_new = Str::replace('-', '', $request->input('phone'));
        $data->email = $request->input('email');
        $data->save();

        return redirect('admin/users');

    }

    public function mail(Request $request){

        $data = [
            'title' => 'メール連絡',
            'auth' => $request->session()->all(),
        ];

        return view('pages.admin.mail', $data);
    }

    public function maintain(Request $request){

        $data = [
            'title' => 'サーバーメンテナンス',
            'auth' => $request->session()->all(),
        ];

        return view('pages.admin.maintain', $data);
    }
}
