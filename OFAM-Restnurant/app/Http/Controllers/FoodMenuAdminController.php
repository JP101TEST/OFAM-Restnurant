<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;



use App\Models\Menu;

class FoodMenuAdminController extends Controller
{
    //
    public function checkDuplicateName($name)
    {
        if ($name->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }


    public function addMenu(Request $request)
    {
        $menuName = $request->input('menuName');
        $menuPrice = $request->input('menuPrice');
        $menuImage = $request->file('menuImage');
        $menuCategory = $request->input('menuCategory');
        $errorMenuName = null;
        $errorImage = null;
        $errorMenuCategory = null;
        $changeImageStatus = true;
        $menuNameDatabase = DB::table('menus')
            ->where('menu_name', $menuName)->get();
        //ตรวจสอบชื่อซ้ำ
        $menuNameDuplicate = FoodMenuAdminController::checkDuplicateName($menuNameDatabase);
        print('$menuName:' . $menuName . '<br>');
        print('$menuPrice:' . $menuPrice . '<br>');
        print('$menuImage:' . $menuImage . '<br>');
        print('$menuCategory:' . $menuCategory . '<br>');
        print('---------------------------------------------<br>');

        //ตรวจสอบชื่อ
        if ($menuName == null) {
            $errorMenuName = 'กรุณากรอกชื่อ';
            session(['errorImage' => $errorMenuName]);
        }

        // ตรวจสอบรูป
        if ($request->hasFile('menuImage')) {
            $menuImage = $request->file('menuImage');
            $originalFileName = $menuImage->getClientOriginalName();
            $fileExtension = $menuImage->getClientOriginalExtension();

            $allowedExtensions = ['jpg', 'png', 'webp', 'gif', 'bmp', 'svg', 'jpeg', 'ico', 'tiff'];

            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                $destinationPath = public_path('images/menu');

                if (File::exists($destinationPath . '/' . $originalFileName)) {
                    //print("รูป  \"$originalFileName\" นี้มีอยู่แล้ว<br>");
                    //$errorImage ='มีรูปซ้ำ';
                } else {
                    $menuImage->move($destinationPath, $originalFileName);
                    //print("รูป  \"$originalFileName\" อัปโหลดสำเร็จ<br>");
                }
            } else {
                $changeImageStatus = false;
                $errorImage = 'ไม่รองรับสกุลไฟล์นี้ (รองรับเฉพาะ jpg, png, webp, gif, bmp, svg, jpeg, ico, tiff)';
                session(['errorImage' => $errorImage]);
            }
        } else {
            //print("ไม่มีรูป  ในคำขอ<br>");
            $changeImageStatus = false;
            $errorImage = 'ไม่มีรูป';
        }

        if ($errorMenuCategory == '0') {
            $errorMenuCategory = 'กรุณาเลือกหมวดหมู่';
            session(['errorMenuCategory' => $errorMenuCategory]);
        }

        /*
        print('$errorMenuName:' . $errorMenuName . '<br>');
        print('$errorImage:' . $errorImage . '<br>');
        print('$originalFileName:' . $originalFileName . '<br>');
        print('$changeImageStatus:' . $changeImageStatus . '<br>');
        print('$menuNameDuplicate:' . $menuNameDuplicate . '<br>');
*/

        if ($errorMenuName != null || $errorMenuCategory != null || $errorImage != null) {
            return redirect()->route('management.admin.food.menu');
        }
        if ($menuNameDuplicate) {
            session(['errorMenuName' => 'ชื่อ ' . $menuName . ' นี้มีการใช้งานแล้ว']);
            return redirect()->route('management.admin.food.menu');
        }

        // Find the maximum menu_id from the 'menus' table
        $lastMenu = DB::table('menus')->orderBy('menu_id', 'desc')->first();
        $menuId = null;
        if ($lastMenu) {
            // If records exist, increment the table_id by 1
            $menuId = $lastMenu->menu_id + 1;
        } else {
            // If no records exist, set an initial value (e.g., 1)
            $menuId = 1;
        }
        print('$menuId:' . $menuId . '<br>');

        DB::table('menus')->insert([
            'menu_id' => $menuId,
            'menu_name' => $menuName,
            'menu_image' => $originalFileName,
            'menu_status' => 1,
            'menu_category_id' => $menuCategory
        ]);

        // Find the maximum menu_id from the 'menus' table
        $lastPriceHistory = DB::table('price_histories')->orderBy('price_history_id', 'desc')->first();
        $priceHistoryId = null;
        if ($lastPriceHistory) {
            // If records exist, increment the table_id by 1
            $priceHistoryId = $lastPriceHistory->price_history_id + 1;
        } else {
            // If no records exist, set an initial value (e.g., 1)
            $priceHistoryId = 1;
        }

        DB::table('price_histories')->insert([
            'price_history_id' => $priceHistoryId,
            'price' => $menuPrice,
            'menu_id' => $menuId,
            'date_start' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        return redirect()->route('management.admin.food');
    }

    public function editMenu(Request $request)
    {
        $menu_id = Route::current()->parameter('menu_id');
        $menuName_New = $request->input('menuName');
        $menuPrice_New = $request->input('menuPrice');
        $errorImage = null;
        $changeImageStatus = true;
        $menuNameDatabase = DB::table('menus')
            ->where('menu_id', $menu_id)->get();
        $price_historyDatabase = DB::table('price_histories')
            ->where('menu_id', $menu_id)
            ->where('date_end', null)->get();
        $menuName_duplicate_same_id = DB::table('menus')
            ->where('menu_name', $menuName_New)
            ->where('menu_id', '!=', $menu_id)
            ->count();
        //ตรวจสอบชื่อซ้ำ
        /*print('$menuName:' . $menuName_New . '$menuName_ole:' . $menuNameDatabase[0]->menu_name . '<br>');
        print('$menuPrice:' . $menuPrice_New . '$menuPrice_ole:' . $price_historyDatabase[0]->price . '<br>');*/


        // ตรวจสอบรูป
        if ($request->hasFile('menuImage')) {
            $menuImage = $request->file('menuImage');
            $originalFileName = $menuImage->getClientOriginalName();
            $fileExtension = $menuImage->getClientOriginalExtension();

            $allowedExtensions = ['jpg', 'png', 'webp', 'gif', 'bmp', 'svg', 'jpeg', 'ico', 'tiff'];

            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                $destinationPath = public_path('images/menu');

                if (File::exists($destinationPath . '/' . $originalFileName)) {
                    //print("รูป  \"$originalFileName\" นี้มีอยู่แล้ว<br>");
                    //$errorImage ='มีรูปซ้ำ';
                } else {
                    $menuImage->move($destinationPath, $originalFileName);
                    //print("รูป  \"$originalFileName\" อัปโหลดสำเร็จ<br>");
                }
            } else {
                $changeImageStatus = false;
                $errorImage = 'ไม่รองรับสกุลไฟล์นี้ (รองรับเฉพาะ jpg, png, webp, gif, bmp, svg, jpeg, ico, tiff)';
                session(['errorImage' => $errorImage]);
            }
        } else {
            //print("ไม่มีรูป  ในคำขอ<br>");
            $changeImageStatus = false;
            //$errorImage = 'ไม่มีรูป';
        }

        if ($request->hasFile('menuImage') != null) {
            print('$menuImage:' . $originalFileName . '$menuImage_ole:' . $menuNameDatabase[0]->menu_image . '<br>');
        } else {
            print('$menuImage:' . 'Null' . '$menuImage_ole:' . $menuNameDatabase[0]->menu_image . '<br>');
        }
        print('---------------------------------------------<br>');

        if ($menuName_duplicate_same_id > 0) {
            $errorMenuName = 'ชื่อนี้มีการใช้งานแล้ว';
            session(['errorMenuName' => $errorMenuName]);
        }

        if ($errorImage != null ||$menuName_duplicate_same_id > 0) {
            return redirect()->route('management.admin.food.menu.edit', ['menu_id' => $menu_id]);
        }

        if ($menuName_New != null && $menuName_New != $menuNameDatabase[0]->menu_name) {
            DB::table('menus')
                ->where('menu_id', $menu_id)
                ->update([
                    'menu_name' => $menuName_New,
                ]);
        }
        if ($changeImageStatus != false) {
            DB::table('menus')
                ->where('menu_id', $menu_id)
                ->update([
                    'menu_image' => $originalFileName,
                ]);
        }
        if ($menuPrice_New != null && $menuPrice_New != $price_historyDatabase[0]->price) {
            DB::table('price_histories')
                ->where('price_history_id', $price_historyDatabase[0]->price_history_id)
                ->update([
                    'date_end' => DB::raw('CURRENT_TIMESTAMP'),
                ]);

            // Find the maximum menu_id from the 'menus' table
            $lastPriceHistory = DB::table('price_histories')->orderBy('price_history_id', 'desc')->first();
            $priceHistoryId = null;
            if ($lastPriceHistory) {
                // If records exist, increment the table_id by 1
                $priceHistoryId = $lastPriceHistory->price_history_id + 1;
            } else {
                // If no records exist, set an initial value (e.g., 1)
                $priceHistoryId = 1;
            }

            DB::table('price_histories')->insert([
                'price_history_id' => $priceHistoryId,
                'price' => $menuPrice_New,
                'menu_id' => $price_historyDatabase[0]->menu_id,
                'date_start' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }
        return redirect()->route('management.admin.food');
        /*
        // Find the maximum menu_id from the 'menus' table
        $lastMenu = DB::table('menus')->orderBy('menu_id', 'desc')->first();
        $menuId = null;
        if ($lastMenu) {
            // If records exist, increment the table_id by 1
            $menuId = $lastMenu->menu_id + 1;
        } else {
            // If no records exist, set an initial value (e.g., 1)
            $menuId = 1;
        }
        print('$menuId:' . $menuId . '<br>');

        DB::table('menus')->insert([
            'menu_id' => $menuId,
            'menu_name' => $menuName,
            'menu_image' => $originalFileName,
            'menu_status' => 1,
            'menu_category_id' => $menuCategory
        ]);

        // Find the maximum menu_id from the 'menus' table
        $lastPriceHistory = DB::table('price_histories')->orderBy('price_history_id', 'desc')->first();
        $priceHistoryId = null;
        if ($lastPriceHistory) {
            // If records exist, increment the table_id by 1
            $priceHistoryId = $lastPriceHistory->price_history_id + 1;
        } else {
            // If no records exist, set an initial value (e.g., 1)
            $priceHistoryId = 1;
        }

        DB::table('price_histories')->insert([
            'price_history_id' => $priceHistoryId,
            'price' => $menuPrice,
            'menu_id' => $menuId,
            'date_start' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        return redirect()->route('management.admin.food');
        */
    }

    public function getPriceHistory()
    {
        $menu_id = Route::current()->parameter('menu_id');
        $allPriceHistory = DB::table('price_histories')
            ->where('menu_id', $menu_id)
            ->orderBy('date_start', 'desc')
            ->get();

        return response()->json(['allPriceHistory' => $allPriceHistory]);
    }

    public function getAllFood()
    {
        $category = Route::current()->parameter('category');
        if ($category == 0) {
            $menu = Menu::select([
                'menus.menu_id as menu_id',
                'menus.menu_name as menu_name',
                'menus.menu_image as menu_image',
                'menus.menu_status as menu_status',
                'menu_categories.menu_category_name as menu_category_name',
                'ph.price as price',
            ])
                ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.menu_category_id')
                ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
                    $join->on('menus.menu_id', '=', 'ph.menu_id');
                })
                ->orderBy('menu_category_name', 'asc')
                ->orderBy('menus.menu_id', 'asc')
                ->get();
        } else {
            $menu = Menu::select([
                'menus.menu_id as menu_id',
                'menus.menu_name as menu_name',
                'menus.menu_image as menu_image',
                'menus.menu_status as menu_status',
                'menu_categories.menu_category_name as menu_category_name',
                'ph.price as price',
            ])
                ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.menu_category_id')
                ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
                    $join->on('menus.menu_id', '=', 'ph.menu_id');
                })
                ->where('menus.menu_category_id', $category)
                ->orderBy('menu_category_name', 'asc')
                ->orderBy('menus.menu_id', 'asc')
                ->get();
        }
        return response()->json(['allMenu' => $menu]);
    }

    public function getFoodFromSearch()
    {
        $category = Route::current()->parameter('category');
        $search = Route::current()->parameter('search');
        if ($category == 0) {
            $menu = Menu::select([
                'menus.menu_id as menu_id',
                'menus.menu_name as menu_name',
                'menus.menu_image as menu_image',
                'menus.menu_status as menu_status',
                'menu_categories.menu_category_name as menu_category_name',
                'ph.price as price',
            ])
                ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.menu_category_id')
                ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
                    $join->on('menus.menu_id', '=', 'ph.menu_id');
                })
                ->where('menus.menu_name', 'LIKE', "%$search%")
                ->orderBy('menu_category_name', 'asc')
                ->orderBy('menus.menu_id', 'asc')
                ->get();
        } else {
            $menu = Menu::select([
                'menus.menu_id as menu_id',
                'menus.menu_name as menu_name',
                'menus.menu_image as menu_image',
                'menus.menu_status as menu_status',
                'menu_categories.menu_category_name as menu_category_name',
                'ph.price as price',
            ])
                ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.menu_category_id')
                ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
                    $join->on('menus.menu_id', '=', 'ph.menu_id');
                })
                ->where('menus.menu_name', 'LIKE', "%$search%")
                ->where('menus.menu_category_id', $category)
                ->orderBy('menu_category_name', 'asc')
                ->orderBy('menus.menu_id', 'asc')
                ->get();
        }

        return response()->json(['allMenu' => $menu]);
    }

    public function changeMenuStatus()
    {
        $menu_id = Route::current()->parameter('menu_id');
        $status = Route::current()->parameter('new_status');
        DB::table('menus')
            ->where('menu_id', $menu_id)
            ->update([
                'menu_status' => $status,
            ]);
    }
}
