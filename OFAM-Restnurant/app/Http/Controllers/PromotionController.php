<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\promotion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Psy\VersionUpdater\Checker;

class PromotionController extends Controller
{

    public function generatePromotionCode() //สร้างรหัสสุ่มสำหรับ promotion
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // You can customize the characters used in the code.
        $code = '';

        do {
            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            $promotionCodeFromData = DB::table('promotions')->where('promotion_code', $code)->get();
            if (count($promotionCodeFromData) == 0) {
                break;
            }
        } while (true);

        return $code;
    }

    public function generatePromotionId() //ตรวจสอบ id ล่าสุด
    {
        $lastPromotion = DB::table('promotions')->orderBy('promotion_id', 'desc')->first();
        $promotionId = null;
        if ($lastPromotion) {
            $promotionId = $lastPromotion->promotion_id + 1;
        } else {
            $promotionId = 1;
        }
        return $promotionId;
    }

    public function addPromotion(Request $request)
    {
        $promotionCode = PromotionController::generatePromotionCode();
        $promotionName = $request->input('promotionName');
        $promotionPercentage = $request->input('promotionPercentage');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        /*
        print('promotionCode:   ' . $promotionCode . '<br>');
        print('promotionName:   ' . $promotionName . '<br>');
        print('promotionPercentage:    ' . $promotionPercentage . '<br>');
        print('startDate:   ' . $startDate . '<br>');
        print('endDate: ' . $endDate . '<br>');
        */
        DB::table('promotions')->insert([
            'promotion_id' => PromotionController::generatePromotionId(),
            'promotion_code'  => $promotionCode,
            'promotion_name'  => $promotionName,
            'discount'  => $promotionPercentage,
            'date_start'  => $startDate,
            'date_end' => $endDate
        ]);
        return redirect()->route('management.admin.promotion');
    }

    public function editPromotion(Request $request)
    {
        $promotion_id = Route::current()->parameter('promotion_id');
        $promotion = DB::table('promotions')
            ->where('promotion_id', $promotion_id)
            ->get();
        $promotionName = $request->input('promotionName');
        $promotionPercentage = $request->input('promotionPercentage');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
/*        print($promotion. '<br>');
        print($promotion[0]->promotion_code. '<br>');
        print($promotion[0]->promotion_name. '<br>');
        print($promotion[0]->discount. '<br>');
        print($promotion[0]->date_start. '<br>');
        print($promotion[0]->date_end. '<br>');
        print('promotion_id:   ' . $promotion_id . '<br>');
        print('promotionName:   ' . $promotionName . '<br>');
        print('promotionPercentage:    ' . $promotionPercentage . '<br>');
        print('startDate:   ' . $startDate . '<br>');
        print('endDate: ' . $endDate . '<br>');
*/
        if ($promotionName != null && $promotionName != $promotion[0]->promotion_name) {
            //print('Update name' . '<br>');
            DB::table('promotions')
            ->where('promotion_id', $promotion_id)
            ->update([
                'promotion_name' => $promotionName,
            ]);
        }
        if ($promotionPercentage != null && $promotionPercentage != $promotion[0]->discount) {
            //print('Update percentage' . '<br>');
            DB::table('promotions')
            ->where('promotion_id', $promotion_id)
            ->update([
                'discount' => $promotionPercentage,
            ]);
        }
        if ($startDate != null && $startDate != $promotion[0]->date_start) {
            //print('Update start date' . '<br>');
            DB::table('promotions')
            ->where('promotion_id', $promotion_id)
            ->update([
                'date_start' => $startDate,
            ]);
        }
        if ($endDate != null && $endDate != $promotion[0]->date_end) {
            //print('Update stop date' . '<br>');
            DB::table('promotions')
            ->where('promotion_id', $promotion_id)
            ->update([
                'date_end' => $endDate,
            ]);
        }
        return redirect()->route('management.admin.promotion');
    }
}
