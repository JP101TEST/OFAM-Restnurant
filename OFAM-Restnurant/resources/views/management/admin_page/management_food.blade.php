<?php

use App\Models\restaurantInfo;

$restaurantlogo = restaurantInfo::value('restaurant_logo');

use App\Models\menu; // Adjust the model namespace as needed
use App\Models\menu_category; // Adjust the model namespace as needed
use Illuminate\Support\Facades\DB;

$menus = Menu::select([
    'menus.menu_id',
    'menus.menu_name',
    'menus.menu_image',
    'menus.menu_status',
    'menu_categories.menu_category_name',
    'ph.price',
])
    ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.menu_category_id')
    ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
        $join->on('menus.menu_id', '=', 'ph.menu_id');
    })
    ->where('menus.menu_status', 1)
    ->orderBy('menus.menu_id', 'asc')
    ->get();
/*
    SELECT
    m.menu_id,
    m.menu_name,
    m.menu_image,
    m.menu_status,
    mc.menu_category_name,
    ph.price
FROM
    `menus` AS m
INNER JOIN `menu_categories` AS mc
ON
    m.menu_category_id = mc.menu_category_id
INNER JOIN (SELECT * FROM `price_histories` WHERE `date_end` IS NULL) AS ph
ON
    m.menu_id = ph.menu_id
WHERE
    1
ORDER BY
    `menu_id` ASC;
    */

