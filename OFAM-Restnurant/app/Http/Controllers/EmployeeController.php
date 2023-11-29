<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function getAllEmployees()
    {
        $employees = employee::all();
        return response()->json(['allEmployees' => $employees]);
    }

    public function getEmployeesFromSearch()
    {
        $category = Route::current()->parameter('category');
        $search = Route::current()->parameter('search');
        if ($category == 0) {
            $employees = employee::where('employees_id', 'LIKE', "%$search%")
                ->orderBy('employees_id', 'asc')
                ->get();
        } else if ($category == 1) {
            $employees = employee::where('first_name', 'LIKE', "%$search%")
                ->orderBy('employees_id', 'asc')
                ->get();
        } else {
            $employees = employee::where('last_name', 'LIKE', "%$search%")
                ->orderBy('employees_id', 'asc')
                ->get();
        }

        return response()->json(['allEmployees' => $employees]);
    }

    public function addEmployee(Request $request)
    {
        $employeeId = $request->input('employeeId');
        $employeePassword = $request->input('employeePassword');
        $employeeFname = $request->input('employeeFname');
        $employeeLname = $request->input('employeeLname');
        $employeeHouseNumber = $request->input('employeeHouseNumber');
        $employeeRoad = $request->input('employeeRoad');
        $employeeSubDistrict = $request->input('employeeSubDistrict');
        $employeeDistrict = $request->input('employeeDistrict');
        $employeeProvince = $request->input('employeeProvince');
        $employeePostalCode = $request->input('employeePostalCode');
        $employeePhone = $request->input('employeePhone');
        $errorImage = null;

        $employeeId_duplicate = employee::where('employees_id', $employeeId)
            ->count();
        $employeePassword_duplicate = employee::where('employees_password', $employeePassword)
            ->count();
        $employeeName_duplicate = employee::where('first_name', $employeeFname)
            ->where('last_name', $employeeLname)
            ->count();
        // ตรวจสอบรูป
        if ($request->hasFile('employeeImage')) {
            $employeeImage = $request->file('employeeImage');
            $originalFileName = $employeeImage->getClientOriginalName();
            $fileExtension = $employeeImage->getClientOriginalExtension();

            $allowedExtensions = ['jpg', 'png', 'webp', 'gif', 'bmp', 'svg', 'jpeg', 'ico', 'tiff'];

            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                $destinationPath = public_path('images/employees');

                if (File::exists($destinationPath . '/' . $originalFileName)) {
                    //print("รูป  \"$originalFileName\" นี้มีอยู่แล้ว<br>");
                    //$errorImage ='มีรูปซ้ำ';
                } else {
                    $employeeImage->move($destinationPath, $originalFileName);
                    //print("รูป  \"$originalFileName\" อัปโหลดสำเร็จ<br>");
                }
            } else {
                $changeImageStatus = false;
                $errorImage = 'ไม่รองรับสกุลไฟล์นี้ (รองรับเฉพาะ jpg, png, webp, gif, bmp, svg, jpeg, ico, tiff)';
                session(['errorImage' => $errorImage]);
            }
        } else {
            //print("ไม่มีรูป  ในคำขอ<br>");
            $changeImageStatus = false;
            //$errorImage = 'ไม่มีรูป';
        }

        if ($employeeId_duplicate > 0) {
            $errorEmployeeId = "รหัสพนักงานนี้มีการใช้งานแล้ว";
            session(['errorEmployeeId' => $errorEmployeeId]);
        }

        if ($employeePassword_duplicate > 0) {
            $errorEmployeePassword = "รหัสผ่านนี้มีการใช้งานแล้ว";
            session(['errorEmployeePassword' => $errorEmployeePassword]);
        }

        if ($employeeName_duplicate > 0) {
            $errorEmployeeName = "ชื่อและนามสกุลนี้มีการใช้งานแล้ว";
            session(['errorEmployeeName' => $errorEmployeeName]);
        }
        if ($employeeId_duplicate > 0 || $employeePassword_duplicate > 0 || $employeeName_duplicate > 0 || $errorImage != null) {
            $errorEmployee = [$employeeId, $employeePassword, $employeeFname, $employeeLname, $employeeHouseNumber, $employeeRoad, $employeeSubDistrict, $employeeDistrict, $employeeProvince, $employeePostalCode, $employeePhone];
            session(['errorEmployee' => $errorEmployee]);
            return redirect()->route('management.admin.employee.add.postData');
        }

        DB::table('employees')->insert([
            'employees_id' => $employeeId,
            'employees_password' => $employeePassword,
            'first_name' => $employeeFname,
            'last_name' => $employeeLname,
            'house_number' => $employeeHouseNumber,
            'road' => $employeeRoad,
            'sub_district' => $employeeSubDistrict,
            'district' => $employeeDistrict,
            'province' => $employeeProvince,
            'postal_code' => $employeePostalCode,
            'employees_picture' => $originalFileName,
            'employees_phone' => $employeePhone,
            'management_lavel' => 1
        ]);
        /*
        print("employeeId:" . $employeeId . "<br>");
        print("employeePassword:" . $employeePassword . "<br>");
        print("employeeFname:" . $employeeFname . "<br>");
        print("employeeLname:" . $employeeLname . "<br>");
        print("employeeImage:" . $employeeImage . "<br>");
        print("employeeHouseNumber:" . $employeeHouseNumber . "<br>");
        print("employeeRoad:" . $employeeRoad . "<br>");
        print("employeeSubDistrict:" . $employeeSubDistrict . "<br>");
        print("employeeDistrict:" . $employeeDistrict . "<br>");
        print("employeeProvinced:" . $employeeProvince . "<br>");
        print("employeePostalCode:" . $employeePostalCode . "<br>");
        print("employeePhone:" . $employeePhone . "<br><br>");
        print("employeeId_duplicate:" . $employeeId_duplicate . "<br>");
        print("employeePassword_duplicate:" . $employeePassword_duplicate . "<br>");
        print("employeeName_duplicate:" . $employeeName_duplicate . "<br>");
        */
        return redirect()->route('management.admin.employee');
    }

    public function editEmployee(Request $request)
    {
        $employeeId = Route::current()->parameter('employee_id');
        $employeeDatabase = DB::table('employees')
            ->where('employees_id', $employeeId)
            ->get();
        $employeePassword = $request->input('employeePassword');
        $employeeFname = $request->input('employeeFname');
        $employeeLname = $request->input('employeeLname');
        $employeeHouseNumber = $request->input('employeeHouseNumber');
        $employeeRoad = $request->input('employeeRoad');
        $employeeSubDistrict = $request->input('employeeSubDistrict');
        $employeeDistrict = $request->input('employeeDistrict');
        $employeeProvince = $request->input('employeeProvince');
        $employeePostalCode = $request->input('employeePostalCode');
        $employeePhone = $request->input('employeePhone');
        $errorImage = null;
        $changeImageStatus = true;

        $employeePassword_duplicate_same_id = employee::where('employees_password', $employeePassword)
            ->where('employees_id', '!=', $employeeId)
            ->count();
        $employeeName_duplicate_same_id = employee::where('first_name', $employeeFname)
            ->where('last_name', $employeeLname)
            ->where('employees_id', '!=', $employeeId)
            ->count();

        // ตรวจสอบรูป
        if ($request->hasFile('employeeImage')) {
            $employeeImage = $request->file('employeeImage');
            $originalFileName = $employeeImage->getClientOriginalName();
            $fileExtension = $employeeImage->getClientOriginalExtension();

            $allowedExtensions = ['jpg', 'png', 'webp', 'gif', 'bmp', 'svg', 'jpeg', 'ico', 'tiff'];

            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                $destinationPath = public_path('images/employees');

                if (File::exists($destinationPath . '/' . $originalFileName)) {
                    //print("รูป  \"$originalFileName\" นี้มีอยู่แล้ว<br>");
                    //$errorImage ='มีรูปซ้ำ';
                } else {
                    $employeeImage->move($destinationPath, $originalFileName);
                    //print("รูป  \"$originalFileName\" อัปโหลดสำเร็จ<br>");
                }
            } else {
                $changeImageStatus = false;
                $errorImage = 'ไม่รองรับสกุลไฟล์นี้ (รองรับเฉพาะ jpg, png, webp, gif, bmp, svg, jpeg, ico, tiff)';
                session(['errorImage' => $errorImage]);
            }
        } else {
            //print("ไม่มีรูป  ในคำขอ<br>");
            $changeImageStatus = false;
            //$errorImage = 'ไม่มีรูป';
        }

        /*if ($employeeId_duplicate > 0) {
            $errorEmployeeId = "รหัสพนักงานนี้มีการใช้งานแล้ว";
            session(['errorEmployeeId' => $errorEmployeeId]);
        }*/



        if ($employeePassword_duplicate_same_id > 0) {
            $errorEmployeePassword = "รหัสผ่านนี้มีการใช้งานแล้ว";
            session(['errorEmployeePassword' => $errorEmployeePassword]);
        }

        if ($employeeName_duplicate_same_id > 0) {
            $errorEmployeeName = "ชื่อและนามสกุลนี้มีการใช้งานแล้ว";
            session(['errorEmployeeName' => $errorEmployeeName]);
        }
        if ($errorImage != null || $employeePassword_duplicate_same_id > 0 || $employeeName_duplicate_same_id > 0) {
            $errorEmployee = [$employeeId, $employeePassword, $employeeFname, $employeeLname, $employeeHouseNumber, $employeeRoad, $employeeSubDistrict, $employeeDistrict, $employeeProvince, $employeePostalCode, $employeePhone];
            session(['errorEmployee' => $errorEmployee]);
            return redirect()->route('management.admin.employee.edit.postData', ['employee_id' => $employeeId]);
        }

        /*DB::table('employees')->insert([
            'employees_id' => $employeeId,
            'employees_password' => $employeePassword,
            'first_name' => $employeeFname,
            'last_name' => $employeeLname,
            'house_number' => $employeeHouseNumber,
            'road' => $employeeRoad,
            'sub_district' => $employeeSubDistrict,
            'district' => $employeeDistrict,
            'province' => $employeeProvince,
            'postal_code' => $employeePostalCode,
            'employees_picture' => $originalFileName,
            'employees_phone' => $employeePhone,
            'management_lavel' => 1
        ]);*/

        /*print("employeeId:" . $employeeId . "<br>");
        print("employeePassword:" . $employeePassword . "<br>");
        print("employeeFname:" . $employeeFname . "<br>");
        print("employeeLname:" . $employeeLname . "<br>");
        print("employeeHouseNumber:" . $employeeHouseNumber . "<br>");
        print("employeeRoad:" . $employeeRoad . "<br>");
        print("employeeSubDistrict:" . $employeeSubDistrict . "<br>");
        print("employeeDistrict:" . $employeeDistrict . "<br>");
        print("employeeProvinced:" . $employeeProvince . "<br>");
        print("employeePostalCode:" . $employeePostalCode . "<br>");
        print("employeePhone:" . $employeePhone . "<br><br>");*/

        if ($employeePassword != null && $employeePassword != $employeeDatabase[0]->employees_password) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'employees_password' => $employeePassword,
                ]);
        }
        if ($employeeFname != null && $employeeFname != $employeeDatabase[0]->first_name) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'first_name' => $employeeFname,
                ]);
        }
        if ($employeeLname != null && $employeeLname != $employeeDatabase[0]->last_name) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'last_name' => $employeeLname,
                ]);
        }
        if ($employeeHouseNumber != null && $employeeHouseNumber != $employeeDatabase[0]->house_number) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'house_number' => $employeeHouseNumber,
                ]);
        }
        if ($employeeRoad != null && $employeeRoad != $employeeDatabase[0]->road) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'road' => $employeeRoad,
                ]);
        }
        if ($employeeSubDistrict != null && $employeeSubDistrict != $employeeDatabase[0]->sub_district) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'sub_district' => $employeeSubDistrict,
                ]);
        }
        if ($employeeDistrict != null && $employeeDistrict != $employeeDatabase[0]->district) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'district' => $employeeDistrict,
                ]);
        }
        if ($employeeProvince != null && $employeeProvince != $employeeDatabase[0]->province) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'province' => $employeeProvince,
                ]);
        }
        if ($employeePostalCode != null && $employeePostalCode != $employeeDatabase[0]->postal_code) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'postal_code' => $employeePostalCode,
                ]);
        }
        if ($employeePhone != null && $employeePhone != $employeeDatabase[0]->employees_phone) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'employees_phone' => $employeePhone,
                ]);
        }
        if ($changeImageStatus == true) {
            DB::table('employees')
                ->where('employees_id', $employeeId)
                ->update([
                    'employees_picture' => $originalFileName,
                ]);
        }

        return redirect()->route('management.admin.employee');
    }
}
