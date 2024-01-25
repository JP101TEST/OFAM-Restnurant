<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\menu_category;

$menuCategorys = menu_category::all();
$menu_id = Route::current()->parameter('menu_id');
$menu = DB::table('menus')
    ->where('menu_id', $menu_id)->get();

$price_history = DB::table('price_histories')
    ->where('menu_id', $menu_id)
    ->where('date_end', null)->get();

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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link yellow-bg justify-content-center" href="{{ route('management.admin.food')}}"><img class="icon-size spade-bar" src="{{ asset('images/go-back-arrow.png') }}" alt="">ย้อนกลับ</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <br>
                <h4 class="text-center">แก้ไขข้อมูลอาหาร</h4>
                <div class="mb-3 container text-center">
                <img class="menu-size-edit" src="{{ asset('images/menu/' . $menu[0]->menu_image ) }}" alt=""><br>
                </div>
                <div class="mb-3 container">
                    <p>เพิ่ม:</p>
                </div>
                <form method="post" action="{{ route('management.admin.food.menu.edit.postData', ['menu_id' => $menu[0]->menu_id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/food-tray.png') }}" alt="">
                        <label for="formGroupExampleInput" class="form-label">ชื่ออาหาร:</label>
                        @if (session('errorMenuName'))
                        <p class="text-center text-light bg-danger">{{ session('errorMenuName') }}</p>
                        @endif
                        <input type="text" class="form-control " id="formGroupExampleInput" name="menuName" value="{{ $menu[0]->menu_name }}" placeholder="กรอกชื่ออาหาร">
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/dollar.png') }}" alt="">
                        <label for="formGroupExampleInput" class="form-label">ราคา:</label>
                        <input type="number" class="form-control " id="formGroupExampleInput2" name="menuPrice" value="{{ $price_history[0]->price }}" min="1" placeholder="กรอกราคา">
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/insert-picture-icon.png') }}" alt="">
                        <label for="formGroupExampleInput2" class="form-label">รูปอาหาร:</label>
                        @if (session('errorImage'))
                        <p class="text-center text-light bg-danger">{{ session('errorImage') }}</p>
                        @endif
                        <input type="file" class="form-control " id="formGroupExampleInput3" name="menuImage" accept="image/*" placeholder="Another input placeholder">
                    </div>
                    <div class="mb-3">
                        <img class="icon-size-no-brightness spade-bar" src="{{ asset('images/menu.png') }}" alt="">
                        <label for="formGroupExampleInput2" class="form-label">หมวดหมู่:</label>
                        @if (session('errorMenuCategory'))
                        <p class="text-center text-light bg-danger">{{ session('errorMenuCategory') }}</p>
                        @endif
                        <select class="form-select " aria-label="Default select example" name="menuCategory" disabled>
                            @foreach ($menuCategorys as $menuCategory)
                            <option value="{{ $menuCategory->menu_category_id }}" @if($menuCategory->menu_category_id == $menu[0]->menu_category_id) selected="selected" @endif>{{ $menuCategory->menu_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{ session()->forget(['errorMenuName','errorImage','errorMenuCategory']) }}
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col navbar-nav me-auto width-150">
                            <button type="submit" class="nav-link custom-nav-link justify-content-center" id="submitButton" onclick="return confirm('คุณแน่ใจว่าต้องการแก้ไขข้อมูล?');">
                                <img class="icon-size spade-bar" src="{{ asset('images/new-page.png') }}" alt="">
                                เพิ่ม
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ราคา</th>
                                        <th>วันที่เริ่ม</th>
                                        <th>วันที่สิ้นสุด</th>
                                    </tr>
                                </thead>
                                <tbody id="table-price">
                                </tbody><br>
                                <br>
                            </table>
                            <nav>
                                <ul class="pagination justify-content-center" id="pagination">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let currentPage = 1 // Track the current page
        const itemsPerPage = 5 // Number of items to display per page

        var id = <?php echo json_encode($menu_id); ?>;


        function getAllpriceHistory(id) {
            $.ajax({
                type: 'GET',
                url: '/management-admin/food/menu/edit/getPriceHistory/MenuId=' + id,
                success: function(response) {
                    // Assuming response.tables_status is an array of objects
                    const totalPriceHistory = response.allPriceHistory.length
                    const startIndex = (currentPage - 1) * itemsPerPage
                    const endIndex = Math.min(startIndex + itemsPerPage, totalPriceHistory);

                    let tableData = response.allPriceHistory
                        .slice(startIndex, endIndex)
                        .map(price => {
                            return `
                            <tr>
                        <td>${price.price}</td>
                        <td>${price.date_start}</td>
                        <td>${price.date_end || '-'}</td>
                    </tr>`
                        })

                    $('#table-price').html(tableData.join('')) // Update the content

                    const totalPages = Math.ceil(totalPriceHistory / itemsPerPage)
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
            getAllpriceHistory(id);
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

        //console.log(id);
        getAllpriceHistory(id);
    })
</script>

</html>
