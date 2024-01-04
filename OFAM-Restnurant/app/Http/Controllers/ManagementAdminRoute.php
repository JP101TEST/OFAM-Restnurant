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
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_home');
        }
    }

    public function goHomepageEditWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_home_edit');
        }
    }

    public function goTablepageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_table');
        }
    }

    public function goTableAddpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_table_add');
        }
    }

    public function goTableEditpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_table_edit');
        }
    }

    public function goFoodpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_food');
        }
    }

    public function goFoodCategorypageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_food_category_add');
        }
    }

    public function goFoodMenupageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_food_menu_add');
        }
    }

    public function goFoodMenuEditpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {


            return view('management/admin_page/management_food_menu_edit');
        }
    }

    public function goPromotionpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {


            return view('management/admin_page/management_promotion');
        }
    }

    public function goPromotionAddpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_promotion_add');
        }
    }

    public function goPromotionEditpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_promotion_edit');
        }
    }

    public function goEmployeepageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_employee');
        }
    }

    public function goEmployeeAddpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_employee_add');
        }
    }

    public function goEmployeeViewpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_employee_view');
        }
    }

    public function goEmployeeEditpageWithGet()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_employee_edit');
        }
    }

    public function goBillpageWithGet() {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_bill');
        }
    }

    public function goTotalSummarypageWithGet() {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } elseif (session('User')[0]['employees_id'] != 'admin') {
            return view('management/management_oder_food_list');
        } else {
            return view('management/admin_page/management_total_summary');
        }
    }
}
