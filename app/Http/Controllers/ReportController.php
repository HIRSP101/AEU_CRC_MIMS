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
        $year = request('year', now()->year);

        $branch = DB::table('branch')->where('branch_id', $branchId)->select('branch_kh')->first();

        $district = DB::table('district as d')
            ->select(
                'd.district_id',
                'd.district_name',
                's.school_id',
                's.school_name',
                DB::raw("COUNT(CASE WHEN YEAR(mrd.registration_date) = $year THEN meb.member_id END) as total_mem"),
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' AND YEAR(mrd.registration_date) = $year THEN meb.member_id END) as total_mem_fem"),

                DB::raw("COUNT(CASE WHEN YEAR(mrd.registration_date) = $year AND mpd.member_type = 'សមាជិកា យុវជន' THEN meb.member_id END) as total_mem_advisor"),
                DB::raw("COUNT(CASE WHEN mpd.gender = 'ស្រី' AND YEAR(mrd.registration_date) = $year AND mpd.member_type = 'សមាជិកា យុវជន' THEN meb.member_id END) as total_mem_fem_advisor"),
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
            'selectedYear' => $year,
            // 'branchWhole' => $branchTotals,
            'branchWhole' => (object)[
                'total_schools' => $totalSchools,
                'total_mem' => $district->sum('total_mem'),
                'total_mem_fem' => $district->sum('total_mem_fem'),
                'total_mem_advisor' => $district->sum('total_mem_advisor'),
                'total_mem_fem_advisor' => $district->sum('total_mem_fem_advisor'),
            ],
        ]);
    }

    public function reportOption3()
    {
        $year = request('year', now()->year);

        $branch_and_count_member = DB::table('branch as b')
            ->leftJoin('school as s', 's.branch_id', '=', 'b.branch_id')
            ->leftJoin('district as v', function ($join) {
                $join->on('v.district_id', '=', 's.district_id')
                    ->on('v.branch_id', '=', 's.branch_id');
            })
            ->leftJoin('member_education_background as meb', function ($join) {
                $join->on('meb.school_id', '=', 's.school_id')
                    ->on('meb.branch_id', '=', 's.branch_id');
            })
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mrd.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', function ($join) {
                $join->on('hei.bhei_id', '=', 'meb.branchhei_id')
                    ->on('hei.branch_id', '=', 'b.branch_id');
            })
            ->select(
                'b.branch_id',
                'b.branch_kh',
                DB::raw("COUNT(CASE WHEN YEAR(mrd.registration_date) = $year THEN meb.member_id END) AS total_mem"),
                DB::raw("COUNT(CASE WHEN YEAR(mrd.registration_date) = $year AND mpd.gender = 'ស្រី' THEN meb.member_id END) AS total_mem_fem"),
                DB::raw("COUNT(CASE WHEN YEAR(mrd.registration_date) = $year AND mpd.member_type = 'សមាជិកា យុវជន' THEN meb.member_id END) AS total_mem_advisor"),
                DB::raw("COUNT(CASE WHEN YEAR(mrd.registration_date) = $year AND mpd.member_type = 'សមាជិកា យុវជន' AND mpd.gender = 'ស្រី' THEN meb.member_id END) AS total_mem_fem_advisor"),
            )
            ->where('b.branch_id', '<', '28')
            ->groupBy('b.branch_id', 'b.branch_kh')
            ->get();

        $school_types_per_branch = DB::table('school as s')
            ->select(
                's.branch_id',
                DB::raw("SUM(CASE WHEN s.type = 'អនុវិទ្យាល័យ' THEN 1 ELSE 0 END) as total_secondary_school"),
                DB::raw("SUM(CASE WHEN s.type = 'វិទ្យាល័យ' THEN 1 ELSE 0 END) as total_high_school")
            )
            ->groupBy('s.branch_id')
            ->get()
            ->keyBy('branch_id');

        $universities_per_branch = DB::table('branch_hei as hei')
            ->select(
                'hei.branch_id',
                DB::raw('COUNT(*) as total_university'),
            )
            ->where('hei.institute_type', 'សាកលវិទ្យាល័យ')
            ->groupBy('hei.branch_id')
            ->get()
            ->keyBy('branch_id');

        $total_member_all_university = DB::table('branch_hei as hei')
            ->select(
                'hei.institute_kh',
                DB::raw("COUNT(CASE 
            WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            THEN meb.member_id END) AS total_mem"),
                DB::raw("COUNT(CASE 
            WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem"),
                DB::raw("COUNT(CASE 
            WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR 
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            THEN meb.member_id END) AS total_mem_advisor"),
                DB::raw("COUNT(CASE 
            WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR 
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem_advisor")
            )
            ->leftJoin('member_education_background as meb', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mrd.member_id', '=', 'mpd.member_id')
            ->groupBy('hei.institute_kh')
            ->get();

        $combined_data = $branch_and_count_member->map(function ($branch) use ($school_types_per_branch, $universities_per_branch) {
            $branch_id = $branch->branch_id;

            $school = $school_types_per_branch[$branch_id] ?? (object)[
                'total_secondary_school' => 0,
                'total_high_school' => 0,
            ];

            $university = $universities_per_branch[$branch_id] ?? (object)[
                'total_university' => 0,
            ];

            return (object)[
                ...get_object_vars($branch),
                'secondary_school' => $school->total_secondary_school,
                'high_school' => $school->total_high_school,
                'university' => $university->total_university,
            ];
        });

        return view('report.partials.report-option3', [
            'branch_and_count_member' => $combined_data,
            'school_types_per_branch' => $school_types_per_branch,
            'universities_per_branch' => $universities_per_branch,
            'total_member_all_university' => $total_member_all_university,
            'selectedYear' => $year,
            'branchWhole' => (object)[
                'total_mem' => $combined_data->sum('total_mem'),
                'total_mem_fem' => $combined_data->sum('total_mem_fem'),
                'total_mem_advisor' => $combined_data->sum('total_mem_advisor'),
                'total_mem_fem_advisor' => $combined_data->sum('total_mem_fem_advisor'),
            ],
            'member_all_university' => (object)[
                'total_mem' => $total_member_all_university->sum('total_mem'),
                'total_mem_fem' => $total_member_all_university->sum('total_mem_fem'),
                'total_mem_advisor' => $total_member_all_university->sum('total_mem_advisor'),
                'total_mem_fem_advisor' => $total_member_all_university->sum('total_mem_fem_advisor'),
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
        // $branchesreport = $this->branchhei()
        //     ->where('hei.type', '=', 'ឯកជន')
        //     ->groupBy('hei.institute_kh', 'hei.bhei_id')
        //     ->orderBy('hei.bhei_id', 'asc')
        //     ->get();
        //  return view('report.partials.private-university', compact('branchesreport'));

        $year = request('year', now()->year);
        $branchhei_private = DB::table('branch_hei as hei')
            ->select(
                'hei.institute_kh',
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            THEN meb.member_id END) AS total_mem"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            THEN meb.member_id END) AS total_mem_advisor"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem_advisor")
            )
            ->leftJoin('member_education_background as meb', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mrd.member_id', '=', 'mpd.member_id')
            ->where('hei.type', '=', 'ឯកជន')
            ->groupBy('hei.institute_kh')
            ->get();

        return view('report.partials.private-university', [
            'branchhei_private' => $branchhei_private,
            'selectedYear' => $year,
            'branchWhole' => (object)[
                'total_mem' => $branchhei_private->sum('total_mem'),
                'total_mem_fem' => $branchhei_private->sum('total_mem_fem'),
                'total_mem_advisor' => $branchhei_private->sum('total_mem_advisor'),
                'total_mem_fem_advisor' => $branchhei_private->sum('total_mem_fem_advisor'),
            ],
        ]);
    }
    public function branchheipublic()
    {
        // $branchesreport = $this->branchhei()
        //     ->where('hei.type', '=', 'សាធារណះ')
        //     ->groupBy('hei.institute_kh', 'hei.bhei_id')
        //     ->orderBy('hei.bhei_id', 'asc')
        //     ->get();
        // return view('report.partials.public-university', compact('branchesreport'));

        $year = request('year', now()->year);
        $branchhei_public = DB::table('branch_hei as hei')
            ->select(
                'hei.institute_kh',
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            THEN meb.member_id END) AS total_mem"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            THEN meb.member_id END) AS total_mem_advisor"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem_advisor")
            )
            ->leftJoin('member_education_background as meb', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mrd.member_id', '=', 'mpd.member_id')
            ->where('hei.type', '=', 'សាធារណះ')
            ->groupBy('hei.institute_kh')
            ->get();
        return view('report.partials.public-university', [
            'branchhei_public' => $branchhei_public,
            'selectedYear' => $year,
            'branchWhole' => (object)[
                'total_mem' => $branchhei_public->sum('total_mem'),
                'total_mem_fem' => $branchhei_public->sum('total_mem_fem'),
                'total_mem_advisor' => $branchhei_public->sum('total_mem_advisor'),
                'total_mem_fem_advisor' => $branchhei_public->sum('total_mem_fem_advisor'),
            ],
        ]);
    }

    public function branchhei_all()
    {
        $year = request('year', now()->year);
        $branchhei = DB::table('branch_hei as hei')
            ->select(
                'hei.institute_kh',
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            THEN meb.member_id END) AS total_mem"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិក យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            THEN meb.member_id END) AS total_mem_advisor"),
                DB::raw("COUNT(CASE 
            WHEN YEAR(mrd.registration_date) = $year 
            AND mpd.member_type = 'សមាជិកា យុវជន' 
            AND mpd.gender = 'ស្រី' 
            THEN meb.member_id END) AS total_mem_fem_advisor")
            )
            ->leftJoin('member_education_background as meb', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mrd.member_id', '=', 'mpd.member_id')
            ->groupBy('hei.institute_kh')
            ->get();
        return view('report.partials.total-university', [
            'branchhei' => $branchhei,
            'selectedYear' => $year,
            'branchWhole' => (object)[
                'total_mem' => $branchhei->sum('total_mem'),
                'total_mem_fem' => $branchhei->sum('total_mem_fem'),
                'total_mem_advisor' => $branchhei->sum('total_mem_advisor'),
                'total_mem_fem_advisor' => $branchhei->sum('total_mem_fem_advisor'),
            ],
        ]);
    }


    public function branchReport()
    {
        $total_mem_branches = $this->totalmem_branches()
            ->where('b.branch_id', '<', '28')
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image')
            ->get();
        // dd($total_mem_branches);

        $title = 'បញ្ជីរាយនាមសមាជិកយុវជនកាកបាទក្រហមប្រចាំសាខានីមួយៗ';

        return view('branch.index', compact('total_mem_branches', 'title'));
    }
    public function showListBranch()
    {
        $total_mem_branches = $this->totalmem_branches()
            ->where('b.branch_id', '<', '28')
            ->groupBy('b.branch_id', 'b.branch_kh', 'b.branch_image')
            ->get();

        $title = 'តារាងទិន្នន័យបច្ចុប្បន្នភាពគ្រឹះស្ថានសិក្សា ទីប្រឹក្សា និងយុវជនប្រចាំសាខានីមួយៗ';

        return view('report.partials.list_branch', compact('total_mem_branches', 'title'));
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
