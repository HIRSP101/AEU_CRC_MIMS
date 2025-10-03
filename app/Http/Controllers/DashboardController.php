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

        $branches = branch::select('branch_kh', 'branch_id', 'branch_image')->get();
        $user = Auth::user();
        $authName = $user->name;
        $authEmail = $user->email;
        $institute_id = \App\Models\branch_bindding_user::where('user_id', $user->id)->value('branch_hei_id');

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
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' AND mrd.expiration_date >= NOW() THEN mpd.member_id END) AS total_wm"),
                DB::raw("COUNT(CASE WHEN mrd.expiration_date >= NOW() THEN meb.member_id END) as total_mem"),
                DB::raw("COUNT(CASE WHEN mrd.expiration_date < NOW() THEN meb.member_id END) as total_mem_expired"),
                DB::raw("COUNT(DISTINCT d.district_id) AS total_villages")
            )
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image')
            ->get();

        $total_mem_institute = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'meb.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->rightJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->select(
                'hei.bhei_id',
                'hei.institute_kh',
                'hei.image',
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' AND mrd.expiration_date >= NOW() THEN mpd.member_id END) AS total_wm"),
                DB::raw("COUNT(CASE WHEN mrd.expiration_date >= NOW() THEN meb.member_id END) as total_mem"),
                DB::raw("COUNT(CASE WHEN mrd.expiration_date < NOW() THEN meb.member_id END) as total_mem_expired"),
            )
            ->where('hei.bhei_id', $institute_id)
            ->groupBy('hei.bhei_id', 'hei.institute_kh', 'hei.image')
            ->first();

        return view('dashboard.index', compact('branches', 'authName', 'authEmail', 'total_mem_branches', 'total_mem_institute'));
    }
}
