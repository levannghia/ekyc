<?php

namespace App\Modules\Sites\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'email', 'dob', 'nation', 'address', 'place_issue', 'date', 'doe', 'class', 'type', 'img_driver_front', 'img_driver_behind', 'img_face_camere', 'img_face'
    ];

    protected $primaryKey = 'id';
    protected $table = 'driver';
}
