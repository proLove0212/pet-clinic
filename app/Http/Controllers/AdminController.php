<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\HTTP\Requests\NewUserRequest;
use App\HTTP\Requests\UpdateUserRequest;
use Carbon\Carbon;
use Hash;
use Str;
use DB;

use App\Mail\CustomMail;

use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;

class AdminController extends Controller
{
    //

    public function index(Request $request){
        $key = $request->query('key', '');

        $users = User::where('pckusers.ClinicName', 'like', '%'.$key.'%')
            ->groupBy('pckusers.ClinicID')
            ->orderBy('pckusers.PeaksUserNo', 'asc');

        $cnt = $users->get()->count();

        $users = $users->select()->paginate(10);

        $user_data = array_map(function($user_item){
            $pet_cnt = Pet::where("ClinicID", $user_item['ClinicID'])
                ->where("PetDeathType", 0)
                ->count();
            $customer_cnt = Customer::where("ClinicID", $user_item['ClinicID'])
                ->count();

            $user_item['pet_cnt'] = $pet_cnt;
            $user_item['customer_cnt'] = $customer_cnt;
            return $user_item;
        }, $users->toArray()['data']);

        $data = [
            'title' => '全ユーザー',
            'auth' => $request->session()->all(),
            'key' => $key,
            'users' => $user_data,
            'links' => $users->toArray()['links'],
            'cnt' => $cnt
        ];

        return view('pages.admin.index', $data)->withInput($request->input());
    }

    public function create(Request $request){

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

    public function store(NewUserRequest $request){
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
        if($request->input('License', 'default') != "default")
            $data->License = Carbon::parse($request->input('License', "03/03/2023"));
        $data->PatientRegOpt = $request->input('PatientRegOpt', 'default') == "PatientRegOpt" ? true : false ;
        $data->ReceptionOpt = $request->input('ReceptionOpt', 'default')  == "ReceptionOpt" ? true : false ;
        $data->ReserveOpt = $request->input('ReserveOpt', 'default')  == "ReserveOpt" ? true : false ;
        $data->Memo = $request->input('Memo', '');
        $data->DBNo = $request->input('DBNo', 0);
        $data->save();

        try {

            $receiver = $request->input('MailAddress');
            $subject = "PetClinic";
            $content = "
                <h1>Your Password is ".$pwd."</h1>
            ";

            Mail::to($receiver)->send(new CustomMail($subject, $content));

        } catch (\Throwable $th) {

        }


        return redirect('/petcrew/admin/users/add')->withInput([
            'success' => true,
            'message' => '正常に登録されました。'
        ]);
    }

    public function edit(Request $request, $uid){

        $sel_user = User::where('id', $uid)->first();
        if($sel_user){
            $cust_cnt = Customer::where('ClinicID', '=', $uid)->count();
            $pet_cnt = Pet::where('ClinicID', '=', $uid)->count();
            $data = [
                'title' => 'ユーザーの変更',
                'auth' => $request->session()->all(),
                'user' => $sel_user,
                'cust_cnt' => $cust_cnt,
                'pet_cnt' => $pet_cnt,
            ];

            return view('pages.admin.edit_user', $data);
        }else
            return redirect('admin/users');

    }

    public function update(UpdateUserRequest $request, $id){
        $clinic_id = $this->makeClinicID($request->input('PeaksUserNo'));

        DB::beginTransaction();

        try {

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
            if($request->input('License', 'default') != "default")
                $data->License = Carbon::parse($request->input('License', "03/03/2023"));
            $data->PatientRegOpt = $request->input('PatientRegOpt', 'default') == "PatientRegOpt" ? true : false ;
            $data->ReceptionOpt = $request->input('ReceptionOpt', 'default')  == "ReceptionOpt" ? true : false ;
            $data->ReserveOpt = $request->input('ReserveOpt', 'default')  == "ReserveOpt" ? true : false ;
            $data->Memo = $request->input('Memo', '');

            if($request->input('active', 'default') != "default")
                $data->CustStatus = $request->input('active') == 'active' ? 5 : 0;


            $data->save();

            DB::commit();

            return redirect('/petcrew/admin/users/edit/'.$id)->withInput([
                'success' => true,
                'message' => "ユーザー情報が更新されました。"
            ]);

        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            return redirect('/petcrew/admin/users/edit/'.$id)->withInput([
                'failed' => true,
                'message' => "資料基地操作汚油。"
            ]);
        }

    }

    public function pwd_reset(Request $request, $cid){

        $pwd = Hash::make(Str::random(8));
        $user = User::where("ClinicID", $cid)->first();

        if($user){
            $user->Password = $pwd;
            $user->CustStatus = 2;
            $user->save();

            try {

                $receiver = $user->MailAddress;
                $subject = "PetClinic";
                $content = "
                    <h1>Your Password is <b>".$pwd."</b></h1>
                ";

                Mail::to($receiver)->send(new CustomMail($subject, $content));

            } catch (\Throwable $th) {

            }


            return redirect('/petcrew/admin/users/edit/'.$user->id)->withInput([
                'success' => true,
                'message' => "パスワードが新しく発行されました。"
            ]);
        }else{
            $request->session()->flush();
            return redirect('/petcrew/admin/login');
        }
    }

    public function delete(Request $request, $cid){

        User::where("ClinicID",  $cid)->delete();
        Customer::where("ClinicID",  $cid)->delete();
        Pet::where("ClinicID",  $cid)->delete();

        return redirect('petcrew/admin/users');
    }


}
