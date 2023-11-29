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

        .text_red {
            color: red;
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

        .error-input {
            border: 1px solid red;
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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" href="{{ route('management.admin.promotion')}}"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <br>
                <h4 class="text-center">เพิ่มรายการอาหาร</h4>
                <div class="mb-3 container">
                    <p>เพิ่ม:</p>
                </div>
                <form method="post" action="{{ route('management.admin.promotion.add.postData') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/discount.png') }}" alt="">
                        <label for="formGroupExampleInput" class="form-label">ชื่อโปรโมชั่น:</label>
                        @if (session('errorPromotionName'))
                        <p class="text-center text-light bg-danger">{{ session('errorPromotionName') }}</p>
                        @endif
                        <input type="text" class="form-control error-input" id="formGroupExampleInput" name="promotionName" placeholder="กรอกชื่อโปรโมชั่น" oninput="checkInputs()">
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/percentage.png') }}" alt="">
                        <label for="formGroupExampleInput" class="form-label">เปอร์เซ็นต์ส่วนลด:</label>
                        <p class="text-center text-light bg-danger" id="errorPromotionPercentage" style="display: none;">{{ "ข้อมูลเป็นตัวเลขและ 0-100 เท่านั้น" }}</p>
                        <input type="number" class="form-control error-input" id="formGroupExampleInput2" name="promotionPercentage" min="1" max="100" placeholder="กรอกชื่อเปอร์เซ็นต์ส่วนลด" oninput="checkInputs()">
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/timetable.png') }}" alt="">
                        <label for="formGroupExampleInput2" class="form-label">วันที่เริ่มโปรโมชั่น:</label>
                        <input type="date" class="form-control error-input" id="formGroupExampleInput3" name="startDate" oninput="checkInputs()">
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/timetable.png') }}" alt="">
                        <label for="formGroupExampleInput2" class="form-label">วันที่สิ้นสุดโปรโมชั่น:<a class="text_red">(สามารถเว้นว่างได้กรณีที่ไม่ต้องการหยุดการใช้โปรโมชั่น)</a></label>
                        <input type="date" class="form-control" id="formGroupExampleInput4" name="endDate" oninput="checkInputs()">
                    </div>
                    {{ session()->forget(['errorPromotionName','errorPromotionPercentage']) }}
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col navbar-nav me-auto width-150">
                            <p id="errorMessage" class="text-danger">กรุณากรอกข้อมูลให้ครบ.</p>
                            <button type="submit" class="nav-link custom-nav-link justify-content-center" id="submitButton" onclick="return confirm('คุณแน่ใจว่าต้องการแก้ไขข้อมูล?');" disabled>
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
<script>
    function checkInputs() {
        const promotionName = document.getElementById('formGroupExampleInput');
        const promotionPercentage = document.getElementById('formGroupExampleInput2');
        const errorElement = document.getElementById("errorPromotionPercentage");
        const startDate = document.getElementById('formGroupExampleInput3');


        const submitButton = document.getElementById('submitButton');

        // Check if any input field is empty or the menuCategory is not selected
        if (promotionName.value.trim() === '') {
            promotionName.classList.add('error-input');
        } else {
            promotionName.classList.remove('error-input');
        }

        if (promotionPercentage.value.trim() === '') {
            promotionPercentage.classList.add('error-input');
        } else {
            promotionPercentage.classList.remove('error-input');
        }

        if (startDate.value.trim() === '') {
            startDate.classList.add('error-input');
        } else {
            startDate.classList.remove('error-input');
        }

        // Check if any input field is empty or the menuCategory is not selected
        if (promotionName.value.trim() === '' || promotionPercentage.value.trim() === '' || startDate.value.trim() === '') {
            submitButton.disabled = true;
            errorMessage.style.display = 'block';
        } else {
            submitButton.disabled = false;
            errorMessage.style.display = 'none';
        }
        // Check if the input value is outside the valid range
        if (promotionPercentage.value < 1 || promotionPercentage.value > 100) {
            submitButton.disabled = true;
            errorMessage.style.display = 'block';
            errorElement.style.display = "block"; // Show the error message
        } else {
            errorElement.style.display = "none"; // Hide the error message
        }


    }
</script>


</html>
