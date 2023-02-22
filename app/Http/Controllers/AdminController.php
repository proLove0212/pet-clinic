<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function all_users(Request $request){

        $data = [
            'user' => $request->session()->all()
        ];

        return view('pages.admin.index', $data);
    }
}
