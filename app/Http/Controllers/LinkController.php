<?php

namespace App\Http\Controllers;

use App\Models\form_submits;
use App\Models\member_registration_detail;
use DB;
use Illuminate\Http\Request;
use Str;

class LinkController extends Controller
{
    public function linkMember()
    {
        if (auth()->user()->hasRole('admin')) {
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
                ->orderBy('b.branch_kh')
                ->orderBy('fs.created_at', 'desc')
                ->get()
                ->groupBy('branch_kh');
            return view('links.link-member', compact('link', ));
        } elseif (auth()->user()->hasRole('user')) {
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
            return view('links.link-member', compact('link'));
        }
    }
    public function createLink()
    {
        $title = 'បង្កើត Link';
        return view('links.create-link', compact('title'));
    }
    public function linkStore(Request $request)
    {
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
    public function linkReport()
    {
        if (auth()->user()->hasRole('admin')) {
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
                ->orderBy('b.branch_kh')
                ->orderBy('fs.created_at', 'desc')
                ->get()
                ->groupBy('branch_kh');
            return view('links.link-report', compact('link'));
        } elseif (auth()->user()->hasRole('user')) {
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
            return view('links.link-report', compact('link'));
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
            ->distinct()
            ->get();
        return view('links.dbl-click', compact('total_mem', 'approved'));
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
        return view('links.dbl-click', compact('total_mem', 'approved'));
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
