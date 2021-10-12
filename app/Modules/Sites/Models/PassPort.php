<?php

namespace App\Modules\Sites\Models;

use Illuminate\Database\Eloquent\Model;

class PassPort extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'email', 'dob', 'pob', 'sex', 'id_number', 'doi', 'doe', 'img_passport', 'img_passport_camera'
    ];

    protected $primaryKey = 'id';
    protected $table = 'passport';
}
