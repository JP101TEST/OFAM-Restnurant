<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementAdminRoute extends Controller
{
    //
    public function goHomepageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif(session('User')[0]['employees_id'] != 'admin'){
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_home');
        }
    }

    public function goHomepageEditWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif(session('User')[0]['employees_id'] != 'admin'){
            return view('management/management_oder_food_list');
        }else {
            return view('management/admin_page/management_home_edit');
        }
    }

    public function goTablepageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        }elseif(session('User')[0]['employees_id'] != 'admin'){
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_table');
        }
    }

    public function goTableAddpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        }elseif(session('User')[0]['employees_id'] != 'admin'){
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_table_add');
        }
    }

    public function goFoodpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif(session('User')[0]['employees_id'] != 'admin'){
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_food');
        }
    }
}
