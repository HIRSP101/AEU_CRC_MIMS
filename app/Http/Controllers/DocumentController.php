<?php

namespace App\Http\Controllers;

use App\Models\school;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index()
    {
        $document = DB::table('school as s')
            ->leftJoin('member_education_background as meb', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->select(
                's.school_id',
                's.school_name',
                's.branch_id',
                's.district_id',
                //DB::raw('COALESCE(COUNT(meb.member_id), 0) as total_mem')
                DB::raw("COUNT(CASE WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR THEN meb.member_id END) as total_mem")
            )
            ->groupBy('s.school_id', 's.school_name', 's.branch_id', 's.district_id')
            ->get();

        return view("document.index", compact('document'));
    }

    public function get(Request $request)
    {
        $schoolId = $request->id;
        $school = school::find($schoolId)->select('school_name')->findOrFail($schoolId);

        $baseQuery = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('branch as b', 'meb.branch_id', '=', 'b.branch_id')
            ->leftJoin('school as s', 's.school_id', '=', 'meb.school_id')
            ->where('meb.school_id', $schoolId)
            ->whereRaw('mrd.registration_date > NOW() - INTERVAL 6 YEAR');

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
                'mpd.shirt_size',
                's.school_name'
            ])
            ->distinct()
            ->get();
        return view('totalmemDocs.index', compact('total_mem', 'school'));
    }
}
