<?php

namespace App\Http\Controllers;

use App\Http\Requests\VillageRequest;
use App\Services\District\CreateDistrictService;
use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\village;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    public function index($branchId)
    {
        $branch = DB::table('branch')->where('branch_id', $branchId)->select('branch_kh')->first();

        $data = DB::table('district as d')
            ->select(
                'd.district_id',
                'd.district_name',
                DB::raw('COUNT(DISTINCT s.school_id) as total_schools'),
                //DB::raw("COUNT(CASE WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR THEN meb.member_id END) as total_mem")
                DB::raw('COUNT(DISTINCT meb.member_id) as total_mem')

            )
            ->leftJoin('school as s', 'd.district_id', '=', 's.district_id')
            ->leftJoin('member_education_background as meb', function ($join) use ($branchId) {
                $join->on('meb.school_id', '=', 's.school_id')->where('meb.branch_id', '=', DB::raw($branchId));
            })
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->where('d.branch_id', $branchId)
            ->groupBy('d.district_id', 'd.district_name')
            ->get();

        $branchTotals = (object) [
            'total_schools' => $data->sum('total_schools'),
            'total_mem' => $data->sum('total_mem'),
        ];
        //dd($branchTotals);
        return view('village.index', [
            'villages' => $data,
            'branchId' => $branchId,
            'branch' => $branch,
            'branchWhole' => $branchTotals,
        ]);
    }
    public function get($branchId, $villageId)
    {
        $schools = DB::table('branch_hei')->where('branch_id', $branchId)->where('village', $villageId)->select('bhei_id', 'institute_kh', 'image')->get();
        return view('school.index', compact('schools', 'branchId', 'villageId'));
    }

    public function create($branchId)
    {
        $branch = branch::findOrFail($branchId);
        return view('village.create-village', compact('branch'));
    }

    public function store(VillageRequest $request, CreateDistrictService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id');

        $village = $service->createDistrict($data);

        return redirect()
            ->route('village', ['id' => $village->branch_id])
            ->with('success', 'Village created successfully');
    }
    public function create2()
    {
        $branches = DB::table('branch')->get();
        return view('village.create-village2', compact('branches'));
    }
    public function store2(VillageRequest $request, CreateDistrictService $service)
    {
        $request->validate([
            'district_name' => 'required|string|max:255',
            'branch_id' => 'required|exists:branch,branch_id'
        ]);

        $districtId = DB::table('district')->insertGetId([
            'district_name' => $request->input('district_name'),
            'branch_id' => $request->input('branch_id')
        ]);

        return redirect()->route('createdistrict')->with('success', 'District created successfully');
    }

    public function getVillages($branchId)
    {
        $villages = DB::table('district')->where('branch_id', $branchId)->get();
        return response()->json($villages);
    }

    public function getDistrict()
    {
        $districts = DB::table('district')->get();
        return response()->json($districts);
    }
}
