<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class TableAdminController extends Controller
{
    //
    public function addTable(Request $request)
    {
        $tableName = $request->input('tableName');
        $tableNameEmpty = TableAdminController::checkEmptyName($tableName);
        $tableNameDatabase = DB::table('tables')
            ->where('table_name', $tableName)->get();
        $tableNameDuplicate = TableAdminController::checkDuplicateName($tableNameDatabase);

        /*
        print("tableName:" . $tableName . '<br>');
        print("tableNameEmpty:" . $tableNameEmpty . '<br>');
        print("tableNameDatabase:" . $tableNameDatabase . '<br>');
        print("tableNameDuplicate:" . $tableNameDuplicate . '<br>');
*/

        if ($tableNameEmpty) {
            session(['errorTableName' => 'กรุณากรอกชื่อ']);
            return redirect()->route('management.admin.table.add');
        }
        if ($tableNameDuplicate) {
            session(['errorTableName' => 'ชื่อ ' . $tableName . ' นี้มีการใช้งานแล้ว']);
            return redirect()->route('management.admin.table.add');
        }

        // Find the maximum table_id from the 'tables' table
        $lastTable = DB::table('tables')->orderBy('table_id', 'desc')->first();
        $tableId = null;
        /*
        print('lastTable->id:' .$lastTable->table_id.'<br>');
        print('lastTable->name:' .$lastTable->table_name.'<br>');
        */
        // Check if any records exist
        if ($lastTable) {
            // If records exist, increment the table_id by 1
            $tableId = $lastTable->table_id + 1;
        } else {
            // If no records exist, set an initial value (e.g., 1)
            $tableId = 1;
        }
        /*
        print('tableId:' . $tableId.'<br>');
        */
        DB::table('tables')->insert([
            'table_id' => $tableId,
            'table_name' => $tableName,
            'tables_password' => TableAdminController::generateRandomNumber(),
            'tables_status' => 1
        ]);


        return view('management/admin_page/management_table');
    }

    public function editTable(Request $request)
    {
        $table_id = Route::current()->parameter('table_id');
        $table = DB::table('tables')
            ->where('table_id', $table_id)
            ->get();
        $tableName = $request->input('tableName');
        $tableName_duplicate_same_id = DB::table('tables')
            ->where('table_name', $tableName)
            ->where('table_id', '!=', $table_id)
            ->count();
        if ($tableName_duplicate_same_id > 0) {
            session(['errorTableName' => 'ชื่อ ' . $tableName . ' นี้มีการใช้งานแล้ว']);
            return redirect()->route('management.admin.table.edit', ['tables_id' => $table_id]);
        }
        if ($tableName != null && $tableName != $table[0]->table_name) {
            //print('Update name' . '<br>');
            DB::table('tables')
                ->where('table_id', $table_id)
                ->update([
                    'table_name' => $tableName,
                ]);
        }
        return view('management/admin_page/management_table');
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

    public function generateRandomNumber()
    {
        $randomNumber = rand(100000, 999999);

        return $randomNumber;
    }

    public function getAllTables()
    {
        $typeValue = request('typeValue');
        $valueOfType = request('valueOfType');
        $allTables = Table::orderBy('table_name', 'asc');
        if ($typeValue == 'status') {
            $allTables = $allTables->where('tables_status', $valueOfType)->get();
        } else {
            $allTables = $allTables->get();
        }
        return response()->json(['allTables' => $allTables]);
    }

    public function getTablesFromSearch()
    {
        $category = Route::current()->parameter('category');
        $search = Route::current()->parameter('search');
        if ($category == 0) {
            $tables = Table::where('table_name', 'LIKE', "%$search%")
                ->orderBy('table_name', 'asc') // Change 'asc' to 'desc' for descending order
                ->get();
        } else {
            $tables = Table::where('tables_status', 'LIKE', "$search%")
                ->orderBy('tables_status', 'asc') // Change 'asc' to 'desc' for descending order
                ->get();
        }

        return response()->json(['allTables' => $tables]);
    }
}
