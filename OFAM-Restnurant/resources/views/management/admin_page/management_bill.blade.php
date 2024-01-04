<?php

use Illuminate\Support\Facades\DB;

$yearSelect = DB::table('bill_lists')
    ->select(DB::raw('YEAR(created_at) as year'))
    ->groupBy(DB::raw('YEAR(created_at)'))
    ->get();

if (count($yearSelect) > 0) {
    $monthSelect = DB::table('bill_lists')
        ->select(DB::raw('MONTH(created_at) as month'))
        ->whereYear('created_at', $yearSelect[sizeof($yearSelect) - 1]->year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

    $daySelect = DB::table('bill_lists')
        ->select(DB::raw('DAY(created_at) as day'))
        ->whereYear('created_at', $yearSelect[sizeof($yearSelect) - 1]->year)
        ->whereMonth('created_at', $monthSelect[sizeof($monthSelect) - 1]->month)
        ->groupBy(DB::raw('DAY(created_at)'))
        ->get();
}else {
    $monthSelect=[];
    $daySelect =[];
    $yearSelect=[];
}
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

        .popup td {
            color: black;
        }

        .popup:hover td {
            color: red;
            cursor: pointer;
            font-weight: 500;
        }

        .selectDate {
            text-align: center;
            border-radius: 5px;
        }

        input[type="number"].selectDate::-webkit-outer-spin-button,
        input[type="number"].selectDate::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .slider {
            height: 5px;
            border-radius: 5px;
            background-color: #ddd;
            position: relative;
        }

        .slider .progress {
            height: 5px;
            left: 0%;
            right: 0%;
            position: absolute;
            border-radius: 5px;
            background-color: #de7e37;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            top: -5px;
            height: 5px;
            width: 100%;
            background: none;
            pointer-events: none;
            appearance: none;
        }

        input[type="range"].range::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 50%;
            pointer-events: auto;
            -webkit-appearance: none;
            background-color: #de7e37;
        }

        .buttonSelect {
            width: 110px;
            height: 40px;
            font-weight: 700;
            border-radius: 15px;
            color: white;
            background-color: #8C5534;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .buttonSelect:hover {
            background-color: #de7e37;
            cursor: pointer;
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
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/document.png') }}" alt="">
                        <!--เมนูการจัดการ-->
                    </div>
                    <span class="navbar-toggler-icon"></span>
                </div>
            </button>
            <div class="collapse navbar-collapse pad" id="navbarSupportedContent_sub">
                <ul class="container navbar-nav me-auto">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.home')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">ข้อมูลร้าน</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.table')}}"><img class="icon-size spade-bar" src="{{ asset('images/dinner-table.png') }}" alt="">ข้อมูลโต๊ะ</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.food')}}"><img class="icon-size spade-bar" src="{{ asset('images/food-tray.png') }}" alt="">ข้อมูลอาหาร</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.promotion')}}"><img class="icon-size spade-bar" src="{{ asset('images/discount.png') }}" alt="">ข้อมูลโปรโมชั่น</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.employee')}}"><img class="icon-size spade-bar" src="{{ asset('images/owner.png') }}" alt="">ข้อมูลพนักงาน</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active  justify-content-center" href="{{ route('management.admin.bill')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">บิล</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.total.summary')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">สรุปยอด</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <h4 class="text-center">บิล</h4>
                <label for="selectShowSize">จำนวนรายการที่ต้องการแสดง</label>
                <select id="selectShowSize" name="selectShowSize" class="text-center" style="margin-left: 10px;border-radius: 15px;width: 110px;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
                <br><br>
                <div style="font-weight: 700;">
                    เลือกช่วงเวลาที่ต้องการค้นหา
                </div>
                <br>
                <div class="col">
                    <label for="selectShowYear">ปีที่ต้องการค้นหา</label>
                    <select id="selectShowYear" name="selectShowYear" class="text-center" style="border-radius: 15px;width: 200px;">
                    @if(count($yearSelect) > 0)
                        @foreach($yearSelect as $year)
                        <option value="{{$year->year}}" {{ $year->year == $yearSelect[sizeof($yearSelect)-1]->year ? 'selected' : '' }}>{{$year->year}}</option>
                        @endforeach
                    @else
                    <option value="">ไม่มีรายการบิลในระบบ</option>
                    @endif
                    </select>
                </div>
                <br>
                <div style="font-weight: 700;">
                    เลือกเดือน
                </div><br>
                <div>
                    <div class="slider">
                        <div class="progress m"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range" name="" id="minMonth" value="10" min="10" max="120">
                        <input type="range" class="range" name="" id="maxMonth" value="120" min="10" max="120">
                    </div>
                    <br>
                    <div class="row justify-align-content-between align-content-sm-center">
                        <div class="col text-start">
                            <label for="minMonth">เริ่มต้น</label>
                            <input type="text" class="selectDate" name="minMonth" id="minMonthShow" style="width: 100px;" value="มกราคม" disabled>
                        </div>
                        <div class="col text-end">
                            <label for="maxMonth">สิ้นสุด</label>
                            <input type="text" class="selectDate" name="maxMonth" id="maxMonthShow" style="width: 100px;" value="ธันวาคม" disabled>
                        </div>
                    </div>
                </div>
                <br>
                <div style="font-weight: 700;">
                    เลือกวัน
                </div><br>
                <div>
                    <div class="slider">
                        <div class="progress d"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range" name="" id="minDay" value="10" min="10" max="310">
                        <input type="range" class="range" name="" id="maxDay" value="310" min="10" max="310">
                    </div>
                    <br>
                    <div class="row justify-align-content-between align-content-sm-center">
                        <div class="col text-start">
                            <label for="minDay">เริ่มต้น</label>
                            <input type="number" class="selectDate" name="minDay" id="minDayShow" style="width: 60px;" value="1" min="0" max="31" disabled>
                        </div>
                        <div class="col text-end">
                            <label for="maxDay">สิ้นสุด</label>
                            <input type="number" class="selectDate" name="maxDay" id="maxDayShow" style="width: 60px;" value="31" min="0" max="31" disabled>
                        </div>
                    </div>
                </div>
                <br><br>
                <div>
                    <p class="buttonSelect" id="buttonSelect">ค้นหา</p>
                </div>
                <div class="row">
                    <!-- <div class="col">
                        <label for="selectShowDay">วัน</label>
                        <select id="selectShowDay" name="selectShowDay">
                            <option value="0">ทั้งหมด</option>
                            @foreach($daySelect as $day)
                            <option value="{{$day->day}}" {{ $day->day == $daySelect[sizeof($daySelect)-1]->day ? 'selected' : '' }}>{{$day->day}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="selectShowMonth">เดือน</label>
                        <select id="selectShowMonth" name="selectShowMonth">
                            @foreach($monthSelect as $month)
                            <option value="{{$month->month}}" {{ $month->month == $monthSelect[sizeof($monthSelect)-1]->month ? 'selected' : '' }}>{{$month->month}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <!-- <div class="col">
                        <label for="selectShowYear">ปีปีที่ต้องการค้นหา</label>
                        <select id="selectShowYear" name="selectShowYear" class="text-center" style="border-radius: 15px;width: 110px;">
                            @foreach($yearSelect as $year)
                            <option value="{{$year->year}}" {{ $year->year == $yearSelect[sizeof($yearSelect)-1]->year ? 'selected' : '' }}>{{$year->year}}</option>
                            @endforeach
                        </select>
                    </div> -->
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>โปรโมชั่นที่ใช้</th>
                            <th>ราคา</th>
                            <th>เวลาที่ชำระ</th>
                            <!-- Add more table headers for other columns as needed -->
                        </tr>
                    </thead>
                    <tbody id="bill-all">
                    </tbody><br>
                </table>
                <nav>
                    <ul class="pagination justify-content-center" id="pagination">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 90vh;margin: auto;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="dateDetail">

                </div>
                <div class="tabs-container" style="height: 30vh; width: auto; overflow-y: auto;">
                    <div class="tabs-box flex-column" id="table-all-basket">

                    </div>
                </div>
                <div id="totalDetail">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const monthList = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];

    function showDetailBill(billId, employees_id, customer_name, billPromotion,discount_thad_day, billTotalPrice, billDate, createdAt, orderInBill) {
        // console.log(billId);
        // console.log(orderInBill);
        $.ajax({
            type: 'GET',
            url: '/management-admin/bill/get-all-menu-bill',
            data: {
                order: orderInBill,
                billId:billId,
            },
            success: function(response) {
                //console.log(response.order);
                let date = `<p class="text-center">หมายเลขโต๊ะ:${response.table_name}</p><p class="text-center">เวลาที่ชำระ:${billDate}</p><div class="row"><p class="col text-center">ลูกค้า:<br>${customer_name}</p><p class="col text-center">พนักงานที่ยืนยัน:<br>${employees_id}</p></div><br><h5>รายการอาหาร</h5><br>`;
                // let list = `
                //     <div class="tab-basket-text-normal">
                //     @for ($index = 0; $index < 50; $index++)
                //         <div class="tab" >menu_categorie->menu_category_name</div>
                //     @endfor
                //     </div>`;
                let list = ``
                for (let index = 0; index < response.order.length; index++) {
                    console.log(response.order[index][0].price);
                    if (index == 0) {
                        list += `<div class="tab row" ><p class="col">ชื่อ</p><p class="col">จำนวน</p><p class="col">ราคา</p></div>`;
                    }
                    list += `<div class="tab row" ><p class="col">${response.order[index][0].menu_name}</p><p class="col">${response.order[index][0].food_amount}</p><p class="col">${response.order[index][0].food_amount*response.order[index][0].price}</p></div>`
                }
                let total = `<h5>สรุปยอด</h5><br><p>โปรโมชั่น:${billPromotion == 'null' ? ' -':(billPromotion+" (ส่วนลด:"+discount_thad_day+")")}</p><p>ยอดรวม: ${billTotalPrice} บาท</p>`;
                $('#exampleModal').find('.modal-title').html('<h1 class="modal-title fs-5" id="exampleModalLabel">' + "รายละเอียด บิล " + billId + '</h1>');
                //$('#exampleModal').find('.modal-body').html(date + list);
                $('#dateDetail').html(date);
                $('#table-all-basket').html(list);
                $('#totalDetail').html(total);
                $('#exampleModal').modal('show');
                console.log(response.o);
            },
            error: function(error) {
                // Handle error if necessary
            }
        })

    }


    $(document).ready(function() {
        let currentPage = 1;
        let itemsPerPage = 10;

        function getAllBill() {
            // console.log("dayStar:" + parseInt($("#minDay").val() / 10));
            // console.log("dayStop:" + parseInt($("#maxDay").val() / 10));
            // console.log("monthStar:" + parseInt($("#minMonth").val() / 10));
            // console.log("monthStop:" + parseInt($("#maxMonth").val() / 10));
            $.ajax({
                type: 'GET',
                url: '/management-admin/bill/get-all-bill',
                data: {
                    year: $("#selectShowYear").val(),
                    monthStar: parseInt($("#minMonth").val() / 10),
                    monthStop: parseInt($("#maxMonth").val() / 10),
                    dayStar: parseInt($("#minDay").val() / 10),
                    dayStop: parseInt($("#maxDay").val() / 10),
                },
                success: function(response) {
                    // Assuming response.tables_status is an array of objects
                    const totalBill = response.allBill.length;
                    if (currentPage > Math.ceil(totalBill / itemsPerPage)) {
                        currentPage = 1;
                    }
                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = Math.min(startIndex + itemsPerPage, totalBill);
                    let billData = ``;
                    if (totalBill === 0) {
                        billData = `
                        <tr>
                            <td colspan="4">
                                <p>ไม่พบบิลในช่วงเวลาดังกล่าวกรุณาเปลี่ยนช่วงเวลาค้นหาใหม่</p>
                            </td>
                        </tr>`;
                    } else {
                        billData = response.allBill
                            .slice(startIndex, endIndex)
                            .map(bill => {
                                // let i = 1;
                                //let foodOrder = JSON.parse(bill.food_order_id);
                                // let foodOrderHTML = foodOrder.map(order => `
                                //     <div>
                                //         ${i++}.${order}
                                //     </div>`).join('');
                                let foodOrder = JSON.parse(bill.food_order_id);
                                let formattedDate = new Date(bill.created_at).toLocaleString('en-GB', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                });
                                return `
                            <tr class="popup" onclick="showDetailBill(${bill.bill_id},'${bill.employees_id}','${bill.customer_name}','${bill.promotion_name}',${bill.discount_thad_day},${bill.total_price},'${formattedDate}','${bill.created_at}',[${foodOrder}]);">
                                <td>
                                    ${bill.bill_id}
                                </td>
                                <td>
                                    ${bill.promotion_id == null ? '-': bill.promotion_name}
                                </td>
                                <td>
                                    ${bill.total_price}
                                </td>
                                <td>
                                    ${formattedDate}
                                </td>
                                <!--<td>

                                </td>-->
                            </tr>`
                            }).join('');
                    }

                    $('#bill-all').html(billData) // Update the content

                    const totalPages = Math.ceil(totalBill / itemsPerPage);
                    $('#pagination').empty();
                    generatePagination(totalPages)

                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        $(document).on('click', '.page-btn-all', function() {
            currentPage = parseInt($(this).data('page'))
            getAllBill();
        })

        function generatePagination(totalPages) {
            if (totalPages > 1) {
                $('#pagination').empty(); // Clear pagination links

                // Calculate the range of pages to show
                const numPagesToShow = 5;
                let startPage = Math.max(1, currentPage - Math.floor(numPagesToShow / 2));
                let endPage = Math.min(startPage + numPagesToShow - 1, totalPages);

                // Add the "Previous" page if not on the first page
                if (currentPage > 1) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-all" data-page="${1}"><a class="page-link" href="#">&lt;</a></li>
                        `);
                }

                // Add pages before the current page
                for (let i = startPage; i < currentPage; i++) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-all" data-page="${i}"><a class="page-link" href="#">${i}</a></li>
                        `);
                }

                // Add the current page
                $('#pagination').append(`
                            <li class="page-item active"><span class="page-link">${currentPage}</span></li>
                        `);

                // Add pages after the current page
                for (let i = currentPage + 1; i <= endPage; i++) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-all" data-page="${i}"><a class="page-link" href="#">${i}</a></li>
                        `);
                }

                // Add the "Next" page if not on the last page
                if (currentPage < totalPages) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-all" data-page="${totalPages}"><a class="page-link" href="#">&gt;</a></li>
                        `);
                }
            }
        }

        $('#selectShowSize').on('change', function() {
            //console.log($(this).val());
            itemsPerPage = parseInt($(this).val());
            getAllBill();
        });

        $('#minDay').on('input', function() {
            if (parseInt($("#minDay").val()) > parseInt($("#maxDay").val())) {
                $("#minDay").val($("#maxDay").val() - 1);
            }
            changeBarDay();
        });

        $('#maxDay').on('input', function() {
            if (parseInt($("#minDay").val()) > parseInt($("#maxDay").val())) {
                $("#maxDay").val($("#minDay").val() + 1);
            }
            changeBarDay();
        });

        function changeBarDay() {
            let min = $("#minDay").val();
            let max = $("#maxDay").val();
            // console.log("min:" + parseInt($("#minDay").val() / 10) + " |max:" + parseInt($("#maxDay").val() / 10));
            let progress = document.querySelector(".slider .progress.d");
            progress.style.left = ((min - 10) / (310 - 10) * 100) + "%";
            progress.style.right = (100 - ((max - 10) / (310 - 10) * 100)) + "%";
            // console.log(((min - 10) / (120 - 10) * 100) + " " + (100 - ((max - 10) / (120 - 10) * 100)));
            $('#minDayShow').val(parseInt($("#minDay").val() / 10));
            $('#maxDayShow').val(parseInt($("#maxDay").val() / 10));
        }

        $('#minMonth').on('input', function() {
            if (parseInt($("#minMonth").val()) > parseInt($("#maxMonth").val())) {
                $("#minMonth").val($("#maxMonth").val() - 1);
            }
            changeBarMonth();
        });

        $('#maxMonth').on('input', function() {
            if (parseInt($("#minMonth").val()) > parseInt($("#maxMonth").val())) {
                $("#maxMonth").val($("#minMonth").val() + 1);
            }
            changeBarMonth();
        });

        function changeBarMonth() {
            let min = $("#minMonth").val();
            let max = $("#maxMonth").val();
            // console.log("min:" + parseInt($("#minMonth").val() / 10) + " |max:" + parseInt($("#maxMonth").val() / 10));
            let progress = document.querySelector(".slider .progress.m");
            progress.style.left = ((min - 10) / (120 - 10) * 100) + "%";
            progress.style.right = (100 - ((max - 10) / (120 - 10) * 100)) + "%";
            // console.log(((min - 10) / (120 - 10) * 100) + " " + (100 - ((max - 10) / (120 - 10) * 100)));
            $('#minMonthShow').val(monthList[parseInt($("#minMonth").val() / 10) - 1]);
            $('#maxMonthShow').val(monthList[parseInt($("#maxMonth").val() / 10) - 1]);
        };

        $('#buttonSelect').on('click', function() {
            getAllBill();
        });

        getAllBill();
    });
</script>

</html>
