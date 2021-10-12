<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Previous extends Controller
{
    public function pre(Request $request)
    {
        $driver = session()->get('driver');

        if ($request->pre == "0") {
            return view('Sites::driver.index')->with('driver', $driver);
        } else {
            if($driver->app_id != 0){
                $url = DB::table('kyc_app')->where('app_id',$driver->app_id)->get('url_back')->first()->url_back;
                echo "<script>setTimeout(function(){ window.location.href = `$url/true` }, 2000);</script>";
                return view('Sites::inc.noti-success');
            }
            return view('Sites::inc.noti-success');
        }
    }
    public function prePassport(Request $request)
    {
        $passport = session()->get('documents');
        if ($request->pre == "0") {
            return view('Sites::passport.index')->with('passport', $passport);
        } else {
            if($passport->app_id != 0){
                $url = DB::table('kyc_app')->where('app_id',$passport->app_id)->get('url_back')->first()->url_back;
                echo "<script>setTimeout(function(){ window.location.href = `$url/true` }, 2000);</script>";
                return view('Sites::inc.noti-success');
            }
            return view('Sites::inc.noti-success');
        }
    }
    public function precmnd(Request $request)
    {
        $cmnd = session()->get('cmnd');
        if ($request->pre == "0") {
            return view('Sites::address.index')->with('document', $cmnd);
        } else {
            if($cmnd->app_id != 0) {
                $url = DB::table('kyc_app')->where('app_id', $cmnd->app_id)->get('url_back')->first()->url_back;
                echo "<script>setTimeout(function(){ window.location.href = `$url/true` }, 2000);</script>";
                return view('Sites::inc.noti-success');
            }
            return view('Sites::inc.noti-success');
        }
    }
}
