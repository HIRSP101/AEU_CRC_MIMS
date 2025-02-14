<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index()
    {
        $document = DB::table('school as s')
            ->leftJoin('member_education_background as meb', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->select(
                's.school_id',
                's.school_name',
                's.branch_id',
                's.district_id',
                DB::raw('COALESCE(COUNT(meb.member_id), 0) as total_mem')
            )
            ->groupBy('s.school_id', 's.school_name', 's.branch_id', 's.district_id')
            ->get();


        // $document = DB::table('school as s')
        //     ->select('school_id', 'school_name', 'branch_id', 'district_id')
        //     ->get();

        // $document = DB::table('school as s')
        //     ->leftJoin('village as v', function ($join) {
        //         $join->on('v.district_id', '=', 's.district_id')
        //             ->on('s.branch_id', '=', 'v.branch_id');
        //     })
        //     ->leftJoin('member_education_background as meb', function ($join) {
        //         $join->on('meb.school_id', '=', 's.school_id')
        //             ->on('meb.branch_id', '=', 's.branch_id');
        //     })
        //     ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
        //     ->where('s.school_id', $schoolId)
        //     ->select(
        //         's.school_id',
        //         's.school_name',
        //         's.type',
        //         's.district',
        //         's.branch_id',
        //         's.district_id',
        //         DB::raw('COUNT(meb.member_id) as total_mem')
        //     )
        //     ->groupBy('s.school_id', 's.school_name', 's.type', 's.district')
        //     ->get();

        return view("document.index", compact('document'));
    }

    // public function get($branchId, $villageId, $schoolId, Request $request)
    // {
    //     $startDate = $request->query('start_date');
    //     $endDate = $request->query('end_date');

    //     $query = DB::table('member_personal_detail as mpd')
    //         ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
    //         ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
    //         // ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
    //         ->join('branch as b', 'meb.branch_id', '=', 'b.branch_id')
    //         ->join('school as s', 'meb.school_id', '=', 's.school_id')
    //         ->join('village as v', 'v.district_id', '=', 's.district_id')
    //         ->where('meb.branch_id', $branchId)
    //         ->where('s.district_id', $villageId)
    //         ->where('meb.school_id', $schoolId)
    //         ->select([
    //             'mpd.member_id',
    //             'mpd.member_code',
    //             'mpd.name_kh',
    //             'mpd.name_en',
    //             'mpd.gender',
    //             'mpd.date_of_birth',
    //             // 'meb.institute_id',
    //             'meb.branch_id',
    //             's.school_name',
    //             'b.branch_name',
    //             'mpd.member_type',
    //             'meb.education_level',
    //             'meb.acadmedic_year',
    //             'mrd.registration_date',
    //             'mrd.expiration_date',
    //             'mpd.full_current_address',
    //             'mpd.phone_number',
    //             // 'mgd.guardian_phone',
    //             'mpd.email',
    //             'mpd.shirt_size'
    //         ]);
    //     $total_mem = $query->get();

    //     if ($startDate && $endDate) {
    //         $query->whereBetween('mrd.registration_date', [$startDate, $endDate]);
    //     }

    //     $data = $query->get();
    //     return view('totalmemDocs.index', [
    //         'data' => $data,
    //         'branchId' => $branchId,
    //         'villageId' => $villageId,
    //         'schoolId' => $schoolId
    //     ]);
    // }

    public function get(Request $request)
    {
        $schoolId = $request->id;

        $baseQuery = DB::table('member_personal_detail as mpd')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('branch as b', 'meb.branch_id', '=', 'b.branch_id')
            ->join('school as s', 's.school_id', '=', 'meb.school_id')
            ->where('meb.school_id', $schoolId);

        $total_fem = (clone $baseQuery)
            ->select(DB::raw('COUNT(meb.member_id) as total_mem_fem'))
            ->where('mpd.gender', 'ស្រី')
            ->first()
            ->total_mem_fem;

        $total_total = (clone $baseQuery)
            ->select(DB::raw('COUNT(meb.member_id) as total_mem'))
            ->first()
            ->total_mem;

        $total_mem = (clone $baseQuery)
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                // 'meb.institute_id',
                's.school_name',
                'b.branch_name',
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
            ])
            ->distinct()
            ->get();
        return view('totalmemDocs.index', compact('total_mem', 'total_fem', 'total_total'));
    }
}
