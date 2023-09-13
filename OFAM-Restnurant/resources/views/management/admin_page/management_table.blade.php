<?php

use App\Models\restaurantInfo;

$restaurantName = restaurantInfo::value('restaurant_name');
$restaurantPhone = restaurantInfo::value('restaurant_phone');
$restaurantlogo = restaurantInfo::value('restaurant_logo');
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

        .icon-size {
            height: 25px;
            filter: brightness(0) invert(1);
        }

        .icon-size-no-brightness {
            height: 25px;
            margin-right: 10px;
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <img class="icon-size spade-bar" src="{{ asset('images/store.png') }}">
            <a class="navbar-brand">ชื่อร้าน</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent_test" aria-controls="navbarSupportedContent_test" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent_test">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="{{ route('management.getRequest')}}">รายการโต๊ะ</a></li>
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="#!">Contact</a></li>
                    @if(session('User')[0]->management_lavel == 'admin')
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center active" aria-current="page" href="{{ route('management.admin.home')}}">จัดการร้าน</a></li>
                    @endif
                    <li>
                        <div class="vl"></div>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <div class="d-flex">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <p class="nav-link active">{{ session('User')[0]->employees_id }} {{ session('User')[0]->employees_password }}</p>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('management.logout') }}" method="post">
                                    @csrf <!-- Add CSRF token for Laravel form -->
                                    <button type="submit" class="btn nav-link">
                                        <img src="{{ asset('images/logout_FILL0_wght400_GRAD0_opsz24.png') }}" alt="Logout">
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent_sub" aria-controls="navbarSupportedContent_sub" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent_sub">
                <ul class="container navbar-nav me-auto">
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link justify-content-center" href="{{ route('management.admin.home')}}"><img class="icon-size spade-bar" src="{{ asset('images/document.png') }}" alt="">ข้อมูลร้าน</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active justify-content-center" href="{{ route('management.admin.table')}}"><img class="icon-size spade-bar" src="{{ asset('images/dinner-table.png') }}" alt="">ข้อมูลโต๊ะ</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link justify-content-center" href="{{ route('management.admin.food')}}"><img class="icon-size spade-bar" src="{{ asset('images/food-tray.png') }}" alt="">ข้อมูลอาหาร</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="col-lg-12 d-flex justify-content-between">
                    <div class="mb-1 row">
                        <ul class="col navbar-nav me-auto width-150">
                            <li class="nav-item text-center"><a class="nav-link custom-nav-link bg-green justify-content-center" href="{{ route('management.admin.table.add')}}"><img class="icon-size spade-bar" src="{{ asset('images/new-page.png') }}" alt="">เพิ่ม</a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <h4 class="text-center">จัดการโต๊ะ</h4>

                <label for="selectSearch">ค้นหาด้วย</label>
                <select id="input1" name="selectSearch">
                    <option value="name">ชื่อโต๊ะ</option>
                    <option value="status">สถานะโต๊ะ</option>
                </select>
                <br><br>
                <label for="inputSearch">ค้นหา</label>
                <input type="text" id="searchInput" name="inputSearch" placeholder="Search Table ID"><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>โต๊ะ</th>
                            <th>รหัสผ่าน</th>
                            <th>สถานะโต๊ะ</th>
                            <th>แก้ไข</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function bindInputChange(inputId) {
        const selectedValue = $('#' + inputId).val();
        return selectedValue; // Return the selected value
    }





    $(document).ready(function() {

        let currentPage = 1 // Track the current page
        const itemsPerPage = 10 // Number of items to display per page

        var inputValue;

        var selectedValue;

        $('#searchInput').on('keyup', function() {
            inputValue = $(this).val();
            if (/^\/+$/.test(inputValue)) {
                inputValue = 'null';
            }
        });

        function getAllTables() {
            $.ajax({
                type: 'GET',
                url: '/management-admin/table/get-all-tables',
                success: function(response) {
                    // Assuming response.tables_status is an array of objects
                    const totalTables = response.allTables.length
                    const startIndex = (currentPage - 1) * itemsPerPage
                    const endIndex = Math.min(startIndex + itemsPerPage, totalTables);

                    let tableData = response.allTables
                        .slice(startIndex, endIndex)
                        .map(table => {
                            return `
                            <tr>
                                <td>
                                ${table.table_name}
                                </td>
                                <td>
                                ${table.tables_password}
                                </td>
                                <td>
                                <p ${table.tables_status == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.tables_status == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.tables_status}</p>
                                <form class="status-form-Required" data-table-id="${table.table_name}" action="/update/table/status/${table.table_name}" method="post">
                                @csrf
                                <label>
                                    <input type="radio" name="status" value="1" ${table.tables_status == 1 ? 'checked' : ''}>
                                    ยกเลิก
                                </label>
                                <label>
                                    <input type="radio" name="status" value="2" ${table.tables_status == 2 ? 'checked' : ''}>
                                    ว่าง
                                </label>
                                <!--
                                <label>
                                    <input type="radio" name="status" value="3" ${table.tables_status == 3 ? 'checked' : ''}>
                                    ไม่ว่าง
                                </label>
                                -->
                                <button type="submit" class="btn btn-success">เปลี่ยนสถานะ</button>
                                </form>
                                </td>
                            </tr>`
                        })

                    $('#table-all').html(tableData.join('')) // Update the content

                    const totalPages = Math.ceil(totalTables / itemsPerPage)
                    $('#pagination').empty();
                    generatePagination(totalPages)

                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        function getUpdateTables(selectedValue) {
            $.ajax({
                type: 'GET',
                url: '/management-admin/table/' + inputValue + ',' + selectedValue,
                success: function(response) {

                    const totalTables = response.allTables.length
                    const startIndex = (currentPage - 1) * itemsPerPage
                    const endIndex = Math.min(startIndex + itemsPerPage, totalTables);


                    let tableData = '';
                    if (totalTables === 0) {
                        tableData = `
                        <tr>
                            <td colspan="2">
                                <p>No data</p>
                            </td>
                        </tr>`;
                    } else {
                        tableData = response.allTables
                            .slice(startIndex, endIndex)
                            .map(table => {
                                return `
                                <tr>
                                <td>
                                ${table.table_name}
                                </td>
                                <td>
                                ${table.tables_password}
                                </td>
                                <td>
                                <p ${table.tables_status == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.tables_status == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.tables_status}</p>
                                <form class="status-form-Required" data-table-id="${table.table_name}" action="/update/table/status/${table.table_name}" method="post">
                                @csrf
                                <label>
                                    <input type="radio" name="status" value="1" ${table.tables_status == 1 ? 'checked' : ''}>
                                    ยกเลิก
                                </label>
                                <label>
                                    <input type="radio" name="status" value="2" ${table.tables_status == 2 ? 'checked' : ''}>
                                    ว่าง
                                </label>
                                <!--
                                <label>
                                    <input type="radio" name="status" value="3" ${table.tables_status == 3 ? 'checked' : ''}>
                                    ไม่ว่าง
                                </label>
                                -->
                                <button type="submit" class="btn btn-success">เปลี่ยนสถานะ</button>
                                </form>
                                </td>
                                </tr>`;
                            })
                            .join('');
                    }

                    $('#table-all').html(tableData); // Update the content
                    const totalPages = Math.ceil(totalTables / itemsPerPage)
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
            getUpdateTables(selectedValue);
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

        getAllTables()
        selectedValue = bindInputChange('input1', 'output1')

        setInterval(function() {
            selectedValue = bindInputChange('input1');
            if (inputValue == null || inputValue === '') {
                getAllTables()
            } else {
                getUpdateTables(selectedValue)
            }
        }, 2000) // 2 seconds
        /*------------------------------------------------------------------------ */


        $(document).on('submit', '.status-form-Required', function(event) {
            event.preventDefault();

            var form = $(this);
            var tableId = form.data('table-id-Required');
            var formData = form.serialize();

            if (!$('input[name="status"]:checked', form).val()) {
                alert('กรุณาเลือกสถานะก่อน');
                return;
            }

            var confirmation = confirm('คุณแน่ต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่');
            if (confirmation) {
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    success: function(response) {},
                    error: function(error) {}
                });
            }
        });
    })
</script>

</html>
