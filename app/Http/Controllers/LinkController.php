<?php

namespace App\Http\Controllers;

use App\Models\user_form_tokens;
use Illuminate\Http\Request;
use Str;

class LinkController extends Controller
{
    public function linkMember()
    {
        return view('links.link-member');
    }
    public function createLink()
    {
        return view('links.create-link');
    }
    public function linkStore(Request $request)
    {
        auth()->user()->setRememberToken(Str::random(200));
        user_form_tokens::create([
            'user_id' => auth()->user()->id,
            'token' => auth()->user()->getRememberToken(),
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
            'academic_year' => $request->academic_year,
        ])->save();

        return response()->json([
            'message' => 'Link created successfully',
            'status' => 200,
            'token' => auth()->user()->getRememberToken(),
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
        ]);
    }
    public function linkReport()
    {
        return view('links.link-report');
    }
    public function linkDetail()
    {
        return view('links.dbl-click');
    }
}
