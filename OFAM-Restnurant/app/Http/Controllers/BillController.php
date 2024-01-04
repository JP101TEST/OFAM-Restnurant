<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    //
    public function getAllBill()
    {
        // $day = request('day');
        // $month = request('month');
        $year = request('year');

        $monthStar = request('monthStar');
        $monthStop = request('monthStop');
        $dayStar = request('dayStar');
        $dayStop = request('dayStop');

        // $bill = DB::table('bill_lists')->get();

        // $bill = DB::table('bill_lists')
        // ->whereDay('created_at', $day)
        // ->get();

        $bill = DB::table('bill_lists as bl')
            ->select([
                'bl.*',
                'p.*'
            ])
            ->leftJoin('promotions as p', function ($join) {
                $join->on('bl.promotion_id', '=', 'p.promotion_id');
            })
            ->orderBy('bl.bill_id', 'DESC')
            ->whereYear('bl.created_at', $year)
            ->whereBetween(DB::raw('MONTH(bl.created_at)'), [$monthStar, $monthStop])
            ->whereBetween(DB::raw('DAY(bl.created_at)'), [$dayStar, $dayStop]);


        $bill = $bill->get();

        return response()->json(['allBill' => $bill]);
    }

    public function getAllMenuBill()
    {
        $order = request('order');
        $billId = request('billId');
        $billDate = DB::table('bill_lists')
            ->where('bill_id', $billId)
            ->value('created_at');

        $orderNew = [];
        $orderOut = [];
        for ($i = 0; $i < sizeof($order); $i++) {

            $orderNew[] = DB::table('food_orders as fo')
                ->select([
                    'fo.food_order_id as food_order_id',
                    't.table_name as table_name',
                    'm.menu_name as menu_name',
                    'm.menu_image as menu_image',
                    'fo.food_amount as food_amount',
                    'fo.food_order_status as food_order_status',
                    'ph.price as price'
                ])
                ->leftJoin('tables as t', function ($join) {
                    $join->on('fo.table_id', '=', 't.table_id');
                })
                ->leftJoin('menus as m', function ($join) {
                    $join->on('fo.menu_id', '=', 'm.menu_id');
                })
                // ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
                //     $join->on('m.menu_id', '=', 'ph.menu_id');
                // })

                ->join(DB::raw("(SELECT * FROM price_histories WHERE (date_end IS NULL OR date_end >= '$billDate') AND date_start <= '$billDate') AS ph"), function ($join) {
                    $join->on('m.menu_id', '=', 'ph.menu_id');
                })

                ->where('fo.food_order_id', $order[$i])
                ->get();
        }

        foreach ($orderNew as $orderNewList) {
            $found = false;
            for ($i = 0; $i < sizeof($orderOut); $i++) {
                if ($orderOut[$i][0]->menu_name == $orderNewList[0]->menu_name) {
                    $orderOut[$i][0]->food_amount = $orderOut[$i][0]->food_amount + $orderNewList[0]->food_amount;
                    $found = true;
                    break;
                }
            }
            if ($found == false) {
                $orderOut[] = $orderNewList;
            }
        }

        return response()->json(['order' => $orderOut, 'table_name' => $orderOut[0][0]->table_name, 'o' => $billDate]);
    }

    // public function change()
    // {
    //     $year = request('year');


    //     $monthSelect_W = DB::table('bill_lists')
    //         ->select(DB::raw('MONTH(created_at) as month'))
    //         ->whereYear('created_at', $year)
    //         ->groupBy(DB::raw('MONTH(created_at)'))
    //         ->get();

    //     $lastMonth = $monthSelect_W[sizeof($monthSelect_W) - 1]->month;
    //     $daySelect_W = DB::table('bill_lists')
    //         ->select(DB::raw('DAY(created_at) as day'))
    //         ->whereYear('created_at', $year)
    //         ->whereMonth('created_at', $lastMonth)
    //         ->groupBy(DB::raw('DAY(created_at)'))
    //         ->get();

    //     return response()->json(['all' => $monthSelect_W, 'allDay' => $daySelect_W]);
    // }

    /*
    SELECT
        DAY(`created_at`) AS day,
        COUNT(*) AS count
    FROM
        `bill_lists`
    GROUP BY
        DAY(`created_at`);
    */
}
