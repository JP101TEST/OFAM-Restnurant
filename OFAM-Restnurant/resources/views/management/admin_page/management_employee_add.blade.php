@php
$errorEmployee = NULL;
@endphp
@if (session('errorEmployee'))
@php
$errorEmployee = session('errorEmployee');
@endphp
@endif
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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" href="{{ route('management.admin.employee')}}"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <br>
                <h4 class="text-center">เพิ่มพนักงาน</h4>
                <div class="mb-3 container">
                    <p>เพิ่ม:</p>
                </div>
                <form method="post" action="{{ route('management.admin.employee.add.postData') }}" enctype="multipart/form-data">
                    @csrf
                    <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/id-card.png') }}" alt="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput" class="form-label">รหัสประจำตัวพนักงาน:</label>
                            @if (session('errorEmployeeId'))
                            <p class="text-center text-light bg-danger">{{ session('errorEmployeeId') }}</p>
                            @endif
                            <input type="text" class="form-control error-input" id="formGroupExampleInput1" name="employeeId" value="{{ $errorEmployee ? $errorEmployee[0] : NULL}}" placeholder="กรอกรหัส" oninput="checkInputs()">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput" class="form-label">รหัสผ่านพนักงาน:</label>
                            @if (session('errorEmployeePassword'))
                            <p class="text-center text-light bg-danger">{{ session('errorEmployeePassword') }}</p>
                            @endif
                            <input type="text" class="form-control error-input" id="formGroupExampleInput2" name="employeePassword" value="{{ $errorEmployee ? $errorEmployee[1]: NULL}}" placeholder="กรอกรหัสผ่าน" oninput="checkInputs()">
                        </div>
                    </div>
                    <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/owner.png') }}" alt="">
                    <div class="row">
                        @if (session('errorEmployeeName'))
                        <p class="text-center text-light bg-danger">{{ session('errorEmployeeName') }}</p>
                        @endif
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput" class="form-label">ชื่อ:</label>
                            <input type="text" class="form-control error-input" id="formGroupExampleInput3" name="employeeFname" value="{{ $errorEmployee ? $errorEmployee[2]: NULL}}" placeholder="กรอกชื่อ" oninput="checkInputs()">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput" class="form-label">นามสกุล:</label>
                            <input type="text" class="form-control error-input" id="formGroupExampleInput4" name="employeeLname" value="{{ $errorEmployee ? $errorEmployee[3] : NULL }}" placeholder="กรอกนามสกุล" oninput="checkInputs()">
                        </div>
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/insert-picture-icon.png') }}" alt="">
                        <label for="formGroupExampleInput2" class="form-label">รูป:</label>
                        @if (session('errorImage'))
                        <p class="text-center text-light bg-danger">{{ session('errorImage') }}</p>
                        @endif
                        <input type="file" class="form-control error-input" id="formGroupExampleInput5" name="employeeImage" accept="image/*" placeholder="Another input placeholder" oninput="checkInputs()">
                    </div>
                    <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/home.png') }}" alt="">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="formGroupExampleInput" class="form-label">บ้านเลขที่:</label>
                            @if (session('errorEmployeeHouseNumber'))
                            <p class="text-center text-light bg-danger">{{ session('errorEmployeeHouseNumber') }}</p>
                            @endif
                            <input type="text" class="form-control error-input" id="formGroupExampleInput6" name="employeeHouseNumber" value="{{ $errorEmployee ? $errorEmployee[4] : NULL }}" placeholder="กรอกบ้านเลขที่" oninput="checkInputs()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="formGroupExampleInput" class="form-label">ถนน:</label>
                            <input type="text" class="form-control" id="formGroupExampleInput7" name="employeeRoad" value="{{ $errorEmployee ? $errorEmployee[5] : NULL }}" placeholder="กรอกหรือไม่กรอกก็ได้" oninput="checkInputs()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="formGroupExampleInput" class="form-label">ตำบล:</label>
                            @if (session('errorEmployeeSubDistrict'))
                            <p class="text-center text-light bg-danger">{{ session('errorEmployeeSubDistrict') }}</p>
                            @endif
                            <input type="text" class="form-control error-input" id="formGroupExampleInput8" name="employeeSubDistrict" value="{{ $errorEmployee ? $errorEmployee[6] : NULL }}" placeholder="กรอกตำบล" oninput="checkInputs()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="formGroupExampleInput" class="form-label">อำเภอ:</label>
                            @if (session('errorEmployeeDistrict'))
                            <p class="text-center text-light bg-danger">{{ session('errorEmployeeDistrict') }}</p>
                            @endif
                            <input type="text" class="form-control error-input" id="formGroupExampleInput9" name="employeeDistrict" value="{{ $errorEmployee ? $errorEmployee[7] : NULL }}" placeholder="กรอกอำเภอ" oninput="checkInputs()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="formGroupExampleInput" class="form-label">จังหวัด:</label>
                            @if (session('errorEmployeeProvince'))
                            <p class="text-center text-light bg-danger">{{ session('errorEmployeeProvince') }}</p>
                            @endif
                            <input type="text" class="form-control error-input" id="formGroupExampleInput10" name="employeeProvince" value="{{ $errorEmployee ? $errorEmployee[8] : NULL }}" placeholder="กรอกจังหวัด" oninput="checkInputs()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="formGroupExampleInput" class="form-label">รหัสไปรษณีย์:</label>
                            @if (session('errorEmployeePostalCode'))
                            <p class="text-center text-light bg-danger">{{ session('errorEmployeePostalCode') }}</p>
                            @endif
                            <input type="text" class="form-control error-input" id="formGroupExampleInput11" name="employeePostalCode" value="{{ $errorEmployee ? $errorEmployee[9] : NULL }}" placeholder="กรอกรหัสไปรษณีย์" oninput="checkInputs()" maxlength="5">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="formGroupExampleInput" class="form-label">เบอร์ติดต่อ:</label>
                        @if (session('errorEmployeePhone'))
                        <p class="text-center text-light bg-danger">{{ session('errorEmployeePhone') }}</p>
                        @endif
                        <input type="text" class="form-control error-input" id="formGroupExampleInput12" name="employeePhone" value="{{ $errorEmployee ? $errorEmployee[10] : NULL }}" placeholder="กรอกเบอร์ติดต่อ" oninput="checkInputs()" maxlength="10">
                    </div>
                    {{ session()->forget(['errorEmployeeId','errorEmployeePassword','errorEmployeeName','errorImage','errorEmployeeHouseNumber','errorEmployeeRoad','errorEmployeeSubDistrict','errorEmployeeDistrict','errorEmployeeProvince','errorEmployeePostalCode','errorEmployeePhone','errorEmployee']) }}
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function checkInputs() {
        const inputElements = [];
        var postalCode = null;
        var phone = null;
        var noNullData = true;
        for (let index = 1; index <= 12; index++) {
            const element = document.getElementById(`formGroupExampleInput${index}`);
            inputElements.push(element);
        }

        /*for (let index = 0; index < 12; index++) {
            console.log("inputElements" + (index + 1) + ":" + inputElements[index].value);
        }*/


        postalCode = /^\d{5}$/.test(inputElements[10].value);
        phone = /^\d{10}$/.test(inputElements[11].value);
        /*console.log("postalCode:" + postalCode);
        console.log("phone:" + phone);*/

        for (let index = 0; index < 10; index++) {
            if (index == 6) {
                continue;
            }
            if (!inputElements[index].value) {
                inputElements[index].classList.add('error-input');
                noNullData = false;
            } else {
                inputElements[index].classList.remove('error-input');
            }
        }
        if (!postalCode) {
            inputElements[10].classList.add('error-input');
        } else {
            inputElements[10].classList.remove('error-input');
        }
        if (!phone) {
            inputElements[11].classList.add('error-input');
        } else {
            inputElements[11].classList.remove('error-input');
        }

        if (noNullData != true || phone == false || postalCode == false) {
            submitButton.disabled = true;
            errorMessage.style.display = 'block';
        } else {
            submitButton.disabled = false;
            errorMessage.style.display = 'none';
        }

        /*const submitButton = document.getElementById('submitButton');

        // Check if any input field is empty or the menuCategory is not selected
        if (input1.value.trim() === '') {
            input1.classList.add('error-input');
        } else {
            input1.classList.remove('error-input');
        }

        if (menuPrice.value.trim() === '') {
            menuPrice.classList.add('error-input');
        } else {
            menuPrice.classList.remove('error-input');
        }

        if (menuImage.value.trim() === '') {
            menuImage.classList.add('error-input');
        } else {
            menuImage.classList.remove('error-input');
        }

        if (menuCategory.value === '0') {
            menuCategory.classList.add('error-input');
        } else {
            menuCategory.classList.remove('error-input');
        }

        // Check if any input field is empty or the menuCategory is not selected
        if (menuName.value.trim() === '' || menuPrice.value.trim() === '' || menuImage.value.trim() === '' || menuCategory.value === '0') {
            submitButton.disabled = true;
            errorMessage.style.display = 'block';
        } else {
            submitButton.disabled = false;
            errorMessage.style.display = 'none';
        }*/
    }

    $(document).ready(function() {
        checkInputs();
    });
</script>


</html>
