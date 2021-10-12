<?php

namespace App\Modules\Sites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use App\Modules\Sites\Models\Testimonials_Model;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

class Home extends Controller
{

    public function index()
    {
        $row = json_decode(json_encode([
            "title" => "Home",
        ]));
        return view("Sites::home.index",compact("row"));
    }
}
