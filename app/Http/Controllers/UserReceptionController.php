<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReceptionController extends Controller
{
    //

    public function getReceptionSetting(Request $request){

        $data = [
            'title' => '時間帯の設定',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.user.reception_setting', $data);
    }
}
