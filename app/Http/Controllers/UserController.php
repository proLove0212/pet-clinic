<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Str;
use DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;

class UserController extends Controller
{
    //

    /***************************************************
     * url: /dashboard
     * method: GET
     * description: get user dashboard
     * *************************************************/
    public function index(Request $request){
        $cid = $request->session()->get('ClinicID', 'default');

        $customer_cnt = Customer::where("ClinicID", "=", $cid)->count();
        $pet_cnt = Pet::where("ClinicID", "=", $cid)->count();
        $reception_cnt = Reception::where("ClinicID", "=", $cid)->count();

        $data = [
            'title' => 'サーバーメンテナンス',
            'auth' => $request->session()->all(),
            'customer_cnt' => $customer_cnt,
            'pet_cnt' => $pet_cnt,
            'reception_cnt' => $reception_cnt
        ];

        return view('pages.user.index', $data);
    }

    /***************************************************
     * url: /upload
     * method: GET
     * description: get upload page
     * *************************************************/
    public function getUploadPage(Request $request){

        $data = [
            'title' => 'アップロード',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.upload', $data);
    }

    public function uploadCustomerData(Request $request){
        $cust_json = $request->input('cust_data', null);

        $cid = $request->session()->get('ClinicID', 'default');

        if($cust_json['Version'] != "Ver2.0")
            return response()->json([
                "success" => false,
                "msg" => "以前の版本の資料です。"

            ], 400);


        if($cust_json['ClinicID'] != $cid)
            return response()->json([
                "success" => false,
                "msg" => "アクセスできません。"

            ], 400);


        DB::transaction(function () use($cust_json, $cid) {
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

                $customer->MailAddress = $cust_json['CustData']['MailAddress'];
                $customer->Kubun = $cust_json['CustData']['Kubun'];
                $customer->LastCommingDate = $cust_json['CustData']['LastCommingDate'];
                $customer->NextDate = $cust_json['CustData']['NextDate'];
                $customer->NextReason = $cust_json['CustData']['NextReason'];
                $customer->CustValid = $cust_json['CustData']['CustValid'];
                $customer->save();

                Pet::where("PetNo", $cust_json['PetData']["PetNo"])
                    ->orWhere("KarteNo", $cust_json['PetData']["KarteNo"])
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

                $customer->MailAddress = $cust_json['CustData']['MailAddress'];
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
                $pet->PetSex = $cust_json['PetData']["PetSex"];
                $pet->VacInfo = $cust_json['PetData']["VacInfo"];
                $pet->Memo = $cust_json['PetData']["Memo"];
                $pet->save();

            }

        });

        return response()->json([
            "success" => true,

        ], 200);


    }

