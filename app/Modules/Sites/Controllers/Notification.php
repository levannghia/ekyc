<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Notification extends Controller
{

    public function getNotiSuccess()
    {
        $row = json_decode(json_encode([
            "title" => "Success",
        ]));
        return view('Sites::inc.noti-success');
    }
}
