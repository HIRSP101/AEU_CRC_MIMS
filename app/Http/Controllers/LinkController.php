<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function linkReport()
    {
        return view('links.link-report');
    }
}
