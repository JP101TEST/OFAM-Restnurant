<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{

    public function goPaymentPage($table_id)
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } else {
            return view('management/management_oder_food_payment', compact('table_id'));
        }
    }

    public function orderPayment()
    {
        $employees_id = request('employees_id');
        $customer_name = request('customer_name');
        $promotion_id = request('promotion_id');
        $discount = request('discount');
        $total_price = request('total_price');
        $oder_list = request('oder_list');
        $tableId = request('table_id');

        $idBill = DB::table('bill_lists')->orderBy('bill_id', 'desc')->first();
        $restaurant = DB::table('restaurant_infos')->orderBy('restaurant_id', 'desc')->first();

        if ($idBill) {
            $idBill  = $idBill->bill_id + 1;
        } else {
            $idBill  = 1;
        }

        if ($promotion_id == 0) {
            $promotion_id = NULL;
        }

        DB::table('bill_lists')->insert([
            'bill_id' => $idBill,
            'employees_id' => $employees_id,
            'food_order_id' => json_encode($oder_list),
            'promotion_id' => $promotion_id,
            'discount_thad_day' => $discount,
            'total_price' => $total_price,
            'customer_name' => $customer_name,
            'restaurant_id' => $restaurant->restaurant_id,
            'created_at' => Carbon::parse(now())->tz('Asia/Bangkok'),
        ]);

        DB::table('food_orders')
            ->whereIn('food_order_id', $oder_list)
            ->update([
                'food_order_status' => 5,
            ]);

        DB::table('tables')
            ->where('table_id', $tableId)
            ->update([
                'tables_password' => PaymentController::generateRandomNumber(),
                'tables_status' => 2,
            ]);
    }

    public function generateRandomNumber()
    {
        $randomNumber = rand(100000, 999999);

        return $randomNumber;
    }
}
