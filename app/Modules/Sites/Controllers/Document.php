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
use Carbon\Carbon;

class Document extends Controller
{
    public function getdocument(Request $request)
    {
        $row = json_decode(json_encode([
            "title" => "Document",
        ]));
        return view('Sites::document.index',compact("row"));
    }

    public function postdocument(Request $request)
    {
        // $a = "https://static.openfpt.vn/vision/faces/2021-09-11/2021-09-11T02:03:12.487940_image.jpg";
        // $b = str_replace('https', 'http', $a);
        // dd($b);
 	if ($request->tab == "cmnd") {
            $this->validate(
                $request,
                [
                    'front' => 'required',
                    'behind' => 'required',
                ]
            );
        } else if ($request->tab == "passport") {
            $this->validate(
                $request,
                [
                    'passport' => 'required',
                ]
            );
        } else if ($request->tab = "driver") {
            $this->validate(
                $request,
                [
                    'driver_front' => 'required',
                    'driver_behind' => 'required',
                ]
            );
        }
        if ($request->next == "1" && $request->tab == "cmnd") {
            if ($request->front && $request->behind) {
                $file = $request->front->getClientOriginalExtension();
                if ($file == "png" || $file == "jpeg" || $file == "jpg") {
                    $file = $request->front->getClientOriginalName();
                    $filePath = public_path() . '/CMND';
                    $request->front->move($filePath, $file);
                }

//                $profiles = session()->get('profile');
//                $email = $profiles[0];
//                $id = session()->get('id');
//                dd($email['email'],$id);
                $file1 = $request->behind->getClientOriginalExtension();
                if ($file1 == "png" || $file1 == "jpeg" || $file1 == "jpg") {
                    $file1 = $request->behind->getClientOriginalName();
                    $filePath = public_path() . '/CMND';
                    $request->behind->move($filePath, $file1);
                }
                $a = "https://ekyc.live/public/CMND/" . $file;
//                $response = Http::attach('image', file_get_contents($a), 'image.jpg')->withHeaders([
//                    'api_key' => 'KPLTkGa2fUHQf3M7ruBmRZfzOigDUGXn'
//                ])->post('https://api.fpt.ai/vision/idr/vnm', ['face' => 1]);

                $response = Http::attach('image', file_get_contents($a), 'image.jpg')->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR'
                ])->post('https://api.fpt.ai/vision/idr/vnm', ['face' => 1]);

                $authentica = json_decode($response->body());
//                dd($authentica);
                //check data fpt return
                switch ($authentica->errorCode) {
                    case "2":
                        return view('Sites::document.index')->with('noti', 'Image Font Side Failed in cropping ');
                        break;
                    case "3":
                        return view('Sites::document.index')->with('noti', 'Image Font Side Unable to find ID card in the image');
                        break;
                    case "7":
                        return view('Sites::document.index')->with('noti', 'Image Font Side Unable to find ID card in the image');
                        break;
                }
                if(!isset($authentica->data[0]->id)){
                    return view('Sites::document.index')->with('noti', 'Invalid photo identity card front');
                }
                //check cmnd exist db
                $profiles = session()->get('profile');
                $email = $profiles[0];
                $id = session()->get('id');
                $app_ids="";
                if($id==null){
                    $app_ids=0;
                    $id=0;
                }else{
                    $app_id_list = DB::table('kyc_app')->get('app_id');

                    foreach ($app_id_list as $app_id) {
                        if($id === md5($app_id->app_id)){
                            $app_ids = $app_id->app_id;
                        }
                    }
                }
                $chek_cmnd = DB::table('authentication')
                    ->where('cmnd',$authentica->data[0]->id);
                if($chek_cmnd->exists()){
                    foreach ($chek_cmnd->get() as $item){
                        if($item->email != $email['email']){
                            if(md5($item->app_id) == $id){
                                return view('Sites::document.index')->with('noti', 'This identity card has been used');
                            }
                        }else{
                            if(md5($item->app_id) == $id){
                                return view('Sites::document.index')->with('noti', 'This identity card has been used');
                            }
                        }
                    }
                }
                //Behind
                $b = "https://ekyc.live/public/CMND/" . $file1;
                $response = Http::attach('image', file_get_contents($b), 'image.jpg')->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR'
                ])->post('https://api.fpt.ai/vision/idr/vnm', ['face' => 1]);
                $authentica1 = json_decode($response->body());
