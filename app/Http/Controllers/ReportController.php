<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Reports\TotalsummarizedProvience;

class ReportController extends Controller
{

    public function index() 
    {
        return view('report.index');
    }
    public function branches_report() {
        $branchesreport = DB::table('member_education_background as meb')
        ->rightjoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
        ->leftjoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
        ->select(
            'branch.branch_kh',
            DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' THEN mpd.member_id END) AS total_wm"),
            DB::raw("COUNT(mpd.member_id) AS total_mem"),
            DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' and mpd.member_type like 'ទីប្រឹក្សា%' THEN mpd.member_id END) AS total_ls_wm"),
            DB::raw("COUNT(CASE WHEN mpd.member_type like 'ទីប្រឹក្សា%' THEN mpd.member_id END) AS total_ls"),
            DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'វិទ្យាល័យ%' or institute_id like '%វិ.ហ%' and meb.branch_id != 28 THEN meb.institute_id END)) as total_hs"),
            DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'អនុ%' and meb.branch_id != 28  THEN meb.institute_id END)) as total_ms")
        )
        ->where('branch.branch_id', '!=', '28')
        ->groupBy( 'branch.branch_kh', 'branch.branch_id')
        ->orderBy('branch.branch_id','asc')
        ->get();
        //dd($branchesreport);
        return view('report.partials.branches_report', compact('branchesreport'));
    }

} 
