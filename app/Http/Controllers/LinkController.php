<?php

namespace App\Http\Controllers;

use App\Models\branch_hei;
use App\Models\form_submits;
use App\Models\member_registration_detail;
use DB;
use Illuminate\Http\Request;
use Str;

class LinkController extends Controller
{
    public function linkMember()
    {
        $title = "បញ្ចូលសមាជិកតាមរយៈតំណរភ្ជាប់(បណ្តោះអាសន្ធ)";
        $admin = false;
        if (auth()->user()->hasRole('admin')) {
            $membersPerHei = DB::table('branch_hei as bhei')
                ->Join('branch_bindding_user as bu', 'bu.branch_hei_id', '=', 'bhei.bhei_id')
                ->Join('form_submits as fs', 'fs.created_by', '=', 'bu.user_id')
                ->Join('member_registration_detail as mrd', 'mrd.form_submits_id', '=', 'fs.id')
                ->Join('member_education_background as meb', 'meb.member_id', '=', 'mrd.member_id')
                ->where('mrd.approved', '=', 0)
                ->selectRaw('
                    COUNT(DISTINCT mrd.mrd_id) as total_members
                ')
                ->groupBy('bhei.bhei_id', 'bhei.institute_kh')
                ->get();
            return view('links.link-member', compact('membersPerHei', 'title', 'admin'));
        } elseif (auth()->user()->hasRole('user')) {
            if (auth()->user()->branch_bindding_user[0]->branch == null) {
                $link = DB::table('form_submits as fs')
                    ->join('branch_bindding_user as bbu', 'fs.created_by', '=', 'bbu.user_id')
                    ->join('branch_hei as bhei', 'bbu.branch_hei_id', '=', 'bhei.bhei_id')
                    ->select(
                        'fs.id',
                        'fs.token',
                        'fs.starts_at',
                        'fs.expires_at',
                        'fs.academic_year',
                        'fs.created_at',
                        'bhei.institute_kh as branch_kh'
                    )
                    ->where('bbu.user_id', auth()->user()->id)
                    ->orderBy('bhei.institute_kh')
                    ->orderBy('fs.created_at', 'desc')
                    ->get()
                    ->groupBy('branch_kh');
                return view('links.link-member', compact('link', 'title', 'admin'));
            } else {
                $link = DB::table('form_submits as fs')
                    ->join('branch_bindding_user as bbu', 'fs.created_by', '=', 'bbu.user_id')
                    ->join('branch as b', 'bbu.branch_id', '=', 'b.branch_id')
                    ->select(
                        'fs.id',
                        'fs.token',
                        'fs.starts_at',
                        'fs.expires_at',
                        'fs.academic_year',
                        'fs.created_at',
                        'b.branch_kh'
                    )
                    ->where('bbu.user_id', auth()->user()->id)
                    ->orderBy('b.branch_kh')
                    ->orderBy('fs.created_at', 'desc')
                    ->get()
                    ->groupBy('branch_kh');
                return view('links.link-member', compact('link', 'title', 'admin'));
            }
        }
    }

    public function linkInstitute()
    {
        $option = 1;
        $total_member_institute = $this->totalMemberInstitute($option);
        $title = "គ្រឹះស្ថានឧត្តមសិក្សា កាកបាទក្រហមកម្ពុជា 25 រាជធានី-​ខេត្ត(បណ្តោះអាសន្ធ)";
        return view("link_institute.index", compact("total_member_institute", 'option', 'title'));
    }
    public function linkInstituteReport()
    {
        $option = 2;
        $total_member_institute = $this->totalMemberInstitute($option);
        $title = "គ្រឹះស្ថានឧត្តមសិក្សា កាកបាទក្រហមកម្ពុជា 25 រាជធានី-​ខេត្ត";
        return view("link_institute.index", compact("total_member_institute", "option", 'title'));
    }

    public function linkInstituteById($id)
    {
        $title = "បញ្ចូលសមាជិកតាមរយៈតំណរភ្ជាប់ (បណ្តោះអាសន្ធ)";
        $admin = true;
        $option = 1;
        $link = DB::table('form_submits as fs')
            ->join('branch_bindding_user as bbu', 'fs.created_by', '=', 'bbu.user_id')
            ->join('branch_hei as bhei', 'bbu.branch_hei_id', '=', 'bhei.bhei_id')
            ->select(
                'fs.id',
                'fs.token',
                'fs.starts_at',
                'fs.expires_at',
                'fs.academic_year',
                'fs.created_at',
                'bhei.institute_kh as branch_kh'
            )
            ->where('bbu.branch_hei_id', $id)
            ->orderBy('bhei.institute_kh')
            ->orderBy('fs.created_at', 'desc')
            ->get()
            ->groupBy('branch_kh');
        // dd($link);
        return view('links.link-member', compact('link', 'title', 'admin', 'option'));
    }
    public function linkInstituteReportById($id)
    {
        $title = "បញ្ចូលសមាជិកតាមរយៈតំណរភ្ជាប់";
        $admin = true;
        $option = 2;
        $link = DB::table('form_submits as fs')
            ->join('branch_bindding_user as bbu', 'fs.created_by', '=', 'bbu.user_id')
            ->join('branch_hei as bhei', 'bbu.branch_hei_id', '=', 'bhei.bhei_id')
            ->select(
                'fs.id',
                'fs.token',
                'fs.starts_at',
                'fs.expires_at',
                'fs.academic_year',
                'fs.created_at',
                'bhei.institute_kh as branch_kh'
            )
            ->where('bbu.branch_hei_id', $id)
            ->orderBy('bhei.institute_kh')
            ->orderBy('fs.created_at', 'desc')
            ->get()
            ->groupBy('branch_kh');
        return view('links.link-member', compact('link', 'title', 'admin', 'option'));
    }

    public function totalMemberInstitute($option)
    {
        if ($option == 1) {
            return DB::table('branch_hei as bhei')
                ->leftJoin('branch_bindding_user as bu', 'bu.branch_hei_id', '=', 'bhei.bhei_id')
                ->leftJoin('form_submits as fs', 'fs.created_by', '=', 'bu.user_id')
                ->leftJoin('member_registration_detail as mrd', 'mrd.form_submits_id', '=', 'fs.id')
                ->leftJoin('member_education_background as meb', function ($join) {
                    $join->on('meb.member_id', '=', 'mrd.member_id')
                        ->whereNotNull('meb.branchhei_id')
                        ->whereNull('meb.school_id');
                })
                ->where('bhei.institute_type', '=', 'សាកលវិទ្យាល័យ')
                ->select(
                    'bhei.institute_kh',
                    'bhei.image',
                    'bhei.bhei_id',
                    DB::raw('COUNT(CASE WHEN mrd.approved = 0 THEN mrd.member_id END) as total_members'),
                    DB::raw('COUNT(DISTINCT fs.id)as total_links')
                )
                ->groupBy('bhei.institute_kh', 'bhei.image', 'bhei.bhei_id')
                ->orderBy('bhei.bhei_id', 'asc')
                ->get();
        } elseif ($option == 2) {
            return DB::table('branch_hei as bhei')
                ->leftJoin('branch_bindding_user as bu', 'bu.branch_hei_id', '=', 'bhei.bhei_id')
                ->leftJoin('form_submits as fs', 'fs.created_by', '=', 'bu.user_id')
                ->leftJoin('member_registration_detail as mrd', 'mrd.form_submits_id', '=', 'fs.id')
                ->leftJoin('member_education_background as meb', function ($join) {
                    $join->on('meb.member_id', '=', 'mrd.member_id')
                        ->whereNotNull('meb.branchhei_id')
                        ->whereNull('meb.school_id');
                })
                ->where('bhei.institute_type', '=', 'សាកលវិទ្យាល័យ')
                ->select(
                    'bhei.institute_kh',
                    'bhei.image',
                    'bhei.bhei_id',
                    DB::raw('COUNT(CASE WHEN mrd.approved = 1 THEN mrd.member_id END) as total_members'),
                    DB::raw('COUNT(DISTINCT fs.id)as total_links')
                )
                ->groupBy('bhei.institute_kh', 'bhei.image', 'bhei.bhei_id')
                ->orderBy('bhei.bhei_id', 'asc')
                ->get();
        }
    }

    public function createLink()
    {
        $title = 'បង្កើត Link';
        $admin = false;
        if (auth()->user()->hasRole('admin')) {
            $admin = true;
            $institute = branch_hei::select('branch_hei.bhei_id', 'branch_hei.institute_kh')
                ->join('branch_bindding_user as bu', 'bu.branch_hei_id', '=', 'branch_hei.bhei_id')
                ->distinct() // make sure no duplicates from join
                ->get();
            // dd($institute);       
            return view('links.create-link', compact('title', 'institute', 'admin'));
        } else {
            return view('links.create-link', compact('title', 'admin'));
        }
    }
    public function linkStore(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {

            $userByInstitue = $request->institute;

            if ($userByInstitue != null) {
                $userId = DB::table('branch_bindding_user as  bu')
                    ->join('branch_hei as bh', 'bh.bhei_id', '=', 'bu.branch_hei_id')
                    ->select('bu.user_id')
                    ->where('bh.bhei_id', $userByInstitue)
                    ->first();

                $existing = form_submits::where('created_by', $userId->user_id)
                    ->where('academic_year', $request->academic_year)
                    ->first();

                if ($existing) {
                    return response()->json([
                        'message' => 'Link សម្រាប់ឆ្នាំសិក្សានេះ មានរួចហើយ។ សូមបង្កើត Link សម្រាប់ឆ្នាំសិក្សាថ្មី។',
                        'status' => 409,
                    ]);
                }

                auth()->user()->setRememberToken(Str::random(200));
                form_submits::create([
                    'created_by' => $userId->user_id,
                    'token' => auth()->user()->getRememberToken(),
                    'starts_at' => $request->starts_at,
                    'expires_at' => $request->expires_at,
                    'academic_year' => $request->academic_year,
                ])->save();

                return response()->json([
                    'message' => 'Link ត្រូវបានបង្កើតដោយជោគជ័យ',
                    'status' => 200,
                    'token' => auth()->user()->getRememberToken(),
                    'starts_at' => $request->starts_at,
                    'expires_at' => $request->expires_at,
                ]);
            }
        } else {
            $userId = auth()->user()->id;

            $existing = form_submits::where('created_by', $userId)
                ->where('academic_year', $request->academic_year)
                ->first();

            if ($existing) {
                return response()->json([
                    'message' => 'Link សម្រាប់ឆ្នាំសិក្សានេះ មានរួចហើយ។ សូមបង្កើត Link សម្រាប់ឆ្នាំសិក្សាថ្មី។',
                    'status' => 409,
                ]);
            }

            auth()->user()->setRememberToken(Str::random(200));
            form_submits::create([
                'created_by' => auth()->user()->id,
                'token' => auth()->user()->getRememberToken(),
                'starts_at' => $request->starts_at,
                'expires_at' => $request->expires_at,
                'academic_year' => $request->academic_year,
            ])->save();

            return response()->json([
                'message' => 'Link ត្រូវបានបង្កើតដោយជោគជ័យ',
                'status' => 200,
                'token' => auth()->user()->getRememberToken(),
                'starts_at' => $request->starts_at,
                'expires_at' => $request->expires_at,
            ]);
        }
    }
    public function linkReport()
    {
        $title = "ការគ្រប់គ្រងតំណរភ្ជាប់";
        if (auth()->user()->hasRole('admin')) {
            $membersPerHei = DB::table('branch_hei as bhei')
                ->Join('branch_bindding_user as bu', 'bu.branch_hei_id', '=', 'bhei.bhei_id')
                ->Join('form_submits as fs', 'fs.created_by', '=', 'bu.user_id')
                ->Join('member_registration_detail as mrd', 'mrd.form_submits_id', '=', 'fs.id')
                ->Join('member_education_background as meb', 'meb.member_id', '=', 'mrd.member_id')
                ->where('mrd.approved', '=', 1)
                ->selectRaw('
                    COUNT(DISTINCT mrd.mrd_id) as total_members
                ')
                ->groupBy('bhei.bhei_id', 'bhei.institute_kh')
                ->get();
            return view('links.link-report', compact('membersPerHei', 'title'));
        } elseif (auth()->user()->hasRole('user')) {
            $link = DB::table('form_submits as fs')
                ->join('branch_bindding_user as bbu', 'fs.created_by', '=', 'bbu.user_id')
                ->join('branch_hei as bhei', 'bbu.branch_hei_id', '=', 'bhei.bhei_id')
                ->select(
                    'fs.id',
                    'fs.token',
                    'fs.starts_at',
                    'fs.expires_at',
                    'fs.academic_year',
                    'fs.created_at',
                    'bhei.institute_kh as branch_kh'
                )
                ->where('bbu.user_id', auth()->user()->id)
                ->orderBy('bhei.institute_kh')
                ->orderBy('fs.created_at', 'desc')
                ->get()
                ->groupBy('branch_kh');
            return view('links.link-report', compact('link', 'title'));
        }
    }
    public function linkDetail_watting_for_approve($linkId)
    {
        $approved = 0;
        $baseQuery = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('form_submits as fsm', 'fsm.id', '=', 'mrd.form_submits_id')
            ->whereRaw('mrd.registration_date > NOW() - INTERVAL 4 YEAR')
            ->where('mrd.form_submits_id', $linkId)
            ->where('mrd.approved', '=', 0);
        $total_mem = (clone $baseQuery)
            ->select([
                'fsm.academic_year',
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
                'branch.branch_kh',
                's.school_name',
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

            ->get()
            ->unique('member_id')->values();
        $data = $baseQuery->get()->unique('member_id');
        //  dd($total_mem[0]->name_en);
        $totalStu = $data->count();
        $femaleStu = $data->where('gender', 'ស្រី')->count();
        if (count($total_mem) == 0) {
            return view('links.dbl-click', compact('total_mem', 'approved', 'totalStu', 'femaleStu'));
        }
        $current_branch = $data->first()->branch_kh;
        $institute_kh = $data->first()->institute_kh;
        return view('links.dbl-click', compact('total_mem', 'approved', 'totalStu', 'femaleStu', 'current_branch', 'institute_kh'));
    }
    public function linkDetail_approved($linkId)
    {
        $approved = 1;
        $baseQuery = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('form_submits as fsm', 'fsm.id', '=', 'mrd.form_submits_id')
            ->whereRaw('mrd.registration_date > NOW() - INTERVAL 4 YEAR')
            ->where('mrd.form_submits_id', $linkId)
            ->where('mrd.approved', '=', 1);
        $total_mem = (clone $baseQuery)
            ->select([
                'fsm.academic_year',
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                // 'meb.institute_id',
                'hei.institute_kh',
                'hei.institute_type',
                's.school_name',
                'branch.branch_name',
                'branch.branch_kh',
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
        $data = $baseQuery->get();
        $totalStu = $data->count();
        $femaleStu = $data->where('gender', 'ស្រី')->count();
        if (count($total_mem) == 0) {
            return view('links.dbl-click', compact('total_mem', 'approved', 'totalStu', 'femaleStu'));
        }
        $current_branch = $data->first()->branch_kh;
        $institute_kh = $data->first()->institute_kh;
        return view('links.dbl-click', compact('total_mem', 'approved', 'totalStu', 'femaleStu', 'current_branch', 'institute_kh'));
    }
    public function linkDelete()
    {
        $tokenEntry = form_submits::where('id', request()->id)
            ->firstOrFail();
        $tokenEntry->delete();
        return response()->json([
            'message' => 'Link ត្រូវបានលុបដោយជោគជ័យ',
            'status' => 200,
        ]);
    }
    public function linkEdit($linkId)
    {
        $title = 'កែប្រែ Link';
        $tokenEntry = form_submits::where('id', $linkId)
            ->firstOrFail();
        return view('links.create-link', compact('title', 'tokenEntry'));
    }
    public function linkUpdate(Request $request)
    {
        $tokenEntry = form_submits::where('id', $request->id)
            ->firstOrFail();
        $tokenEntry->starts_at = $request->starts_at;
        $tokenEntry->expires_at = $request->expires_at;
        $tokenEntry->save();

        return response()->json([
            'message' => 'Link ត្រូវបានកែប្រែដោយជោគជ័យ',
            'status' => 200,
            'data' => $tokenEntry->token,
        ]);
    }

    public function memberApprove(Request $request)
    {
        $member = member_registration_detail::whereIn('member_id', $request->arr)
            ->update(['approved' => 1]);
        return response()->json([
            'message' => 'Member approved successfully',
            'status' => 200,
        ]);
    }
}
