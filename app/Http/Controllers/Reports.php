<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Reports extends Controller
{
    //
    public function reports()
    {
        return view("pages/reports/reports");
    }
}
