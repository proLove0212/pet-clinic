<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\HTTP\Requests\SendEmailRequest;

use App\Mail\CustomMail;
use App\Models\User;
class AdminMailController extends Controller
{

    public function index(Request $request){

        $users = User::get();

        $data = [
            'title' => 'メール連絡',
            'auth' => $request->session()->all(),
            "users" => $users
        ];

        return view('pages.admin.mail', $data);
    }

    public function send(SendEmailRequest $request){

        $subject = $request->input('subject', 'PetClinic');
        $content = $request->input('content', '...');
        $receivers = $request->input('receivers', []);

        foreach ($receivers as $key => $receiver) {

            try {
                Mail::to($receiver)->send(new CustomMail($subject, $content));
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        $res = [
            "success" => true,
        ];

        return response()->json($res);

    }
}
