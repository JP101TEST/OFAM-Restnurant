<?php
/*
    SELECT
        fo.food_order_id,t.table_name,m.menu_name,m.menu_image,fo.food_amount,fo.food_order_status,fo.date_order
    FROM
        `food_orders` AS fo
        INNER JOIN
        `tables` AS t
        ON
        fo.table_id = t.table_id
        INNER JOIN
        `menus` AS m
        ON
        fo.menu_id = m.menu_id
    WHERE
        1
*/

use App\Models\table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

$table_id = Route::current()->parameter('table_id');
$table_name = Table::where('table_id', $table_id)->get();
$food_orders = DB::table('food_orders')
    ->where('table_id', $table_id)
    ->where('food_order_status', '!=', 'ชำระเงินเรียบร้อย')
    ->get();
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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" href="{{ route('management.getRequest')}}"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <h4 class="text-center">จัดการรายการเมนู<br>โต๊ะ {{ $table_name[0]->table_name}}</h4>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <!--<label for="selectSearch">ค้นหาด้วย</label>
                <select id="input1" name="selectSearch">
                    <option value="name">ชื่อโต๊ะ</option>
                    <option value="status">สถานะโต๊ะ</option>
                </select>
                <br><br>
                <label for="inputSearch">ค้นหา</label>
                <input type="text" id="searchInput" name="inputSearch"><br>-->
                <label for="selectSearch">หมวดหมู่ที่แสดง</label>
                <select id="inputSelected" name="selectSearch">
                    <option value="0">ทั้งหมด</option>
                    <option value="1">สั่ง</option>
                    <option value="2">กำลังปรุง</option>
                    <option value="3">เสริฟแล้ว</option>
                </select><br><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>เมนู</th>
                            <th>จำนวน</th>
                            <th>สถานะเมนู</th>
                            <!-- Add more table headers for other columns as needed -->
                        </tr>
                    </thead>
                    <tbody id="menu-all">
                    </tbody><br>
                </table>
                <nav>
                    <ul class="pagination justify-content-center" id="pagination">
                    </ul>
                </nav>
            </div>
            <div class="col-lg-12 d-flex justify-content-between">
                <div class="col navbar-nav me-auto width-150">
                    <button type="submit" class="nav-link custom-nav-link justify-content-center" id="submitButton" onclick="pymentOrder()" disabled>
                        <img class="icon-size spade-bar" src="{{ asset('images/new-page.png') }}" alt="">
                        ชำระเงิน
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var selectedStatus;

    function bindInputChange(inputId) {
        const selectedValue = $('#' + inputId).val();
        return selectedValue; // Return the selected value
    }

    function deleteOder(id) {
        var confirmation = confirm('คุณต้องการลบเมนูที่สั่งใช่หรือไม่');
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: '/management/order/order_id=' + id + '/delete',
                success: function(response) {},
                error: function(error) {}
            });
        }
    }

    function changeStatusOder(id, value) {
        var confirmation = confirm('คุณต้องการเปลี่ยนสถานะเมนูที่สั่งใช่หรือไม่');
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: '/management/order/order_id=' + id + ',status=' + value + '/change_status',
                success: function(response) {getAllMenu();},
                error: function(error) {}
            });
        }
    }

    function checkPay(s1, s2,all) {
        console.log(all);
        if (s1 == 0 && s2 == 0 && all != 0) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    function pymentOrder() {
        //var confirmation = confirm('คุณแน่ใจว่าต้องการชำระเงิน?');
        var tableId = '{{$table_id}}';
        //if (confirmation) {
        window.location.href = '/management/order/payment/table_id=' + tableId;
        //}
    }

    $(document).ready(function() {
        var id = <?php echo json_encode($table_id); ?>;

        let currentPage = 1 // Track the current page
        const itemsPerPage = 10 // Number of items to display per page



        //get data from text search
        $('#searchInput').on('keyup', function() {
            inputValue = $(this).val();
            if (/^\/+$/.test(inputValue)) {
                inputSearchValue = 'null'; // Update inputSearchValue
            } else {
                inputSearchValue = inputValue; // Update inputSearchValue with the actual input value
            }
        });

        function getAllMenu(show) {
            $.ajax({
                type: 'GET',
                url: '/management/order/table_id=' + id + '/get-all-menu/show=' + show,
                success: function(response) {
                    // Assuming response.tables_status is an array of objects
                    const totalMenus = response.allMenus.length;
                    const status1 = response.statusCounts.status1;
                    const status2 = response.statusCounts.status2;
                    /*console.log("สั่ง:" + status1);
                    console.log("กำลังปรุง:" + status2);*/
                    checkPay(status1, status2,response.allMenus.length);
                    if (currentPage > Math.ceil(totalMenus / itemsPerPage)) {
                        currentPage = 1;
                    }
                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = Math.min(startIndex + itemsPerPage, totalMenus);
                    let tableData = response.allMenus
                        .slice(startIndex, endIndex)
                        .map(menu => {
                            return `
                            <tr>
                                <td style="margin-left: 10%;">
                                ชื่อ : ${menu.menu_name}<br><br>
                                <img class="menu-size" src="/images/menu/${menu.menu_image}" alt=""><br>
                                </td>
                                <td style="text-align: center;vertical-align: middle;font-size:30px;">
                                <p>${menu.food_amount}</p><br>
                                </td>
                                <td>
                                <p style="text-align: center;" ${menu.food_order_status == 'สั่ง' ? 'class="bg-danger text-white"' : menu.food_order_status == 'กำลังปรุง' ? 'class="bg-warning text-white"' : menu.food_order_status == 'เสริฟแล้ว' ? 'class="bg-info text-white"' :menu.food_order_status == 'รอชำระเงิน' ? 'class="bg-primary text-white"' :'class=""'} >${menu.food_order_status != null ?menu.food_order_status:'-'}</p>
                                ${menu.food_order_status == 'สั่ง' ?
                                `<label style="margin-left: 10%;">
                                    <input type="radio" name="status" " onclick="deleteOder(${menu.food_order_id})">
                                    ยกเลิก
                                </label><br><br><label style="margin-left: 10%;">
                                    <input type="radio" name="status" " onclick="changeStatusOder(${menu.food_order_id},2)">
                                    กำลังปรุง
                                </label><br><br>`: menu.food_order_status == 'กำลังปรุง' ?
                                `<label style="margin-left: 10%;">
                                    <input type="radio" name="status" " onclick="changeStatusOder(${menu.food_order_id},3)">
                                    เสริฟแล้ว
                                </label><br><br>` :
                                ``}
                                </td>
                            </tr>`

                        })

                    $('#menu-all').html(tableData.join('')) // Update the content

                    const totalPages = Math.ceil(totalMenus / itemsPerPage);
                    $('#pagination').empty();
                    generatePagination(totalPages)

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
            getAllMenu();
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



        getAllMenu()
        selectedStatus = bindInputChange('inputSelected')

        setInterval(function() {
            selectedStatus = bindInputChange('inputSelected');
            /*console.log("selectedStatus: " + selectedStatus);
            console.log("inputValue: " + inputValue);*/

            getAllMenu(selectedStatus)

        }, 2000) // 2 seconds
        /*------------------------------------------------------------------------ */


    })
</script>





</html>
