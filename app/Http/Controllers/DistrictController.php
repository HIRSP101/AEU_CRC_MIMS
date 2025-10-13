<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistrictRequest;
use App\Services\District\CreateDistrictService;
use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\branch_bindding_user;
use App\Models\district;
use App\Services\District\DeleteDistrictService;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    protected DeleteDistrictService $deleteService;

    public function __construct(DeleteDistrictService $deleteService)
    {
        $this->deleteService = $deleteService;
    }
    public function index($branchId)
    {
        if (auth()->user()->hasRole('user')) {
            $user = branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id;
            $branches = DB::table('branch')
                ->where('branch_id', $user)
                ->get();

            $branch = DB::table('branch')->where('branch_id', $branchId)->select('branch_kh')->first();
            $data = DB::table('district as d')
                ->select(
                    'd.district_id',
                    'd.district_name',
                    DB::raw('COUNT(DISTINCT s.school_id) as total_schools'),
                    DB::raw("COUNT(CASE WHEN mrd.expiration_date >= NOW() THEN meb.member_id END) as total_mem")
                    //DB::raw('COUNT(DISTINCT meb.member_id) as total_mem')

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
            return view('district.index', [
                'districts' => $data,
                'branchId' => $branchId,
                'branch' => $branch,
                'branches' => $branches,
                'user' => $user,
                'branchWhole' => $branchTotals,
            ]);
        } else {

            $branch = DB::table('branch')->where('branch_id', $branchId)->select('branch_kh')->first();

            $data = DB::table('district as d')
                ->select(
                    'd.district_id',
                    'd.district_name',
                    DB::raw('COUNT(DISTINCT s.school_id) as total_schools'),
                    DB::raw("COUNT(CASE WHEN mrd.expiration_date >= NOW() THEN meb.member_id END) as total_mem")
                    //DB::raw('COUNT(DISTINCT meb.member_id) as total_mem')

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
            return view('district.index', [
                'districts' => $data,
                'branchId' => $branchId,
                'branch' => $branch,
                'branchWhole' => $branchTotals,
            ]);
        }
    }
    public function get($branchId, $districtId)
    {
        $schools = DB::table('branch_hei')->where('branch_id', $branchId)->where('village', $districtId)->select('bhei_id', 'institute_kh', 'image')->get();
        return view('school.index', compact('schools', 'branchId', 'districtId'));
    }

    public function create($branchId)
    {
        $branch = branch::findOrFail($branchId);
        if (auth()->user()->hasRole('user')) {
            $user = branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id;
            $branches = DB::table('branch')
                ->where('branch_id', $user)
                ->get();
            $districts = DB::table('district as d')
                ->leftJoin('branch as b', 'b.branch_id', '=', 'd.branch_id')
                ->where('d.branch_id', $user)
                ->get();
        } else {
            $branch = branch::findOrFail($branchId);
            $branches = DB::table('branch')->get();
            $districts = DB::table('district as d')
                ->leftJoin('branch as b', 'b.branch_id', '=', 'd.branch_id')->get();
        }

        return view('district.create-district', compact('branch', 'branches', 'districts'));
    }

    public function store(DistrictRequest $request, CreateDistrictService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id');

        $district = $service->createDistrict($data);

        return redirect()
            ->route('district', ['id' => $district->branch_id])
            ->with('success', 'District created successfully');
    }
    public function create2()
    {
        $user = branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id;

        // if user has role 'user', get only their branch and districts
        if (auth()->user()->hasRole('user')) {
            $branches = DB::table('branch')
                ->where('branch_id', $user)
                ->get();

            $districts = DB::table('district as d')
                ->leftJoin('branch as b', 'b.branch_id', '=', 'd.branch_id')
                ->where('d.branch_id', $user)
                ->get();
        }
        // if admin, get all branches and districts
        else {
            $branches = DB::table('branch')->get();

            $districts = DB::table('district as d')
                ->leftJoin('branch as b', 'b.branch_id', '=', 'd.branch_id')
                ->get();
        }
        $title = "បង្កើតស្រុក/ក្រុង";
        return view('district.create-district2', compact('branches', 'districts', 'title'));
    }
    public function store2(DistrictRequest $request, CreateDistrictService $service)
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

    public function getDistricts($branchId)
    {
        $district = DB::table('district')->where('branch_id', $branchId)->get();
        return response()->json($district);
    }

    public function getDistrict()
    {
        $districts = DB::table('district')->get();
        return response()->json($districts);
    }

    // new code 2025/03/27 get district by user when login 
    public function getDistrictByUserLogin($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $districts = DB::table('district')
                ->where('district.branch_id', $id)
                ->get();
            return response()->json($districts);
        }
        $districts = DB::table('district')
            ->leftJoin('branch', 'district.branch_id', '=', 'branch.branch_id')
            ->leftJoin('branch_bindding_user', 'branch.branch_id', '=', 'branch_bindding_user.branch_id')
            ->where('branch_bindding_user.user_id', auth()->user()->id)
            ->get();
        return response()->json($districts);
    }


    public function deleteDistrict($id)
    {
        return $this->deleteService->deleteDistrict($id);
    }
    public function editDistrict($id)
    {
        $district = district::findOrFail($id);
        $branches = branch::all();
        return view('district.edit-district', compact('district', 'branches'));
    }
    public function updateDistrict(Request $request, $id)
    {
        $district = district::findOrFail($id);
        $district->district_name = $request->district_name;
        $district->branch_id = $request->branch_id;
        $district->save();
        return redirect()->route('createdistrict')->with('success', 'District updated successfully');
    }
}
