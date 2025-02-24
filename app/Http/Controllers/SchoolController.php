<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\branch;
use App\Models\school;
use App\Models\village;
use App\Services\Schools\CreateSchoolService;

class SchoolController extends Controller
{
    public function index1($branchId, $villageId)
    {
        $village = DB::table('district')
            ->where('district_id', $villageId)
            ->select('district_name')
            ->first();

        // $schools = DB::table('school as s')
        // ->join('village as v', 'v.village_id', '=', 's.village_id')
        // ->leftJoin('branch as b', 'b.branch_id', '=', 's.branch_id')
        // ->leftJoin('member_education_background as meb', 'b.branch_id', '=', 'meb.branch_id')
        // ->leftJoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
        // ->where('s.branch_id', $branchId)
        // ->where('s.village_id', $villageId)
        // ->select(
        //     's.school_id',
        //     's.school_name',
        //     's.type',
        //     's.district',
        //     DB::raw('COUNT(DISTINCT meb.member_id) as total_mem')
        // )
        // ->groupBy('s.school_id', 's.school_name', 's.type', 's.district')
        // ->get();

        $schools = DB::table('school as s')
            ->leftJoin('district as v', function ($join) {
                $join->on('v.district_id', '=', 's.district_id')
                    ->on('s.branch_id', '=', 'v.branch_id');
            })
            ->leftJoin('member_education_background as meb', function ($join) {
                $join->on('meb.school_id', '=', 's.school_id')
                    ->on('meb.branch_id', '=', 's.branch_id');
            })
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->where('s.branch_id', $branchId)
            ->where('s.district_id', $villageId)
            ->select(
                's.school_id',
                's.school_name',
                's.type',
                's.village_name',
                DB::raw('COUNT(meb.member_id) as total_mem')
            )
            ->groupBy('s.school_id', 's.school_name', 's.type', 's.village_name')
            ->get();

        return view('school.index', compact('schools', 'branchId', 'villageId', 'village'));
    }

    public function get($branchId, $villageId, $schoolId, Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        //$currentSchoolId = $request->id;
        $currentSchool = school::find($schoolId)->select('school_name')->findOrFail($schoolId);

        $query = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('branch as b', 'meb.branch_id', '=', 'b.branch_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('district as v', 'v.district_id', '=', 's.district_id')
            ->where('meb.branch_id', $branchId)
            ->where('s.district_id', $villageId)
            ->where('meb.school_id', $schoolId)
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                'b.branch_name',
                'mpd.member_type',
                's.school_name',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
                'mpd.full_current_address',
                'mpd.phone_number',
                'mpd.email',
                'mpd.shirt_size',
                // DB::raw('COUNT(DISTINCT meb.member_id) as total_mem')
            ])
            ->groupBy([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'meb.school_id',
                's.school_name',
                'mpd.date_of_birth',
                'mpd.member_type',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
                'mpd.full_current_address',
                'mpd.phone_number',
                'mpd.email',
                'mpd.shirt_size'
            ]);

        $total_mem = $query->get();

        if ($startDate && $endDate) {
            $query->whereBetween('mrd.registration_date', [$startDate, $endDate]);
        }

        $data = $query->get();

        return view('totalmemSchool.index', [
            'data' => $data,
            'branchId' => $branchId,
            'villageId' => $villageId,
            'schoolId' => $schoolId
        ], compact('currentSchool'));
    }

    public function create($branchId, $villageId)
    {
        $branch = DB::table('branch')->where('branch_id', $branchId)->first();
        $village = DB::table('district')->where('district_id', $villageId)->first();
        $branches = DB::table('branch')->get();
        $villages = DB::table('district')->where('branch_id', $branchId)->get();

        return view('school.create-school', compact('branch', 'village', 'branches', 'villages'));
    }
    public function store(SchoolRequest $request, CreateSchoolService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id');
        $data['district_id'] = $request->route('v_id');

        $school = $service->createSchool($data);

        return redirect()->route('school', ['id' => $school->branch_id, 'v_id' => $school->district_id])
            ->with('success', 'School created successfully');
    }
}
