<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;



class APIDataController extends Controller
{
    //
    public function index(Request $request){
        $cid = $request->query('key', 'default');
        $dt = $request->query('dt', 'default');
        $cg = $request->query('cg', 'default');
        $mode = $request->query('mode', 'default');

        if($cid == "default" || $dt == "default" || $cg == "default" || $mode == "default"){
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 400);
        }

        $cg_check = sum(array_map('intval', explode(',', $cid))) + sum(array_map('intval', explode(',', $dt)));

        if($cg !== $cg_check){
            return response()->json([
                "success" => false,
                "msg" => "Invalid query!"
            ], 400);
        }

        if($mode == "addupdate"){
            if($request->input('Version', 'default') != "Ver2.0"){
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid data!"
                ], 400);
            }

            $ClinicID = $request->input('ClinicID', 'default');

            if($cid !== $ClinicID){
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid data!"
                ], 400);
            }

            $cust_data = $request->input('CustData', null);
            $pet_data = $request->input('PetData', null);

            $rslt = $this->addUpdate($cid, $cust_data, $pet_data);

            if($rslt){
                return response()->json([
                    "success" => true,
                    "msg" => "Customer changed"
                ], 200);
            }else{
                return response()->json([
                    "success" => false,
                    "msg" => "DB Error"
                ], 400);
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
                    ], 400);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 400);
            }
        }
        else if($mode == "change_karteno"){
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
                        "msg" => "DB Error"
                    ], 400);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 400);
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
                    ], 400);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 400);
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
                    ], 400);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "success" => false,
                    "msg" => "Invalid Data"
                ], 400);
            }

        }

        return response()->json([
            "success" => true
        ], 200);
    }

    public function addUpdate($cid, $cust_data, $pet_data){

        DB::beginTransaction();

        try {
            $customer = Customer::where("ClinicID", $cid)
                    ->where("CustNo", $cust_no)
                    ->first();


            if($customer){
                $customer->ClinicID = $cid;
                $customer->CustNo = $cust_data["CustNo"];
                $customer->CustFamilyName = $cust_data["CustFamilyName"];
                $customer->CustName = $cust_data["CustName"];
                $customer->CustFamilyName_furigana = $cust_data["CustFamilyName_furigana"];
                $customer->CustName_furigana = $cust_data["CustName_furigana"];
                $customer->Address = $cust_data["Address"];

                $tels = explode("/", $cust_data["Tel"]);
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

                $customer->MailAddress = $cust_data['MailAddress'];
                $customer->Kubun = $cust_data['Kubun'];
                $customer->LastCommingDate = $cust_data['LastCommingDate'];
                $customer->NextDate = $cust_data['NextDate'];
                $customer->NextReason = $cust_data['NextReason'];
                $customer->CustValid = $cust_data['CustValid'];
                $customer->save();

                Pet::where("PetNo", $pet_data["PetNo"])
                    ->orWhere("KarteNo", $pet_data["KarteNo"])
                    ->delete();

                $pet = new Pet;
                $pet->CustNo = $cust_data['CustNo'];
                $pet->ClinicID = $cid;
                $pet->KarteNo = $pet_data["KarteNo"];
                $pet->PetNo = $pet_data["PetNo"];
                $pet->PetName = $pet_data["PetName"];
                $pet->PetName_furigana = $pet_data["PetName_furigana"];
                $pet->PetKind = $pet_data["PetKind"];
                $pet->PetBreed = $pet_data["PetBreed"];
                $pet->PetBirthday = $pet_data["PetBirthday"];
                $pet->PetDeathType = $pet_data["PetDeathType"];
                $pet->PetSex = $pet_data["PetSex"];
                $pet->VacInfo = $pet_data["VacInfo"];
                $pet->Memo = $pet_data["Memo"];
                $pet->save();


            }else{
                $customer = new Customer;
                $customer->ClinicID = $cust_json->ClinicID;
                $customer->CustNo = $cust_data["CustNo"];
                $customer->CustFamilyName = $cust_data["CustFamilyName"];
                $customer->CustName = $cust_data["CustName"];
                $customer->CustFamilyName_furigana = $cust_data["CustFamilyName_furigana"];
                $customer->CustName_furigana = $cust_data["CustName_furigana"];
                $customer->Address = $cust_data["Address"];

                $tels = explode("/", $cust_data["Tel"]);
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

                $customer->MailAddress = $cust_data['MailAddress'];
                $customer->Kubun = $cust_data['Kubun'];
                $customer->LastCommingDate = $cust_data['LastCommingDate'];
                $customer->NextDate = $cust_data['NextDate'];
                $customer->NextReason = $cust_data['NextReason'];
                $customer->CustValid = $cust_data['CustValid'];
                $customer->save();


                Pet::where("ClinicID", $cid)
                    ->where("CustNo", $cust_no)
                    ->delete();

                $pet = new Pet;
                $pet->CustNo = $cust_no;
                $pet->ClinicID = $cid;
                $pet->KarteNo = $pet_data["KarteNo"];
                $pet->PetNo = $pet_data["PetNo"];
                $pet->PetName = $pet_data["PetName"];
                $pet->PetName_furigana = $pet_data["PetName_furigana"];
                $pet->PetKind = $pet_data["PetKind"];
                $pet->PetBreed = $pet_data["PetBreed"];
                $pet->PetBirthday = $pet_data["PetBirthday"];
                $pet->PetDeathType = $pet_data["PetDeathType"];
                $pet->PetSex = $pet_data["PetSex"];
                $pet->VacInfo = $pet_data["VacInfo"];
                $pet->Memo = $pet_data["Memo"];
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
            $customer = Customer::where("ClinicID", $cid)
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

            $reception = Reception::where("ClinicID", $cid)
                ->where("CustNo", $cust_no_old)
                ->update("CustNo", $cust_no_new);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();

            return false;
        }
        return true;
    }

    public function changeKarteNo($cid, $karteno, $cust_no_new, $pet_no_new){
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
