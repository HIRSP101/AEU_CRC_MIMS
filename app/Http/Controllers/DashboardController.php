<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch;

class DashboardController extends Controller
{
    public function index() {
        $branches = branch::all()->pluck('branch_kh', 'branch_id');
       // dd($branches);
        return view('dashboard.index', compact('branches'));
    }
}
