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
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' THEN mpd.member_id END) AS total_wm"),
                DB::raw("COUNT(CASE WHEN mrd.expiration_date >= NOW() THEN meb.member_id END) as total_mem"),
                DB::raw("COUNT(DISTINCT d.district_id) AS total_villages")
            )
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image')
            ->get();
        return view('dashboard.index', compact('branches', 'authName', 'authEmail', 'total_mem_branches'));
    }
}
