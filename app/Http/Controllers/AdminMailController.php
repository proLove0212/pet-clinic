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
        $content = $request->input('content', 'Hello!');
        $receivers = $request->input('receivers', []);

        try {
            foreach ($receivers as $key => $receiver) {
                Mail::to($receiver)->send(new CustomMail($subject, $content));
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('admin.contact'))->withInput([
                'failed' => true,
                'message' => 'メール送信失敗'
            ]);
        }

        return redirect(route('admin.contact'))->withInput([
            'success' => true,
            'message' => '正常に送信されました'
        ]);

    }
}
