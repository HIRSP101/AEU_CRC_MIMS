<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DataChatController;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$appC = "App\Http\Controllers";

Route::get('/', function () {
    return view('dashboard.index')-> name('dashboard');
});

$appController = "App\Http\Controllers";


// Insert Member Route
Route::controller(MemberController::class)->group(function() {
    Route::get('/', 'home');
    Route::get('/detail/{id}', 'details');
    Route::get('/create', 'create')->name('create-member');
    Route::post('/add-member', 'addmember')->name('addmember');
});


//All Reports Route
Route::controller(ReportController::class)->group(function() {
    Route::get('/reports', 'index')->name('report-page');
    Route::get("/data-chart", 'data_chart')->name('data-chart');
    Route::get("/branch", "branch")->name('branch');
    Route::get("/list-of-name", 'listOfName')->name('list-of-name');
});


Route::get("/provinces","{$appController}\\ProvincesController@index")->name('provinces');
Route::get("/table_member","{$appController}\\ProvincesController@table_member")->name('table_member');

=======
    return view('welcome');
});


Route::middleware('auth')->group(function () use ($appC) {
    Route::get('/profile', "{$appC}\\ProfileController@edit")->name('profile.edit');
    Route::patch('/profile', "{$appC}\\ProfileController@update")->name('profile.update');
    Route::delete('/profile', "{$appC}\\ProfileController@destroy")->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () use ($appC) {
    Route::get('/userroles', "{$appC}\\User\UserController@index")->name('userroles');
    Route::post('/storeregister', "{$appC}\\Auth\RegisteredUserController@store")->name('register.store');
    Route::post('/deleteuser', "{$appC}\\User\UserController@delete")->name('user.delete');
    Route::post('/edituser/{id}', "{$appC}\\User\UserController@edit")->name('user.edit');
    Route::post('/storeuser', "{$appC}\\User\UserController@store")->name('user.store');
    Route::get('/createuser', function () {
        return view('user.partials.createuser');
    });
});

Route::post('/logout', "{$appC}\\LogoutUserController@logout");

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () use ($appC) {

    Route::get('/dashboard', "{$appC}\\DashboardController@index")
        ->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/test_db_connection', "{$appC}\\testdbconnection@testConnection");
    Route::get('/initialmodels', "{$appC}\\testdbconnection@initialModelsSetup");
    Route::get('/insertmember', "{$appC}\\testdbconnection@getMemberColumns")->name('import');
    Route::post('/insertmemberfr', "{$appC}\\testdbconnection@insertMember");
    Route::post('/importdata', "{$appC}\\ImportController@import");
    Route::get('/member', "{$appC}\\testdbconnection@eloquent_relation_delete");
    Route::get("/deleteall", "{$appC}\\testdbconnection@deleteall_elo");
    Route::get("/create", "{$appC}\\MemberController@index")->name('createmember');
    Route::post('/createmember', "{$appC}\\MemberController@insertMember");
    Route::get('/branch', "{$appC}\\BranchController@index")->name('branch');
    Route::get('/branch/{id}', "{$appC}\\BranchController@get");
    Route::get('/member/{id}', "{$appC}\\MemberController@getMemberDetail");
    Route::post('/createbranch', "{$appC}\\BranchController@index")->name('createbranch');
    Route::get('/uploadint', "{$appC}\\ResourceController@index");
    Route::post('/uploadimage', "{$appC}\\ResourceController@uploadImage");
    Route::get('/getallmembers', "{$appC}\\MemberController@getMemberDetail");
    Route::post('/delete_member', "{$appC}\\MemberController@deleteMember");
    Route::post('/delete_member_one', "{$appC}\\MemberController@deleteMemberOne");
    Route::get('/member/{id}/edit', "{$appC}\\MemberController@edit")->name('editMember');
    Route::put('/member/{id}', "{$appC}\\MemberController@update")->name('updateMember');

});
Route::get('/test_db_connection', "{$appC}\\testdbconnection@testConnection");
