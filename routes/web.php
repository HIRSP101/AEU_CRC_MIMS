<?php

use Illuminate\Support\Facades\Route;

$appC = "App\Http\Controllers";

Route::get('/', function () {
    return view('dashboard.index');
});
Route::get('/', "{$appC}\\DashboardController@index");
Route::get('/test_db_connection', "{$appC}\\testdbconnection@testConnection");
Route::get('/initialmodels', "{$appC}\\testdbconnection@initialModelsSetup");
Route::get('/insertmember', "{$appC}\\testdbconnection@getMemberColumns");
Route::post('/insertmemberfr', "{$appC}\\testdbconnection@insertMember");
Route::post('/importdata', "{$appC}\\ImportController@import");
Route::get('/member',"{$appC}\\testdbconnection@eloquent_relation_delete");
Route::get("/deleteall", "{$appC}\\testdbconnection@deleteall_elo");
Route::get("/create", "{$appC}\\MemberController@index");
Route::post('/createmember', "{$appC}\\MemberController@insertMember");
Route::get('/uploadint', "{$appC}\\ResourceController@index");
Route::post('/uploadimage',"{$appC}\\ResourceController@uploadImage");
Route::get('/getallmembers', "{$appC}\\MemberController@getMemberDetail");
