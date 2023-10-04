<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodCategoryAdminController extends Controller
{
    //
    public function addCategory(Request $request)
    {
        $categoryName = $request->input('categoryName');
        $categoryNameEmpty = FoodCategoryAdminController::checkEmptyName($categoryName);
        $categoryNameDatabase = DB::table('menu_categories')
            ->where('menu_category_name', $categoryName)->get();
        $categoryNameDuplicate = FoodCategoryAdminController::checkDuplicateName($categoryNameDatabase);

        /*
        print("categoryName:" . $categoryName . '<br>');
        print("categoryNameEmpty:" . $categoryNameEmpty . '<br>');
        print("categoryNameDatabase:" . $categoryNameDatabase . '<br>');
        print("categoryNameDuplicate:" . $categoryNameDuplicate . '<br>');
*/

        if ($categoryNameEmpty) {
            session(['errorCategoryName' => 'กรุณากรอกชื่อ']);
            return redirect()->route('management.admin.food.category');
        }
        if ($categoryNameDuplicate) {
            session(['errorCategoryName' => 'ชื่อ ' . $categoryName . ' นี้มีการใช้งานแล้ว']);
            return redirect()->route('management.admin.food.category');
        }

        // Find the maximum table_id from the 'tables' table
        $lastCategory = DB::table('menu_categories')->orderBy('menu_category_id', 'desc')->first();
        $categoryId = null;

        /*
            # code...
            print('lastCategory->id:' . $lastCategory->menu_category_id . '<br>');
            print('lastCategory->name:' . $lastCategory->menu_category_name . '<br>');
*/

        // Check if any records exist

        if ($lastCategory) {
            // If records exist, increment the table_id by 1
            $categoryId = $lastCategory->menu_category_id + 1;
        } else {
            // If no records exist, set an initial value (e.g., 1)
            $categoryId = 1;
        }


        //print('categoryId:' . $categoryId . '<br>');


        DB::table('menu_categories')->insert([
            'menu_category_id' => $categoryId,
            'menu_category_name' => $categoryName
        ]);


        return view('management/admin_page/management_food');
    }

    public function checkEmptyName($name)
    {
        if ($name == '') {
            return true;
        } else {
            return false;
        }
    }

    public function checkDuplicateName($name)
    {
        if ($name->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

}
