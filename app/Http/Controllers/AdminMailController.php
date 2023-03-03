<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\HTTP\Requests\SendEmailRequest;

use App\Mail\CustomMail;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Reception;

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

            Mail::to($receiver)->send(new CustomMail($subject, $content));
        }

        $res = [
            "success" => true,
        ];

        return response()->json($res);

    }
}
