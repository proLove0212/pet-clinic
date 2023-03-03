<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;

class UserDashboardController extends Controller
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
            'title' => '管理画面',
            'auth' => $request->session()->all(),
            'customer_cnt' => $customer_cnt,
            'pet_cnt' => $pet_cnt,
            'reception_cnt' => $reception_cnt
        ];

        return view('pages.user.index', $data);
    }

}
