<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    public function hr_manage()
    {
        return view('manageInterview.manage-hr');
    }
    public function final_selection()
    {
          return view('manageInterview.final-selection');
    }
}
