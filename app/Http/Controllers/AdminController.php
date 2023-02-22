<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function all_users(Request $request){

        $data = [
            'title' => '全ユーザー',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.index', $data);
    }

    public function add_user(Request $request){

        $data = [
            'title' => 'ユーザー新規追加',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.new_user', $data);
    }

    public function search_user(Request $request){

        $data = [
            'title' => '高度な検索',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.new_user', $data);
    }

    public function mail(Request $request){

        $data = [
            'title' => 'メール連絡',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.mail', $data);
    }

    public function maintain(Request $request){

        $data = [
            'title' => 'サーバーメンテナンス',
            'user' => $request->session()->all()
        ];

        return view('pages.admin.maintain', $data);
    }
}
