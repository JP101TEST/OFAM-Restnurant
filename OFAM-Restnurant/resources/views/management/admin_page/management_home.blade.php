<?php

use App\Models\restaurantInfo;

$restaurantName = restaurantInfo::value('restaurant_name');
$restaurantPhone = restaurantInfo::value('restaurant_phone');
$restaurantlogo = restaurantInfo::value('restaurant_logo');
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <img class="icon-size spade-bar" src="{{ asset('images/store.png') }}">
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
                                        <img src="{{ asset('images/logout_FILL0_wght400_GRAD0_opsz24.png') }}" alt="Logout">
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent_sub" aria-controls="navbarSupportedContent_sub" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent_sub">
                <ul class="container navbar-nav me-auto">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active  justify-content-center"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">ข้อมูลร้าน</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.table')}}"><img class="icon-size spade-bar" src="{{ asset('images/dinner-table.png') }}" alt="">ข้อมูลโต๊ะ</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.food')}}"><img class="icon-size spade-bar" src="{{ asset('images/food-tray.png') }}" alt="">ข้อมูลอาหาร</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <h4 class="text-center">จัดข้อมูลร้าน</h4>
                <div class="col-lg-12 d-flex justify-content-center align-items-center">
                    <div class="mb-6 row">
                        <div class="col-sm-7">
                            <img class="width-150" src="{{ asset('images/save/' . $restaurantlogo) }}" alt="">
                        </div>
                    </div>
                </div>
                <br>
                <div class="mb-3">
                    <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/store.png') }}" alt="">
                    <label for="formGroupExampleInput" class="form-label">ชื่อร้าน:</label>
                    <input type="text" disabled class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" value="{{ $restaurantName }}">
                </div>
                <div class="mb-3">
                    <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/telephone-symbol-button.png') }}" alt="">
                    <label for="formGroupExampleInput2" class="form-label">เบอร์ติดต่อ:</label>
                    <input type="text" disabled class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder" value="{{ $restaurantPhone }}">
                </div>
                <br><br><br>
                <div class="col-lg-12 d-flex justify-content-between">
                    <div class="mb-1 row">
                        <ul class="col navbar-nav me-auto width-150">
                            <li class="nav-item text-center"><a class="nav-link custom-nav-link-yellow justify-content-center" href="{{ route('management.admin.home.edit')}}"><img class="icon-size spade-bar" src="{{ asset('images/pencil.png') }}" alt="">แก้ไข</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
