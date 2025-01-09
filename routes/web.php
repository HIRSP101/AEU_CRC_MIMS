<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Events\TestProgress;
use Illuminate\Support\Facades\Log;

Route::post('/test-progress', function () {
    try {
        for ($i = 0; $i <= 100; $i += 1) {
            broadcast(new TestProgress($i));
            // or event(new TestProgress($i));
            
            // Add some logging
            Log::info("Progress event broadcasted: $i%");
            
            sleep(0.25); // Simulate work
        }
        return response()->json(['message' => 'Progress complete']);
    } catch (\Exception $e) {
        Log::error("Error broadcasting progress: " . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
});



Route::get('/welcome', function () {
    return view('welcome');
});

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
    return redirect('/login');
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
    Route::get('/dashboard', "{$appC}\\DashboardController@index")->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/initialmodels', "{$appC}\\testdbconnection@initialModelsSetup");
    Route::get('/insertmember', "{$appC}\\testdbconnection@getMemberColumns")->name('import');
    Route::post('/insertmemberfr', "{$appC}\\testdbconnection@insertMember");
    Route::post('/importdata', "{$appC}\\ImportController@import");
    Route::get('/member', "{$appC}\\testdbconnection@eloquent_relation_delete");
    Route::get("/deleteall", "{$appC}\\testdbconnection@deleteall_elo");
    Route::get("/create", "{$appC}\\MemberController@index")->name('createmember');
    Route::post('/importmember', "{$appC}\\MemberController@importMember");
    Route::post('/createmember', "{$appC}\\MemberController@insertMember");
    Route::get('/branch', "{$appC}\\BranchController@index")->name('branch');
    Route::get('/branchhei', "{$appC}\\BranchController@branch_hei")->name('branchhei');
    Route::get('/branchheiprivate', "{$appC}\\ReportController@branchheiprivate");
    Route::get('/allbranches', "{$appC}\\ReportController@branches_hei_report");
    Route::get('/branch/{id}', "{$appC}\\BranchController@get");
    Route::get('/member/{id}', "{$appC}\\MemberController@getMemberDetail");
    Route::post('/createbranch', "{$appC}\\BranchController@index")->name('createbranch');
    Route::get('/uploadint', "{$appC}\\ResourceController@index");
    Route::post('/uploadimage', "{$appC}\\ResourceController@uploadImage");
    Route::get('/getallmembers', "{$appC}\\MemberController@getMemberDetail");
    Route::post('/deletemember', "{$appC}\\MemberController@deleteMembers");
    Route::post('/deletememberone', "{$appC}\\MemberController@deleteMember");
    Route::get('/reports', "{$appC}\\ReportController@index")->name('report');
    Route::get('/branchesreport', "{$appC}\\ReportController@branches_report")->name('branchesreport');
    Route::get('/create-branch', "{$appC}\\BranchController@createform")->name('create-branch');
    Route::post('/create-branch', "{$appC}\\BranchController@store")->name('branch.store');
    Route::get('/update-branch/{id}', "{$appC}\\BranchController@updateform");
    Route::post('/update-branch', "{$appC}\\BranchController@update")->name('branch.update');
    Route::post('/delete-branch', "{$appC}\\BranchController@deleteBranch");
    Route::post('/delete-branches', "{$appC}\\BranchController@deleteBranches");
});

Route::get('/test_db_connection', "{$appC}\\testdbconnection@testConnection");
