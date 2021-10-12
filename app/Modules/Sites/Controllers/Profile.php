<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

class Profile extends Controller
{

    public function getProfile(Request $request)
    {
//       dd($request->session()->get('id'));
        $row = json_decode(json_encode([
        "title" => "Profile",
        ]));
        return view("Sites::profile.index",compact("row"));
    }
    public function postProfile(Request $request)
    {
        session(['profile' => [$request->all()]]);

        if ($request->next == "1") {
            return redirect('document');
        } else {
            return redirect('/');
        }
    }
}