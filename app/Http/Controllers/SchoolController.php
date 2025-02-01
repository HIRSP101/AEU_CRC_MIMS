<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\branch;
use App\Models\village;
use App\Services\Schools\CreateSchoolService;

class SchoolController extends Controller
{
    public function index1($branchId, $villageId)
    {
        $village = DB::table('branch_hei')
            ->where('branch_id', $branchId)
            ->where('village', $villageId)
            ->select('village')
            ->first();

        $schools = DB::table('branch_hei as bhei')
            ->leftJoin('member_education_background as meb', 'bhei.bhei_id', '=', 'meb.institute_id')
            ->leftJoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->where('bhei.branch_id', $branchId)
            ->where('bhei.village', $villageId)
            ->select(
            'bhei.bhei_id',
                'bhei.institute_kh',
                'bhei.image',
                DB::raw('COUNT(DISTINCT mpd.member_id) as total_mem')
            )
            ->groupBy('bhei.bhei_id', 'bhei.institute_kh', 'bhei.image')
            ->get();

    return view('school.index', compact('schools', 'branchId', 'villageId', 'village'));
    }
    
    public function get($branchId, $villageId, $schoolId, Request $request)
    {
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    $query = DB::table('member_personal_detail as mpd')
        ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
        ->join('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
        ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
        ->where('hei.branch_id', $branchId)
        ->where('hei.village', $villageId)
        ->where('hei.bhei_id', $schoolId)
        ->select('mpd.*', 'meb.*', 'mrd.registration_date');

    if ($startDate && $endDate) {
        $query->whereBetween('mrd.registration_date', [$startDate, $endDate]);
    }

    $data = $query->get();

    return view('totalmemSchool.index', [
        'data' => $data,
        'branchId' => $branchId,
        'villageId' => $villageId,
        'schoolId' => $schoolId
    ]);
    }

    public function create($branchId, $villageId)
    {
        $branch = DB::table('branch')->where('branch_id', $branchId)->first();
        $village = DB::table('village')->where('village_id', $villageId)->first();
        
        return view('school.create-school', compact('branch', 'village'));
    }
    public function store(SchoolRequest $request, CreateSchoolService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id');
        $data['village_id'] = $request->route('v_id');
       
        $school = $service->createSchool($data);

        return redirect()->route('school', ['id' => $school->branch_id, 'v_id' => $school->village_id])
                        ->with('success', 'School created successfully');
    }
}    