//                dd($authentica1);
                switch ($authentica1->errorCode) {
                    case "2":
                        return view('Sites::document.index')->with('noti', 'Image Back Side Failed in cropping ');
                        break;
                    case "3":
                        return view('Sites::document.index')->with('noti', 'Image Back Side Unable to find ID card in the image');
                        break;
                    case "7":
                        return view('Sites::document.index')->with('noti', 'Image Back Side Unable to find ID card in the image');
                        break;
                }
                if(!isset($authentica1->data[0]->ethnicity)){
                    return view('Sites::document.index')->with('noti', 'Invalid photo identity card behind');
                }
                if ($authentica->errorCode == "0" && $authentica1->errorCode == "0") {
                    $documents = new Authentication();
                    $documents['img_front'] = $file;
                    $documents['img_behind'] = $file1;
                    $documents->save();
                    //Front 
                    $documents['name'] = $authentica->data[0]->name;
                    $documents['cmnd'] = $authentica->data[0]->id;
                    $dob =  \DateTime::createFromFormat('d/m/Y', $authentica->data[0]->dob)->format('Y-m-d');
                    $documents['dob'] = $dob;
                    $documents['home'] = $authentica->data[0]->home;
                    $documents['address'] = $authentica->data[0]->address;

                    $documents['img_face'] =  "user-" .  date('d-m-y-H-i') . '.jpg';
                    //Save Image face CMND in folder face    
                    $path = public_path() . '/face';
                    $image = file_get_contents($authentica->data[0]->face);
                    file_put_contents("${path}/" . "user-" . date('d-m-y-H-i') . ".jpg", $image);
                    //behind
                    $documents['ethnicity'] = $authentica1->data[0]->ethnicity;
                    $documents['religion'] = $authentica1->data[0]->religion;
                    $documents['features'] = $authentica1->data[0]->features;
                    $issue_date =  \DateTime::createFromFormat('d/m/Y', $authentica1->data[0]->issue_date)->format('Y-m-d');
                    $documents['issue_date'] = $issue_date;
                    $documents['issue_loc'] = $authentica1->data[0]->issue_loc;
                    $documents['email'] = $email['email'];
                    $profile = session()->get('profile');
                    $documents['gender'] = $profile[0]['gender'];
                    $documents['app_id'] = $app_ids;
                    $documents['created_at'] = Carbon::now();
//                    dd($documents['email'],$documents['gender']);

                    $documents->save();
                }
            }
            return view('Sites::address.index')->with('document', $documents);
        } else if ($request->pre == "0") {
            return redirect('profile');
        } else if ($request->next == "1" && $request->tab == "passport") {
            if ($request->passport) {
                $file = $request->passport->getClientOriginalExtension();
                if ($file == "png" || $file == "jpeg" || $file == "jpg") {
                    $file = $request->passport->getClientOriginalName();
                    $filePath = public_path() . '/passport';
                    $request->passport->move($filePath, $file);
                }
                $a = "https://ekyc.live/public/passport/" . $file;

                $response = Http::attach('image', file_get_contents($a), 'image.jpg')->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR'
                ])->post('https://api.fpt.ai/vision/passport/vnm', ['face' => 1]);
                $authentica = json_decode($response->body());
