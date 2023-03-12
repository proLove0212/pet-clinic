<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use DB;
use Auth;
use App\Models\Customer;
use App\Models\Pet;


class UploadController extends Controller
{
     /***************************************************
     * url: /upload
     * method: GET
     * description: get upload page
     * *************************************************/
    public function index(Request $request){

        return view('pages.user.upload.index');
    }

    public function store(Request $request){
        $cust_json = $request->input('cust_data', null);

        $cid = Auth::user()->ClinicID;

        if($cust_json['Version'] != "Ver2.0")
            return response()->json([
                "success" => false,
                "msg" => "以前の版本の資料です。"

            ], 400);


        if($cust_json['ClinicID'] != $cid)
            return response()->json([
                "success" => false,
                "msg" => "病院IDを確認してください。"

            ], 400);

        if($cust_json['CustData']['CustNo']."-".$cust_json['PetData']['PetNo'] != $cust_json["PetData"]['KarteNo']){
            return response()->json([
                "success" => false,
                "msg" => "カルテ番号を確認してください。"

            ], 400);
        }

        DB::beginTransaction();

        try {
            $cust_no = $cust_json['CustData']['CustNo'];

            $customer = Customer::where("ClinicID", $cid)
                    ->where("CustNo", $cust_no)
                    ->first();


            if($customer){
                $customer->ClinicID = $cust_json['ClinicID'];
                $customer->CustNo = $cust_json['CustData']["CustNo"];
                $customer->CustFamilyName = $cust_json['CustData']["CustFamilyName"];
                $customer->CustName = $cust_json['CustData']["CustName"];
                $customer->CustFamilyName_furigana = $cust_json['CustData']["CustFamilyName_furigana"];
                $customer->CustName_furigana = $cust_json['CustData']["CustName_furigana"];
                $customer->Address = $cust_json['CustData']["Address"];

                $tels = explode("/", $cust_json['CustData']["Tel"]);
                foreach ($tels as $index => $tel) {

                    if($index == 0){
                        $customer->Tel1 = $tel;
                        $customer->Tel1Num = Str::replace('-', '', $tel);
                        $customer->Tel1Last4 = explode("-", $tel)[2];
                    }
                    if($index == 1){
                        $customer->Tel2 = $tel;
                        $customer->Tel2Num = Str::replace('-', '', $tel);
                        $customer->Tel2Last4 = explode("-", $tel)[2];
                    }
                    if($index == 2){
                        $customer->Tel3 = $tel;
                        $customer->Tel3Num = Str::replace('-', '', $tel);
                        $customer->Tel3Last4 = explode("-", $tel)[2];
                    }
                    if($index == 3){
                        $customer->Tel4 = $tel;
                        $customer->Tel4Num = Str::replace('-', '', $tel);
                        $customer->Tel4Last4 = explode("-", $tel)[2];
                    }
                    if($index == 4){
                        $customer->Tel5 = $tel;
                        $customer->Tel5Num = Str::replace('-', '', $tel);
                        $customer->Tel5Last4 = explode("-", $tel)[2];
                    }
                    if($index == 5){
                        $customer->Tel6 = $tel;
                        $customer->Tel6Num = Str::replace('-', '', $tel);
                        $customer->Tel6Last4 = explode("-", $tel)[2];
                    }
                    if($index == 6){
                        $customer->Tel7 = $tel;
                        $customer->Tel7Num = Str::replace('-', '', $tel);
                        $customer->Tel7Last4 = explode("-", $tel)[2];
                    }
                    if($index == 7){
                        $customer->Tel8 = $tel;
                        $customer->Tel8Num = Str::replace('-', '', $tel);
                        $customer->Tel8Last4 = explode("-", $tel)[2];
                    }

                }

                $customer->email = $cust_json['CustData']['MailAddress'];
                $customer->Kubun = $cust_json['CustData']['Kubun'];
                $customer->LastCommingDate = $cust_json['CustData']['LastCommingDate'];
                $customer->NextDate = $cust_json['CustData']['NextDate'];
                $customer->NextReason = $cust_json['CustData']['NextReason'];
                $customer->CustValid = $cust_json['CustData']['CustValid'];
                $customer->save();

                Pet::where("PetNo", $cust_json['PetData']["PetNo"])
                    ->where("ClinicID", $cid)
                    ->delete();

                $pet = new Pet;
                $pet->CustNo = $cust_no;
                $pet->ClinicID = $cid;
                $pet->KarteNo = $cust_json['PetData']["KarteNo"];
                $pet->PetNo = $cust_json['PetData']["PetNo"];
                $pet->PetName = $cust_json['PetData']["PetName"];
                $pet->PetName_furigana = $cust_json['PetData']["PetName_furigana"];
                $pet->PetKind = $cust_json['PetData']["PetKind"];
                $pet->PetBreed = $cust_json['PetData']["PetBreed"];
                $pet->PetBirthday = $cust_json['PetData']["PetBirthday"];
                $pet->PetDeathType = $cust_json['PetData']["PetDeathType"];
                $pet->PetDeathDate = $cust_json['PetData']["PetDeathDate"];
                $pet->PetSex = $cust_json['PetData']["PetSex"];
                $pet->VacInfo = $cust_json['PetData']["VacInfo"];
                $pet->Memo = $cust_json['PetData']["Memo"];
                $pet->save();


            }else{
                $customer = new Customer;
                $customer->ClinicID = $cust_json->ClinicID;
                $customer->CustNo = $cust_json['CustData']["CustNo"];
                $customer->CustFamilyName = $cust_json['CustData']["CustFamilyName"];
                $customer->CustName = $cust_json['CustData']["CustName"];
                $customer->CustFamilyName_furigana = $cust_json['CustData']["CustFamilyName_furigana"];
                $customer->CustName_furigana = $cust_json['CustData']["CustName_furigana"];
                $customer->Address = $cust_json['CustData']["Address"];

                $tels = explode("/", $cust_json['CustData']["Tel"]);
                foreach ($tels as $index => $tel) {

                    if($index == 0){
                        $customer->Tel1 = $tel;
                        $customer->Tel1Num = Str::replace('-', '', $tel);
                        $customer->Tel1Last4 = explode("-", $tel)[2];
                    }
                    if($index == 1){
                        $customer->Tel2 = $tel;
                        $customer->Tel2Num = Str::replace('-', '', $tel);
                        $customer->Tel2Last4 = explode("-", $tel)[2];
                    }
                    if($index == 2){
                        $customer->Tel3 = $tel;
                        $customer->Tel3Num = Str::replace('-', '', $tel);
                        $customer->Tel3Last4 = explode("-", $tel)[2];
                    }
                    if($index == 3){
                        $customer->Tel4 = $tel;
                        $customer->Tel4Num = Str::replace('-', '', $tel);
                        $customer->Tel4Last4 = explode("-", $tel)[2];
                    }
                    if($index == 4){
                        $customer->Tel5 = $tel;
                        $customer->Tel5Num = Str::replace('-', '', $tel);
                        $customer->Tel5Last4 = explode("-", $tel)[2];
                    }
                    if($index == 5){
                        $customer->Tel6 = $tel;
                        $customer->Tel6Num = Str::replace('-', '', $tel);
                        $customer->Tel6Last4 = explode("-", $tel)[2];
                    }
                    if($index == 6){
                        $customer->Tel7 = $tel;
                        $customer->Tel7Num = Str::replace('-', '', $tel);
                        $customer->Tel7Last4 = explode("-", $tel)[2];
                    }
                    if($index == 7){
                        $customer->Tel8 = $tel;
                        $customer->Tel8Num = Str::replace('-', '', $tel);
                        $customer->Tel8Last4 = explode("-", $tel)[2];
                    }

                }

                $customer->email = $cust_json['CustData']['MailAddress'];
                $customer->Kubun = $cust_json['CustData']['Kubun'];
                $customer->LastCommingDate = $cust_json['CustData']['LastCommingDate'];
                $customer->NextDate = $cust_json['CustData']['NextDate'];
                $customer->NextReason = $cust_json['CustData']['NextReason'];
                $customer->CustValid = $cust_json['CustData']['CustValid'];
                $customer->save();


                Pet::where("ClinicID", $cid)
                    ->where("CustNo", $cust_no)
                    ->delete();

                $pet = new Pet;
                $pet->CustNo = $cust_no;
                $pet->ClinicID = $cid;
                $pet->KarteNo = $cust_json['PetData']["KarteNo"];
                $pet->PetNo = $cust_json['PetData']["PetNo"];
                $pet->PetName = $cust_json['PetData']["PetName"];
                $pet->PetName_furigana = $cust_json['PetData']["PetName_furigana"];
                $pet->PetKind = $cust_json['PetData']["PetKind"];
                $pet->PetBreed = $cust_json['PetData']["PetBreed"];
                $pet->PetBirthday = $cust_json['PetData']["PetBirthday"];
                $pet->PetDeathType = $cust_json['PetData']["PetDeathType"];
                $pet->PetDeathDate = $cust_json['PetData']["PetDeathDate"];
                $pet->PetSex = $cust_json['PetData']["PetSex"];
                $pet->VacInfo = $cust_json['PetData']["VacInfo"];
                $pet->Memo = $cust_json['PetData']["Memo"];
                $pet->save();

            }

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return response()->json([
                "success" => true,
                "msg" => "資料基地操作汚油"

            ], 400);
        }

        return response()->json([
            "success" => true,

        ], 200);

    }

}
