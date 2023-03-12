<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Str;
use App\Models\Customer;
use App\Models\Pet;

class SearchController extends Controller
{
    //

    /***************************************************
     * url: /search/no
     * method: GET
     * description: get search page by customer number and telephone number.
     * *************************************************/
    public function index(Request $request){

        return view('pages.user.search.index');
    }

     /***************************************************
     * url: /search
     * method: POST
     * description: ajax call, search information is contained in request
     *              after search, return view.
     * *************************************************/
    public function search(Request $request){
        $mode = $request->input('search_mode', "default");

        $cid = Auth::user()->ClinicID;

        $pet_mode = $request->input('pet_mode', ['only-live'])[0];

        $rslt = [];

        if($mode == "number"){
            $rslt = $this->searchByNo($request->input(), $cid);
        }else if($mode == "name"){
            $rslt = $this->searchByName($request->input(), $cid, $pet_mode);
        }

        $custs = array_map(function($cust) use($cid, $pet_mode){
            if($pet_mode == "only-live"){
                $pets = Pet::where("ClinicID", $cid)
                    ->where("CustNo", $cust['CustNo'])
                    ->where("PetDeathType", 0)
                    ->get()->toArray();

                $cust['pets'] = $pets;
                return $cust;
            }else{
                $pets = Pet::where("ClinicID", $cid)
                    ->where("CustNo", $cust['CustNo'])
                    ->get()->toArray();

                $cust['pets'] = $pets;
                return $cust;
            }
        }, $rslt['data']);

        $data = [
            'data' => $custs,
        ];
        return view('pages.user.search.result', $data);
    }

