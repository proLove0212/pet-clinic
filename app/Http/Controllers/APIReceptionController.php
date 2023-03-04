<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Str;
use DB;
use App\Models\Reception;
use App\Models\ReceptionSetting;

class APIReceptionController extends Controller
{
    //
    public function index(Request $request){
        try {
            $cid = $request->query('cid', 'default');
            $dt = $request->query('dt', 'default');

            $v_dt = Carbon::createFromFormat('Ymd', $dt)->format('Y-m-d');

            $receptions = Reception::where("ClinicID", $cid)
                ->where("VisitDate", $v_dt)
                ->get();

            return response()->json([
                "success" => true,
                "data" => $receptions
            ], 200);


        } catch (\Throwable $th) {

            return response()->json([
                "success" => false,
                "data" => []
            ], 202);

        }
    }

    public function enable(Request $request){
        $cid = $request->query('key', 'default');
        $dt = $request->query('dt', 'default');
        $cg = $request->query('cg', 'default');


        if($cid == "default" || $dt == "default" || $cg == "default"){
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 202);
        }

        $cg_check = array_sum(array_map('intval', explode(',', $cid))) + array_sum(array_map('intval', explode(',', $dt)));

        if($cg !== $cg_check){
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 202);
        }

        DB::beginTransaction();

        try {
            $body = $request->getContent();

            $st_1 = explode(",", $body)[0];
            $st_2 = explode(",", $body)[1];

            if($st_1 != "-"){
                $st_date_1 = Carbon::createFromFormat('Ymd', $st_1)->format('Y-m-d');

                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time1EnableDate", $st_date_1);
            }else{
                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time1EnableDate", null);
            }

            if($st_2 != "-"){
                $st_date_2 = Carbon::createFromFormat('Ymd', $st_2)->format('Y-m-d');

                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time2EnableDate", $st_date_2);
            }else{
                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time2EnableDate", null);
            }


            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 202);
        }
    }

    public function entry(Request $request){

        $cid = $request->query('key', 'default');
        $dt = $request->query('dt', 'default');
        $cg = $request->query('cg', 'default');


        if($cid == "default" || $dt == "default" || $cg == "default"){
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 202);
        }

        $cg_check = array_sum(array_map('intval', explode(',', $cid))) + array_sum(array_map('intval', explode(',', $dt)));

        if($cg !== $cg_check){
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 202);
        }

        DB::beginTransaction();

        try {
            $body = $request->getContent();

            $st_1 = explode(",", $body)[0];
            $st_2 = explode(",", $body)[1];

            if($st_1 != "-"){
                $st_date_1 = Carbon::createFromFormat('Ymd', $st_1)->format('Y-m-d');

                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time1EnableDate", $st_date_1);
            }else{
                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time1EnableDate", null);
            }

            if($st_2 != "-"){
                $st_date_2 = Carbon::createFromFormat('Ymd', $st_2)->format('Y-m-d');

                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time2EnableDate", $st_date_2);
            }else{
                ReceptionSetting::where("ClinicID", $cid)
                    ->update("Time2EnableDate", null);
            }


            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 202);
        }
    }
}
