<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


$employee_id = Route::current()->parameter('employee_id');
$employee = DB::table('employees')
    ->where('employees_id', $employee_id)->get();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--<link href="{{ asset('css/test.css') }}" rel="stylesheet">-->
    <style>
        h2.intro {
            background-color: yellow;
        }

        .ddy {
            background-color: rgb(167, 167, 167);
        }

        .custom-nav-link {
            background-color: #82ddf0;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
            cursor: pointer;
            margin-top: 5px;
            margin-left: 5px;
            border-radius: 10px;
        }


        .custom-nav-link-yellow {
            background-color: #c0b17f;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
            cursor: pointer;
            margin-top: 5px;
            margin-left: 5px;
            border-radius: 10px;
        }

        .custom-nav-link-active {
            background-color: #0dcaf0;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
            cursor: pointer;
            margin-top: 5px;
            margin-left: 5px;
            border-radius: 10px;
        }

        .custom-nav-link-yellow-active {
            background-color: #e9bc26;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
            cursor: pointer;
            margin-top: 5px;
            margin-left: 5px;
            border-radius: 10px;
        }

        .custom-nav-link:hover {
            background-color: #0dcaf0;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
        }

        .custom-nav-link:disabled {
            background-color: rgb(167, 167, 167);
            color: white;
        }

        .custom-nav-link-active:hover {
            /* Change this to your desired background color */
            color: white;
        }

        .custom-nav-link-yellow:hover {
            background-color: #e9bc26;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
        }

        .custom-nav-link-h {
            background-color: #0dcaf0;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
            cursor: pointer;
            margin-top: 5px;
            margin-left: 2px;
            border-radius: 10px;
        }

        .bg-active:hover {
            background-color: #82ddf0;
        }

        .icon-size {
            height: 25px;
            filter: brightness(0) invert(1);
        }

        .icon-size-no-brightness {
            height: 25px;
            margin-right: 10px;
        }

        .icon-brightness {
            filter: brightness(0) invert(1);
        }

        .spade-bar {
            margin-left: 10px;
            margin-right: 10px;
        }

        .vl {
            background-color: #82ddf0;
            border-radius: 15;
            height: 2px;
            width: 100%;
        }

        .width-90 {
            width: 90px;
        }

        .width-100 {
            width: 100px;
        }

        .width-150 {
            width: 150px;
        }

        .high-50 {
            height: 50px;
        }

        .high-150 {
            height: 150px;
        }

        .pad {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .bg-green {
            background-color: #99c07f;
            /* Change this to your desired background color */
            color: white;
        }

        .bg-green:hover {
            background-color: #5cc118;
            /* Change this to your desired background color */
            color: white;
        }

        .bg-yellow {
            background-color: #c0b17f;
            /* Change this to your desired background color */
            color: white;
        }

        .bg-yellow:hover {
            background-color: #e9bc26;
            /* Change this to your desired background color */
            color: white;
        }

        .error-input {
            border: 1px solid red;
        }

        .menu-size-edit{
            width: 200px;
            height: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <img class="icon-size spade-bar" src="{{ asset('images/store.png') }}">
            <a class="navbar-brand">ชื่อร้าน</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent_test" aria-controls="navbarSupportedContent_test" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent_test">
                <ul class="container navbar-nav me-auto">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active bg-active justify-content-center pad-lr" href="{{ route('management.getRequest')}}">รายการโต๊ะ</a></li>
                    @if(session('User')[0]->management_lavel == 'admin')
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active bg-active text-center active" aria-current="page" href="{{ route('management.admin.home')}}">จัดการร้าน</a></li>
                    @endif
                    <li>
                        <div class="vl"></div>
                    </li>
                </ul>
                <ul class="container justify-content-end navbar-nav me-auto">
                    <li class="text-center"><a class="nav-link custom-nav-link-active justify-content-center align-content-center">ชื่อผู้ใช้{{ session('User')[0]->employees_id }} {{ session('User')[0]->employees_password }}</a></li>
                    <li class="nav-item text-center"><a>
                            <form action="{{ route('management.logout') }}" method="post">
                                @csrf <!-- Add CSRF token for Laravel form -->
                                <button type="submit" class="nav-link custom-nav-link-active bg-active justify-content-center w-100">
                                    <img class="icon-brightness" src="{{ asset('images/logout_FILL0_wght400_GRAD0_opsz24.png') }}" alt="Logout">
                                </button>
                            </form>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br>
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="mb-1 row">
                <ul class="col navbar-nav me-auto width-150">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" href="{{ route('management.admin.employee')}}"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <br>
                <h4 class="text-center">ข้อมมูลพนักงาน</h4>
                <div class="mb-3 container text-center">
                    <img class="menu-size-edit" src="{{ asset('images/employees/' . $employee[0]->employees_picture ) }}" alt=""><br>
                </div>
                <div class="mb-3 container">
                    <p>ข้อมูล:</p>
                </div>
                <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/id-card.png') }}" alt="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="formGroupExampleInput" class="form-label">รหัสประจำตัวพนักงาน:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput1" name="employeeId" value="{{ $employee[0]->employees_id}}" placeholder="กรอกรหัส" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="formGroupExampleInput" class="form-label">รหัสผ่านพนักงาน:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" name="employeePassword" value="{{ $employee[0]->employees_password}}" placeholder="กรอกรหัสผ่าน" disabled>
                    </div>
                </div>
                <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/owner.png') }}" alt="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="formGroupExampleInput" class="form-label">ชื่อ:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput3" name="employeeFname" value="{{$employee[0]->first_name}}" placeholder="กรอกชื่อ" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="formGroupExampleInput" class="form-label">นามสกุล:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput4" name="employeeLname" value="{{ $employee[0]->last_name }}" placeholder="กรอกนามสกุล" disabled>
                    </div>
                </div>
                <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/home.png') }}" alt="">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="formGroupExampleInput" class="form-label">บ้านเลขที่:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput6" name="employeeHouseNumber" value="{{ $employee[0]->house_number }}" placeholder="กรอกบ้านเลขที่" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="formGroupExampleInput" class="form-label">ถนน:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput7" name="employeeRoad" value="{{ $employee[0]->road ? $employee[0]->road : '-' }}" placeholder="กรอกหรือไม่กรอกก็ได้" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="formGroupExampleInput" class="form-label">ตำบล:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput8" name="employeeSubDistrict" value="{{ $employee[0]->sub_district }}" placeholder="กรอกตำบล" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="formGroupExampleInput" class="form-label">อำเภอ:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput9" name="employeeDistrict" value="{{ $employee[0]->district }}" placeholder="กรอกอำเภอ" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="formGroupExampleInput" class="form-label">จังหวัด:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput10" name="employeeProvince" value="{{ $employee[0]->province }}" placeholder="กรอกจังหวัด" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="formGroupExampleInput" class="form-label">รหัสไปรษณีย์:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput11" name="employeePostalCode" value="{{ $employee[0]->postal_code }}" placeholder="กรอกรหัสไปรษณีย์" maxlength="5" disabled>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="formGroupExampleInput" class="form-label">เบอร์ติดต่อ:</label>
                    <input type="text" class="form-control" id="formGroupExampleInput12" name="employeePhone" value="{{ $employee[0]->employees_phone }}" placeholder="กรอกเบอร์ติดต่อ" maxlength="10" disabled>
                </div>
                <div class="col-lg-12 d-flex justify-content-between">
                    <div class="col navbar-nav me-auto width-150">
                        <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-yellow justify-content-center" href="/management-admin/employee/edit/employeeId={{$employee[0]->employees_id}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">แก้ไข</a></li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
