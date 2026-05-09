<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboards.dashboard'); 
    }
    public function overview(){
        return view('admin.dashboards.overview');
    }
}
