<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\branch;
use App\Models\branch_hei;
use App\Models\member_personal_detail;
use App\Services\Branches\CreateBranchService;
use App\Services\Branches\DeleteBranchService;
use App\Services\Branches\UpdateBranchService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use ZipArchive;

class InstituteController extends Controller
{
    public function index1()
    {
        $total_member_institute = $this->totalMemberInstitute();
        return view("institude.index", compact("total_member_institute"));
    }
    public function totalMemberInstitute()
    {
        return DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'meb.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->select(
                'hei.bhei_id',
                'hei.institute_kh',
                'hei.image',
                //DB::raw('COUNT(DISTINCT meb.member_id) as total_members')
                DB::raw("COUNT(CASE 
                    WHEN mrd.registration_date > NOW() - INTERVAL 4 YEAR
                    THEN meb.member_id END) as total_members")
            )
            ->groupBy('hei.bhei_id', 'hei.institute_kh', 'hei.image')
            ->get();
    }

    public function get(Request $request)
    {

        $instituteId = $request->id;
        $institution = branch_hei::find($instituteId)->select('institute_kh')->findOrFail($instituteId);

        $baseQuery = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->leftJoin('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->leftJoin('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->leftJoin('branch_hei as hei', 'branch.branch_id', '=', 'hei.bhei_id')
            ->where('meb.branchhei_id', '=', $instituteId)
            ->where('hei.institute_type', '=', 'សាកលវិទ្យាល័យ')
            ->whereRaw('mrd.registration_date > NOW() - INTERVAL 4 YEAR');
        $total_mem = (clone $baseQuery)
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                // 'meb.institute_id',
                'hei.institute_kh',
                'hei.institute_type',
                'branch.branch_name',
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
                'mpob.village',
                'mpob.commune_sangkat',
                'mpob.district_khan',
                'mpob.provience_city',
                'mpob.home_no',
                'mpob.street_no',
                'mcad.home_no as home_no_current',
                'mcad.street_no as street_no_current',
                'mcad.village  as village_current',
                'mcad.commune_sangkat as commune_sangkat_current',
                'mcad.district_khan as district_khan_current',
                'mcad.provience_city as provience_city_current',

            ])
            ->distinct()
            ->get();
        return view('totalmemInstitute.index', compact('total_mem', 'institution'));
    }

    public function generateReport($id)
    {

        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');  // Set execution time limit to 300 seconds (5 minutes)
        $chunkSize = 100;

        $chunkCounter = 1;
        $tempDir = storage_path('app/reports/');

        $institution = branch_hei::where('bhei_id', $id)->select('institute_kh')->first();


        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Start chunking the query
        DB::table('member_personal_detail as mpd')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
            ->join('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
            ->join('branch_hei as hei', 'meb.branchhei_id', '=', 'hei.bhei_id')
            ->where('meb.branchhei_id', $id)
            ->orderBy('mpd.member_id')
            ->chunk($chunkSize, function ($member) use ($tempDir, $institution, &$chunkCounter) {

                if ($member->isEmpty())
                    return;

                $pdfFilePath = $tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន_យុវជន_កក្រក_ប្រចាំ_{$institution->institute_kh}{$chunkCounter}.pdf";

                $html = view('edu', compact('member'))->render();
                Browsershot::html($html)->format('A4')->savePdf($pdfFilePath);

                $chunkCounter++;
            });

        // Create a Zip file
        $zipFilePath = storage_path("app/reports/សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន_យុវជន_កក្រក_ប្រចាំ_{$institution->institute_kh}.zip");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {

            // Add all generated PDFs to the Zip file
            foreach (glob($tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន_យុវជន_កក្រក_ប្រចាំ_{$institution->institute_kh}*.pdf") as $file) {
                $zip->addFile($file, basename($file));  // Add each PDF as a file in the zip
            }
            $zip->close();
        }


        foreach (glob($tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន_យុវជន_កក្រក_ប្រចាំ_{$institution->institute_kh}*.pdf") as $file) {
            unlink($file);  // Delete the temporary PDF files
        }

        // Return the Zip file as a download in the response
        return response()->download($zipFilePath)->deleteFileAfterSend(true);  // Automatically delete after download
    }
}
