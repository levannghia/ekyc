<?php

namespace App\Modules\Sites\Models;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name','cmnd','dob','home','address','ethnicity','religion','features','issue_date','issue_loc','user_id'
    ];

    protected $primaryKey = 'id';
    protected $table = 'authentication';
}
