<?php

use App\Models\employee; //เพิ่มมาทีหลัง
$employees = Employee::all();

use Illuminate\Support\Facades\DB;
//ดึงค่ามาใช้จาก json array
// $idJson = DB::table('bill_lists')->get();

// print("<td>bill_id:" . $idJson[4]->bill_id . "<br>employees_id:" . $idJson[4]->employees_id . "<br>food_order_id:" . $idJson[4]->food_order_id . "<br>promotion_id:" . $idJson[4]->promotion_id . "<br>discount_thad_day:" . $idJson[4]->discount_thad_day . "<br>total_price:" . $idJson[4]->total_price . "<br>customer_name:" . $idJson[4]->customer_name . "<br>restaurant_id:" . $idJson[4]->restaurant_id . "<br>created_at:" . $idJson[4]->created_at . "</td><br><br>");

// $decodedArray = json_decode($idJson[4]->food_order_id, true);
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
            background-color: #67DBF1;
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

        .icon-size-dark {
            height: 25px;
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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active bg-active justify-content-center" href="{{ route('management.getRequest')}}">รายการโต๊ะ</a></li>
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
                                <button type="submit" class="nav-link custom-nav-link-active bg-active justify-content-center w-100" title="ออกจากระบบ">
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
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/dinner-table.png') }}" alt="">
                        <!--เมนูการจัดการ-->
                    </div>
                    <span class="navbar-toggler-icon"></span>
                </div>
            </button>
            <div class="collapse navbar-collapse pad" id="navbarSupportedContent_sub">
                <ul class="container navbar-nav me-auto">
                    <li class="nav-item text-center" style="width:120px;"><a class="nav-link custom-nav-link-active  justify-content-center"><img class="icon-size spade-bar" src="{{ asset('images/dinner-table.png') }}" alt="">โต๊ะ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <label for="selectSearch">ค้นหาด้วย</label>
                <select id="input1" name="selectSearch">
                    <option value="name">หมายเลขโต๊ะ</option>
                    <option value="status">สถานะโต๊ะ</option>
                </select>
                <br><br>
                <!--<div id="output1">Output will be displayed here for Select 1</div>-->
                <label for="inputSearch">ค้นหา</label>
                <input type="text" id="searchInput" name="inputSearch" style="display: block;">
                <select id="searchInputSelect" name="inputSearch" style="display: none;">
                    <option value="ว่าง" selected>ว่าง</option>
                    <option value="ไม่ว่าง">ไม่ว่าง</option>
                </select>

                <!--<p id="outputSearch" name="outputSearchValue"></p>-->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>โต๊ะ</th>
                            <th>สถานะโต๊ะ</th>
                            <th>สถานะรายการอาหาร</th>
                            <!-- Add more table headers for other columns as needed -->
                        </tr>
                    </thead>
                    <tbody id="table-all">
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var inputValue;
    var selectedValue;
    var selectedValueByOption = 'name';

    let currentPage = 1 // Track the current page
    const itemsPerPage = 7 // Number of items to display per page

    function bindInputChange(inputId) {
        const selectedValue = $('#' + inputId).val();
        return selectedValue; // Return the selected value
    }

    function changeMenuStatus(id, value, typeShow) {
        var confirmation = confirm('คุณต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่');
        console.log("id:" + id + " | value:" + value);
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: '/update/table/status/table_id=' + id + '/table_status=' + value,
                success: function(response) {},
                error: function(error) {}
            });
            if (typeShow == 1) {
                getAllTables();
            } else {
                getSearchTables(selectedValue);
            }
        }
    }








    //get data from text search
    $('#searchInput').on('keyup', function() {
        inputValue = $(this).val();
        // console.log(inputValue);
        // if (/^\/+$/.test(inputValue)) {
        //     inputSearchValue = 'null'; // Update inputSearchValue
        // } else {
        //     inputSearchValue = inputValue; // Update inputSearchValue with the actual input value
        // }
        if (inputValue === '' || inputValue == null) {
            getAllTables();
        } else {
            getSearchTables(selectedValue);
        }
    });

    $('#input1').on('change', function() {
        let textSearch = document.getElementById('searchInput');
        let selectSearch = document.getElementById('searchInputSelect');
        // console.log(inputValue);
        selectedValueByOption = $(this).val();
        if (selectedValueByOption == 'name') {
            textSearch.style.display = 'block';
            selectSearch.style.display = 'none';
            if (inputValue == null || inputValue === '') {
                getAllTables();
            } else {
                getSearchTables(selectedValue);
            }
        } else {
            textSearch.style.display = 'none';
            selectSearch.style.display = 'block';
            inputValue = '';
            $('#searchInput').val('');
            getAllTables();
        }
    })

    $('#searchInputSelect').on('change', function() {
        getAllTables();
    })

    function getAllTables() {
        $.ajax({
            type: 'GET',
            url: '/management/table/get-all-tables',
            data: {
                typeValue: selectedValueByOption,
                valueOfType: $('#searchInputSelect').val()
            },
            success: function(response) {
                console.log("typeValue: " + response.one + ",valueOfType:" + response.two);
                // Assuming response.tables_status is an array of objects
                const statusMapping = [
                    null, // 0 index is not used
                    'สั่ง',
                    'กำลังปรุง',
                    'เสิร์ฟแล้ว',
                    'รอชำระเงิน'
                ];
                const totalTables = response.allTables.length;
                if (currentPage > Math.ceil(totalTables / itemsPerPage)) {
                    currentPage = 1;
                }
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, totalTables);
                let tableData = '';
                if (totalTables === 0) {
                    tableData = `
                        <tr>
                            <td colspan="4">
                                <p>ไม่พบข้อมูล</p>
                            </td>
                        </tr>`;
                } else {
                    tableData = response.allTables
                        .slice(startIndex, endIndex)
                        .map(table => {
                            //console.log(table.table_name+" "+table.table_id);
                            return `
                            <tr>
                                <td class="text-center ">
                                <p >${table.table_name}</p>
                                <ul class="container navbar-nav me-auto">
                                    <ul class="container navbar-nav me-auto "style="width:70px;" >
                                        <li class="nav-item text-center " title="ปริ้น Qrcode"><a class="nav-link custom-nav-link justify-content-center text-dark" href="/order/generateQRCode/Table=${table.table_name},PassWord=${table.tables_password}"><img class="icon-size-dark spade-bar" src="{{ asset('images/qr-code.png') }}"></a></li>
                                    </ul>
                                </ul>
                                </td>
                                <td>
                                <p style="text-align: center;" ${table.tables_status == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.tables_status == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.tables_status}</p>
                                <label style="margin-left: 10%;">
                                    <input type="radio" name="status" onclick="changeMenuStatus(${table.table_id},2,1)">
                                    ว่าง
                                </label><br><br>
                                <label style="margin-left: 10%;">
                                    <input type="radio" name="status" onclick="changeMenuStatus(${table.table_id},3,1)">
                                    ไม่ว่าง
                                </label><br>
                                </div>
                                </td>
                                <td>
                                <p style="text-align: center;" ${table.table_order_status === 1 ? 'class="bg-danger text-white"' : table.table_order_status === 2 ? 'class="bg-warning text-white"' : table.table_order_status === 3 ? 'class="bg-info text-white"' :table.table_order_status === 4 ? 'class="bg-primary text-white"' :'class=""'} >${table.table_order_status != null ?statusMapping[table.table_order_status]:'-'}</p>
                                ${table.table_order_status != null && table.table_order_status !== '' ?
                                `<ul class="container navbar-nav me-auto">
                                    <ul class="container navbar-nav me-auto" style="width:70px;">
                                        <li class="nav-item text-center " title="แสดงรายการสั่งอาหาร"><a class="nav-link custom-nav-link justify-content-center" href="/management/order/table_id=${table.table_id}"><img class="icon-size-dark spade-bar" src="{{ asset('images/document.png') }}"></a></li>
                                    </ul>
                                </ul>` : ''}
                                </td>
                            </tr>`
                        }).join('');
                }

                $('#table-all').html(tableData) // Update the content

                const totalPages = Math.ceil(totalTables / itemsPerPage);
                $('#pagination').empty();
                generatePagination(totalPages)

            },
            error: function(error) {
                // Handle error if necessary
            }
        })
    }

    function getSearchTables(selectedValue) {
        $.ajax({
            type: 'GET',
            url: '/management/table/category=' + selectedValue + '/search=' + inputValue,
            success: function(response) {
                const statusMapping = [
                    null, // 0 index is not used
                    'สั่ง',
                    'กำลังปรุง',
                    'เสิร์ฟแล้ว',
                    'รอชำระเงิน'
                ];

                const totalTables = response.allTables.length
                if (currentPage > Math.ceil(totalTables / itemsPerPage)) {
                    currentPage = 1;
                }
                const startIndex = (currentPage - 1) * itemsPerPage
                const endIndex = Math.min(startIndex + itemsPerPage, totalTables);

                let tableData = '';
                if (totalTables === 0) {
                    tableData = `
                        <tr>
                            <td colspan="4">
                                <p>ไม่พบข้อมูล</p>
                            </td>
                        </tr>`;
                } else {
                    tableData = response.allTables
                        .slice(startIndex, endIndex)
                        .map(table => {
                            return `
                                <tr>
                                <td class="text-center ">
                                <p >${table.table_name}</p>
                                <ul class="container navbar-nav me-auto">
                                    <ul class="container navbar-nav me-auto "style="width:70px;" >
                                        <li class="nav-item text-center " title="ปริ้น Qrcode"><a class="nav-link custom-nav-link justify-content-center text-dark" href="/order/generateQRCode/Table=${table.table_name},PassWord=${table.tables_password}"><img class="icon-size-dark spade-bar" src="{{ asset('images/qr-code.png') }}"></a></li>
                                    </ul>
                                </ul>
                                </td>
                                <td>
                                <p style="text-align: center;" ${table.tables_status == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.tables_status == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.tables_status}</p>
                                <label style="margin-left: 10%;">
                                    <input type="radio" name="status" onclick="changeMenuStatus(${table.table_id},2,2)">
                                    ว่าง
                                </label><br><br>
                                <label style="margin-left: 10%;">
                                    <input type="radio" name="status" onclick="changeMenuStatus(${table.table_id},3,2)">
                                    ไม่ว่าง
                                </label><br>
                                </div>
                                </td>
                                <td>
                                <p style="text-align: center;" ${table.table_order_status === 1 ? 'class="bg-danger text-white"' : table.table_order_status === 2 ? 'class="bg-warning text-white"' : table.table_order_status === 3 ? 'class="bg-info text-white"' :table.table_order_status === 4 ? 'class="bg-primary text-white"' :'class=""'} >${table.table_order_status != null ?statusMapping[table.table_order_status]:'-'}</p>
                                ${table.table_order_status != null && table.table_order_status !== '' ?
                                `<ul class="container navbar-nav me-auto">
                                    <ul class="container navbar-nav me-auto" style="width:70px;">
                                        <li class="nav-item text-center " title="แสดงรายการสั่งอาหาร"><a class="nav-link custom-nav-link justify-content-center" href="/management/order/table_id=${table.table_id}"><img class="icon-size-dark spade-bar" src="{{ asset('images/document.png') }}"></a></li>
                                    </ul>
                                </ul>` : ''}
                                </td>
                            </tr>`;
                        })
                        .join('');
                }

                $('#table-all').html(tableData); // Update the content
                const totalPages = Math.ceil(totalTables / itemsPerPage);
                $('#pagination').empty();
                generatePaginationUpdateTables(totalPages)
            },
            error: function(error) {
                // Handle error if necessary
            }
        })
    }

    // Handle page navigation
    //สำหรับ all
    $(document).on('click', '.page-btn-all', function() {
        currentPage = parseInt($(this).data('page'))
        getAllTables();
    })

    $(document).on('click', '.page-btn-update', function() {
        currentPage = parseInt($(this).data('page'))
        getSearchTables(selectedValue);
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

    function generatePaginationUpdateTables(totalPages) {
        if (totalPages > 1) {
            $('#pagination').empty(); // Clear pagination links

            // Calculate the range of pages to show
            const numPagesToShow = 5;
            let startPage = Math.max(1, currentPage - Math.floor(numPagesToShow / 2));
            let endPage = Math.min(startPage + numPagesToShow - 1, totalPages);

            // Add the "Previous" page if not on the first page
            if (currentPage > 1) {
                $('#pagination').append(`
                            <li class="page-item page-btn-update" data-page="${1}"><a class="page-link" href="#">&lt;</a></li>
                        `);
            }

            // Add pages before the current page
            for (let i = startPage; i < currentPage; i++) {
                $('#pagination').append(`
                            <li class="page-item page-btn-update" data-page="${i}"><a class="page-link" href="#">${i}</a></li>
                        `);
            }

            // Add the current page
            $('#pagination').append(`
                            <li class="page-item active"><span class="page-link">${currentPage}</span></li>
                        `);

            // Add pages after the current page
            for (let i = currentPage + 1; i <= endPage; i++) {
                $('#pagination').append(`
                            <li class="page-item page-btn-update" data-page="${i}"><a class="page-link" href="#">${i}</a></li>
                        `);
            }

            // Add the "Next" page if not on the last page
            if (currentPage < totalPages) {
                $('#pagination').append(`
                            <li class="page-item page-btn-update" data-page="${totalPages}"><a class="page-link" href="#">&gt;</a></li>
                        `);
            }
        }
    }



    $(document).ready(function() {
        getAllTables()
        selectedValue = bindInputChange('input1')

        setInterval(function() {
            selectedValue = bindInputChange('input1');
            //console.log(selectedValue);
            /*console.log("selectedValue: " + selectedValue);
            console.log("inputValue: " + inputValue);*/
            if (inputValue == null || inputValue === '') {
                getAllTables();
            } else {
                getSearchTables(selectedValue);
            }
        }, 5000) // 2 seconds
        /*------------------------------------------------------------------------ */


    })
</script>





</html>
