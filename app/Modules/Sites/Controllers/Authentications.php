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

class Authentications extends Controller
{
    public function postAuthentication(Request $request)
    {
        // $image = $request->file('upload');
        // $response = Http::attach('image', file_get_contents($image), 'image.jpg')->withHeaders([
        //     'api_key' => '0CITNwUZE35O11Qc4wpnPqxqcN1N8Lmj'
        // ])->post('https://api.fpt.ai/vision/idr/vnm');
        // $authentica = json_decode($response->body());
        // $authentication = new Authentication();
        // //Front 
        // $authentication['name'] = $authentica->data[0]->name;
        // $authentication['cmnd'] = $authentica->data[0]->id;
        // $dob =  \DateTime::createFromFormat('d/m/Y', $authentica->data[0]->dob)->format('Y-m-d');
        // $authentication['dob'] = $dob;
        // $authentication['home'] = $authentica->data[0]->home;
        // $authentication['address'] = $authentica->data[0]->address;
        // $authentication->save();
    }
}
