<?php

namespace App\Http\Controllers;

use App\Models\branch_hei;
use DB;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use ZipArchive;
// use Iluminate\Support\Facades\DB;

class PdfController extends Controller
{   
    public function generateReport($id)
    {

        ini_set('memory_limit', '512M'); // Set memory limit to 512MB
        ini_set('max_execution_time', '300');  // Set execution time limit to 300 seconds (5 minutes)
        $chunkSize = 100;
        // Define chunk size for processing
        $chunkCounter = 1;
        $tempDir = storage_path('app/reports/');  // Temporary directory to save PDFs

        $institution = branch_hei::where('bhei_id', $id)->select('institute_kh')->first();

        // Make sure the temporary directory exists
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
