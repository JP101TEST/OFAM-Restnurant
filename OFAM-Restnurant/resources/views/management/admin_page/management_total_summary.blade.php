<?php

use Illuminate\Support\Facades\DB;

$yearSelect = DB::table('bill_lists')
    ->select(DB::raw('YEAR(created_at) as year'))
    ->groupBy(DB::raw('YEAR(created_at)'))
    ->get();
// print(sizeof($yearSelect));
// if (sizeof($yearSelect) > 0) {
//     $selectedYear = $yearSelect[sizeof($yearSelect) - 1]->year; // Get the last year in the result
//     $monthSelect = DB::table('bill_lists')
//         ->select(DB::raw('MONTH(MAX(created_at)) as last_month'))
//         ->whereYear('created_at', $selectedYear)
//         ->get();
//     print($monthSelect);
// } else {
//     print("No years found");
// }
$monthList = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
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

        @media (max-width: 550px) {
            body {
                width: 550px;
            }
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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.bill')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">บิล</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active  justify-content-center" href="{{ route('management.admin.total.summary')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">สรุปยอด</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <h4 class="text-center">สรุปยอด</h4>
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
                <div class="text-center">
                    <h5 id="yearTotal">รับในแต่ละเดือนภายในปี</h5>
                </div>
                <div style="height: 300px;">
                    <canvas id="monthlyIncomeChart"></canvas>
                </div>
                <br><br>
                <div class="col" id="selectShowMonthUpdate">
                    <label for="selectShowMonth">เดือนที่ต้องการค้นหา</label>
                    <select id="selectShowMonth" name="selectShowMonth" class="text-center" style="border-radius: 15px;width: 200px;">
                        @foreach($monthList as $index => $month)
                        <option value="{{ $index + 1 }} " {{ $index + 1 == now()->month ? 'selected' : '' }}>{{$month}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="text-center">
                    <h5 id="dayTotal">รับในแต่ละวันภายในเดือน</h5>
                </div>
                <div style="height: 300px;">
                    <canvas id="dayIncomeChart"></canvas>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let myBarChart = null;
    let barDay = null;
    const monthList = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
    document.addEventListener('DOMContentLoaded', function() {
        // Initial chart setup
        const monthlyChartData = {
            labels: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
            datasets: [{
                label: 'รายได้ในเดือน',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                backgroundColor: 'rgba(54, 262, 105, 0.5)',
                borderColor: 'rgba(54, 262, 105, 1)',
                borderWidth: 1
            }]
        };

        const dailyChartData = {
            labels: Array.from({
                length: 31
            }, (_, i) => i + 1), // Assuming max 31 days in a month
            datasets: [{
                label: 'รายได้ในแต่ละวัน',
                data: Array.from({
                    length: 31
                }, () => 0),
                backgroundColor: 'rgba(54, 262, 105, 0.5)',
                borderColor: 'rgba(54, 262, 105, 1)',
                borderWidth: 1
            }]
        };

        const chartOptions = {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 50,
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        };

        const ctxMonth = document.getElementById('monthlyIncomeChart').getContext('2d');
        const ctxDay = document.getElementById('dayIncomeChart').getContext('2d');
        barMonth = new Chart(ctxMonth, {
            type: 'bar',
            data: monthlyChartData,
            options: chartOptions
        });
        barDay = new Chart(ctxDay, {
            type: 'bar',
            data: dailyChartData,
            options: chartOptions
        });
    });

    $(document).on('change', '#selectShowYear', function() {
        $('#yearTotal').text("รับในแต่ละเดือนภายในปี " + $('#selectShowYear').val());
        updateTotalInYear();
        updateTotalInMonth();
    });

    $(document).on('change', '#selectShowMonth', function() {

        $('#dayTotal').text("รับในแต่ละวันภายในเดือน " + monthList[$('#selectShowMonth').val() - 1]);
        updateTotalInMonth();
    });

    function updateTotalInYear() {
        $('#dayTotal').text("รับในแต่ละวันภายในเดือน " + monthList[$('#selectShowMonth').val() - 1]);
        $.ajax({
            type: 'GET',
            url: '/management-admin/total-summary/get-all-totals-in-year',
            data: {
                year: $("#selectShowYear").val(),
            },
            success: function(response) {
                //console.log(response.totals);
                // Update the chart data
                barMonth.data.datasets[0].data = response.totals;
                // Update the chart
                barMonth.update();
            },
            error: function(error) {
                // Handle error if necessary
            }
        });
    }

    function updateTotalInMonth() {
        //console.log($("#selectShowMonth").val());
        $.ajax({
            type: 'GET',
            url: '/management-admin/total-summary/get-all-totals-in-month',
            data: {
                year: $("#selectShowYear").val(),
                month: $("#selectShowMonth").val(),
            },
            success: function(response) {
                //console.log(response.totals);
                // Update the chart data
                barDay.data.datasets[0].data = response.totals;
                // Update the chart
                barDay.update();
            },
            error: function(error) {
                // Handle error if necessary
            }
        });
    }

    $(document).ready(function() {
        updateTotalInYear();
        updateTotalInMonth();
    });
</script>

</html>
