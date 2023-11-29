<?php

use App\Models\restaurantInfo;

$restaurantlogo = restaurantInfo::value('restaurant_logo');

use App\Models\promotion; // Adjust the model namespace as needed
use Illuminate\Support\Facades\DB;

function getDateFormate($data, $dataType, $dataTypeTital)
{
    return promotion::select(
        DB::raw("DATE_FORMAT($data, '$dataType') as $dataTypeTital"),
        //DB::raw('COUNT(*) as day_count')
    )
        ->groupBy($dataTypeTital)
        ->orderBy($dataTypeTital)
        ->get();
}

$promotions = promotion::select(
    'promotion_id',
    'promotion_code',
    'promotion_name',
    'discount',
    DB::raw("DATE_FORMAT(date_start, '%d-%m-%Y') as dayStart"),
    DB::raw("DATE_FORMAT(date_end, '%d-%m-%Y') as dayEnd")
)
    ->orderBy('date_start', 'desc')->get();

/*
    $dayStarts = getDateFormate('date_start', '%d', 'dayStart');
    $dayEnds = getDateFormate('date_end', '%d', 'dayEnd');
    $monthStarts = getDateFormate('date_start', '%m', 'monthStart');
    $monthEnds = getDateFormate('date_end', '%m', 'monthEnd');
    $yearStarts = getDateFormate('date_start', '%Y', 'yearStart');
    $yearEnds = getDateFormate('date_end', '%Y', 'yearEnd');
*/

