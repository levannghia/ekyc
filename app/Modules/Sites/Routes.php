<?php
//Sites routes

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::group(['module' => 'sites', 'middleware' => 'web', 'namespace' => "App\Modules\Sites\Controllers"], function () {
    
    Route::get("/", ["as" => "sites.home.index", "uses" => "Home@index"]);

    //Email 
    Route::get('email',["as" => "kyc.email", "uses" => "EmailController@getEmail"]);
    Route::post('email',["as" => "kyc.postemail", "uses" => "EmailController@postEmail"]);

    //OTP authentica
    Route::get('otp-email',["as" => "kyc.otpemail", "uses" => "EmailController@getOtpEmail"]);
    Route::post('otp-email',["as" => "kyc.postotpemail", "uses" => "EmailController@getOtpEmail"]);

    //Address
    Route::get('address',["as" => "kyc.address", "uses" => "Address@getAddress"])->name('kyc.address');
    Route::post('postaddress',["as" => "kyc.postaddress", "uses" => "Address@postAddress"]);


// Route::get('ads','KYCController@getads')->name('kyc.ads');

    //document
    Route::get('document',["as" => "kyc.document", "uses" => "Document@getDocument"]);
    Route::post('postdocument',["as" => "kyc.postdocument", "uses" => "Document@postDocument"]);

    //profile
    Route::get('profile',["as" => "kyc.profile", "uses" => "Profile@getProfile"]);
    Route::post('postprofile',["as" => "kyc.postprofile", "uses" => "Profile@postProfile"]);

    Route::post('postauthentication',["as" => "kyc.authentica", "uses" => "Authentications@postAuthentication"]);
    //report cmnd
    Route::get('noti-success',["as" => "kyc.notisuccess", "uses" => "Notification@getNotiSuccess"]);
    //pre driver
    Route::post('pre',["as" => "kyc.pre", "uses" => "Previous@pre"]);
    //pre passport
    Route::post('pre-passport',["as" => "kyc.pre-passport", "uses" => "Previous@prePassport"]);
    //pre cmnd
    Route::post('pre-cmnd',["as" => "kyc.pre-cmnd", "uses" => "Previous@precmnd"]);
    
});