$menu_categories = menu_category::all();
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
            width: 100px;

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
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/food-tray.png') }}" alt="">
                        <!--เมนูการจัดการ-->
                    </div>
                    <span class="navbar-toggler-icon"></span>
                </div>
            </button>
            <div class="collapse navbar-collapse pad" id="navbarSupportedContent_sub">
                <ul class="container navbar-nav me-auto">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.home')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">ข้อมูลร้าน</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.table')}}"><img class="icon-size spade-bar" src="{{ asset('images/dinner-table.png') }}" alt="">ข้อมูลโต๊ะ</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active  justify-content-center" href="{{ route('management.admin.food')}}"><img class="icon-size spade-bar" src="{{ asset('images/food-tray.png') }}" alt="">ข้อมูลอาหาร</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.promotion')}}"><img class="icon-size spade-bar" src="{{ asset('images/discount.png') }}" alt="">ข้อมูลโปรโมชั่น</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.employee')}}"><img class="icon-size spade-bar" src="{{ asset('images/owner.png') }}" alt="">ข้อมูลพนักงาน</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.bill')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">บิล</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link  justify-content-center" href="{{ route('management.admin.total.summary')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">สรุปยอด</a></li>
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
                        <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-green justify-content-center" href="{{ route('management.admin.food.category')}}"><img class="icon-size spade-bar" src="{{ asset('images/menu.png') }}" alt="">เพิ่มหมวดหมู่</a></li>
                        <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-green justify-content-center" href="{{ route('management.admin.food.menu')}}"><img class="icon-size spade-bar" src="{{ asset('images/food-tray.png') }}" alt="">เพิ่มรายการอาหาร</a></li>
                        <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-yellow justify-content-center" href="{{ route('management.admin.food.category.edit')}}"><img class="icon-size spade-bar" src="{{ asset('images/menu.png') }}" alt="">แก้ไขหมวดหมู่</a></li>
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
                <h4 class="text-center">จัดข้อมูลอาหาร</h4>
                <br>
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label for="selectSearch">หมวดหมู่</label>
                            <select id="inputSelected" name="selectSearch">
                                <option value="0">ทั้งหมด</option>
                                @foreach ($menu_categories as $menu_categorie)
                                <option value="{{ $menu_categorie->menu_category_id }}">{{ $menu_categorie->menu_category_name }}</option>
                                @endforeach
                                <!--<option value="name">ชื่อโต๊ะ</option>
                                <option value="status">สถานะโต๊ะ</option>-->
                            </select><br><br>
                            <label for="inputSearch">ค้นหา</label>
                            <input type="text" id="searchInput" name="inputSearch" placeholder="ชื่อเมนู"><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>หมวดหมู่</th>
                                        <th>เมนู</th>
                                        <th>สถานะ</th>
                                        <th>แก้ไข</th>
                                        <!-- Add more table headers for other columns as needed -->
                                    </tr>
                                </thead>

                                <!--<tbody id="table-body">
                                    @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $menu->menu_category_name }}</td>
                                        <td>ชื่อ:{{ $menu->menu_name }}<br>
                                        <img class="menu-size" src="{{ asset('images/menu/' . $menu->menu_image ) }}" alt=""><br>
                                        ราคา:{{ $menu->price }}
                                        </td>
                                        <td>{{ $menu->menu_status }}</td>
                                        <td>

                                                <ul class="container navbar-nav me-auto">
                                                    <ul class="container navbar-nav me-auto">
                                                        <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-yellow justify-content-center" href="{{ route('management.admin.food.menu.edit', ['menu_id' => $menu->menu_id])}}"><img class="icon-size spade-bar" src="{{ asset('images/menu.png') }}" alt="">แก้ไข</a></li>
                                                    </ul>
                                                </ul>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>-->
                                <tbody id="table-menu">
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
    var inputSearchValue = null;
    var selectedSearchValue = bindInputChange('inputSelected');
    let currentPage = 1 // Track the current page
    const itemsPerPage = 5 // Number of items to display per page

    function bindInputChange(inputId) {
        const selectedValue = $('#' + inputId).val();
        return selectedValue; // Return the selected value
    }

    function changeMenuStatus(id, value) {
        // You can use the 'value' parameter to determine which radio button was clicked.
        /*console.log("id "+id);
        if (value === 1) {
            // Code to execute when the first radio button is clicked
            console.log("ยกเลิกให้บริการ");
        } else if (value === 2) {
            // Code to execute when the second radio button is clicked
            console.log("พร้อมให้บริการ");
        } else if (value === 3) {
            // Code to execute when the second radio button is clicked
            console.log("หมด");
        }*/
        var confirmation = confirm('คุณต้องการเปลี่ยนสถานะเมนูใช่หรือไม่');
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: '/management-admin/food/menu_id=' + id + ',new_status=' + value,
                success: function(response) {},
                error: function(error) {}
            });
            getAllMenu(selectedSearchValue);
        }
    }

    //get data from text search
    $('#searchInput').on('keyup', function() {
        inputValue = $(this).val();
        console.log();
        if (/^\/+$/.test(inputValue)) {
            inputSearchValue = 'null'; // Update inputSearchValue
        } else {
            inputSearchValue = inputValue; // Update inputSearchValue with the actual input value
        }
        getAllMenu(selectedSearchValue);
    });

    $('#inputSelected').on('change', function() {
        selectedSearchValue = $(this).val();
        getAllMenu(selectedSearchValue);
    })

    function getAllMenu(selectedSearchValue) {
        $.ajax({
            type: 'GET',
            url: '/management-admin/food/get-all-food,category=' + selectedSearchValue,
            data: {
                inputSearchValue: inputSearchValue,
            },
            success: function(response) {
                // Assuming response.tables_status is an array of objects
                console.log(response.test);
                const totalMenu = response.allMenu.length
                if (currentPage > Math.ceil(totalMenu / itemsPerPage)) {
                    currentPage = 1;
                }
                const startIndex = (currentPage - 1) * itemsPerPage
                const endIndex = Math.min(startIndex + itemsPerPage, totalMenu);

                let tableData = ``;
                if (totalMenu === 0) {
                    tableData = `
                        <tr>
                            <td colspan="4">
                                <p>ไม่พบข้อมูล</p>
                            </td>
                        </tr>`;
                } else {
                    tableData = response.allMenu
                        .slice(startIndex, endIndex)
                        .map(menu => {
                            return `
                            <tr>
                        <td>${menu.menu_category_name}</td>
                        <td>ชื่อ:${menu.menu_name }<br>
                            <img class="menu-size" src="/images/menu/${menu.menu_image}" alt=""><br>
                            ราคา:${menu.price}
                        </td>
                        <td>
                        <p ${menu.menu_status == 'ยกเลิกให้บริการ' ? 'class="bg-danger text-white" style="text-align: center;"' : menu.menu_status == 'พร้อมให้บริการ' ? 'class="bg-success text-white" style="text-align: center;"' : 'class="bg-dark text-white" style="text-align: center;"'} >${menu.menu_status}</p>
                        <!--${menu.menu_status}--><br>
                        <label>
                        <input type="radio" name="status" onclick="changeMenuStatus(${menu.menu_id},1)">
                        ยกเลิกให้บริการ
                        </label><br>
                        <label>
                        <input type="radio" name="status" onclick="changeMenuStatus(${menu.menu_id},2)">
                        พร้อมให้บริการ
                        </label><br>
                        <label>
                        <input type="radio" name="status" onclick="changeMenuStatus(${menu.menu_id},3)">
                        หมด
                        </label>
                        </td>
                        <td>
                            <ul class="container navbar-nav me-auto">
                                <ul class="container navbar-nav me-auto">
                                    <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-yellow justify-content-center" href="/management-admin/food/menu/edit/MenuId=${menu.menu_id}"><img class="icon-size spade-bar" src="{{ asset('images/menu.png') }}" alt="">แก้ไข</a></li>
                                </ul>
                            </ul>
                        </td>
                    </tr>`
                        }).join('');
                }

                $('#table-menu').html(tableData) // Update the content

                const totalPages = Math.ceil(totalMenu / itemsPerPage);

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
        getAllMenu(selectedSearchValue);
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


    $(document).ready(function() {
        getAllMenu(selectedSearchValue);
    })
</script>

</html>
