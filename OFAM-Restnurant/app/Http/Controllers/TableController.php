<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class TableController extends Controller
{
    //
    public function updateStatus()
    {
        $table_id = Route::current()->parameter('table_id');
        $table_status = Route::current()->parameter('table_status');
        DB::table('tables')
            ->where('table_id', $table_id)
            ->update(['tables_status' => $table_status]);
    }

    public function getAllTables()
    {
        $typeValue = request('typeValue');
        $valueOfType = request('valueOfType');

        $allTables = DB::table('tables as t')
            ->select('t.*', 'f1.table_id as t_id', 'f1.food_order_status as table_order_status')
            ->leftJoin(DB::raw('(SELECT
        table_id,
        MIN(
            CASE food_order_status WHEN "สั่ง" THEN 1 WHEN "กำลังปรุง" THEN 2 WHEN "เสริฟแล้ว" THEN 3 WHEN "รอชำระเงิน" THEN 4 WHEN "ชำระเงินเรียบร้อย" THEN 5
        END
    ) AS food_order_status
    FROM
        food_orders
    WHERE
        food_order_status BETWEEN 1 AND 4
    GROUP BY
        table_id) AS f1'), 't.table_id', '=', 'f1.table_id')
            ->where('t.tables_status', '!=', 'ยกเลิกการใช้งาน')
            ->orderBy(DB::raw("CASE
        WHEN f1.food_order_status = 4 THEN 1
        WHEN f1.food_order_status = 1 THEN 2
        WHEN f1.food_order_status = 2 THEN 3
        WHEN f1.food_order_status = 3 THEN 4
        ELSE 5
    END"))
            ->orderBy('table_id', 'asc');

        if ($typeValue == 'status') {
            $allTables = $allTables->where('t.tables_status', $valueOfType)->get();
        } else {
            $allTables = $allTables->get();
        }
        /*
    SELECT
    t.*,
    f1.table_id,
    f1.food_order_status
FROM TABLES AS t
LEFT JOIN (
    SELECT
        table_id,
        MIN(
        CASE food_order_status WHEN 'สั่ง' THEN 1 WHEN 'กำลังปรุง' THEN 2 WHEN 'เสริฟแล้ว' THEN 3 WHEN 'รอชำระเงิน' THEN 4 WHEN 'ชำระเงินเรียบร้อย' THEN 5
    END
) AS food_order_status
    FROM
        food_orders
    WHERE
        food_order_status BETWEEN 1 AND 4
    GROUP BY
        table_id
    ORDER BY
        CASE
            WHEN MIN(food_order_status) = 'รอชำระเงิน' THEN 1
            WHEN MIN(food_order_status) = 'สั่ง' THEN 2
            WHEN MIN(food_order_status) = 'กำลังปรุง' THEN 3
            WHEN MIN(food_order_status) = 'เสริฟแล้ว' THEN 4
            ELSE 5
        END
) AS f1 ON t.table_id = f1.table_id
WHERE
    t.tables_status != 'ยกเลิกการใช้งาน'
ORDER BY CASE WHEN
    f1.food_order_status = 1 THEN 1 WHEN f1.food_order_status = 2 THEN 2 WHEN f1.food_order_status = 3 THEN 3 WHEN f1.food_order_status = 4 THEN 4 ELSE 5 -- For any other values (if any)
END;
    */

        return response()->json(['allTables' => $allTables, 'one' => $typeValue, 'two' => $valueOfType]);
    }

    public function getTablesFromSearch()
    {
        $category = Route::current()->parameter('category');
        $search = Route::current()->parameter('search');
        /*if ($category == 'name') {
            $tables = DB::table('tables as t')
                ->select([
                    't.table_id as table_id',
                    't.table_name as table_name',
                    't.tables_password as tables_password',
                    't.tables_status as tables_status',
                    'f1.food_order_status as table_order_status',
                ])
                ->leftJoin('food_orders as f1', function ($join) {
                    $join->on('t.table_id', '=', 'f1.table_id')
                        ->whereBetween('f1.food_order_status', [1, 4])
                        ->where('f1.food_order_status', function ($query) {
                            $query->from('food_orders as f2')
                                ->whereColumn('t.table_id', 'f2.table_id')
                                ->whereBetween('f2.food_order_status', [1, 4])
                                ->select(DB::raw('MIN(f2.food_order_status)'));
                        });
                })
                ->where('t.table_name', 'LIKE', "%$search%")
                ->where('t.tables_status', '!=', 'ยกเลิกการใช้งาน')
                ->orderBy(DB::raw("CASE
            WHEN f1.food_order_status = 'รอชำระเงิน' THEN 1
            WHEN f1.food_order_status = 'สั่ง' THEN 2
            WHEN f1.food_order_status = 'กำลังปรุง' THEN 3
            WHEN f1.food_order_status = 'เสริฟแล้ว' THEN 4
            ELSE 5
        END"))
                ->orderBy('t.table_name', 'asc')
                ->get();
        } else {
            $tables = DB::table('tables as t')
                ->select([
                    't.table_id as table_id',
                    't.table_name as table_name',
                    't.tables_password as tables_password',
                    't.tables_status as tables_status',
                    'f1.food_order_status as table_order_status',
                ])
                ->leftJoin('food_orders as f1', function ($join) {
                    $join->on('t.table_id', '=', 'f1.table_id')
                        ->whereBetween('f1.food_order_status', [1, 4])
                        ->where('f1.food_order_status', function ($query) {
                            $query->from('food_orders as f2')
                                ->whereColumn('t.table_id', 'f2.table_id')
                                ->whereBetween('f2.food_order_status', [1, 4])
                                ->select(DB::raw('MIN(f2.food_order_status)'));
                        });
                })
                ->where('t.tables_status', 'LIKE', "$search%")
                ->where('t.tables_status', '!=', 'ยกเลิกการใช้งาน')
                ->orderBy(DB::raw("CASE
            WHEN f1.food_order_status = 'รอชำระเงิน' THEN 1
            WHEN f1.food_order_status = 'สั่ง' THEN 2
            WHEN f1.food_order_status = 'กำลังปรุง' THEN 3
            WHEN f1.food_order_status = 'เสริฟแล้ว' THEN 4
            ELSE 5
        END"))
                ->orderBy('t.tables_status', 'asc')
                ->get();
        }*/

        $tables = DB::table('tables as t')
            ->select('t.*', 'f1.table_id as t_id', 'f1.food_order_status as table_order_status')
            ->leftJoin(DB::raw('(SELECT
        table_id,
        MIN(
            CASE food_order_status WHEN "สั่ง" THEN 1 WHEN "กำลังปรุง" THEN 2 WHEN "เสริฟแล้ว" THEN 3 WHEN "รอชำระเงิน" THEN 4 WHEN "ชำระเงินเรียบร้อย" THEN 5
        END
    ) AS food_order_status
    FROM
        food_orders
    WHERE
        food_order_status BETWEEN 1 AND 4
    GROUP BY
        table_id) AS f1'), 't.table_id', '=', 'f1.table_id')
            ->where('t.tables_status', '!=', 'ยกเลิกการใช้งาน')
            ->orderBy(DB::raw("CASE
        WHEN f1.food_order_status = 4 THEN 1
        WHEN f1.food_order_status = 1 THEN 2
        WHEN f1.food_order_status = 2 THEN 3
        WHEN f1.food_order_status = 3 THEN 4
        ELSE 5
    END"));

        if ($category == 'name') {
            $tables->where('t.table_name', 'LIKE', "%$search%");
        } else {
            $tables->where('t.tables_status', 'LIKE', "$search%");
        }
        $tables = $tables->get();
        return response()->json(['allTables' => $tables]);
    }

    public function goOrderPage()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } else {
            return view('management.management_oder_food_management');
        }
    }
}
