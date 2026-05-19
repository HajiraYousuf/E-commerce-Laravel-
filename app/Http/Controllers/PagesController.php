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
    public function report(){
        return view('admin.dashboards.reports');
    }
    public function insight(){
        return view('admin.dashboards.insights');
    }
    public function inventroy(){
        return view('admin.inventory.inventory');
    }
    public function transaction(){
        return view('admin.transaction.transaction');
    }
    public function calendar(){
        return view('admin.calendar.calendar');
    }
    public function settings(){
        return view('admin.settings.settings');
    }
    public function messages(){
        return view('admin.messages.messages');
    }
    public function products(){
        return view('admin.products.index');
    }
    
    public function users(){
        return view('admin.users.index');
    }
    
    public function roles_perm(){
        return view('admin.users.roles-perm');
    }
    
    public function user_activity(){
        return view('admin.users.user-activity');
    }
}