    /***************************************************
     * url: /search/name
     * method: GET
     * description: get search page by customer name and pet name.
     * *************************************************/
    public function getSearchNamePage(Request $request){

        $data = [
            'title' => '名前検索',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.search_name', $data);
    }

    /***************************************************
     * url: /search/name
     * method: POST
     * description: ajax call, search information is contained in request
     *              after search, return view.
     * *************************************************/
    public function getSearchNameResult(Request $request){
        $cust_family_name = $request->input('cust_family_name', '');
        $cust_name = $request->input('cust_name', '');
        $cust_family_name_furigana = $request->input('cust_family_name_furigana', '');
        $cust_name_furigana = $request->input('cust_name_furigana', '');
        $address = $request->input('address', '');
        $pet_name = $request->input('pet_name', '');

        $cid = $request->session()->get('ClinicID', 'default');

        if($pet_name == ""){

            $customers = Customer::where("ClinicID", "=", $cid)
                ->where("CustFamilyName", "like", "%".$cust_family_name."%")
                ->where("CustName", "like", "%".$cust_name."%")
                ->where("CustFamilyName_furigana", "like", "%".$cust_family_name_furigana."%")
                ->where("CustName_furigana", "like", "%".$cust_name_furigana."%")
                ->where("Address", "like", "%".$address."%")
                ->get();


            if(count($customers)){
                $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                return response()->json( array(
                    'success' => true,
                    'html'=> $rslt
                ));
            }else{
                return response()->json( array(
                    'success' => false,
                ));
            }
        }else{
            $pets = Pet::where("ClinicID", $cid)
                ->where(function (Builder $query) use ($pet_name) {
                    $query->where('PetName', 'like', "%{$pet_name}%")
                        ->orWhere('PetName_furigana', 'like', "%{$pet_name}%");
                })
                ->pluck("CustNo");

            $customers = Customer::where("ClinicID", "=", $cid)
                ->where("CustFamilyName", "like", "%".$cust_family_name."%")
                ->where("CustName", "like", "%".$cust_name."%")
                ->where("CustFamilyName_furigana", "like", "%".$cust_family_name_furigana."%")
                ->where("CustName_furigana", "like", "%".$cust_name_furigana."%")
                ->where("Address", "like", "%".$address."%")
                ->whereIn("CustNo", $pets)
                ->get();


            if(count($customers)){
                $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                return response()->json( array(
                    'success' => true,
                    'html'=> $rslt
                ));
            }else{
                return response()->json( array(
                    'success' => false,
                ));
            }
        }


    }


    /***************************************************
     * url: /search/phone
     * method: GET
     * description: get search page by customer number and telephone number.
     * *************************************************/
    public function getSearchPhonePage(Request $request){

        $data = [
            'title' => '番号検索',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.search_phone', $data);
    }

    /***************************************************
     * url: /search/phone
     * method: POST
     * description: ajax call, search information is contained in request
     *              after search, return view.
     * *************************************************/
    public function getSearchPhoneResult(Request $request){
        $mode = $request->input('mode', "default");
        $key = $request->input('key', '');

        $cid = $request->session()->get('ClinicID', 'default');

        if($mode == "cust"){
            $customers = Customer::where("ClinicID", "=", $cid)
            ->where("CustNo", "like", "%".$key."%")
            ->orderBy("LastCommingDate", "desc")
            ->limit(30)
            ->get();

            if(count($customers)){
                $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                return response()->json( array(
                    'success' => true,
                    'html'=> $rslt
                ));
            }else{
                return response()->json( array(
                    'success' => false,
                ));
            }
        }else if($mode == "tel") {
            if( strlen($key) == 4 ){
                $tel = $key;
                $customers = Customer::where("Tel1Last4", "=", $tel)
                ->orWhere("Tel2Last4", "=", $tel)
                ->orWhere("Tel3Last4", "=", $tel)
                ->orWhere("Tel4Last4", "=", $tel)
                ->orWhere("Tel5Last4", "=", $tel)
                ->orWhere("Tel6Last4", "=", $tel)
                ->orWhere("Tel7Last4", "=", $tel)
                ->orWhere("Tel8Last4", "=", $tel)
                ->orderBy("LastCommingDate", "desc")
                ->limit(30)
                ->get();

                if(count($customers)){
                    $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                    return response()->json( array(
                        'success' => true,
                        'html'=> $rslt
                    ));
                }else{
                    return response()->json( array(
                        'success' => false,
                    ));
                }

            }else{
                $tel = Str::replace('-', '', $key);
                $customers = Customer::where("ClinicID", "=", $cid)
                ->where(function($query) use($tel) {
                    $query->where("Tel1Last4", "=", $tel)
                    ->orWhere("Tel2Last4", "=", $tel)
                    ->orWhere("Tel3Last4", "=", $tel)
                    ->orWhere("Tel4Last4", "=", $tel)
                    ->orWhere("Tel5Last4", "=", $tel)
                    ->orWhere("Tel6Last4", "=", $tel)
                    ->orWhere("Tel7Last4", "=", $tel)
                    ->orWhere("Tel8Last4", "=", $tel);
                })
                ->orderBy("LastCommingDate", "desc")
                ->limit(30)
                ->get();

                if(count($customers)){
                    $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                    return response()->json( array(
                        'success' => true,
                        'html'=> $rslt
                    ));
                }else{
                    return response()->json( array(
                        'success' => false,
                    ));
                }
            }
        }
    }

    /***************************************************
     * url: /customer/view/{c_no}
     * method: GET
     * description: get customer's all information. this is called
     *              when you click "more" button.
     * *************************************************/
    public function getCustomerInfo(Request $request, $c_no){
        $cid = $request->session()->get('ClinicID', 'default');
        $customer = Customer::where("CustNo", $c_no)
            ->where("ClinicID", $cid)
            ->first();

        if($customer){
            $pets = Pet::where("CustNo", $c_no)
            ->where("ClinicID", $cid)
            ->get();

            $data = [
                'title' => '顧客情報',
                'auth' => $request->session()->all(),
                "customer" => $customer,
                "pets" => $pets
            ];

            return view("pages.customer.info", $data);
        }else{
            $request->session()->flush();
            return redirect('/');
        }

    }
}
