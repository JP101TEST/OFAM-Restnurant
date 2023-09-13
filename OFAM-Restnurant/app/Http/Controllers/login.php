<?php

namespace App\Http\Controllers;

use App\Models\Employee; //เพิ่มมาทีหลัง
use Illuminate\Http\Request;

class login extends Controller
{

    /*
    public function index()
    {

        $employees = Employee::all(); // Retrieve all employees from the database

        return view('management.management_oder_food_list', ['employees' => $employees]);
        //return view('management.management_oder_food_list');

    }
*/

    public function postRequest(Request $request)
    {
        $user = $request->input('user');
        $password = $request->input('password');
        $errorUser = null;
        $errorPassword = null;

        /*
        $filteredEmployees = Employee::where('employees_id', $user)
        ->where('employees_password', $password)
        ->get();


        if (Employee::where('employees_id', $user)->isEmpty()) {
            return redirect()->route('login')->with('error.user', 'ชื่อผู้ใช้ไม่ถูกต้อง');
        }
*/

        session(['user.ole' => $user, 'password.ole' => $password]);

        if (Employee::where('employees_id', $user)->get()->isEmpty()) {
            $errorUser = 'ชื่อผู้ใช้ไม่ถูกต้อง';
            session(['errorUser' => $errorUser]);
        }

        if (Employee::where('employees_id', $user)
            ->where('employees_password', $password)
            ->get()
            ->isEmpty()
        ) {
            $errorPassword = 'รหัสผ่านไม่ถูกต้อง';
            session(['errorPassword' => $errorPassword]);
        }

        if ($errorUser == null && $errorPassword == null) {
            //$employees = Employee::all();
            session(['User' => Employee::where('employees_id', $user)
                ->where('employees_password', $password)
                ->get()]);
            session(['errorUser' => $errorUser]);
            //return view('management.management_oder_food_list', ['employees' => $employees]);
            session()->forget(['errorUser', 'errorPassword', 'user.ole', 'password.ole']);
    /*
            print(session('User') . '<br>');
            $user = session('User')[0];
            $employeesId = $user['employees_id'];
            print("employees_id : " . $employeesId . '<br>');
            print("employees_id : " .session('User')[0]['employees_id'] . '<br>');
    */
            return view('management.management_oder_food_list');
        } else {
            return redirect()->route('login');
        }
    }

    public function getRequest()
    {
        if (empty(session('User'))) {
            return redirect()->route('login');
        } else {
            return view('management.management_oder_food_list');
        }
    }

    public function logOut()
    {
        session()->forget(['User']);
        return redirect()->route('login');
    }
}
