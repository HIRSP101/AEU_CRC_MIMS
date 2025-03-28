<?php

namespace App\Http\Controllers;

use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
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

        $html = view('pdf-preview.request-form.index', compact('member'))->render();
        Browsershot::html($html)->format('A4')->savePdf($pdfFilePath);
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);  // Automatically delete after download

    }

    public function exportPdfDetailForm($id)
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
        //return response()->json($member);
        $tempDir = storage_path('app/reports/');
        $pdfFilePath = $tempDir . "សាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន.pdf";

        $html = view('pdf-preview.detail-form.index', compact('member'))->render();
        Browsershot::html($html)->format('A4')->savePdf($pdfFilePath);
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}
