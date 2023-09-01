<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    //
    public function updateStatus(Request $request, $table_id)
    {
        $table = Table::where('table_id', $table_id)->firstOrFail();
        print($table_id);
        print($table->table_id);
        print($table->status_tables);
        /*print($table);
        echo "<br>";
        print($table->table_id);
        echo "<br>";
        print($table->status_tables);
        echo "<br>";*/
        $newStatus = $request->input('status');
        if ($newStatus == 0) {
            return response()->json(['status_tables' => $table->status_tables]);
        }
        $table->status_tables = $newStatus;
        DB::table('tables')
            ->where('table_id', $table_id)
            ->update(['status_tables' => $newStatus]);
        /*$table = Table::where('table_id', $table_id)->firstOrFail();
        print($table);
        echo "<br>";
        print($table->table_id);
        echo "<br>";
        print($table->status_tables);*/
        //return redirect()->back();
        $table = Table::where('table_id', $table_id)->firstOrFail();
        return response()->json(['status_tables' => $table->status_tables]);
    }

    public function getStatus($table_id)
    {
        $table = Table::where('table_id', $table_id)->firstOrFail();
        return response()->json(['status_tables' => $table->status_tables]);
    }

    public function getUpdatedTables()
    {
        $updatedTables = Table::all();
        return response()->json(['allTables' => $updatedTables]);
    }

    public function getUpdatedTablesInput(Request $request, $table_inpt_id, $table_select_inpt)
    {
        /*
        // Retrieve the input value from the request
        $table = Table::where('table_id', $table_inpt_id)->first();
        // Perform any necessary processing based on the input
        // For this example, let's assume you're just returning the input
        return response()->json(['allTables' => $table]);
        */

        if ($table_select_inpt == 'id') {
            $tables = Table::where('table_id', 'LIKE', "%$table_inpt_id%")
            ->orderBy('table_id', 'asc') // Change 'asc' to 'desc' for descending order
            ->get();
        }else {
            $tables = Table::where('status_tables', 'LIKE', "%$table_inpt_id%")
            ->orderBy('status_tables', 'asc') // Change 'asc' to 'desc' for descending order
            ->get();
        }

        return response()->json(['allTables' => $tables]);
    }
}
