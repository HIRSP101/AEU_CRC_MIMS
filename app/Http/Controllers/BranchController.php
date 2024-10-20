<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index() {
        $total_mem_branches = DB::table('branch as branch')
            ->leftjoin('member_education_background as meb', 'branch.branch_id', '=', 'meb.branch_id')
            ->leftjoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->select(
                'branch.branch_id',
                'branch.branch_kh',
                'branch.image',
                DB::raw("COUNT(distinct meb.institute_id) AS total_institutes"),
                DB::raw("COUNT(meb.member_id) AS total_mem")
            )
            ->groupBy('branch.branch_id', 'branch.branch_kh', 'branch.image')
            ->orderBy('total_institutes', 'desc')
            ->get();
        return view('branch.index', compact('total_mem_branches'));
    }

    public function get(Request $request) {
        $total_fem = DB::table('member_personal_detail as mpd')
        ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
        ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
        ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
        ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
        ->select(DB::raw("COUNT(meb.member_id) AS total_mem_fem"))
        ->where("branch.branch_id", $request->id)
        ->where("mpd.gender", "ស្រី")
        ->get();
        $total_total = DB::table('member_personal_detail as mpd')
        ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
        ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
        ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
        ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
        ->select(DB::raw("COUNT(meb.member_id) AS total_mem"))
        ->where("branch.branch_id", $request->id)
        ->get();
        $total_mem = DB::table('member_personal_detail as mpd')
        ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
        ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
        ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
        ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
        ->select(
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
        )
        ->where('branch.branch_id', $request->id)
        ->get();

        return view('totalmembranch.index', compact('total_mem','total_fem', 'total_total'));
    }
}
