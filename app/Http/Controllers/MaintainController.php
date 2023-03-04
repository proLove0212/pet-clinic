<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HTTP\Requests\NewMaintainRequest;
use App\Models\MaintainLog;

class MaintainController extends Controller
{

    public function index(Request $request){

        $plans = MaintainLog::orderBy('from', 'desc')->paginate(10);
        $data = [
            'title' => 'メンテナンス',
            'auth' => $request->session()->all(),
            'plans' => $plans,
            'links' => json_decode(json_encode($plans))->links
        ];

        return view('pages.admin.maintain', $data);
    }

    public function store(NewMaintainRequest $request){

        $data = new MaintainLog;
        $data->from = $request->input('start_time');
        $data->to = $request->input('end_time');
        if($request->input('memo')){
            $data->memo = $request->input('memo');
        }
        $data->save();

        $res = [
            "success" => true,
        ];

        return response()->json($res);
    }

    public function delete(Request $request, $id){
        MaintainLog::where("id", '=', $id)->delete();
        return redirect('admin/maintain');
    }
}
