<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(Request $request){

        $data = [
            'title' => 'サーバーメンテナンス',
            'auth' => $request->session()->all(),
            // 'plans' => $plans,
            // 'links' => json_decode(json_encode($plans))->links
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
}
