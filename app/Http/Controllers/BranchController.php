<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\branch_hei;
use App\Services\Branches\DeleteBranchService;
use App\Services\Branches\CreateBranchService;
use App\Services\Branches\UpdateBranchService;
use Illuminate\Support\Facades\Route;
use Exception;

class BranchController extends Controller
{
    protected CreateBranchService $createService;
    protected UpdateBranchService $updateService;
    protected DeleteBranchService $deleteService;

    public function __construct(CreateBranchService $createService, UpdateBranchService $updateService, DeleteBranchService $deleteService)
    {
        $this->deleteService = $deleteService;
        $this->createService = $createService;
        $this->updateService = $updateService;
    }
    public function index()
    {
        dd(Route::currentRouteName());
        $total_mem_branches = $this->totalmem_branches()
            ->where('b.branch_id', '<', '28')
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image')
            ->get();

        return view('branch.index', compact('total_mem_branches'));
    }

    public function branch_hei()
    {
        $total_mem_branchhei = $this->totalmem_branches()
            ->where('b.branch_id', '>', '28')
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.image')
            ->get();
        //dd($total_mem_branchhei);
        return view('branch_hei.index', compact('total_mem_branchhei', ));
    }

    public function totalmem_branches()
    {
        $total_mem_branches = DB::table('branch as b')
            ->leftJoin('district as d', 'b.branch_id', '=', 'd.branch_id')
            ->leftJoin('school as s', 'd.district_id', '=', 's.district_id')
            ->leftjoin('member_education_background as meb', function ($join) {
                $join->on('meb.school_id', '=', 's.school_id')
                    ->on('meb.branch_id', '=', 'b.branch_id');
            })
            ->leftJoin('member_personal_detail as mpd', function ($join) {
                $join->on('mpd.member_id', '=', 'meb.member_id');
            })
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->select(
                'b.branch_id',
                'b.branch_kh',
                'b.branch_image',
                //DB::raw("COUNT(DISTINCT meb.member_id) AS total_mem"),
                DB::raw("COUNT(CASE 
                    WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR
                    THEN meb.member_id END) as total_mem"),
                DB::raw("COUNT(DISTINCT d.district_id) AS total_villages")
            )
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image');

        return $total_mem_branches;
    }

    public function createform()
    {
        $total_mem_branches = $this->totalmem_branches()
            ->where("branch.branch_id", '<', 28)
            ->groupBy('branch.branch_id', 'branch.branch_kh', 'branch.image')
            ->orderBy('total_institutes', 'desc')
            ->get();
        $bhei_col = branch_hei::all();
        return view('branch.partials.createform.create', compact('total_mem_branches', 'bhei_col'));
    }
    public function updateform(Request $request)
    {
        $total_branches = branch::where('branch_id', '<', '28')->get();
        $bhei = branch::find($request->id);
        //dd($bhei_col);
        return view('branch.partials.createform.update', compact('total_branches', 'bhei'));
    }

    // public function get(Request $request)
    // {
    //     $baseQuery = DB::table('member_personal_detail as mpd')
    //         ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
    //         ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
    //         ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
    //         ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
    //         ->where('branch.branch_id', $request->id);

    //     $total_fem = (clone $baseQuery)
    //         ->select(DB::raw('COUNT(meb.member_id) as total_mem_fem'))
    //         ->where('mpd.gender', 'ស្រី')
    //         ->first()
    //         ->total_mem_fem;

    //     $total_total = (clone $baseQuery)
    //         ->select(DB::raw('COUNT(meb.member_id) as total_mem'))
    //         ->first()
    //         ->total_mem;

    //     $total_mem = (clone $baseQuery)
    //         ->select([
    //             'mpd.member_id',
    //             'mpd.member_code',
    //             'mpd.name_kh',
    //             'mpd.name_en',
    //             'mpd.gender',
    //             'mpd.date_of_birth',
    //             'meb.institute_id',
    //             'branch.branch_name',
    //             'mpd.member_type',
    //             'meb.education_level',
    //             'meb.acadmedic_year',
    //             'mrd.registration_date',
    //             'mrd.expiration_date',
    //             'mpd.full_current_address',
    //             'mpd.phone_number',
    //             'mgd.guardian_phone',
    //             'mpd.email',
    //             'mpd.shirt_size'
    //         ])
    //         ->get();
    //     //dd($total_mem);

    //     return view('totalmembranch.index', compact('total_mem', 'total_fem', 'total_total'));
    // }


    public function get($id)
    {
        $branch = DB::table('branch')->where('branch_id', $id)->first();
        $villages = DB::table('branch_hei')->where('branch_id', $id)->get();
        return view('branch.show', compact('branch', 'villages'));
    }

    //new code 2025/03/27 get branch by user when user login
    public function getBranchByUser()
    {
        $branch = DB::table('branch')
        ->leftJoin('branch_bindding_user', 'branch.branch_id', '=', 'branch_bindding_user.branch_id')
        ->where('user_id', auth()->user()->id)
        ->get();
        return response()->json($branch);

    }

    public function store(BranchRequest $request): RedirectResponse
    {
        // dd($request->all());
        try {
            DB::beginTransaction();

            $data_arr = $request;
            //dd($data_arr->provinceOrCity);
            $bhei_id = branch_hei::latest()->first()?->bhei_id ?? 0;
            $this->createService->createBranch($data_arr, $request->file('image'), $bhei_id);
            DB::commit();
            return redirect()->route('/create-branch');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard');
        }
    }
    public function update(BranchRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $bhei_id = $request->bhei_id;
            // dd($bhei_id);
            $this->updateService->updateBranch(data: $request, image: $request->file('image'), bheiId: $bhei_id);

            DB::commit();
            return redirect()->route('/create-branch');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard');
        }
    }
    // multiple delete
    public function deleteBranches(Request $request)
    {
        $this->deleteService->deleteBranches($request->arr);
        return response()->json(['message' => 'Members deleted successfully']);
    }
    // single delete
    public function deleteBranch(Request $request): JsonResponse
    {
        $this->deleteService->deleteBranch($request->arr[0]);
        return response()->json(['message' => 'Member deleted successfully']);
    }
}
