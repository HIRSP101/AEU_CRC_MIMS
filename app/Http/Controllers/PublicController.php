<?php

namespace App\Http\Controllers;

use App\Services\Members\CreateMemberService;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\branch_hei;

class PublicController extends Controller
{
    protected CreateMemberService $createService;

    public function __construct(CreateMemberService $createService) {
        $this->createService = $createService;
    }


    public function index() {
        $branches = Branch::all()->pluck('branch_kh', 'branch_id');
        $branchhei = branch_hei::all()->pluck('institute_kh', 'bhei_id');
        return view("public_form.index", compact('branches', 'branchhei'));
    }

    public function store(Request $request) {   

    }


    public function update(Request $request, $id) {

    }

    public function member_form() {

    }

}
