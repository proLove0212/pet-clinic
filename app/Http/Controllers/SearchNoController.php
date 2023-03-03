<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;
use DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;

class SearchNoController extends Controller
{
    //

    /***************************************************
     * url: /search/no
     * method: GET
     * description: get search page by customer number and telephone number.
     * *************************************************/
    public function index(Request $request){

        $data = [
            'title' => '番号検索',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.search_no', $data);
    }

    /***************************************************
     * url: /search/no
     * method: POST
     * description: ajax call, search information is contained in request
     *              after search, return view.
     * *************************************************/
    public function search(Request $request){
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
                    'html'=> $rslt,
                    "rslt_cnt" => count($customers)
                ));
            }else{
                return response()->json( array(
                    'success' => false,
                ));
            }
        }else if($mode == "tel") {
            if( strlen($key) == 4 ){
                $tel = "0002";

                $customers = Customer::where("ClinicID", "=", $cid)
                ->where(function($query) use($tel) {
                    $query->whereEncrypted("Tel1Last4", "=", $tel)
                    ->orWhereEncrypted("Tel2Last4", "=", $tel)
                    ->orWhereEncrypted("Tel3Last4", "=", $tel)
                    ->orWhereEncrypted("Tel4Last4", "=", $tel)
                    ->orWhereEncrypted("Tel5Last4", "=", $tel)
                    ->orWhereEncrypted("Tel6Last4", "=", $tel)
                    ->orWhereEncrypted("Tel7Last4", "=", $tel)
                    ->orWhereEncrypted("Tel8Last4", "=", $tel);
                })
                ->orderBy("LastCommingDate", "desc")
                ->limit(30)
                ->get();

                if(count($customers)){
                    $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                    return response()->json( array(
                        'success' => true,
                        'html'=> $rslt,
                        "rslt_cnt" => count($customers)
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
                ->get();

                if(count($customers)){
                    $rslt = view("parts.customer_list")->with("customers", $customers)->render();

                    return response()->json( array(
                        'success' => true,
                        'html'=> $rslt,
                        "rslt_cnt" => count($customers)
                    ));
                }else{
                    return response()->json( array(
                        'success' => false,
                    ));
                }
            }
        }
    }
}
