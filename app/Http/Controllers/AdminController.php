<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\HTTP\Requests\NewUserRequest;
use App\HTTP\Requests\UpdateUserRequest;
use App\HTTP\Requests\NewMaintainRequest;
use App\HTTP\Requests\SendEmailRequest;
use Carbon\Carbon;
use Hash;
use Str;

use App\Mail\CustomMail;

use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;
use App\Models\MaintainLog;

class AdminController extends Controller
{
    //

    public function all_users(Request $request){
        $key = $request->query('key', '');

        $users = User::leftJoin('pckcustlists', 'pckcustlists.ClinicID', '=', 'pckusers.ClinicID')
            ->leftJoin('pckpetlists', 'pckpetlists.ClinicID', '=', 'pckusers.ClinicID')
            ->where('pckusers.ClinicName', 'like', '%'.$key.'%')
            ->orWhere('pckusers.PeaksUserNo', 'like', '%'.$key.'%')
            ->orWhere('pckusers.ClinicID', 'like', '%'.$key.'%')
            ->orWhere('pckusers.TelNo', 'like', '%'.$key.'%')
            ->orWhere('pckusers.TelNum', 'like', '%'.$key.'%')
            // ->orWhere('pckusers.email', 'like', '%'.$key.'%')
            ->groupBy('pckusers.ClinicID')
            ->orderBy('pckusers.created_at', 'desc')
            ->selectRaw('pckusers.*, count(DISTINCT pckcustlists.id) as customer_cnt, count(DISTINCT pckpetlists.id) as pet_cnt')
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

    public function makeClinicID($PeaksNo){
        $number = $PeaksNo;
        $num_arr  = array_map('intval', str_split($number));
        $arr_sum = ($num_arr[2] + $num_arr[3]) * ($num_arr[4] + $num_arr[5]);
        $num_arr1 = array_map('intval', str_split($arr_sum));
        $suf_val = 0;
        foreach ($num_arr1 as $key => $num_at) {
            # code...
            if($suf_val + $num_at > 10){
                break;
            }else{
                $suf_val = $suf_val + $num_at;
            }
        }

        return ($number%10000)*10 + $suf_val;
    }

    public function create_user(NewUserRequest $request){
        $clinic_id = $this->makeClinicID($request->input('PeaksUserNo'));

        $pwd = Hash::make(Str::random(8));

        $data = new User;
        $data->PeaksUserNo = $request->input('PeaksUserNo');
        $data->ClinicName = $request->input('ClinicName');
        $data->ClinicID = $clinic_id;
        $data->TelNo = $request->input('TelNo');
        $data->TelNum = Str::replace('-', '', $request->input('TelNo'));
        $data->MailAddress = $request->input('MailAddress');
        $data->Password = $pwd;
        $data->PasswordExpiry = Carbon::now()->addDays(3);
        $data->PatientRegOpt = $request->input('PatientRegOpt') ? $request->input('PatientRegOpt') : false ;
        $data->ReceptionOpt = $request->input('ReceptionOpt') ? $request->input('ReceptionOpt') : false ;
        $data->Memo = $request->input('Memo') ? $request->input('Memo') : "" ;
        $data->save();

        //Mail::to($data->email)->send(new UserCreated($pwd));
        $receiver = $request->input('MailAddress');
        $subject = "PetClinic";
        $content = "
            <h1>Your Password is ".$pwd."</h1>
        ";
        Mail::to($receiver)->send(new CustomMail($subject, $content));

        $res = [
            "success" => true,
        ];

        return response()->json($res);

    }

    public function edit_user(Request $request){
        $uid = $request->query('uid', 'default');

        $sel_user = User::where('ClinicID', '=', $uid)->first();
        if($sel_user){
            $cust_cnt = Customer::where('ClinicID', '=', $uid)->count();
            $pet_cnt = Pet::where('ClinicID', '=', $uid)->count();
            $recept_cnt = Reception::where('ClinicID', '=', $uid)->count();

            $data = [
                'title' => 'ユーザーの変更',
                'auth' => $request->session()->all(),
                'user' => $sel_user,
                'cust_cnt' => $cust_cnt,
                'pet_cnt' => $pet_cnt,
                "recept_cnt" => $recept_cnt
            ];

            return view('pages.admin.edit_user', $data);
        }else
            return redirect('admin/users');

    }

    public function update_user(UpdateUserRequest $request, $id){
        $clinic_id = $this->makeClinicID($request->input('PeaksUserNo'));

        $data = User::where('id', '=', $id)->first();
        if($data->ClinicID != $clinic_id){
            Customer::where("ClinicID", "=", $data->ClinicID)->update([
                "ClinicID" => $clinic_id
            ]);
            Pet::where("ClinicID", "=", $data->ClinicID)->update([
                "ClinicID" => $clinic_id
            ]);
        }

        $data->PeaksUserNo = $request->input('PeaksUserNo');
        $data->ClinicName = $request->input('ClinicName');
        $data->ClinicID = $clinic_id;
        $data->TelNo_2 = $data->TelNo;
        $data->TelNum_2 = $data->TelNum;
        $data->TelNo = $request->input('TelNo');
        $data->TelNum = Str::replace('-', '', $request->input('TelNo'));
        $data->MailAddress = $request->input('MailAddress');

        $data->save();

        $res = [
            "success" => true,
        ];

        return response()->json($res);

    }

    public function delete_user(Request $request){
        $ClinicID = $request->query('uid', 'default');

        User::where("ClinicID", '=', $ClinicID)->delete();
        Customer::where("ClinicID", "=", $ClinicID)->delete();
        Pet::where("ClinicID", "=", $ClinicID)->delete();

        $res = [
            "success" => true,
        ];

        return response()->json($res);
    }

    public function mail(Request $request){

        $users = User::get();

        $data = [
            'title' => 'メール連絡',
            'auth' => $request->session()->all(),
            "users" => $users
        ];

        return view('pages.admin.mail', $data);
    }

    public function sendMails(SendEmailRequest $request){

        $subject = $request->input('subject', 'PetClinic');
        $content = $request->input('content', '...');
        $receivers = $request->input('receivers', []);

        foreach ($receivers as $key => $receiver) {

            Mail::to($receiver)->send(new CustomMail($subject, $content));
        }

        $res = [
            "success" => true,
        ];

        return response()->json($res);

    }

    public function maintain(Request $request){

        $plans = MaintainLog::orderBy('from', 'desc')->paginate(10);
        $data = [
            'title' => 'メンテナンス',
            'auth' => $request->session()->all(),
            'plans' => $plans,
            'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.admin.maintain', $data);
    }

    public function add_maintain(NewMaintainRequest $request){

        $data = new MaintainLog;
        $data->from = $request->input('start_time');
        $data->to = $request->input('end_time');
        if($request->input('memo')){
            $data->memo = $request->input('memo');
        }
        $data->save();

        $res = [
            "success" => true,
        ];

        return response()->json($res);
    }

    public function delete_maintain(Request $request, $id){
        MaintainLog::where("id", '=', $id)->delete();
        return redirect('admin/maintain');
    }
}
