<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\branch;
use App\Models\branch_hei;
use App\Services\Branches\CreateBranchService;
use App\Services\Branches\DeleteBranchService;
use App\Services\Branches\UpdateBranchService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituteController extends Controller
{   
    public function index1()
    {
        $total_member_institute = $this->totalMemberInstitute();
        return view("institude.index", compact("total_member_institute"));
    }
    public function totalMemberInstitute() 
    {
        return DB::table('branch_hei as bhei')
            ->leftJoin('member_education_background as meb', 'bhei.bhei_id', '=', 'meb.institute_id')
            ->leftJoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->select('bhei.bhei_id', 'bhei.institute_kh', 'bhei.image', DB::raw('COUNT(DISTINCT mpd.member_id) as total_members'))
            ->groupBy('bhei.bhei_id', 'bhei.institute_kh', 'bhei.image')
            ->get();
    }
    
    public function get(Request $request)
    {

        $instituteId = $request->id;

        $baseQuery = DB::table('member_personal_detail as mpd')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->join('branch_hei as hei', 'branch.branch_id', '=', 'hei.branch_id')
            ->where('meb.branchhei_id', $instituteId);

        $total_fem = (clone $baseQuery)
            ->select(DB::raw('COUNT(meb.member_id) as total_mem_fem'))
            ->where('mpd.gender', 'ស្រី')
            ->first()
            ->total_mem_fem;

        $total_total = (clone $baseQuery)
            ->select(DB::raw('COUNT(meb.member_id) as total_mem'))
            ->first()
            ->total_mem;

        $total_mem = (clone $baseQuery)
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                'meb.institute_id',
                'branch.branch_name',
                'mpd.member_type',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
                'mpd.full_current_address',
                'mpd.phone_number',
                'mgd.guardian_phone',
                'mpd.email',
                'mpd.shirt_size'
            ])
            ->distinct()
            ->get();

        return view('totalmemInstitute.index', compact('total_mem', 'total_fem', 'total_total'));
    }
}
