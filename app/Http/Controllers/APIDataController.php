<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use DB;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;



class APIDataController extends Controller
{
    //
    public function index(Request $request){

        $cid = $request->query('cid', 'default');
        $dt = $request->query('dt', 'default');
        $dg = $request->query('dg', 'default');
        $mode = $request->query('mode', 'default');


        if($cid == "default" || $dt == "default" || $dg == "default" || $mode == "default"){
            return response()->json([
                "success" => false,
                "msg" => "Query type is not corrected!"
            ], 202);
        }

        $dg_check = array_sum(array_map('intval', str_split($cid))) + array_sum(array_map('intval', str_split($dt)));


        if($dg != $dg_check){
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 202);
        }

        if($mode == "addupdate"){
            $body = json_decode($request->getContent());

            try {
                if($body->Version != "Ver2.0"){
                    return response()->json([
                        "success" => false,
                        "msg" => "Old version"
                    ], 202);
                }

                $ClinicID = $body->ClinicID;

                if($cid != $ClinicID){
                    return response()->json([
                        "success" => false,
                        "msg" => "Invalid data!"
                    ], 202);
                }


                $rslt = $this->addUpdate($cid, $body);


                if($rslt){
                    return response()->json([
                        "success" => true,
                        "msg" => "Customer changed"
                    ], 200);
                }else{
                    return response()->json([
                        "success" => false,
                        "msg" => "DB Error"
                    ], 201);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Datatype"
                ], 201);
            }


        }else if($mode == "change_custno"){
            $body = $request->getContent();

            try {

                $rslt = $this->changeCustNo($cid, explode("\t", $body)[0], explode("\t", $body)[1]);


                if($rslt){
                    return response()->json([
                        "success" => true,
                        "msg" => "CustNo changed!"
                    ], 200);
                }else{
                    return response()->json([
                        "success" => false,
                        "msg" => "DB Error"
                    ], 201);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 202);
            }
        }
        else if($mode == "change_kartetno"){
            $body = $request->getContent();

            try {
                $arr = explode("\t", $body);

                $karte_no_old = $arr[0];
                $karte_no_new = $arr[1];

                $rslt = $this->changeKarteNo($cid, $karte_no_old, explode("-", $karte_no_new)[0], explode("-", $karte_no_new)[1]);

                if($rslt){
                    return response()->json([
                        "success" => true,
                        "msg" => "KarteNo changed!"
                    ], 200);
                }else{
                    return response()->json([
                        "success" => false,
                        "msg" => "KarteNo Error"
                    ], 201);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 202);
            }

        }else if($mode == "delete_cust"){
            $body = $request->getContent();

            try {

                $rslt = $this->deleteCust($cid, $body);

                if($rslt){
                    return response()->json([
                        "success" => true,
                        "msg" => "Cust deleted!"
                    ], 200);
                }else{
                    return response()->json([
                        "success" => false,
                        "msg" => "DB Error"
                    ], 201);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 202);
            }
        }else if($mode == "delete_pet"){
            $body = $request->getContent();

            try {

                $rslt = $this->deletePet($cid, $body);

                if($rslt){
                    return response()->json([
                        "success" => true,
                        "msg" => "Pet deleted!"
                    ], 200);
                }else{
                    return response()->json([
                        "success" => false,
                        "msg" => "DB Error"
                    ], 201);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 202);
            }

        }

        return response()->json([
            "success" => true
        ], 200);
    }

    public function addUpdate($cid, $cust_json){

        if($cust_json['CustData']['CustNo']."-".$cust_json['PetData']['PetNo'] != $cust_json["PetData"]['KarteNo']){
           return false;
        }

        DB::beginTransaction();

        try {
            $cust_no = $cust_json->CustData->CustNo;

            $customer = Customer::where("ClinicID", $cid)
                    ->where("CustNo", $cust_no)
                    ->first();

            if($customer){
                $customer->ClinicID = $cust_json->ClinicID;
                $customer->CustNo = $cust_json->CustData->CustNo;
                $customer->CustFamilyName = $cust_json->CustData->CustFamilyName;
                $customer->CustName = $cust_json->CustData->CustName;
                $customer->CustFamilyName_furigana = $cust_json->CustData->CustFamilyName_furigana;
                $customer->CustName_furigana = $cust_json->CustData->CustName_furigana;
                $customer->Address = $cust_json->CustData->Address;

                $tels = explode("/", $cust_json->CustData->Tel);
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

                $customer->email = $cust_json->CustData->MailAddress;
                $customer->Kubun = $cust_json->CustData->Kubun;
                $customer->LastCommingDate = $cust_json->CustData->LastCommingDate;
                $customer->NextDate = $cust_json->CustData->NextDate;
                $customer->NextReason = $cust_json->CustData->NextReason;
                $customer->CustValid = $cust_json->CustData->CustValid;
                $customer->save();

                Pet::where("PetNo", $cust_json->PetData->PetNo)
                    ->where("ClinicID", $cid)
                    ->delete();

                $pet = new Pet;
                $pet->CustNo = $cust_no;
                $pet->ClinicID = $cid;
                $pet->KarteNo = $cust_json->PetData->KarteNo;
                $pet->PetNo = $cust_json->PetData->PetNo;
                $pet->PetName = $cust_json->PetData->PetName;
                $pet->PetName_furigana = $cust_json->PetData->PetName_furigana;
                $pet->PetKind = $cust_json->PetData->PetKind;
                $pet->PetBreed = $cust_json->PetData->PetBreed;
                $pet->PetBirthday = $cust_json->PetData->PetBirthday;
                $pet->PetDeathType = $cust_json->PetData->PetDeathType;
                $pet->PetDeathDate = $cust_json->PetData->PetDeathDate;
                $pet->PetSex = $cust_json->PetData->PetSex;
                $pet->VacInfo = $cust_json->PetData->VacInfo;
                $pet->Memo = $cust_json->PetData->Memo;
                $pet->save();

            }else{
                $customer = new Customer;
                $customer->ClinicID = $cid;
                $customer->CustNo = $cust_json->CustData->CustNo;
                $customer->CustFamilyName = $cust_json->CustData->CustFamilyName;
                $customer->CustName = $cust_json->CustData->CustName;
                $customer->CustFamilyName_furigana = $cust_json->CustData->CustFamilyName_furigana;
                $customer->CustName_furigana = $cust_json->CustData->CustName_furigana;
                $customer->Address = $cust_json->CustData->Address;

                $tels = explode("/", $cust_json->CustData->Tel);
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
                $customer->email = $cust_json->CustData->MailAddress;
                $customer->Kubun = $cust_json->CustData->Kubun;
                $customer->LastCommingDate = $cust_json->CustData->LastCommingDate;
                $customer->NextDate = $cust_json->CustData->NextDate;
                $customer->NextReason = $cust_json->CustData->NextReason;
                $customer->CustValid = $cust_json->CustData->CustValid;
                $customer->save();


                Pet::where("ClinicID", $cid)
                    ->where("CustNo", $cust_no)
                    ->delete();

                $pet = new Pet;
                $pet->CustNo = $cust_no;
                $pet->ClinicID = $cid;
                $pet->KarteNo = $cust_json->PetData->KarteNo;
                $pet->PetNo = $cust_json->PetData->PetNo;
                $pet->PetName = $cust_json->PetData->PetName;
                $pet->PetName_furigana = $cust_json->PetData->PetName_furigana;
                $pet->PetKind = $cust_json->PetData->PetKind;
                $pet->PetBreed = $cust_json->PetData->PetBreed;
                $pet->PetBirthday = $cust_json->PetData->PetBirthday;
                $pet->PetDeathType = $cust_json->PetData->PetDeathType;
                $pet->PetDeathDate = $cust_json->PetData->PetDeathDate;
                $pet->PetSex = $cust_json->PetData->PetSex;
                $pet->VacInfo = $cust_json->PetData->VacInfo;
                $pet->Memo = $cust_json->PetData->Memo;
                $pet->save();

            }

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return false;
        }
        return true;
    }

    public function changeCustNo($cid, $cust_no_old, $cust_no_new){

        DB::beginTransaction();

        try {
            Customer::where("ClinicID", $cid)
                ->where("CustNo", $cust_no_old)
                ->update(["CustNo" => $cust_no_new]);

            $pets = Pet::where("ClinicID", $cid)
                ->where("CustNo", $cust_no_old)
                ->get();

            foreach ($pets as $key => $pet) {
                # code...
                $pet->CustNo = $cust_no_new;
                $pet->KarteNo = $cust_no_new + $pet->PetNo;
                $pet->save();
            }

            Reception::where("ClinicID", $cid)
                ->where("CustNo", $cust_no_old)
                ->update(["CustNo" => $cust_no_new]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();

            return false;
        }
        return true;
    }

    public function changeKarteNo($cid, $karteno, $cust_no_new, $pet_no_new){

        $pets = Pet::where("ClinicID", $cid)
        ->where(function($query) use($cust_no_new, $pet_no_new) {
            $query->where("PetNo", $pet_no_new)
                ->orWhere($cust_no_new."-".$pet_no_new);
        })
        ->get();

        if($pets){
            return false;
        }

        DB::beginTransaction();

        try {
            $pet = Pet::where("ClinicID", $cid)
                ->where("KarteNo", $karteno)->first();

            $pet->CustNo = $cust_no_new;
            $pet->PetNo = $pet_no_new;
            $pet->KarteNo = $cust_no_new."-".$pet_no_new;
            $pet->save();

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return false;
        }
        return true;
    }

    public function deleteCust($cid, $cust_no){
        DB::beginTransaction();

        try {

            Customer::where("ClinicID", $cid)
                ->where("CustNo", $cust_no)
                ->delete();

            Pet::where("ClinicID", $cid)
                ->where("CustNo", $cust_no)
                ->delete();

            Reception::where("ClinicID", $cid)
                ->where("CustNo", $cust_no)
                ->delete();

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return false;
        }
        return true;
    }

    public function deletePet($cid, $karte_no){
        DB::beginTransaction();

        try {

            Pet::where("ClinicID", $cid)
                ->where("KarteNo", $karte_no)
                ->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return false;
        }
        return true;
    }
}
