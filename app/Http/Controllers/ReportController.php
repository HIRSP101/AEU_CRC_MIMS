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

    public function branches_report()
    {
        $branchesreport = $this->branches()
            ->where('branch.branch_id', '!=', '28')
            ->where('meb.branchhei_id', '=', null)
            ->groupBy('branch.branch_kh', 'branch.branch_id')
            ->orderBy('branch.branch_id', 'asc')
            ->get();
        return view('report.partials.branches_report', compact('branchesreport'));
    }

    public function branchesHeiReport($branchId)
    {

        // $branchesReport = $this->branches()
        //     // ->with(['branchhei '])
        //     ->select('branch.branch_kh', 'branch.branch_id')
        //     ->where('branch.branch_id', '!=', '28')
        //     ->groupBy('branch.branch_kh', 'branch.branch_id')
        //     ->orderBy('branch.branch_id', 'asc')
        //     ->get();

        // $branchHeiReport = $this->branchhei()
        //     ->select('hei.institute_kh', 'hei.bhei_id', 'hei.branch_id',)
        //     ->groupBy('hei.institute_kh', 'hei.bhei_id', 'hei.branch_id',)
        //     ->orderBy('hei.bhei_id', 'asc')
        //     ->get();

        // $branchesReports = $branchesReport->merge($branchHeiReport);
        // $groupedReports = $branchesReports->groupBy('branch_kh');
        // return view('report.partials.total-member-university', compact('groupedReports'));

        $branch = DB::table('branch')->where('branch_id', $branchId)->select('branch_kh')->first();

        $district = DB::table('district as d')
            ->select(
                'd.district_id',
                'd.district_name',
                's.school_id',
                's.school_name',
                DB::raw("COUNT(CASE WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR THEN meb.member_id END) as total_mem")
            )
            ->leftJoin('school as s', 'd.district_id', '=', 's.district_id')
            ->leftJoin('member_education_background as meb', function ($join) use ($branchId) {
                $join->on('meb.school_id', '=', 's.school_id')->where('meb.branch_id', '=', DB::raw($branchId));
            })
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->where('d.branch_id', $branchId)
            ->groupBy('d.district_id', 'd.district_name', 's.school_id', 's.school_name')
            ->orderBy('d.district_name')
            ->get();



        $branchTotals = (object) [
            'total_schools' => $district->sum('total_schools'),
            'total_mem' => $district->sum('total_mem'),
        ];

        $totalSchools = DB::table('school')
            ->where('branch_id', $branchId)
            ->distinct()
            ->count('school_id');


        return view('report.partials.total-member-university', [
            'district' => $district,
            'branchId' => $branchId,
            'branch' => $branch,
            // 'branchWhole' => $branchTotals,
            'branchWhole' => (object)[
                'total_schools' => $totalSchools,
                'total_mem' => $district->sum('total_mem'),
            ],
        ]);
    }

    public function branches($is_district = null)
    {

        $base_select = [
            DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' THEN mpd.member_id END) AS total_wm"),
            DB::raw("COUNT(mpd.member_id) AS total_mem"),
            DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' and mpd.member_type like 'ទីប្រឹក្សា%' THEN mpd.member_id END) AS total_ls_wm"),
            DB::raw("COUNT(CASE WHEN mpd.member_type like 'ទីប្រឹក្សា%' THEN mpd.member_id END) AS total_ls"),
            DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'វិទ្យាល័យ%' or institute_id like '%វិ.ហ%' and meb.branch_id != 28 THEN meb.institute_id END)) as total_hs"),
            DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'អនុ%' and meb.branch_id != 28  THEN meb.institute_id END)) as total_ms"),
            DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'សាកល%' or institute_id like 'សកល%' THEN meb.institute_id END)) as total_hei")
        ];

        $additional_select = [];


        $branches = DB::table('member_education_background as meb')
            ->rightjoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id');
        if ($is_district) {
            $branches->leftJoin('school', 'meb.school_id', '=', 'school.school_id');
            $branches->leftJoin('district', 'school.district_id', '=', 'district.district_id');
            array_push($additional_select, 'district.district_name');
        }
        $branches->leftjoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->select(
                array_merge($additional_select, $base_select)
            );

        return $branches;
    }

    public function branch_report_exclude(Request $request)
    {
        if (empty($request->id)) {
            return redirect('report');
        }
        $branchesReport = $this->branches(true)
            ->where('meb.branch_id', '=', $request->id)
            ->groupBy('district.district_name')
            ->get();
        dd($branchesReport);
        return view('report.partials.total-member-university', compact('branchesReport'));
    }

    public function branchhei()
    {
        $branchhei = DB::table('member_education_background as meb')
            ->rightjoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftjoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->select(
                'hei.institute_kh as branch_kh',
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' THEN mpd.member_id END) AS total_wm"),
                DB::raw("COUNT(mpd.member_id) AS total_mem"),
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' and mpd.member_type like 'ទីប្រឹក្សា%' THEN mpd.member_id END) AS total_ls_wm"),
                DB::raw("COUNT(CASE WHEN mpd.member_type like 'ទីប្រឹក្សា%' THEN mpd.member_id END) AS total_ls"),
                DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'វិទ្យាល័យ%' or institute_id like '%វិ.ហ%' THEN meb.institute_id END)) as total_hs"),
                DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'អនុ%'  THEN meb.institute_id END)) as total_ms"),
                DB::raw("COUNT(distinct (CASE WHEN meb.institute_id like 'សាកល%' or institute_id like 'សកល%' THEN meb.institute_id END)) as total_hei")
            );
        return $branchhei;
    }
    public function branchheiprivate()
    {
        $branchesreport = $this->branchhei()
            ->where('hei.type', '=', 'ឯកជន')
            ->groupBy('hei.institute_kh', 'hei.bhei_id')
            ->orderBy('hei.bhei_id', 'asc')
            ->get();
        return view('report.partials.private-university', compact('branchesreport'));
    }

    public function branchheipublic()
    {
        $branchesreport = $this->branchhei()
            ->where('hei.type', '=', 'សាធារណះ')
            ->groupBy('hei.institute_kh', 'hei.bhei_id')
            ->orderBy('hei.bhei_id', 'asc')
            ->get();
        return view('report.partials.public-university', compact('branchesreport'));
    }

    public function branchhei_all()
    {
        $branchesreport = $this->branchhei()
            ->groupBy('hei.institute_kh', 'hei.bhei_id')
            ->orderBy('hei.bhei_id', 'asc')
            ->get();
        return view('report.partials.total-university', compact('branchesreport'));
    }


    public function showListBranch()
    {
        $total_mem_branches = $this->totalmem_branches()
            ->where('b.branch_id', '<', '28')
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image')
            ->get();

        return view('report.partials.list_branch', compact('total_mem_branches'));
    }

    public function totalmem_branches()
    {
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
                //DB::raw("COUNT(DISTINCT meb.member_id) AS total_mem"),
                DB::raw("COUNT(CASE 
                    WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR
                    THEN meb.member_id END) as total_mem"),
                DB::raw("COUNT(DISTINCT d.district_id) AS total_villages")
            )
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image');

        return $total_mem_branches;
    }
}
