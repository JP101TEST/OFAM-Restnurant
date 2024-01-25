<?php

$employeesId = session('User')[0]->employees_id;

use App\Models\table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

$table_id = Route::current()->parameter('table_id');
$table_name = (Table::where('table_id', $table_id)->get())[0]->table_name;

$order = DB::table('food_orders as fo')
    ->select([
        'fo.food_order_id as food_order_id',
        't.table_name as table_name',
        'm.menu_name as menu_name',
        'm.menu_image as menu_image',
        'fo.food_amount as food_amount',
        'fo.food_order_status as food_order_status',
        'ph.price as price'
    ])
    ->leftJoin('tables as t', function ($join) {
        $join->on('fo.table_id', '=', 't.table_id');
    })
    ->leftJoin('menus as m', function ($join) {
        $join->on('fo.menu_id', '=', 'm.menu_id');
    })
    ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
        $join->on('m.menu_id', '=', 'ph.menu_id');
    })
    ->where('t.table_name', $table_name)
    ->whereBetween('fo.food_order_status', [1, 4])
    ->orderBy(DB::raw("CASE
            WHEN fo.food_order_status = 'รอชำระเงิน' THEN 1
            WHEN fo.food_order_status = 'สั่ง' THEN 2
            WHEN fo.food_order_status = 'กำลังปรุง' THEN 3
            WHEN fo.food_order_status = 'เสริฟแล้ว' THEN 4
            ELSE 5
        END"))
    ->get();



$newOrder = [];
if (count($order) > 0) {
    foreach ($order as $item) {
        $menuName = $item->menu_name;
        $foodAmount = $item->food_amount;
        $foodStatus = $item->food_order_status;
        $foodImage = $item->menu_image;
        $foodPrice = $item->price;

        // Check if an item with the same menu_name already exists in $newOrder
        $existingItemIndex = array_search($menuName, array_column($newOrder, 'menu_name'));

        if ($existingItemIndex !== false) {
            // If the item exists, update its food_amount
            $newOrder[$existingItemIndex]['food_amount'] += $foodAmount;
        } else {
            // If the item doesn't exist, add it to $newOrder
            $orderItem = [
                'menu_name' => $menuName,
                'food_amount' => $foodAmount,
                'food_order_status' => $foodStatus,
                'menu_image' => $foodImage,
                'menu_price' => $foodPrice
            ];

            $newOrder[] = $orderItem;
        }
    }
}

$date = date("d-m-Y H:i:s");

$totalPrice = 0;

$arrayIdOderMenu = [];

foreach ($order as $item) {
    $totalPrice += $item->food_amount * $item->price;
    $arrayIdOderMenu[] = $item->food_order_id;
}

$arrayIdOderMenu = [];

foreach ($order as $item) {
    $arrayIdOderMenu[] = $item->food_order_id;
}

$promotions = DB::table('promotions as p')->get();

// print($promotions);
// print("<br><br><br>" . now() . "<br><br><br>");
$promotionsFilter = DB::table('promotions as p')
    ->where('p.date_start', '<=', now())
    ->where(function ($query) {
        $query->where('p.date_end', '>=', now())
            ->orWhereNull('p.date_end');
    })
    ->get();

// print($promotionsFilter);

//ดึงค่ามาใช้จาก json array
// $idJson = DB::table('bill_lists')->get();

// print("<td>bill_id:" . $idJson[0]->bill_id . "<br>employees_id:" . $idJson[0]->employees_id . "<br>food_order_id:" . $idJson[0]->food_order_id . "<br>promotion_id:" . $idJson[0]->promotion_id . "<br>discount_thad_day:" . $idJson[0]->discount_thad_day . "<br>total_price:" . $idJson[0]->total_price . "<br>customer_name:" . $idJson[0]->customer_name . "<br>restaurant_id:" . $idJson[0]->restaurant_id . "<br>created_at:" . $idJson[0]->created_at . "</td><br><br>");

// $decodedArray = json_decode($idJson[0]->food_order_id, true);
// $foodOderList = DB::table('food_orders as fo')
//     ->select([
//         'fo.food_order_id as food_order_id',
//         't.table_name as table_name',
//         'm.menu_name as menu_name',
//         'm.menu_image as menu_image',
//         'fo.food_amount as food_amount',
//         'fo.food_order_status as food_order_status',
//         'ph.price as price'
//     ])
//     ->leftJoin('tables as t', function ($join) {
//         $join->on('fo.table_id', '=', 't.table_id');
//     })
//     ->leftJoin('menus as m', function ($join) {
//         $join->on('fo.menu_id', '=', 'm.menu_id');
//     })
//     ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
//         $join->on('m.menu_id', '=', 'ph.menu_id');
//     })
//     ->whereIn('food_order_id', $decodedArray)->get();

// //print_r($foodOderList);

// foreach ($foodOderList as $item) {
//     print("<td> $item->food_order_id  $item->table_name  $item->menu_name  $item->menu_image  จำนวน $item->food_amount  $item->food_order_status </td><br>");
// }

// //print_r($decodedArray);

// foreach ($decodedArray as $value) {
//     print($value . "<br>");
// }

//ตรวจสอบว่ามีรายการอาหารถ้าไม่จะกลับไปหน้าหลัก
if (count($order) == 0) {
    header("Location: /management");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOFL</title>
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

        .menu-size-edit {
            height: 300px;
            width: 300px;
            justify-self: center;

        }

        .menu-size {
            height: 150px;
            width: 150px;

        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler w-100" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent_sub" aria-controls="navbarSupportedContent_sub" aria-expanded="false" aria-label="Toggle navigation">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <div class="align-items-center">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">
                        <!--เมนูการจัดการ-->
                    </div>
                    <span class="navbar-toggler-icon"></span>
                </div>
            </button>
            <div class="collapse navbar-collapse pad" id="navbarSupportedContent_sub">
                <ul class="container navbar-nav me-auto">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" onclick="goBackOrderPage('{{$table_id}}')"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <h4 class="text-center">ชำระเงิน <br>โต๊ะ {{$table_name}}</h4>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <!-- <td>โต๊ะ:{{$table_name}}</td>
                <br><br> -->
                <!-- <td>วันเวลาที่ชำระ:{{ $date }}</td>
                <br><br> -->
                <!-- <td>ยอดรวม:{{ $totalPrice }}</td>
                <br><br> -->

                <p id="inputCustomerError" style="color: red;display: none;">กรุณากรอกชื่อลูกค้า</p>
                <label for="inputCustomer" style="width:120px;">ชื่อลูกค้า</label>
                <td><input type="text" name="inputCustomer" id="inputCustomer" style="width:300px;border-radius: 30px;padding-left: 10px;"></td>
                <!-- <td>ยอดชำระ:{{ $totalPrice-((5/100)*$totalPrice) }} ปัดเศษ: {{ $totalPrice-round((5/100)*$totalPrice) }}</td> -->
                <!-- <br><br><br> --><br><br>
                <p id="inputEmployeeError" style="color: red;display: none;">รหัสพนักงานไม่ถูกต้อง</p>
                <label for="inputEmployee" style="width:120px;">รหัสพนักงาน</label>
                <td><input type="text" name="inputEmployee" id="inputEmployee" style="width:300px;border-radius: 30px;padding-left: 10px;"></td>
                <!-- <td>ยอดชำระ:{{ $totalPrice-((5/100)*$totalPrice) }} ปัดเศษ: {{ $totalPrice-round((5/100)*$totalPrice) }}</td> -->
                <br><br>
                <td>
                    <label for="promotionSelect">โปรโมชั่น</label>
                    <select name="promotionSelect" id="promotionSelect" style="width:300px;border-radius: 30px;padding-left: 10px;" onchange="selectedValue()">
                        <option value="0" data-discount="0">ว่าง</option>
                        @foreach($promotionsFilter as $item)
                        <option value="{{ $item->promotion_id }}" data-discount="{{ $item->discount }}">{{ $item->promotion_name }} - ส่วนลด {{ $item->discount }}%</option>
                        @endforeach
                    </select>
                </td>
                <!-- <br><br>
                <div id="showDiscount">ส่วนลด:0 บาท</div> -->
                <!--
                <td>ส่วนลด 5%:{{ (5/100)*$totalPrice }} ปัดเศษ:{{ round((5/100)*$totalPrice) }}</td> -->
                <!-- <h4>Order list in database</h4>
                @foreach ($order as $item)
                <td>{{ $item->food_order_id }} {{ $item->table_name }} {{ $item->menu_name }} {{ $item->menu_image }} จำนวน{{ $item->food_amount }} {{ $item->food_order_status }}</td><br>
                @endforeach
                -->
                <br><br>
                <div id="showTotalPriceDiscount" style="font-size: 18px;font-weight: bold;">ยอดรวมที่ต้องชำระ:{{$totalPrice}} บาท</div>
                <!-- <td>ยอดชำระ:{{ $totalPrice-((5/100)*$totalPrice) }} ปัดเศษ: {{ $totalPrice-round((5/100)*$totalPrice) }}</td> -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>เมนู</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <!-- Add more table headers for other columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newOrder as $item)
                        <tr>
                            <td><img style="border-radius: 10px;width: 40px;height: 40px;" src="{{ asset("images/menu/{$item['menu_image']}") }}"> {{ $item['menu_name'] }} </td>
                            <td>{{ $item['food_amount'] }} </td>
                            <td>ชิ้นละ={{ $item['menu_price'] }} รวม={{ $item['menu_price']*$item['food_amount'] }}</td><br>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br><br>
                <div><button id="payment" type="button" class="btn btn-success" style="color: #fff;" disabled>ชำระเงิน</button></div>
                <br><br><br>
            </div>
        </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    let selectedValueCode = 0;
    let discount = 0;
    let totalPrice = 0;
    let checkInputEmployeeStatus = false;
    let checkInputCustomerStatus = false;

    function goBackOrderPage(table_Id) {
        window.location.href = '/management/order/table_id=' + table_Id;
    }

    function checkInputEmployee(inputValue, employeesId) {
        var inputEmployee = document.getElementById("inputEmployeeError");

        // Toggle visibility
        if (inputValue === employeesId) {
            inputEmployee.style.display = "none";
            checkInputEmployeeStatus = true;
        } else {
            inputEmployee.style.display = "block";
            checkInputEmployeeStatus = false;
        }

        // Toggle disabled state (optional)
        // employeeCodeElement.disabled = !employeeCodeElement.disabled;
    }

    function selectedValue() {
        var selectElement = document.getElementById("promotionSelect");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        selectedValueCode = selectElement.value;
        discount = selectedOption.getAttribute("data-discount");
        // console.log("Selected Value:", selectedValueCode);
        //console.log("Selected Discount:", discount);
        var discountCalulate = (parseInt(discount) / 100) * parseInt("{{$totalPrice}}");
        var discountCalulateUse = Math.round(discountCalulate);
        var totalPriceDiscountCalulateUse = parseInt("{{$totalPrice}}") - discountCalulateUse;
        //$('#showDiscount').html(`ส่วนลด:${parseInt(discount)} บาท ${(parseInt(discount)/100)*parseInt("{{$totalPrice}}")}`);
        $('#showDiscount').html(`ส่วนลด:${discountCalulate} บาท | ปัดเศษ ${discountCalulateUse} บาท`);
        $('#showTotalPriceDiscount').html(`ยอดรวมที่ต้องชำระ:${totalPriceDiscountCalulateUse} บาท`);
        totalPrice = totalPriceDiscountCalulateUse;
    }

    $('#inputEmployee').on('keyup', function() {
        //console.log($(this).val());
        // console.log("inputEmployee:" + $(this).val());
        // console.log("employeesId:" + "{{$employeesId}}");
        checkInputEmployee($(this).val(), "{{$employeesId}}");
        checkPaymentButtonStatus();
    });

    $('#inputCustomer').on('keyup', function() {
        checkInputCustomer();
        checkPaymentButtonStatus();
    });

    function checkInputCustomer() {
        var inputCustomer = document.getElementById("inputCustomerError");
        if ($('#inputCustomer').val() === '') {
            checkInputCustomerStatus = false;
            inputCustomer.style.display = "block";
        } else {
            checkInputCustomerStatus = true;
            inputCustomer.style.display = "none";

        }
    }

    function checkPaymentButtonStatus() {
        if (checkInputCustomerStatus === true && checkInputEmployeeStatus == true) {
            payment.disabled = false;
        } else {
            payment.disabled = true;
        }
    }

    $('#payment').on('click', function() {
        /*console.log($('#inputCustomer').val());
        console.log($('#inputEmployee').val());
        console.log(selectedValueCode);
        console.log(parseInt(discount));
        console.log(totalPrice);*/
        var oder_list_array = <?php echo json_encode($arrayIdOderMenu); ?>; //ส่งค่า arrayIdOderMenu ที่แปลงจาก array เป็น json
        $.ajax({
            type: 'GET',
            url: '/management/order/payment',
            data: {
                employees_id: $('#inputEmployee').val(),
                customer_name: $('#inputCustomer').val(),
                promotion_id: selectedValueCode,
                discount: parseInt(discount),
                total_price: totalPrice,
                oder_list: oder_list_array,
                table_id: "{{$table_id}}",

            },
            success: function(response) {},
            error: function(error) {}
        })
        window.location.href = '/management';
    });

    $(document).ready(function() {
        totalPrice = parseInt("{{$totalPrice}}");

        //totalPrice = parseInt("{{$totalPrice}}");
        // console.log("inputEmployee:" + $('#inputEmployee').val());
        // console.log("employeesId:" + "{{$employeesId}}");
        // checkInputEmployee($('#inputEmployee').val(), "{{$employeesId}}");
    })
</script>





</html>
