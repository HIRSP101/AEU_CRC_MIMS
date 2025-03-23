<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Events\TestProgress;
use App\Models\member_personal_detail;
use Carbon\Carbon;
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
    //All Members Routes
    Route::get('/insertmember', "{$appC}\\testdbconnection@getMemberColumns")->name('import');
    Route::post('/insertmemberfr', "{$appC}\\testdbconnection@insertMember");
    // Route::post('/importdata', "{$appC}\\ImportController@import");
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
    Route::get('/branch_report', "{$appC}\\BranchController@index")->name('branch.report.exclude');
    Route::get('/branch_report/{id}', "{$appC}\\ReportController@branch_report_exclude")->name('branch.report.exclude');

    // option page
    //Route::get('/member/option/{id}', "{$appC}\\MemberController@getMemberOption")->name('member.option');
    // get user detail form
    Route::get('/member/{id}', "{$appC}\\MemberController@getMemberDetail")->name('member.detail');
    // get request form
    Route::get('/member/{r_id}/request', "{$appC}\\MemberController@getRequestForm")->name('member.request');
    // Card
    Route::get('/member/{c_id}/card', "{$appC}\\MemberController@getMemberCard")->name('member.card');

    Route::post('/createbranch', "{$appC}\\BranchController@index")->name('createbranch');
    Route::get('/uploadint', "{$appC}\\ResourceController@index");
    Route::post('/uploadimage', "{$appC}\\ResourceController@uploadImage");
    Route::get('/getallmembers', "{$appC}\\MemberController@getMemberDetail");
    Route::post('/deletemember', "{$appC}\\MemberController@deleteMembers");
    Route::post('/deletememberone', "{$appC}\\MemberController@deleteMember");
    Route::get('/update-member/{id}', "{$appC}\\MemberController@getupdateMember")->name("memberupdate");
    Route::post('/update-member/{memberId}', "{$appC}\\MemberController@updateMember");
    // all reports routes
    Route::get('/reports', "{$appC}\\ReportController@index")->name('report');
    Route::get('/branchesreport', "{$appC}\\ReportController@branches_report")->name('branchesreport');
    Route::get('/private/university', "$appC\\ReportController@branchheiprivate")->name('private.university');
    Route::get('/public/university', "$appC\\ReportController@branchheipublic")->name('public.university');
    Route::get('/total/university', "$appC\\ReportController@branchhei_all")->name('total.university');
    Route::get('/total/member/university', "$appC\\ReportController@branchesHeiReport")->name('total.member.university');

    Route::get('/create-branch', "{$appC}\\BranchController@createform")->name('create-branch');
    Route::post('/create-branch', "{$appC}\\BranchController@store")->name('branch.store');
    Route::get('/update-branch/{id}', "{$appC}\\BranchController@updateform");
    Route::post('/update-branch', "{$appC}\\BranchController@update")->name('branch.update');
    Route::post('/update-members', "{$appC}\\MemberController@updateMember");
    Route::post('/delete-branch', "{$appC}\\BranchController@deleteBranch");
    Route::post('/delete-branches', "{$appC}\\BranchController@deleteBranches");

    Route::get('/institute', "{$appC}\\InstituteController@index1")->name('institute');
    Route::get('/institute/{id}', "{$appC}\\InstituteController@get");
    Route::get('/generate-report/{id}', "{$appC}\\InstituteController@generateReport");
    // Create village
    Route::get('/branch/{id}/village/create', "{$appC}\\VillageController@create")->name('village.create');
    Route::post('/branch/{id}/village/store', "{$appC}\\VillageController@store")->name('village.store');
    Route::get('/getVillages/{branchId}', "{$appC}\\VillageController@getVillages");
    // Create school
    Route::get('/branch/{id}/village/{v_id}/school/create', "{$appC}\\SchoolController@create")->name('school.create');
    Route::post('/branch/{id}/village/{v_id}/school/store', "{$appC}\\SchoolController@store")->name('school.store');

    //Create district2
    Route::get('/createdistrict', "{$appC}\\VillageController@create2")->name('createdistrict');
    Route::post('/storedistrict', "{$appC}\\VillageController@store2")->name('storedistrict');
    Route::get('/get-district', "{$appC}\\VillageController@getDistrict");
    Route::post('/deletedistrict', "{$appC}\\VillageController@deleteDistrict");
    // Create school 2
    Route::get('/createschool', "{$appC}\\SchoolController@create2")->name('createschool');
    Route::post('/storeschool', "{$appC}\\SchoolController@store2")->name('storeschool');

    Route::get('/branch/{id}/village', "{$appC}\\VillageController@index")->name('village');
    Route::get('/branch/{id}/village/{v_id}', "{$appC}\\VillageController@get");
    Route::get('/branch/{id}/village/{v_id}/school', "{$appC}\\SchoolController@index1")->name('school');
    Route::get('/branch/{id}/village/{v_id}/school/{s_id}', "{$appC}\\SchoolController@get");
    Route::get("/wholebranch/{id}", "{$appC}\\SchoolController@get")->name("wholebranch");

    Route::get('/document', "{$appC}\\DocumentController@index")->name('document');
    Route::get('/document/{id}', "{$appC}\\DocumentController@get");
    // Route::get('/document/{id}/{v_id}/{s_id}', "{$appC}\\DocumentController@get");

    Route::get('/pdf/{id}', "{$appC}\\MemberController@memberDetailPdf");
    Route::get('/listschool', "{$appC}\\ExpireController@getListSchool")->name('listschool');
    Route::get('/listschool/{id}', "{$appC}\\ExpireController@index");
    Route::get('/list-institute', "{$appC}\\ExpireController@getListInstitute")->name('list-institute');
    Route::get('/list-institute/{id}', "{$appC}\\ExpireController@index1");
    //Route::get('/instituteexpire', "{$appC}\\ExpireController@index1")->name('institute_ex');

    // Notification expire
    Route::get('/check-expired-members', "{$appC}\\ExpireController@checkExpiredMembers")->name('checkExpiredMembers');
    Route::get('/check-expired-members-institute', "{$appC}\\ExpireController@checkExpiredMemberInstitute")->name('checkExpiredMemberInstitute');
});





Route::get('/test_db_connection', "{$appC}\\testdbconnection@testConnection");
