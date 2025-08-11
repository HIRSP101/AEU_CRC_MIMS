<?php

namespace App\Http\Controllers;

use App\Models\branch_hei;
use App\Models\school;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class PdfController extends Controller
{
    // 2025/05/07 new function to export PDF generate members detail form by institute
    public function generateMembersByInstitute(Request $request)
    {
        $instituteId = $request->input('institute_id');
        $memberIds = $request->input('member_ids');
        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');  // Set execution time limit to 300 seconds (5 minutes)

        $institution = branch_hei::where('bhei_id', $instituteId)->select('institute_kh')->first();

        // Start chunking the query
        $members = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->where('hei.bhei_id', $instituteId)
            ->whereIn('mpd.member_id', $memberIds)
            ->select(
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
                'mpd.full_current_address',
                'mpd.phone_number',
                'mpd.email',
                'mpd.shirt_size',
                'mpob.village',
                'mpob.commune_sangkat',
                'mpob.district_khan',
                'mpob.provience_city',
                'mcad.home_no',
                'mcad.street_no',
                'mcad.village as village_current',
                'mcad.commune_sangkat as commune_sangkat_current',
                'mcad.district_khan as district_khan_current',
                'mcad.provience_city as provience_city_current',
                'meb.acadmedic_year',
                'meb.language',
                'meb.misc_skill',
                'meb.computer_skill',
                'meb.major',
                'hei.institute_kh',
                's.school_name',
                'mpd.facebook',
                'mgd.father_name',
                'mgd.father_dob',
                'mgd.father_current_address',
                'mgd.father_occupation',
                'mgd.mother_name',
                'mgd.mother_dob',
                'mgd.mother_current_address',
                'mgd.mother_occupation',
                'mgd.guardian_phone',
            )
            ->orderBy('mpd.member_id')
            ->get();

        return view('pdf-preview.multimember-detail-form.index', compact('members', 'institution'));
    }
    public function generateMembersRequestFormByInstitute(Request $request)
    {
        $instituteId = $request->input('institute_id');
        $memberIds = $request->input('member_ids');
        $institution = branch_hei::where('bhei_id', $instituteId)->select('institute_kh')->first();

        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');
        $members = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->leftJoin('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->whereIn('mpd.member_id', $memberIds)
            ->select(
                'mpd.*',
                'mca.village as current_village',
                'mca.commune_sangkat as current_commune',
                'mca.district_khan as current_district',
                'mca.provience_city as current_province',
                'mca.home_no',
                'mca.street_no',
                'mrd.*',
                's.school_name',
                'hei.institute_kh',
                'b.branch_kh'
            )
            ->orderBy('mpd.member_id')
            ->get();

        return view('pdf-preview.multimember-request-form.index', compact('members', 'institution'));
    }
    // 2025/05/07 end of new function to export PDF generate members detail form by institute
    public function exportPdfRequestForm(Request $request)
    {
        $memberId = $request->input('member_id');
        $member = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->leftJoin('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->where('mpd.member_id', $memberId)
            ->select(
                'mpd.*',
                'mca.village as current_village',
                'mca.commune_sangkat as current_commune',
                'mca.district_khan as current_district',
                'mca.provience_city as current_province',
                'mca.home_no',
                'mca.street_no',
                'mrd.*',
                's.school_name',
                'hei.institute_kh',
                'b.branch_kh'
            )
            ->first();
        // return response()->json($member);
        $tempDir = storage_path('app/reports/');

        $pdfFilePath = $tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន.pdf";

        return view('pdf-preview.request-form-preview.index', compact('member')); // Automatically delete after download

    }
    public function exportPdfDetailForm(Request $request)
    {
        $memberId = $request->input('member_id');
        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');
        $member = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->leftJoin('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->where('mpd.member_id', $memberId)
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.member_image',
                'mpd.date_of_birth',
                'b.branch_name',
                'b.branch_kh',
                'mpd.member_type',
                's.school_name',
                'hei.institute_kh',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
                'mrd.scout_youth_registration_date',
                'mrd.other_ngos_registration_date',
                'mrd.uyfc_registration_date',
                'mpd.full_current_address',
                'mpd.phone_number',
                'mpd.email',
                'mpd.shirt_size',
                'mpa.village',
                'mpa.commune_sangkat',
                'mpa.district_khan',
                'mpa.provience_city',
                'mca.home_no',
                'mca.street_no',
                'mca.village as village_current',
                'mca.commune_sangkat as commune_sangkat_current',
                'mca.district_khan as district_khan_current',
                'mca.provience_city as provience_city_current',
                'meb.acadmedic_year',
                'meb.language',
                'meb.misc_skill',
                'meb.computer_skill',
                'meb.major',
                'mpd.facebook',
                'mgd.father_name',
                'mgd.father_dob',
                'mgd.father_current_address',
                'mgd.father_occupation',
                'mgd.mother_name',
                'mgd.mother_dob',
                'mgd.mother_current_address',
                'mgd.mother_occupation',
                'mgd.guardian_phone',
            ])
            ->first();

        return view('pdf-preview.member-detail-form.index', compact('member'));

    }
    // 2025/05/23 new function to export PDF generate members detail form by School
    public function generateMembersBySchool(Request $request)
    {
        $schoolId = $request->input('school_id');
        $memberIds = $request->input('member_ids');
        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');  // Set execution time limit to 300 seconds (5 minutes)

        $school = school::where('school_id', $schoolId)->select('school_name')->first();

        // return response()->json($school);
        // Start chunking the query
        $members = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->where('s.school_id', $schoolId)
            ->whereIn('mpd.member_id', $memberIds)
            ->select(
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
                'mpd.full_current_address',
                'mpd.phone_number',
                'mpd.email',
                'mpd.shirt_size',
                'mpob.village',
                'mpob.commune_sangkat',
                'mpob.district_khan',
                'mpob.provience_city',
                'mcad.home_no',
                'mcad.street_no',
                'mcad.village as village_current',
                'mcad.commune_sangkat as commune_sangkat_current',
                'mcad.district_khan as district_khan_current',
                'mcad.provience_city as provience_city_current',
                'meb.acadmedic_year',
                'meb.language',
                'meb.misc_skill',
                'meb.computer_skill',
                'meb.major',
                'hei.institute_kh',
                's.school_name',
                'mpd.facebook',
                'mgd.father_name',
                'mgd.father_dob',
                'mgd.father_current_address',
                'mgd.father_occupation',
                'mgd.mother_name',
                'mgd.mother_dob',
                'mgd.mother_current_address',
                'mgd.mother_occupation',
                'mgd.guardian_phone',
            )
            ->orderBy('mpd.member_id')
            ->get();

        return view('pdf-preview.multimember-detail-form.index', compact('members', 'school'));
    }
    public function generateMembersRequestFormBySchool(Request $request)
    {
        $schoolId = $request->input('school_id');
        $memberIds = $request->input('member_ids');
        $school = school::where('school_id', $schoolId)->select('school_name')->first();

        $chunkSize = 100;

        $chunkCounter = 1;
        $tempDir = storage_path('app/reports/');

        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');
        $members = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->leftJoin('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->leftJoin('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->whereIn('mpd.member_id', $memberIds)
            ->select(
                'mpd.*',
                'mca.village as current_village',
                'mca.commune_sangkat as current_commune',
                'mca.district_khan as current_district',
                'mca.provience_city as current_province',
                'mca.home_no',
                'mca.street_no',
                'mrd.*',
                's.school_name',
                'hei.institute_kh',
                'b.branch_kh'
            )
            ->orderBy('mpd.member_id')
            ->get();

        // Return the Zip file as a download in the response
        return view('pdf-preview.multimember-request-form.index', compact('members', 'school'));
    }
    // 2025/05/23 end of new function to export PDF generate members detail form by School 

}
