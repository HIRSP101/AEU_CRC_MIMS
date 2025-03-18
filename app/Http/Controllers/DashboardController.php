<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $branches = branch::select('branch_kh', 'branch_id');
        $branches = branch::select('branch_kh', 'branch_id', 'branch_image')->get();

        $user = Auth::user();
        $authName = $user->name;
        $authEmail = $user->email;
        $total_mem_branches = DB::table('member_personal_detail as mpd')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->select(
                'branch.branch_id',
                'branch.branch_kh',
                'branch.branch_image',
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' THEN mpd.member_id END) AS total_wm"),
                DB::raw("COUNT(mpd.member_id) AS total_mem")
            )
            ->groupBy('branch.branch_id', 'branch.branch_kh')
            ->orderBy('total_mem', 'desc')
            ->get();
        //dd($total_mem_branches);
        //    dd($branches->branch_);
        return view('dashboard.index', compact('branches', 'authName', 'authEmail', 'total_mem_branches'));
    }
}
