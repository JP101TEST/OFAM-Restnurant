<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class ManagementUserRoute extends Controller
{
    //
    public function goUserHomepage($table_name, $table_password)
    {
        $table = Table::where('table_name', $table_name)->firstOrFail();
        if ($table->tables_password == $table_password) {
            $fileName = $table_name . '_qrcode.png';
            // Other code...
            return view('user/user_home', compact('table_name', 'fileName'));
            //return view('user/user_home');
            //return view('management/admin_page/management_home');
        } else {
            print("error password");
        }
    }
}
