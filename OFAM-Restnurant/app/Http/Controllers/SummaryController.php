<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    public function getTotalsInYear()
    {
        $year = request('year');
        $summaryInyear = DB::table('bill_lists')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total_price_sum'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $dataIncomeMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($summaryInyear as $summary) {
            $month = $summary->month;
            $totalPriceSum = $summary->total_price_sum;

            $dataIncomeMonth[$month - 1] = $totalPriceSum;
        }
        return response()->json(['totals' => $dataIncomeMonth,]);
    }

    public function getTotalsInMonth()
    {
        $year = request('year');
        $month = request('month');
        $summaryInDay = DB::table('bill_lists')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('SUM(total_price) as total_price_sum'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();

        $dataIncomeDay = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($summaryInDay as $summary) {
            $day = $summary->day;
            $totalPriceSum = $summary->total_price_sum;

            $dataIncomeDay[$day - 1] = $totalPriceSum;
        }
        return response()->json(['totals' => $dataIncomeDay]);
    }
}
