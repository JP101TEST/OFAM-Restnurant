<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MenuOrderController extends Controller
{
    //

    /*
    SELECT
    fo.food_order_id as oder_id,m.menu_name as menu_name,m.menu_image as menu_image,fo.food_amount as food_amount,fo.food_order_status as food_order_status
    FROM
        `food_orders` AS fo
        LEFT JOIN
        `tables` AS t
        ON fo.table_id = t.table_id
        LEFT JOIN
        `menus` AS m
        ON fo.menu_id = m.menu_id
    WHERE
        fo.food_order_status BETWEEN 1 AND 4
    ORDER BY CASE
    WHEN fo.food_order_status = 'รอชำระเงิน' THEN 1
    WHEN fo.food_order_status = 'สั่ง' THEN 2
    WHEN fo.food_order_status = 'กำลังปรุง' THEN 3
    WHEN fo.food_order_status = 'เสริฟแล้ว' THEN 4
    ELSE 5 END
    */
    public function getAllMenu()
    {
        $table_id = Route::current()->parameter('table_id');
        $show = Route::current()->parameter('show');

        $allMenu = DB::table('food_orders as fo')
            ->select([
                'fo.food_order_id as food_order_id',
                'm.menu_name as menu_name',
                'm.menu_image as menu_image',
                'fo.food_amount as food_amount',
                'fo.food_order_status as food_order_status'
            ])
            ->leftJoin('tables as t', function ($join) {
                $join->on('fo.table_id', '=', 't.table_id');
            })
            ->leftJoin('menus as m', function ($join) {
                $join->on('fo.menu_id', '=', 'm.menu_id');
            })
            ->where('fo.table_id', $table_id)
            ->whereBetween('fo.food_order_status', [1, 4])
            ->orderBy(DB::raw("CASE
        WHEN fo.food_order_status = 'รอชำระเงิน' THEN 1
        WHEN fo.food_order_status = 'สั่ง' THEN 2
        WHEN fo.food_order_status = 'กำลังปรุง' THEN 3
        WHEN fo.food_order_status = 'เสริฟแล้ว' THEN 4
        ELSE 5
    END"))
            ->get();
        $statusCounts = $allMenu->groupBy('food_order_status')->map->count();
        if ($show == 1) {
            $allMenu = DB::table('food_orders as fo')
                ->select([
                    'fo.food_order_id as food_order_id',
                    'm.menu_name as menu_name',
                    'm.menu_image as menu_image',
                    'fo.food_amount as food_amount',
                    'fo.food_order_status as food_order_status'
                ])
                ->leftJoin('tables as t', function ($join) {
                    $join->on('fo.table_id', '=', 't.table_id');
                })
                ->leftJoin('menus as m', function ($join) {
                    $join->on('fo.menu_id', '=', 'm.menu_id');
                })
                ->where('fo.table_id', $table_id)
                ->where('fo.food_order_status', 'สั่ง')
                ->get();
        } elseif ($show == 2) {
            $allMenu = DB::table('food_orders as fo')
                ->select([
                    'fo.food_order_id as food_order_id',
                    'm.menu_name as menu_name',
                    'm.menu_image as menu_image',
                    'fo.food_amount as food_amount',
                    'fo.food_order_status as food_order_status'
                ])
                ->leftJoin('tables as t', function ($join) {
                    $join->on('fo.table_id', '=', 't.table_id');
                })
                ->leftJoin('menus as m', function ($join) {
                    $join->on('fo.menu_id', '=', 'm.menu_id');
                })
                ->where('fo.table_id', $table_id)
                ->where('fo.food_order_status', 'กำลังปรุง')
                ->get();
        } elseif ($show == 3) {
            $allMenu = DB::table('food_orders as fo')
                ->select([
                    'fo.food_order_id as food_order_id',
                    'm.menu_name as menu_name',
                    'm.menu_image as menu_image',
                    'fo.food_amount as food_amount',
                    'fo.food_order_status as food_order_status'
                ])
                ->leftJoin('tables as t', function ($join) {
                    $join->on('fo.table_id', '=', 't.table_id');
                })
                ->leftJoin('menus as m', function ($join) {
                    $join->on('fo.menu_id', '=', 'm.menu_id');
                })
                ->where('fo.table_id', $table_id)
                ->where('fo.food_order_status', 'เสริฟแล้ว')
                ->get();
        }



        return response()->json([
            'allMenus' => $allMenu,
            'statusCounts' => [
                'status1' => $statusCounts->get('สั่ง', 0),
                'status2' => $statusCounts->get('กำลังปรุง', 0),
            ],
        ]);
    }

    public function deleteFoodOrder()
    {
        $order_id = Route::current()->parameter('order_id');
        DB::table('food_orders')
            ->where('food_order_id', $order_id)
            ->delete();
    }

    public function changeStatusFoodOrder()
    {
        $order_id = Route::current()->parameter('order_id');
        $order_status = Route::current()->parameter('status');
        DB::table('food_orders')
            ->where('food_order_id', $order_id)
            ->update(['food_order_status' => $order_status]);
    }
}
