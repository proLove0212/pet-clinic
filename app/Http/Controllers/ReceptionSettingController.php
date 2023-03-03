<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Pet;
use App\Models\ReceptionSetting;
use App\Models\ReasonSetting;

class ReceptionSettingController extends Controller
{
    //
    public function index(Request $request){

        $cid = $request->session()->get('ClinicID', 'default');
        $setting = ReceptionSetting::where("ClinicID", $cid)->first();

        if($setting){

            $data = [
                'title' => '時間帯の設定',
                'auth' => $request->session()->all(),
                "setting" => $setting
            ];

            return view('pages.user.reception_setting', $data);
        }else{
            return redirect('/');
        }
    }

    public function update(Request $request){
        $st_time1 = $request->input('start_time1', '09:00');
        $ed_time1 = $request->input('end_time1', '12:00');
        $st_time2 = $request->input('start_time2', '15:00');
        $ed_time2 = $request->input('end_time2', '17:00');

        $cid = $request->session()->get('ClinicID', 'default');
        $setting = ReceptionSetting::where("ClinicID", $cid)->first();

        if($setting){
            $setting->StartTime1 = $st_time1;
            $setting->EndTime1 = $ed_time1;
            $setting->StartTime2 = $st_time2;
            $setting->EndTime2 = $ed_time2;
            $setting->save();

            return response()->json([
                "success" => true,
                "msg" => "設定しました。"
            ], 200);
        }else{
            return response()->json([
                "success" => false,
                "msg" => "そのデータはありません。"
            ], 200);
        }
    }
}
