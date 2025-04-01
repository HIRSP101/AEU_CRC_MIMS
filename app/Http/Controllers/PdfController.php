<?php

namespace App\Http\Controllers;

use App\Models\branch_hei;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class PdfController extends Controller
{
    public function generateReport($id)
    {

        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');  // Set execution time limit to 300 seconds (5 minutes)

        $tempDir = storage_path('app/reports/');  // Temporary directory to save PDFs

        // Make sure the temporary directory exists
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Start chunking the query
        $member =  DB::table('member_personal_detail as mpd')
            ->where('mpd.member_id', $id)
            ->orderBy('mpd.member_id')
            ->get();


        // return response()->json($member);

        $pdfFilePath = $tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន_យុវជន.pdf";

        $html = view('pdf-preview.member-detail-form.index', compact('member'))->render();
        Browsershot::html($html)->format('A4')->savePdf($pdfFilePath);

        // Return the Zip file as a download in the response
        // return response()->download($pdfFilePath)->deleteFileAfterSend(true);  // Automatically delete after download
    }
    public function exportPdfRequestForm($id)
    {
        $member = DB::table('member_personal_detail as mpd')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->join('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->join('school as s', 'meb.school_id', '=', 's.school_id')
            ->join('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->where('mpd.member_id', $id)
            ->select(
                'mpd.*',
                'mgd.*',
                'mrd.*',
                'meb.*',
                'mca.*',
                'mpa.*',
                's.school_name',
                'b.branch_kh'
            )
            ->first();
        // return response()->json($member);
        $tempDir = storage_path('app/reports/');
        $pdfFilePath = $tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន.pdf";

        $html = view('pdf-preview.request-form-preview.index', compact('member'))->render();
        Browsershot::html($html)->format('A4')->savePdf($pdfFilePath);
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);  // Automatically delete after download

    }

    public function exportPdfDetailForm($id)
    {
        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');
        $member = DB::table('member_personal_detail as mpd')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->join('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->join('school as s', 'meb.school_id', '=', 's.school_id')
            ->join('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->where('mpd.member_id', $id)
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                'b.branch_name',
                'b.branch_kh',
                'mpd.member_type',
                's.school_name',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
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
                'meb.major',
                'meb.institute_id',
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
        // return response()->json($member);
        $tempDir = storage_path('app/reports/');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $pdfFilePath = $tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន.pdf";

        $html = view('pdf-preview.member-detail-form.index', compact('member'))->render();
        Browsershot::html($html)->format('A4')->savePdf($pdfFilePath);
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}