/* สำหรับตรวจสอบ วัน เดือน ปี ที่ต้องการค้นหา
    SELECT DATE(`date_start`),COUNT(DATE(`date_start`))
    FROM `price_histories`
    GROUP BY `date_start`
    ORDER BY `date_start`;

    SELECT DATE_FORMAT(`date_start`, '%Y-%m') AS month, COUNT(*) AS month_count
    FROM `price_histories`
    GROUP BY month
    ORDER BY month;

    SELECT DATE_FORMAT(`date_start`, '%d') AS month, COUNT(*) AS month_count
    FROM `price_histories`
    GROUP BY month
    ORDER BY month;

    SELECT DATE_FORMAT(`date_start`, '%m') AS month, COUNT(*) AS month_count
    FROM `price_histories`
    GROUP BY month
    ORDER BY month;

    SELECT DATE_FORMAT(`date_start`, '%y') AS month, COUNT(*) AS month_count
    FROM `price_histories`
    GROUP BY month
    ORDER BY month;
*/
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
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/discount.png') }}" alt="">
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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active  justify-content-center" href="{{ route('management.admin.promotion')}}"><img class="icon-size spade-bar" src="{{ asset('images/discount.png') }}" alt="">ข้อมูลโปรโมชั่น</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.employee')}}"><img class="icon-size spade-bar" src="{{ asset('images/owner.png') }}" alt="">ข้อมูลพนักงาน</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler w-100" type="button" data-bs-toggle="collapse" data-bs-target="#sub_add" aria-controls="sub_add" aria-expanded="false">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <div class="align-items-center">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/new-page.png') }}" alt="">
                        <!--เมนูการจัดการ-->
                    </div>
                    <span class="navbar-toggler-icon"></span>
                </div>
            </button>
            <div class="collapse navbar-collapse pad" id="sub_add">
                <ul class="container navbar-nav me-auto">
                    <ul class="container navbar-nav me-auto">
                        <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-green justify-content-center" href="{{ route('management.admin.promotion.add')}}"><img class="icon-size spade-bar" src="{{ asset('images/discount.png') }}" alt="">เพิ่มโปรโมชั่น</a></li>
                    </ul>
                    <!--
                    <ul class="container justify-content-end navbar-nav me-auto">
                        <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.home')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">ออก</a></li>
                    </ul>-->
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <h4 class="text-center">จัดข้อมูลโปรโมชั่น</h4>
                <br>
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label for="nameInputSelectedType">ค้นหาด้วย</label>
                            <select id="inputSelectedTypeSearch" name="nameInputSelectedType">
                                <option value="0">ชื่อโปรโมชั่น</option>
                                <option value="1">รหัสโปรโมชั่น</option>
                            </select><br><br>
                            <label for="inputSearch">ค้นหา</label>
                            <input type="text" id="searchInput" name="inputSearch"><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>โปรโมชั่น</th>
                                        <th>ช่วงเวลาที่จัดโปรโมชั่น</th>
                                    </tr>
                                </thead>
                                <!--
                                <tbody id="table-body">
                                    @foreach ($promotions as $promotion)
                                    <tr>
                                        <td>
                                            ชื่อโปรโมชั่น: {{ $promotion->promotion_name}}<br>
                                            โค้ด: {{ $promotion->promotion_code}}<br>
                                            ส่วนลด: {{ $promotion->discount}}%<br>
                                            <ul class="container navbar-nav me-auto">
                                                <ul class="container navbar-nav me-auto">
                                                    <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-yellow justify-content-center" href="{{ route('management.admin.promotion.edit', ['promotion_id' => $promotion->promotion_id])}}"><img class="icon-size spade-bar" src="{{ asset('images/discount.png') }}" alt="">แก้ไข</a></li>
                                                </ul>
                                            </ul>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>วันที่เริ่ม</th>
                                                        <th>วันที่สิ้นสุด</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $promotion->dayStart}}</td>
                                                        <td>{{ $promotion->dayStart ? $promotion->dayStart : '-'}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody><br>
-->
                                <tbody id="table-promotion">
                                </tbody>
                                <br>
                            </table>
                            <nav>
                                <ul class="pagination justify-content-center" id="pagination">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var inputSelectedTypeSearch;
    var searchInput;

    function bindInputChange(inputId) {
        const selectedValue = $('#' + inputId).val();
        return selectedValue; // Return the selected value
    }

    $(document).ready(function() {
        let currentPage = 1 // Track the current page
        const itemsPerPage = 5 // Number of items to display per page

        function getAllPromotion() {
            $.ajax({
                type: 'GET',
                url: '/management-admin/promotion/get-all-promotion',
                success: function(response) {
                    // Assuming response.tables_status is an array of objects
                    const totalPromotions = response.allPromotions.length
                    if (currentPage > Math.ceil(totalPromotions / itemsPerPage)) {
                        currentPage = 1;
                    }
                    const startIndex = (currentPage - 1) * itemsPerPage
                    const endIndex = Math.min(startIndex + itemsPerPage, totalPromotions);

                    let tableData = response.allPromotions
                        .slice(startIndex, endIndex)
                        .map(promotion => {
                            return `
                            <tr>
                                        <td>
                                            ชื่อโปรโมชั่น: ${promotion.promotion_name}<br>
                                            โค้ด: ${promotion.promotion_code}<br>
                                            ส่วนลด: ${promotion.discount}%<br>
                                            <ul class="container navbar-nav me-auto">
                                                <ul class="container navbar-nav me-auto">
                                                    <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-yellow justify-content-center" href="/management-admin/promotion/edit/PromotionId=${promotion.promotion_id}"><img class="icon-size spade-bar" src="{{ asset('images/discount.png') }}" alt="">แก้ไข</a></li>
                                                </ul>
                                            </ul>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>วันที่เริ่ม</th>
                                                        <th>วันที่สิ้นสุด</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>${promotion.dateStart}</td>
                                                        <td>${promotion.dateEnd ? promotion.dateEnd : '-'}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>`
                        })

                    $('#table-promotion').html(tableData.join('')) // Update the content

                    const totalPages = Math.ceil(totalPromotions / itemsPerPage);

                    $('#pagination').empty();
                    generatePagination(totalPages)
                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        function getSearchPromotion(searchInput, inputSelectedTypeSearch) {
            $.ajax({
                type: 'GET',
                url: '/management-admin/promotion/get-all-promotion/searchType=' + inputSelectedTypeSearch + ',search=' + searchInput,
                success: function(response) {
                    // Assuming response.tables_status is an array of objects
                    const totalPromotions = response.allPromotions.length
                    if (currentPage > Math.ceil(totalPromotions / itemsPerPage)) {
                        currentPage = 1;
                    }
                    const startIndex = (currentPage - 1) * itemsPerPage
                    const endIndex = Math.min(startIndex + itemsPerPage, totalPromotions);

                    let tableData;
                    if (totalPromotions === 0) {
                        tableData = `
                        <tr>
                            <td colspan="4">
                                <p>No data</p>
                            </td>
                        </tr>`;
                    } else {
                        tableData = response.allPromotions
                            .slice(startIndex, endIndex)
                            .map(promotion => {
                                return `
                            <tr>
                                        <td>
                                            ชื่อโปรโมชั่น: ${promotion.promotion_name}<br>
                                            โค้ด: ${promotion.promotion_code}<br>
                                            ส่วนลด: ${promotion.discount}%<br>
                                            <ul class="container navbar-nav me-auto">
                                                <ul class="container navbar-nav me-auto">
                                                    <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-yellow justify-content-center" href="/management-admin/promotion/edit/PromotionId=${promotion.promotion_id}"><img class="icon-size spade-bar" src="{{ asset('images/discount.png') }}" alt="">แก้ไข</a></li>
                                                </ul>
                                            </ul>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>วันที่เริ่ม</th>
                                                        <th>วันที่สิ้นสุด</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>${promotion.dateStart}</td>
                                                        <td>${promotion.dateEnd ? promotion.dateEnd : '-'}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>`
                            }).join('');
                    }
                    $('#table-promotion').html(tableData) // Update the content

                    const totalPages = Math.ceil(totalPromotions / itemsPerPage);

                    $('#pagination').empty();
                    generatePaginationSearch(totalPages)
                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        $(document).on('click', '.page-btn-all', function() {
            currentPage = parseInt($(this).data('page'))
            getAllPromotion();
        })

        $(document).on('click', '.page-btn-Search', function() {
            currentPage = parseInt($(this).data('page'))
            getSearchPromotion(searchInput, inputSelectedTypeSearch);
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
                            <li class="page-item page-btn-all" data-page="${1}"><a class="page-link" href="#">&lt;&lt;</a></li>
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
                            <li class="page-item page-btn-all" data-page="${totalPages}"><a class="page-link" href="#">&gt;&gt;</a></li>
                        `);
                }
            }
        }

        function generatePaginationSearch(totalPages) {
            if (totalPages > 1) {
                $('#pagination').empty(); // Clear pagination links

                // Calculate the range of pages to show
                const numPagesToShow = 5;
                let startPage = Math.max(1, currentPage - Math.floor(numPagesToShow / 2));
                let endPage = Math.min(startPage + numPagesToShow - 1, totalPages);

                // Add the "Previous" page if not on the first page
                if (currentPage > 1) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-Search" data-page="${1}"><a class="page-link" href="#">&lt;&lt;</a></li>
                        `);
                }

                // Add pages before the current page
                for (let i = startPage; i < currentPage; i++) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-Search" data-page="${i}"><a class="page-link" href="#">${i}</a></li>
                        `);
                }

                // Add the current page
                $('#pagination').append(`
                            <li class="page-item active"><span class="page-link">${currentPage}</span></li>
                        `);

                // Add pages after the current page
                for (let i = currentPage + 1; i <= endPage; i++) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-Search" data-page="${i}"><a class="page-link" href="#">${i}</a></li>
                        `);
                }

                // Add the "Next" page if not on the last page
                if (currentPage < totalPages) {
                    $('#pagination').append(`
                            <li class="page-item page-btn-Search" data-page="${totalPages}"><a class="page-link" href="#">&gt;&gt;</a></li>
                        `);
                }
            }
        }

        inputSelectedTypeSearch = bindInputChange('inputSelectedTypeSearch');
        searchInput = bindInputChange('searchInput');
        getAllPromotion();

        setInterval(function() {
            inputSelectedTypeSearch = bindInputChange('inputSelectedTypeSearch');
            searchInput = bindInputChange('searchInput');
            /*
                        console.log("inputSelectedTypeSearch: " + inputSelectedTypeSearch);
                        console.log("searchInput: " + searchInput);
            */
            if (searchInput == null || searchInput === '') {
                getAllPromotion();
            } else {
                getSearchPromotion(searchInput, inputSelectedTypeSearch);
            }
        }, 2000)
    })
</script>

</html>
