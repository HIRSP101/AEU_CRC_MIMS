<?php

namespace App\Http\Controllers;

use App\Http\Requests\VillageRequest;
use App\Services\Villages\CreateVillageService;
use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\village;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    public function index($branchId)
    {
        $branch = DB::table('branch')
            ->where('branch_id', $branchId)
            ->select('branch_kh')
            ->first();

        $villages = DB::table('district as d')
            ->leftJoin('school as s', 'd.district_id', '=', 's.district_id')
            ->leftJoin('member_education_background as meb', function ($join) {
                $join->on('meb.school_id', '=', 's.school_id')
                    ->on('meb.branch_id', '=', 'd.branch_id');
            })
            ->leftJoin('member_personal_detail as mpd', function ($join) {
                $join->on('mpd.member_id', '=', 'meb.member_id');
            })
            ->where('d.branch_id', $branchId)
            ->select(
                'd.district_id',
                'd.district_name',
                DB::raw('COUNT(DISTINCT s.school_id) as total_schools'),
                DB::raw('COUNT(DISTINCT meb.member_id) as total_mem')
            )
            ->groupBy('d.district_id', 'd.district_name')
            ->get();

        return view('village.index', compact('villages', 'branchId', 'branch'));
    }

    public function get($branchId, $villageId)
    {
        $schools = DB::table('branch_hei')
            ->where('branch_id', $branchId)
            ->where('village', $villageId)
            ->select('bhei_id', 'institute_kh', 'image')
            ->get();
        return view('school.index', compact('schools', 'branchId', 'villageId'));
    }

    public function create($branchId)
    {
        $branch = branch::findOrFail($branchId);
        return view('village.create-village', compact('branch'));
    }

    public function store(VillageRequest $request, CreateVillageService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id');

        $village = $service->createVillage($data);

        return redirect()->route('village', ['id' => $village->branch_id])
            ->with('success', 'Village created successfully');
    }
    public function create2()
    {
        $branches = DB::table('branch')->get();
        return view('village.create-village2', compact('branches'));
    }
    public function store2(VillageRequest $request, CreateVillageService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id');

        $village = $service->createVillage($data);

        return redirect()->route('village', ['id' => $village->branch_id])
            ->with('success', 'Village created successfully');
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
