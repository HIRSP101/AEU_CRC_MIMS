<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    public function index($branchId)
    {
        $villages = DB::table('branch_hei')
            ->where('branch_id', $branchId)
            ->get();
        return view('village.index', compact('villages', 'branchId'));
    }

    // public function totalMemberVillage()
    // {
    //     return DB::table('branch_hei as hei')
    //             ->join('branch as br', 'hei.branch_id', '=', 'br.branch_id')
    //             ->select('hei.village', 'br.branch_id')
    //             ->where('br.branch_id', 1)
    //             ->get();
    // }

    public function get($branchId, $villageId)
    {
        $schools = DB::table('branch_hei')
            ->where('branch_id', $branchId)
            ->where('village', $villageId)
            ->select('bhei_id', 'institute_kh', 'image')
            ->get();
        return view('school.index', compact('schools', 'branchId', 'villageId'));
    }

}
