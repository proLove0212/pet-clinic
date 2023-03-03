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
