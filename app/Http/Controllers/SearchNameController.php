<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;
use DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;

class SearchNameController extends Controller
{
    //

    /***************************************************
     * url: /search/name
     * method: GET
     * description: get search page by customer name and pet name.
     * *************************************************/
    public function index(Request $request){

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
    public function search(Request $request){
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
                    'html'=> $rslt,
                    "rslt_cnt" => count($customers)
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