//                dd($authentica);

                switch ($authentica->errorCode) {
                    case "2":
                        return view('Sites::document.index')->with('noti', 'The Vietnamese Passport in the image is missing of corners so it cannot be cropped to the standard format.');
                        break;
                    case "3":
                        return view('Sites::document.index')->with('noti', 'The system cannot find the Vietnamese Passport in the image or the image is of poor quality (too blur, too dark/bright).');
                        break;
                    case "7":
                        return view('Sites::document.index')->with('noti', 'The uploaded file is not an image file.');
                        break;
                }
                if(!isset($authentica->data[0]->passport_number)){
                    return view('Sites::document.index')->with('noti', 'Invalid photo passport');
                }
                //check PASSPORT exist db
                $profiles = session()->get('profile');
                $email = $profiles[0];
                $id = session()->get('id');
                $app_ids="";
                if($id==null){
                    $app_ids=0;
                    $id=0;
                }else{
                    $app_id_list = DB::table('kyc_app')->get('app_id');

                    foreach ($app_id_list as $app_id) {
                        if($id === md5($app_id->app_id)){
                            $app_ids = $app_id->app_id;
                        }
                    }
                }
                $chek_passport = DB::table('passport')
                    ->where('passport_number',$authentica->data[0]->passport_number);
                if($chek_passport->exists()){
                    foreach ($chek_passport->get() as $item){
                        if($item->email != $email['email']){
                            if(md5($item->app_id) == $id){
                                return view('Sites::document.index')->with('noti', 'This passport has been used');
                            }
                        }else{
                            if(md5($item->app_id) == $id){
                                return view('Sites::document.index')->with('noti', 'This passport has been used');
                            }
                        }
                    }
                }

                if ($authentica->errorCode == "0") {
                    $passport = new PassPort();
                    $passport['img'] = $file;
                    $passport['name'] = $authentica->data[0]->name;
                    $passport['email'] = $email['email'];
                    $dob =  \DateTime::createFromFormat('d/m/Y', $authentica->data[0]->dob)->format('Y-m-d');
                    $passport['dob'] = $dob;
                    $passport['sex'] = $authentica->data[0]->sex;
                    $passport['pob'] = $authentica->data[0]->pob;
                    $passport['id_number'] = $authentica->data[0]->id_number;
                    $passport['passport_number'] = $authentica->data[0]->passport_number;
                    $doi =  \DateTime::createFromFormat('d/m/Y', $authentica->data[0]->doi)->format('Y-m-d');
                    $passport['doi'] = $doi;
                    $doe =  \DateTime::createFromFormat('d/m/Y', $authentica->data[0]->doe)->format('Y-m-d');
                    $passport['doe'] = $doe;
                    $passport['img_passport'] =  "user-passport-" .  date('d-m-y-H-i') . '.jpg';
                    $passport['app_id'] = $app_ids;
                    $passport['created_at'] = Carbon::now();

                    //Save Image face CMND in folder face
                    $path = public_path() . '/face_passport';
                    $image = file_get_contents($authentica->data[0]->face);
                    file_put_contents("${path}/" . "user-passport-" . date('d-m-y-H-i') . ".jpg", $image);

                    $passport->save();
                    return view('Sites::passport.index')->with('passport', $passport);
                }
            }
        } else if ($request->next == "1" && $request->tab == "driver") {
            if ($request->driver_front && $request->driver_behind) {
                $file = $request->driver_front->getClientOriginalExtension();
                if ($file == "png" || $file == "jpeg" || $file == "jpg") {
                    $file = $request->driver_front->getClientOriginalName();
                    $filePath = public_path() . '/driver';
                    $request->driver_front->move($filePath, $file);
                }
                $file1 = $request->driver_behind->getClientOriginalExtension();
                if ($file1 == "png" || $file1 == "jpeg" || $file1 == "jpg") {
                    $file1 = $request->driver_behind->getClientOriginalName();
                    $filePath = public_path() . '/driver';
                    $request->driver_behind->move($filePath, $file1);
                }

                $a = "https://ekyc.live/public/driver/" . $file;
                $response = Http::attach('image', file_get_contents($a), 'image.jpg')->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR'
                ])->post('https://api.fpt.ai/vision/dlr/vnm', ['face' => 1]);
                $authentica = json_decode($response->body());
