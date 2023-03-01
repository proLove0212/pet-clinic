<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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

        return response()->json([
            "n" => Crypt::encryptString("asdf"),
            "ne" => Crypt::encryptString("asdf")
        ], 200);


        if($key == "")
            return "";

        $cid = $request->session()->get('ClinicID', 'default');

        if($mode == "cust"){
            $customers = Customer::where("ClinicID", "=", $cid)
            ->where("CustNo", "like", "%".$key."%")
            ->orderBy("LastCommingDate", "desc")
            ->limit(30)
            ->get();

            $rslt = view("parts.customer_list")->with("customers", $customers)->render();

            return response()->json( array(
                'success' => true,
                'html'=> $rslt
            ));
        }else if($mode == "tel") {
            if( strlen($key) == 4 ){
                $tel = Crypt::encryptString($key);
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

                $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                return response()->json( array(
                    'success' => true,
                    'html'=> $rslt
                ));

            }else{
                $tel = Crypt::encryptString(Str::replace('-', '', $key));
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

                $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                return response()->json( array(
                    'success' => true,
                    'html'=> $rslt
                ));
            }
        }
    }

    public function getCustomerInfo(Request $request, $c_no){


        return view("pages.customer.info");
    }
}
