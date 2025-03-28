<?php

namespace App\Http\Controllers;

use App\Models\branch_bindding_user;
use App\Models\branch_hei;
use App\Models\member_personal_detail;
use App\Models\member_registration_detail;
use App\Models\membership_detail;
use App\Models\school;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpireController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $schoolId = $request->id;
        $school = school::find($schoolId)->select('school_name')->findOrFail($schoolId);
        //$school = School::select('school_name')->findOrFail($schoolId);

        //dd(branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id);
        $user = branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id;


        $query = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('branch as b', 'meb.branch_id', '=', 'b.branch_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('district as v', 'v.district_id', '=', 's.district_id')
            ->whereIn('s.type', ['អនុវិទ្យាល័យ', 'វិទ្យាល័យ'])
            ->where('meb.school_id', $schoolId)
            ->whereRaw('mrd.registration_date <= NOW() - INTERVAL 6 YEAR')
            //->where('meb.branch_id', '=', $user)
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                'b.branch_name',
                'b.branch_kh',
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
            ]);

        // if (!auth()->user()->hasRole('admin')) {
        //     $query->where('meb.branch_id', '=', $user);
        // }

        if ($startDate && $endDate) {
            $query->whereBetween('mrd.registration_date', [$startDate, $endDate]);
        }
        $data = $query->get();

        return view('totalmem_expire.index', [
            'data' => $data
        ], compact('school'));
    }
    public function index1(Request $request)
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
            ->where('hei.institute_type', '=', 'សាកលវិទ្យាល័យ')
            ->where('meb.branchhei_id', '=', $instituteId)
            ->whereRaw('mrd.registration_date <= NOW() - INTERVAL 4 YEAR');
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
                'hei.institute_type',
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
        return view('totalmemInstitute_ex.index', compact('total_mem'));
    }

    public function checkExpiredMembers()
    {
        $count = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', 'branch.branch_id', '=', 'hei.bhei_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->where('mrd.registration_date', '<=', now()->subYears(6))
            ->whereIn('s.type', ['អនុវិទ្យាល័យ', 'វិទ្យាល័យ'])
            ->count();
        return response()->json(['count' => $count]);
    }

    public function checkExpiredMemberInstitute()
    {
        $count = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            //->leftJoin('branch_hei as hei', 'branch.branch_id', '=', 'hei.bhei_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->where('hei.institute_type', '=', 'សាកលវិទ្យាល័យ')
            ->whereRaw('mrd.registration_date <= NOW() - INTERVAL 4 YEAR')
            ->count();
        return response()->json(['count' => $count]);
    }

    public function getListSchool()
    {
        $user = branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id;

        if (auth()->user()->hasRole('admin')) {
            $schools = DB::table('school as s')
                ->leftJoin('member_education_background as meb', 'meb.school_id', '=', 's.school_id')
                ->leftJoin('member_registration_detail as mrd', 'meb.member_id', '=', 'mrd.member_id')
                //->where('s.branch_id', '=', $user) // Filter schools by user branch
                ->whereIn('s.type', ['អនុវិទ្យាល័យ', 'វិទ្យាល័យ']) // School types
                ->select(
                    's.school_id',
                    's.school_name',
                    's.branch_id',
                    DB::raw("COUNT(DISTINCT CASE WHEN mrd.registration_date <= NOW() - INTERVAL 6 YEAR THEN meb.member_id END) as total_mem") // Count expired members
                )
                ->groupBy('s.school_id', 's.school_name', 's.branch_id')
                ->get();
        } else {
            $schools = DB::table('school as s')
                ->leftJoin('member_education_background as meb', 'meb.school_id', '=', 's.school_id')
                ->leftJoin('member_registration_detail as mrd', 'meb.member_id', '=', 'mrd.member_id')
                ->where('s.branch_id', '=', $user) // Filter schools by user branch
                ->whereIn('s.type', ['អនុវិទ្យាល័យ', 'វិទ្យាល័យ']) // School types
                ->select(
                    's.school_id',
                    's.school_name',
                    's.branch_id',
                    DB::raw("COUNT(DISTINCT CASE WHEN mrd.registration_date <= NOW() - INTERVAL 6 YEAR THEN meb.member_id END) as total_mem") // Count expired members
                )
                ->groupBy('s.school_id', 's.school_name', 's.branch_id')
                ->get();
        }

        return view("totalmem_expire.list-school", compact('schools'));
    }
    public function getListInstitute()
    {
        $total_member_institute = $this->totalMemberInstitute();
        return view("totalmemInstitute_ex.list-institute", compact("total_member_institute"));
    }
    public function totalMemberInstitute()
    {
        return DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'meb.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->select(
                'hei.bhei_id',
                'hei.institute_kh',
                'hei.image',
                DB::raw("COUNT(CASE 
                    WHEN mrd.registration_date <= NOW() - INTERVAL 4 YEAR
                    THEN meb.member_id END) as total_members")
            )
            ->groupBy('hei.bhei_id', 'hei.institute_kh', 'hei.image')
            ->get();
    }
}
