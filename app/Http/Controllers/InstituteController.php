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
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class InstituteController extends Controller
{   
    public function index1()
    {
        $total_member_institute = $this->totalMemberInstitute();
        // dd($total_member_institute);
        return view("institude.index", compact("total_member_institute"));
    }
    public function totalMemberInstitute() 
    {
        return DB::table('branch_hei as bhei')
            ->leftJoin('member_education_background as meb', 'bhei.bhei_id', '=', 'meb.member_id')
            ->leftJoin('member_personal_detail as mpd', 'meb.member_id', '=', 'mpd.member_id')
            ->select('bhei.bhei_id', 'bhei.institute_kh', 'bhei.branchhei_image', DB::raw('COUNT(DISTINCT mpd.member_id) as total_members'))
            ->groupBy('bhei.bhei_id', 'bhei.institute_kh', 'bhei.branchhei_image')
            ->get();
    }
    
    public function get(Request $request)
    {

        $instituteId = $request->id;
        $institution = branch_hei::find($instituteId)->select('institute_kh')->first();

        $baseQuery = DB::table('member_personal_detail as mpd')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
            ->join('member_pob_address as mpob','mpob.member_id','=','mpd.member_id')
            ->join('member_current_address as mcad','mcad.member_id','=','mpd.member_id')
            ->join('branch_hei as hei', 'branch.branch_id', '=', 'hei.bhei_id')
            ->where('meb.branchhei_id' , '=',$instituteId);

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
                'hei.institute_kh',
            ])
            ->distinct()
            ->get();
        return view('totalmemInstitute.index', compact('total_mem', 'total_fem', 'total_total','institution'));
    }

        public function generateReport($id)
        {
            ini_set('memory_limit', '512M'); // Set memory limit to 512MB
            ini_set('max_execution_time', '300');  // Set execution time limit to 300 seconds (5 minutes)
            
            $institution = branch_hei::find($id)->select('institute_kh')->first();

            // Define chunk size for processing
            $chunkSize = 100;
            $tempDir = storage_path('app/reports/');  // Temporary directory to save PDFs
        
            // Make sure the temporary directory exists
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }
        
            // Start chunking the query
            DB::table('member_personal_detail as mpd')
                ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
                ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
                ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
                ->join('branch as branch', 'meb.branch_id', '=', 'branch.branch_id')
                ->join('member_pob_address as mpob', 'mpob.member_id', '=', 'mpd.member_id')
                ->join('member_current_address as mcad', 'mcad.member_id', '=', 'mpd.member_id')
                ->join('branch_hei as hei', 'branch.branch_id', '=', 'hei.branch_id')
                ->where('meb.branchhei_id', $id)
                ->orderBy('mpd.member_id') 
                ->chunk($chunkSize, function ($members, $index) use ($tempDir, $institution) {

                    // Generate a PDF for the current chunk
                    $pdfContent = PDF::loadView('edu', ['member' => $members]);
        
                    // Save the PDF chunk to a temporary file
                    $pdfFilePath = $tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន_យុវជន_កក្រក_ប្រចាំ_{$institution->institute_kh}" . ($index + 1) . ".pdf";
                    $pdfContent->save($pdfFilePath);
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
        
            // Optional: Clean up temporary files after zipping
            foreach (glob($tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន_យុវជន_កក្រក_ប្រចាំ_{$institution->institute_kh}*.pdf") as $file) {
                unlink($file);  // Delete the temporary PDF files
            }
        
            // Return the Zip file as a download in the response
            return response()->download($zipFilePath)->deleteFileAfterSend(true);  // Automatically delete after download
        }

        
    }
