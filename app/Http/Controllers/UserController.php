<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Str;

use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;

class UserController extends Controller
{
    //

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

    public function getUploadPage(Request $request){

        $data = [
            'title' => 'アップロード',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.upload', $data);
    }

    public function getSearchNamePage(Request $request){

        $data = [
            'title' => '名前検索',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.search_name', $data);
    }

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


    public function getSearchPhonePage(Request $request){

        $data = [
            'title' => '番号検索',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.search_phone', $data);
    }

    public function getSearchPhoneResult(Request $request){
        $mode = $request->input('mode', "default");
        $key = $request->input('key', '');

        if($key == "")
            return "";

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
