<?php
//Dashboard routes
use Illuminate\Support\Facades\Route;

Route::group(['module' => 'dashboard', 'middleware' => 'web', 'namespace' => "App\Modules\Dashboard\Controllers"], function () {

    Route::get("error/login.html", ["as" => "login", "uses" => "Errorcode@index"]);

    Route::group(["prefix" => "dashboard"], function () {
        //login
        Route::get("login", ["as" => "admin.login", "uses" => "Authentication@login"]);
        Route::post("login", ["as" => "admin.login_request", "uses" => "Authentication@login_request"]);
        Route::get("logout", ["as" => "admin.logout", "uses" => "Authentication@logout"]);
        Route::get("create", ["as" => "admin.create", "uses" => "Authentication@create"]);

         Route::group(['middleware' => ['auth:admin']], function () {
            Route::get("/access", ["as" => "RolePermission.access", "uses" => "RolePermission@access"]);
            //Dashboard
            Route::get("/", ["as" => "admin.dashboard.index", "uses" => "Dashboard@index"]);

            Route::group(["prefix" => "rules"], function() {
                Route::get("/", ["as" => "admin.rules", "uses" => "Rules@index"]);
                Route::get("add", ["as" => "admin.rules.add", "uses" => "Rules@add"]);
                Route::post("add", ["as" => "admin.rules.add", "uses" => "Rules@postAdd"]);
                Route::get("edit", ["as" => "admin.rules.edit", "uses" => "Rules@edit"]);
                Route::post("edit", ["as" => "admin.rules.eidt", "uses" => "Rules@postEdit"]);
            });

            //users
            Route::group(["prefix" => "users"], function() {
                Route::get("/", ["as" => "admin.users", "uses" => "Users@index"]);
                Route::post("/", ["as" => "admin.users", "uses" => "Users@postIndex"]);
                // Route::get("add", ["as" => "admin.getAdd", "uses" => "Users@add"]);
                // Route::post("add", ["as" => "admin.postAdd", "uses" => "Users@postAdd"]);
                // Route::get("edit", ["as" => "admin.users.Edit", "uses" => "Users@edit"]);
                // Route::post("edit", ["as" => "admin.users.Eidt", "uses" => "Users@postEdit"]);
                // Route::get("edit/{id}", ["as" => "admin.users.edit", "uses" => "Users@edit"]);
                // Route::post("edit/{id}", ["as" => "admin.users.postEdit", "uses" => "Users@postEdit"]);
                // Route::get("delete/{id}", ["as" => "admin.users.delete", "uses" => "Users@delete"]);
                Route::get("status/{id}/{status}", ["as" => "admin.users.status", "uses" => "Users@status"]);
                // Route::get("status-role/{id}/{status}", ["as" => "admin.users.role.status", "uses" => "Users@statusRole"]);
            });

            //admin
            Route::group(["prefix" => "admin"], function() {
                Route::get("/", ["as" => "admin.admins", "uses" => "Admins@index"]);
                Route::post("/", ["as" => "admin.admins", "uses" => "Admins@postIndex"]);
                Route::get("add", ["as" => "admin.admins.getAdd", "uses" => "Admins@add"]);
                Route::post("add", ["as" => "admin.admins.postAdd", "uses" => "Admins@postAdd"]);
                Route::get("edit/{id}", ["as" => "admin.admins.edit", "uses" => "Admins@edit"]);
                Route::post("edit/{id}", ["as" => "admin.admins.postEdit", "uses" => "Admins@postEdit"]);
                Route::get("delete/{id}", ["as" => "admin.admins.delete", "uses" => "Admins@delete"]);
                Route::get("status/{id}/{status}", ["as" => "admin.admins.status", "uses" => "Admins@status"]);
                Route::get("/trash", ["as" => "admin.admins.trash", "uses" => "Admins@trash"]);
                Route::get("/trash/delete/{id}", ["as" => "admin.admins.trash", "uses" => "Admins@trashDelete"]);
            });

        });
    });
});