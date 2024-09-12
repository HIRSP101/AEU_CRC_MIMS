<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $branches = branch::all()->pluck('branch_kh', 'branch_id');
        $user = Auth::user();
        $authName = $user->name;
        $authEmail = $user->email;
       // dd($branches);
        return view('dashboard.index', compact('branches', 'authName', 'authEmail'));
    }
}
