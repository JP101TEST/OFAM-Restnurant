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

        .menu-size {
            height: 100px;

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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active bg-active justify-content-center pad-lr" href="#!">About</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active bg-active justify-content-center pad-lr" href="#!">Contact</a></li>
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
                        </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br>
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="mb-1 row">
                <ul class="col navbar-nav me-auto width-150">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" href="{{ route('management.admin.home')}}"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <h4 class="text-center">แก้ไขข้อมูลร้าน</h4>
                <br>
                <div class="mb-3 container">
                    <p>แก้ไข:</p>
                </div>
                <form method="post" action="{{ route('management.admin.home.edit.postData') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/store.png') }}" alt="">
                        <label for="formGroupExampleInput" class="form-label">ชื่อร้าน:</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="restaurantName" placeholder="Example input placeholder" @if (session('restaurantName.ole')) value="{{ session('restaurantName.ole') }} " @else value="{{ $restaurantName }} " @endif>
                        <!--<p id="formGroupExampleOutput"></p>-->
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/telephone-symbol-button.png') }}" alt="">
                        <label for="formGroupExampleInput2" class="form-label">เบอร์ติดต่อ:</label>
                        @if (session('errorPhone'))
                        <p class="text-center text-light bg-danger">{{ session('errorPhone') }}</p>
                        @endif
                        <input type="text" class="form-control" id="formGroupExampleInput2" name="restaurantPhone" placeholder="Another input placeholder" @if (session('restaurantPhone.ole')) value="{{ session('restaurantPhone.ole') }} " @else value="{{ $restaurantPhone }} " @endif>
                        <!--<p id="formGroupExampleOutput2"></p>-->
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/insert-picture-icon.png') }}" alt="">
                        <label for="formGroupExampleInput2" class="form-label">รูปlogo:</label>
                        @if (session('errorImage'))
                        <p class="text-center text-light bg-danger">{{ session('errorImage') }}</p>
                        @endif
                        <input type="file" class="form-control" id="formGroupExampleInput3" name="restaurantImage" accept="image/*" placeholder="Another input placeholder">
                        <!--<p id="formGroupExampleOutput3"></p>-->
                    </div>
                    {{ session()->forget(['errorPhone', 'errorImage', 'restaurantName.ole', 'restaurantPhone.ole']) }}
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col navbar-nav me-auto width-150">
                            <button type="submit" class="nav-link custom-nav-link justify-content-center" onclick="return confirm('คุณแน่ใจว่าต้องการแก้ไขข้อมูล?');">
                                <img class="icon-size spade-bar" src="{{ asset('images/save.png') }}" alt="">
                                แก้ไข
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
