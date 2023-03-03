<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ReceptionReason;
use App\Http\Requests\CreateReceptionReasonRequest;

class ReceptionReasonController extends Controller
{
    //
    public function index(Request $request){

        $cid = $request->session()->get('ClinicID', 'default');

        $reason_list = ReceptionReason::where("ClinicID", $cid)
            ->orderBy("VisitReasonDispOrder", "desc")
            ->get();

        $data = [
            'title' => '来院理由の設定',
            'auth' => $request->session()->all(),
            "reasons" => $reason_list
        ];

        return view('pages.user.reception_reason', $data);
    }

    public function store(CreateReceptionReasonRequest $request){
        $rsn_name = $request->input('reason_name', 'default');
        $rsn_time = $request->input('reason_time', 10);

        $cid = $request->session()->get('ClinicID', 'default');

        $disp = ReceptionReason::where("ClinicID", $cid)->max("VisitReasonDispOrder")+1;

        $reason = new ReceptionReason;
        $reason->ClinicID = $cid;
        $reason->VisitReason = $rsn_name;
        $reason->TakeTime = $rsn_time;
        $reason->VisitReasonDispOrder = $disp;
        $reason->save();

        return redirect('/reception/reason');
    }

    public function swap(Request $request){
        $cid = $request->session()->get('ClinicID', 'default');
        $cur_id = $request->input('cur_id', 'default');
        $target_id = $request->input('target_id', 'default');

        DB::transaction(function () use($cid, $cur_id, $target_id) {
            $cur_reason = ReceptionReason::where("ClinicID", $cid)
                ->where("id", $cur_id)->first();

            $target_reason = ReceptionReason::where("ClinicID", $cid)
                ->where("id", $target_id)->first();


            if($cur_reason && $target_reason){
                $temp = $cur_reason->VisitReasonDispOrder;
                $cur_reason->VisitReasonDispOrder = $target_reason->VisitReasonDispOrder;
                $cur_reason->save();

                $target_reason->VisitReasonDispOrder = $temp;
                $target_reason->save();

                return $cur_reason->VisitReasonDispOrder."-".$target_reason->VisitReasonDispOrder;
            }
        });

        return redirect('/reception/reason');
    }

    public function delete(Request $request, $id){
        $cid = $request->session()->get('ClinicID', 'default');
        $reason = ReceptionReason::where("id", $id)->first();

        if($reason && $reason->ClinicID == $cid){
            $reason->delete();
        }

        return redirect('/reception/reason');
    }

}
