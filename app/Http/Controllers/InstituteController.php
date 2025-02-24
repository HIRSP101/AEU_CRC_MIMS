<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\branch;
use App\Models\branch_hei;
use App\Models\member_personal_detail;
use App\Services\Branches\CreateBranchService;
use App\Services\Branches\DeleteBranchService;
use App\Services\Branches\UpdateBranchService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class InstituteController extends Controller
{
    public function index1()
    {
        $total_member_institute = $this->totalMemberInstitute();
        return view("institude.index", compact("total_member_institute"));
    }
    public function totalMemberInstitute()
    {
        return DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'meb.member_id', '=', 'mpd.member_id')
            ->join('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->select(
                'hei.bhei_id',
                'hei.institute_kh',
                'hei.image',
                DB::raw('COUNT(DISTINCT meb.member_id) as total_members')
            )
            ->groupBy('hei.bhei_id', 'hei.institute_kh', 'hei.image')
            ->get();
    }

    public function get(Request $request)
    {

        $instituteId = $request->id;
        $institution = branch_hei::find($instituteId)->select('institute_kh')->findOrFail($instituteId);

        $baseQuery = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', 'branch.branch_id', '=', 'hei.bhei_id')
            ->where('meb.branchhei_id', '=', $instituteId);

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
                // 'meb.institute_id',
                'hei.institute_kh',
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
                'mpd.shirt_size',
                'mpob.village',
                'mpob.commune_sangkat',
                'mpob.district_khan',
                'mpob.provience_city',
                'mpob.home_no',
                'mpob.street_no',
                'mcad.home_no as home_no_current',
                'mcad.street_no as street_no_current',
                'mcad.village  as village_current',
                'mcad.commune_sangkat as commune_sangkat_current',
                'mcad.district_khan as district_khan_current',
                'mcad.provience_city as provience_city_current',

            ])
            ->distinct()
            ->get();
        return view('totalmemInstitute.index', compact('total_mem', 'total_fem', 'total_total', 'institution'));
    }

 
}
