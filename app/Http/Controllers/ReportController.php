<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() 
    {
        return view('dashboard.report.all-report-list');
    }

    public function data_chart() {
        return view('dashboard.report.data-chart');
    }

    public function branch() {
        return view('dashboard.report.branch');
    }

    public function listOfName() {
        return view('dashboard.report.list-of-name');
    }


} 
