<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Modules\Sites\Models\Authentication;
use App\Modules\Sites\Models\Driver;
use App\Modules\Sites\Models\PassPort;
use App\Modules\Sites\Models\OtpEmail;
use Illuminate\Support\Facades\Http;

class Address extends Controller
{

    public function getAddress()
    {
        $row = json_decode(json_encode([
            "title" => "Address",
        ]));
        return view('Sites::address.index',compact("row"));
    }
    public function postAddress(Request $request)
    {

        if ($request->next == "1" && $request->cmnd == "cmnd") {
 
            if ($request->photo == null) {
                $document = Authentication::findOrFail($request->id);
                return view('Sites::address.index')->with('document', $document)->with('error', 'Pleade take your photo');
            }

            $filePath = public_path() . '/user';
            $data = $request->photo;
            $data = str_replace('data:image/png;base64,', '', $data);
            $data = base64_decode($data);
            file_put_contents("${filePath}/" . "img-" .  date('d-m-y-H-i') . ".jpg", $data);
            // $img_face = DB::table('authentication')->where('id',$id)->first();
            $documents =  Authentication::findOrFail($request->id);
            $documents['img_face_camera'] = "img-" .  date('d-m-y-H-i') . ".jpg";
            $documents->save();
            $c = "https://ekyc.live/public/face/" . $documents['img_face'];
            $d = "https://ekyc.live/public/user/" . $documents['img_face_camera'];

            $response = Http::attach('file[]', file_get_contents($c), 'image.jpg')
                ->attach('file[]',  file_get_contents($d), 'image.jpg')
                ->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR',
                ])->post('https://api.fpt.ai/dmp/checkface/v1');
            $authentica = json_decode($response->body());
//            dd($authentica);
            if ($authentica->data->similarity > 90 && $authentica->data->isMatch) {
                $data = [
                    'email' => $documents['email']
                ];
//                Mail::send('verification_success', $data, function ($message) use ($documents) {
//                    $message->from('no-reply@ekyc.live', 'Account Verification Success');
//                    $message->to($documents['email']);
//                    $message->subject('Account Verification Success');
//                });
                session(['cmnd' => $documents]);
                return view("Sites::inc.report-cmnd")->with('documents', $documents)->with('facematch', $authentica);
            } else {
                $documents->delete();
                return view("Sites::inc.noti-wrong");
            }
        } else if ($request->pre == "0") {
            return redirect('Sites::document.index');
        }
        if ($request->next == "1" && $request->passport == "passport") {
	    if ($request->photo == null) {
                $document =  PassPort::findOrFail($request->id);
                return view('Sites::passport.index')->with('passport', $document)->with('error', 'Pleade take your photo');
            }
            $filePath = public_path() . '/user_passport';
            $data = $request->photo;
            $data = str_replace('data:image/png;base64,', '', $data);
            $data = base64_decode($data);
            file_put_contents("${filePath}/" . "img-passport" .  date('d-m-y-H-i') . ".jpg", $data);

            // $img_face = DB::table('authentication')->where('id',$id)->first();
            $documents =  PassPort::findOrFail($request->id);
            $documents['img_passport_camera'] = "img-passport" .  date('d-m-y-H-i') . ".jpg";
            $documents->save();

            $c = "https://ekyc.live/public/face_passport/" . $documents['img_passport'];
            $d = "https://ekyc.live/public/user_passport/" . $documents['img_passport_camera'];

            $response = Http::attach('file[]', file_get_contents($c), 'image.jpg')
                ->attach('file[]',  file_get_contents($d), 'image.jpg')
                ->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR',
                ])->post('https://api.fpt.ai/dmp/checkface/v1');
            $authentica = json_decode($response->body());
//            dd($authentica);
            if ($authentica->data->similarity > 90 && $authentica->data->isMatch) {
                $data = [
                    'email' => $documents['email']
                ];
//                Mail::send('verification_success', $data, function ($message) use ($documents) {
//                    $message->from('no-reply@ekyc.live', 'Account Verification Success');
//                    $message->to($documents['email']);
//                    $message->subject('Account Verification Success');
//                });
                session(['documents' => $documents]);
                return view("Sites::inc.report-passport")->with('documents', $documents)->with('facematch', $authentica);
            } else {
                $documents->delete();
                return view("Sites::inc.noti-wrong");
            }
        } else if ($request->pre == "0") {
            return redirect('Sites::document.index');
        }
        if ($request->next == "1" && $request->driver == "driver") {
	
            if ($request->photo == null) {
                $document =  Driver::findOrFail($request->id);
                return view('driver')->with('driver', $document)->with('error','Pleade take your photo');
            }
            $filePath = public_path() . '/user_driver';
            $data = $request->photo;
            $data = str_replace('data:image/png;base64,', '', $data);
            $data = base64_decode($data);
            file_put_contents("${filePath}/" . "img-driver" .  date('d-m-y-H-i') . ".jpg", $data);

            // $img_face = DB::table('authentication')->where('id',$id)->first();
            $documents =  Driver::findOrFail($request->id);
            $documents['img_face_camere'] = "img-driver" .  date('d-m-y-H-i') . ".jpg";
            $documents->save();
            $c = "https://ekyc.live/public/face_driver/" . $documents['img_face'];
            $d = "https://ekyc.live/public/user_driver/" . $documents['img_face_camere'];

            $response = Http::attach('file[]', file_get_contents($c), 'image.jpg')
                ->attach('file[]',  file_get_contents($d), 'image.jpg')
                ->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR',
                ])->post('https://api.fpt.ai/dmp/checkface/v1');
            $authentica = json_decode($response->body());
//            dd($authentica);
            if ($authentica->data->similarity > 90 && $authentica->data->isMatch) {
                $data = [
                    'email' => $documents['email']
                ];
//                Mail::send('verification_success', $data, function ($message) use ($documents) {
//                    $message->from('no-reply@ekyc.live', 'Account Verification Success');
//                    $message->to($documents['email']);
//                    $message->subject('Account Verification Success');
//                });
                session(['driver' => $documents]);
                return view("Sites::inc.report-driver")->with('documents', $documents)->with('facematch', $authentica);
            } else {
                $documents->delete();
                return view("Sites::inc.noti-wrong");
            }
        } else if ($request->pre == "0") {
            return redirect('Sites::document.index');
        }
    }

}
