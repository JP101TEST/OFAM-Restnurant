<?php

use App\Models\restaurantInfo;

$restaurantName = restaurantInfo::value('restaurant_name');
$restaurantPhone = restaurantInfo::value('restaurant_phone');
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

        .custom-nav-link:hover {
            background-color: #0dcaf0;
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

        .icon-size {
            height: 25px;
            filter: brightness(0) invert(1);
        }

        .icon-size-no-brightness {
            height: 25px;
            margin-right: 10px;
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

        .yellow-bg {
            background-color: #c0b17f;
        }

        .yellow-bg-active {
            background-color: #e9bc26;
        }

        .yellow-bg:hover {
            background-color: #e9bc26;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <img class="icon-size spade-bar" src="{{ asset('images/store.png') }}" alt="">
            <a class="navbar-brand">ชื่อร้าน</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent_test" aria-controls="navbarSupportedContent_test" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent_test">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="{{ route('management.getRequest')}}">รายการโต๊ะ</a></li>
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="#!">Contact</a></li>
                    @if(session('User')[0]->management_lavel == 'admin')
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center active" aria-current="page" href="{{ route('management.admin.home')}}">จัดการร้าน</a></li>
                    @endif
                    <li>
                        <div class="vl"></div>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <div class="d-flex">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <p class="nav-link active">{{ session('User')[0]->employees_id }} {{ session('User')[0]->employees_password }}</p>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('management.logout') }}" method="post">
                                    @csrf <!-- Add CSRF token for Laravel form -->
                                    <button type="submit" class="btn nav-link">
                                        <img src="{{ asset('images/logout_FILL0_wght400_GRAD0_opsz24.png') }}" alt="">
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <br>
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="mb-1 row">
                <ul class="col navbar-nav me-auto width-150">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" href="{{ route('management.admin.table')}}"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <br>
                <h4 class="text-center">เพิ่มโต๊ะ</h4>
                <div class="mb-3 container">
                    <p>เพิ่ม:</p>
                </div>
                <form method="post" action="{{ route('management.admin.table.add.postData') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/dinner-table.png') }}" alt="">
                        <label for="formGroupExampleInput" class="form-label">ชื่อโต๊ะ:</label>
                        @if (session('errorTableName'))
                        <p class="text-center text-light bg-danger">{{ session('errorTableName') }}</p>
                        @endif
                        <input type="text" class="form-control" id="formGroupExampleInput" name="tableName" placeholder="กรอกชื่อโต๊ะแนะนำให้ใช้ t-01,t-02,...,t-0n" @if (session('tableName.ole')) value="{{ session('tableName.ole') }} " @endif>
                        <!--<p id="formGroupExampleOutput"></p>-->
                    </div>
                    {{ session()->forget(['errorTableName','tableName.ole']) }}
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col navbar-nav me-auto width-150">
                            <button type="submit" class="nav-link custom-nav-link justify-content-center" onclick="return confirm('คุณแน่ใจว่าต้องการแก้ไขข้อมูล?');">
                                <img class="icon-size spade-bar" src="{{ asset('images/new-page.png') }}" alt="">
                                เพิ่ม
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    /*function inputAndOutput(inputId, outputId) {
        const selectedValue = $('#' + inputId).val();
        $('#' + outputId).text(selectedValue);
        return selectedValue; // Return the selected value
    }

    setInterval(function() {
        const selectedValue1 = inputAndOutput('formGroupExampleInput', 'formGroupExampleOutput');
        const selectedValue2 = inputAndOutput('formGroupExampleInput2', 'formGroupExampleOutput2');
        const selectedValue3 = inputAndOutput('formGroupExampleInput3', 'formGroupExampleOutput3');
    }, 3000) // 10 seconds*/
</script>

</html>
