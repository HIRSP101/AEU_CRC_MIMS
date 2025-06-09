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
        $branch_id = DB::table('branch')
            ->leftJoin('branch_bindding_user', 'branch.branch_id', '=', 'branch_bindding_user.branch_id')
            ->where('user_id', auth()->user()->id)
            ->get();
        $linkByUserId = DB::table('branch_bindding_user as bh')
            ->Join('form_submits', 'bh.user_id', '=', 'form_submits.created_by')
            ->where('bh.branch_id', $branch_id[0]->branch_id)
            ->select('form_submits.*', 'bh.user_id', 'bh.branch_id')
            ->get();
        return view('links.link-member', compact('linkByUserId'));
    }
    public function createLink()
    {
        $title = 'បង្កើត Link';
        return view('links.create-link', compact('title'));
    }
    public function linkStore(Request $request)
    {
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
        $branch_id = DB::table('branch')
            ->leftJoin('branch_bindding_user', 'branch.branch_id', '=', 'branch_bindding_user.branch_id')
            ->where('user_id', auth()->user()->id)
            ->get();
        $linkByUserId = DB::table('branch_bindding_user as bh')
            ->Join('form_submits', 'bh.user_id', '=', 'form_submits.created_by')
            ->where('bh.branch_id', $branch_id[0]->branch_id)
            ->select('form_submits.*', 'bh.user_id', 'bh.branch_id')
            ->get();
        return view('links.link-report', compact('linkByUserId'));
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
            ->leftJoin('form_submits as fsm', 'fsm.id', '=', 'mrd.form_submits_id')
            ->whereRaw('mrd.registration_date > NOW() - INTERVAL 4 YEAR')
            ->where('mrd.form_submits_id',  $linkId)
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
        return view('links.dbl-click', compact('total_mem','approved'));
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
            ->leftJoin('form_submits as fsm', 'fsm.id', '=', 'mrd.form_submits_id')
            ->whereRaw('mrd.registration_date > NOW() - INTERVAL 4 YEAR')
            ->where('mrd.form_submits_id',  $linkId)
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
        return view('links.dbl-click', compact('total_mem','approved'));
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

    public function memberApprove (Request $request)
    {
        $member = member_registration_detail::whereIn('member_id', $request->arr)
        ->update(['approved' => 1]);
        return response()->json([
            'message' => 'Member approved successfully',
            'status' => 200,
        ]);
    }
}
