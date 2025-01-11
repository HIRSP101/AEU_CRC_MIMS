<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituteController extends Controller
{
    public function index()
    {
        $total_member_institute = $this->totalMemberInstitute();
        return view("institude.index", compact("total_member_institute"));
    }

    public function totalMemberInstitute() 
    {
        return DB::table('branch_hei')
                ->select('bhei_id', 'institute_kh', 'image')
                ->get();
    }
}