    public function searchByNo($input, $cid){

        try {
            $mode = $input['mode'];

            if($mode == "cust"){
                $key = $input['cust-no'];
                $customers = Customer::where("ClinicID", "=", $cid)
                ->where("CustNo", "like", "%".$key."%")
                ->orderBy("LastCommingDate", "desc")
                ->limit(30)
                ->get()->toArray();

                if(count($customers)){
                    return [
                        "success" => true,
                        "data" => $customers
                    ];
                }else{
                    return [
                        "success" => false,
                        "data" => []
                    ];
                }
            }else if($mode == "tel") {
                $key = $input['tel-no'];
                if( strlen($key) == 4 ){
                    $tel = $key;

                    $customers = Customer::where("ClinicID", $cid)
                    ->where(function($query) use($tel) {
                        $query->whereEncrypted("Tel1Last4", $tel)
                        ->orWhereEncrypted("Tel2Last4", $tel)
                        ->orWhereEncrypted("Tel3Last4", $tel)
                        ->orWhereEncrypted("Tel4Last4", $tel)
                        ->orWhereEncrypted("Tel5Last4", $tel)
                        ->orWhereEncrypted("Tel6Last4", $tel)
                        ->orWhereEncrypted("Tel7Last4", $tel)
                        ->orWhereEncrypted("Tel8Last4", $tel);
                    })
                    ->orderBy("LastCommingDate", "desc")
                    ->limit(30)
                    ->get()->toArray();


                    if(count($customers)){
                        return [
                            "success" => true,
                            "data" => $customers
                        ];
                    }else{
                        return [
                            "success" => false,
                            "data" => []
                        ];
                    }

                }else{
                    $tel = Str::replace('-', '', $key);
                    $customers = Customer::where("ClinicID", "=", $cid)
                    ->where(function($query) use($tel) {
                        $query->whereEncrypted("Tel1Num", "=", $tel)
                            ->orWhereEncrypted("Tel2Num", "=", $tel)
                            ->orWhereEncrypted("Tel3Num", "=", $tel)
                            ->orWhereEncrypted("Tel4Num", "=", $tel)
                            ->orWhereEncrypted("Tel5Num", "=", $tel)
                            ->orWhereEncrypted("Tel6Num", "=", $tel)
                            ->orWhereEncrypted("Tel7Num", "=", $tel)
                            ->orWhereEncrypted("Tel8Num", "=", $tel);
                    })
                    ->orderBy("LastCommingDate", "desc")
                    ->limit(30)
                    ->get()->toArray();

                    if(count($customers)){
                        return [
                            "success" => true,
                            "data" => $customers
                        ];
                    }else{
                        return [
                            "success" => false,
                            "data" => []
                        ];
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return [
                "success" => false,
                "data" => []
            ];
        }
    }

    public function searchByName($input, $cid, $pet_mode){

        try {
            $cust_family_name =$input['cust_family_name'];
            $cust_name = $input['cust_name'];
            $cust_family_name_furigana = $input['cust_family_name_furigana'];
            $cust_name_furigana = $input['cust_name_furigana'];
            $address = $input['address'];
            $pet_name = $input['pet_name'];

            if($pet_name == ""){

                $customers = Customer::where("ClinicID", "=", $cid)
                    ->where(function($query) use($cust_family_name, $cust_name, $cust_family_name_furigana, $cust_name_furigana, $address ) {
                        $query->orWhereEncrypted("CustFamilyName", "like", "%".$cust_family_name."%")
                        ->orWhereEncrypted("CustName", "like", "%".$cust_name."%")
                        ->orWhereEncrypted("CustFamilyName_furigana", "like", "%".$cust_family_name_furigana."%")
                        ->orWhereEncrypted("CustName_furigana", "like", "%".$cust_name_furigana."%")
                        ->orWhereEncrypted("Address", "like", "%".$address."%");
                    })
                    ->get()->toArray();


                if(count($customers)){
                    return [
                        "success" => true,
                        "data" => $customers
                    ];
                }else{
                    return [
                        "success" => false,
                        "data" => []
                    ];
                }
            }else{
                $pets = [];
                if($pet_mode == "only-live"){
                    $pets = Pet::where("ClinicID", $cid)
                        ->where("PetDeathType", 0)
                        ->where(function ($query) use ($pet_name) {
                            $query->where('PetName', 'like', "%{$pet_name}%")
                                ->orWhere('PetName_furigana', 'like', "%{$pet_name}%");
                        })
                        ->pluck("CustNo");
                }else{
                    $pets = Pet::where("ClinicID", $cid)
                        ->where(function ($query) use ($pet_name) {
                            $query->where('PetName', 'like', "%{$pet_name}%")
                                ->orWhere('PetName_furigana', 'like', "%{$pet_name}%");
                        })
                        ->pluck("CustNo");
                }


                $customers = Customer::where("ClinicID", $cid)
                    ->where(function($query) use($cust_family_name, $cust_name, $cust_family_name_furigana, $cust_name_furigana, $address ) {
                        $query->orWhereEncrypted("CustFamilyName", "like", "%".$cust_family_name."%")
                        ->orWhereEncrypted("CustName", "like", "%".$cust_name."%")
                        ->orWhereEncrypted("CustFamilyName_furigana", "like", "%".$cust_family_name_furigana."%")
                        ->orWhereEncrypted("CustName_furigana", "like", "%".$cust_name_furigana."%")
                        ->orWhereEncrypted("Address", "like", "%".$address."%");
                    })
                    ->whereIn("CustNo", $pets)
                    ->get()->toArray();


                if(count($customers)){
                    return [
                        "success" => true,
                        "data" => $customers
                    ];
                }else{
                    return [
                        "success" => false,
                        "data" => []
                    ];
                }
            }

        } catch (\Throwable $th) {
            //throw $th;
            return [
                "success" => false,
                "data" => []
            ];
        }
    }

    public function getCustomerInfo(Request $request, $c_no){
        $cid = Auth::user()->ClinicID;
        $customer = Customer::where("CustNo", $c_no)
            ->where("ClinicID", $cid)
            ->first();

        if($customer){
            $pets = Pet::where("CustNo", $c_no)
            ->where("ClinicID", $cid)
            ->get();

            $data = [
                "customer" => $customer,
                "pets" => $pets
            ];

            return view("pages.customer.info", $data);
        }else{

            return view('errors.404');
        }

    }
}
