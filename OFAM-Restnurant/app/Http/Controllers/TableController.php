<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    //
    public function updateStatus(Request $request, $table_name)
    {
        $table = Table::where('table_name', $table_name)->firstOrFail();
        print($table_name);
        print($table->table_name);
        print($table->tables_status);
        /*print($table);
        echo "<br>";
        print($table->table_name);
        echo "<br>";
        print($table->status_tables);
        echo "<br>";
*/
        $newStatus = $request->input('status');
        if ($newStatus == 0) {
            return response()->json(['tables_status' => $table->tables_status]);
        }
        $table->status_tables = $newStatus;
        DB::table('tables')
            ->where('table_name', $table_name)
            ->update(['tables_status' => $newStatus]);
        /*$table = Table::where('table_name', $table_name)->firstOrFail();
        print($table);
        echo "<br>";
        print($table->table_name);
        echo "<br>";
        print($table->status_tables);
*/
        //return redirect()->back();
        $table = Table::where('table_name', $table_name)->firstOrFail();
        return response()->json(['tables_status' => $table->tables_status]);
    }

    public function getStatus($table_name)
    {
        $table = Table::where('table_name', $table_name)
            ->firstOrFail();
        return response()->json(['tables_status' => $table->status_tables]);
    }

    public function getUpdatedTables()
    {
        //$updatedTables = Table::all();
        $updatedTables = Table::where('tables_status', '!=', 'ยกเลิกการใช้งาน')->get();
        return response()->json(['allTables' => $updatedTables]);
    }

    public function getUpdatedTablesInput(Request $request, $table_inpt_id, $table_select_inpt)
    {
        /*
        // Retrieve the input value from the request
        $table = Table::where('table_name', $table_inpt_id)->first();
        // Perform any necessary processing based on the input
        // For this example, let's assume you're just returning the input
        return response()->json(['allTables' => $table]);
*/

        if ($table_select_inpt == 'name') {
            $tables = Table::where('table_name', 'LIKE', "%$table_inpt_id%")
                ->where('tables_status', '!=', 'ยกเลิกการใช้งาน')
                ->orderBy('table_name', 'asc') // Change 'asc' to 'desc' for descending order
                ->get();
        } else {
            $tables = Table::where('tables_status', 'LIKE', "%$table_inpt_id%")
                ->where('tables_status', '!=', 'ยกเลิกการใช้งาน')
                ->orderBy('tables_status', 'asc') // Change 'asc' to 'desc' for descending order
                ->get();
        }

        return response()->json(['allTables' => $tables]);
    }
}