//                dd($authentica);

                switch ($authentica->errorCode) {
                    case "2":
                        return view('Sites::document.index')->with('noti', 'The Vietnamese Driving Licence in the image is missing of corners so it cannot be cropped to the standard format.');
                        break;
                    case "3":
                        return view('Sites::document.index')->with('noti', 'The system cannot find the Vietnamese Driving Licence in the image or the image is of poor quality (too blur, too dark/bright).');
                        break;
                    case "7":
                        return view('Sites::document.index')->with('noti', 'The uploaded file is not an image file');
                        break;
                }
                if(!isset($authentica->data[0]->id)){
                    return view('Sites::document.index')->with('noti', 'Invalid photo Driving Licence front');
                }
                //check driver exist db
                $profiles = session()->get('profile');
                $email = $profiles[0];
                $id = session()->get('id');
                $app_ids="";
                if($id==null){
                    $app_ids=0;
                    $id=0;
                }else{
                    $app_id_list = DB::table('kyc_app')->get('app_id');

                    foreach ($app_id_list as $app_id) {
                        if($id === md5($app_id->app_id)){
                            $app_ids = $app_id->app_id;
                        }
                    }
                }
                $chek_driver = DB::table('driver')
                    ->where('id_driver',$authentica->data[0]->id);
                if($chek_driver->exists()){
                    foreach ($chek_driver->get() as $item){
                        if($item->email != $email['email']){
                            if(md5($item->app_id) == $id){
                                return view('Sites::document.index')->with('noti', 'This driver has been used');
                            }
                        }else{
                            if(md5($item->app_id) == $id){
                                return view('Sites::document.index')->with('noti', 'This driver has been used');
                            }
                        }
                    }
                }
                //Behind
                $b = "https://ekyc.live/public/driver/" . $file1;
                $response = Http::attach('image', file_get_contents($b), 'image.jpg')->withHeaders([
                    'api_key' => 'EUBv25PFIJfINMEf4qg8bc0SMJrQUGhR'
                ])->post('https://api.fpt.ai/vision/dlr/vnm', ['face' => 1]);
                $authentica1 = json_decode($response->body());
//                dd($authentica1);
                switch ($authentica1->errorCode) {
                    case "2":
                        return view('Sites::document.index')->with('noti', 'The Vietnamese Driving Licence in the image is missing of corners so it cannot be cropped to the standard format.');
                        break;
                    case "3":
                        return view('Sites::document.index')->with('noti', 'The system cannot find the Vietnamese Driving Licence in the image or the image is of poor quality (too blur, too dark/bright).');
                        break;
                    case "7":
                        return view('Sites::document.index')->with('noti', 'The uploaded file is not an image file');
                        break;
                }

                if ($authentica->errorCode == "0" && $authentica1->errorCode == "0") {
                    $driver = new Driver();
                    $driver['img_driver_front'] = $file;
                    $driver['img_driver_behind'] = $file1;
                    $driver->save();
                    //Front
                    $driver['name'] = $authentica->data[0]->name;
                    $driver['id_driver'] = $authentica->data[0]->id;
                    $dob =  \DateTime::createFromFormat('d/m/Y', $authentica->data[0]->dob)->format('Y-m-d');
                    $driver['dob'] = $dob;
                    $driver['nation'] = $authentica->data[0]->nation;
                    $driver['address'] = $authentica->data[0]->address;
                    $driver['place_issue'] = $authentica->data[0]->place_issue;
                    $driver['img_face'] =  "user-" .  date('d-m-y-H-i') . '.jpg';
                    //Save Image face CMND in folder face
                    $path = public_path() . '/face_driver';
                    $b = str_replace('https', 'http', $authentica->data[0]->face);
                    $image = file_get_contents($b);
                    file_put_contents("${path}/" . "user-" . date('d-m-y-H-i') . ".jpg", $image);
                    //behind
                    $date =  \DateTime::createFromFormat('d/m/Y', $authentica->data[0]->date)->format('Y-m-d');
                    $driver['date'] = $date;
                    $driver['doe'] = $authentica->data[0]->doe;
                    $driver['class'] = $authentica->data[0]->class;
                    $driver['email'] = $email['email'];
                    $driver['type'] = $authentica->data[0]->type;
                    $driver['app_id'] = $app_ids;
                    $driver['created_at'] = Carbon::now();

                    $driver->save();
                }
            }
            return view('Sites::driver.index')->with('driver', $driver);
        }
    }
}