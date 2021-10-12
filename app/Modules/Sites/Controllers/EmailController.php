<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use App\Modules\Sites\Models\Testimonials_Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Validator;
use Carbon\Carbon;

class EmailController extends Controller
{

    public function getEmail()
    {
        $row = json_decode(json_encode([
            "title" => "Email",
        ]));
        return view('Sites::email.index',compact("row"));
    }

    public function postEmail(Request $request)
    {

        $email_actived = DB::table('authentication')->where('email', $request->email)->first();
        $email_actived_passport = DB::table('passport')->where('email', $request->email)->first();
        $email_actived_driver = DB::table('driver')->where('email', $request->email)->first();
        if ($email_actived == null && $email_actived_passport == null && $email_actived_driver == null) {
            $otp = rand(0, 99999999);
            $dataAll = $request->all();
            $data = [
                'otp' => $otp,
            ];
            Mail::send('Sites::email.send_mail', $data, function ($message) use ($dataAll) {
                $message->from('no-reply@ekyc.live', 'Xác thực KYC');
                $message->to($dataAll['email']);
                $message->subject('Thư xác thực KYC');
            });

            session(['email' => $dataAll['email']]);
            session(['data' => $data]);
            session(['dataAll' => $dataAll]);
            return view('Sites::email.otp_email')->with('data', $data)->with('dataAll', $dataAll);
        } else {
            return view('Sites::email.index')->with('error', "Verified Account");
        }
    }

    public function postOtpEmail(Request $request)
    {
       if ($request->otp == $request->otp_email) {
            return view('Sites::profile.index')->with('email', $request->email);
        } else {
            return view('Sites::email.otp_email')
                ->with('data', session()->get('data'))
                ->with('dataAll', session()->get('dataAll'))
                ->with('error', 'OTP is not correct ');
        }
    }
    public function getOtpEmail()
    {
        $row = json_decode(json_encode([
            "title" => "OTP - Email",
        ]));
        return view('Sites::email.otp_email',compact("row"));
    }
}