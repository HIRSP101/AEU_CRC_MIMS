<?php

namespace App\Http\Controllers;

use App\Http\Requests\VillageRequest;
use App\Services\Villages\CreateVillageService;
use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\village;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    public function index($branchId)
    {
        $branch = DB::table('branch')
            ->where('branch_id', $branchId)
            ->select('branch_kh')
            ->first();

        $villages = DB::table('village')
            ->where('branch_id', $branchId)
            ->select('village_id', 'village_name')
            ->get();

        return view('village.index', compact('villages', 'branchId', 'branch'));
    }

    public function get($branchId, $villageId)
    {
        $schools = DB::table('branch_hei')
            ->where('branch_id', $branchId)
            ->where('village', $villageId)
            ->select('bhei_id', 'institute_kh', 'image')
            ->get();
        return view('school.index', compact('schools', 'branchId', 'villageId'));
    }

    public function create($branchId)
    {
        $branch = branch::findOrFail($branchId);
        return view('village.create-village', compact('branch'));
    }
   
    public function store(VillageRequest $request, CreateVillageService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id'); // Get branch ID from URL
    
        $village = $service->createVillage($data);
    
        return redirect()->route('village', ['id' => $village->branch_id])
                     ->with('success', 'Village created successfully');
    }
}
