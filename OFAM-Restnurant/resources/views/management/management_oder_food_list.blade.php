<?php

use App\Models\Employee; //เพิ่มมาทีหลัง
$employees = Employee::all();
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
        /* Adjust table styles for smaller screens */
        @media (max-width: 360px) {

            .table th,
            .table td {
                font-size: 12px;
            }

            .table td img {
                max-width: 50px;
                /* Adjust image size */
                height: auto;
            }
        }

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

        .custom-nav-link:hover {
            background-color: #0dcaf0;
            /* Change this to your desired background color */
            color: white;
            /* Optionally, change the text color to make it readable */
        }

        .custom-nav-link-active:hover {
            background-color: #0dcaf0;
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

        .icon-size {
            height: 25px;
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
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <img class="icon-size spade-bar" src="images/store.png">
            <a class="navbar-brand">ชื่อร้าน</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent_test" aria-controls="navbarSupportedContent_test" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent_test">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="#">รายการโต๊ะ</a></li>
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link custom-nav-link-h width-90 text-center" href="#!">Contact</a></li>
                    @if(session('User')[0]->management_lavel == 'admin')
                    <li class="nav-item"><a class="nav-link custom-nav-link-h active width-90 text-center" aria-current="page" href="{{ route('management.admin.home')}}">จัดการร้าน</a></li>
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
                                        <img src="images/logout_FILL0_wght400_GRAD0_opsz24.png" alt="Logout">
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
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link-active width-150">โต๊ะ</a></li>
                    <li class="nav-item text-center"><a class="nav-link custom-nav-link width-150">รายการอาหาร</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <label for="selectSearch">ค้นหาด้วย</label>
                <select id="input1" name="selectSearch">
                    <option value="name">ชื่อโต๊ะ</option>
                    <option value="status">สถานะโต๊ะ</option>
                </select>
                <br><br>
                <!--<div id="output1">Output will be displayed here for Select 1</div>-->
                <label for="inputSearch">ค้นหา</label>
                <input type="text" id="searchInput" name="inputSearch" placeholder="Search Table ID"><br>
                <!--<p id="outputSearch" name="outputSearchValue"></p>-->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>โต๊ะ</th>
                            <th>สถานะโต๊ะ</th>
                            <!-- Add more table headers for other columns as needed -->
                        </tr>
                    </thead>
                    <tbody id="table-all">
                    </tbody><br>
                </table>
                <div id="pagination"></div>
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

    $(document).ready(function() {

        function bindInputChange(inputId, outputId) {
            const selectedValue = $('#' + inputId).val();
            $('#' + outputId).text(selectedValue);
            return selectedValue; // Return the selected value
        }

        let currentPage = 1 // Track the current page
        const itemsPerPage = 5 // Number of items to display per page

        var inputValue;

        var selectedValue;

        function updateTables() {
            $.ajax({
                type: 'GET',
                url: '/get-updated-tables',
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
                                <form class="goToUserView" action="/order/Table=${table.table_name}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">หน้าลูกค้า</button>
                                </form>
                                </td>
                                <td>
                                <p ${table.tables_status == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.tables_status == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.tables_status}</p>
                                <form class="status-form-Required" data-table-id="${table.table_name}" action="/update/table/status/${table.table_name}" method="post">
                                @csrf
                                <!--<label>
                                    <input type="radio" name="status" value="1" ${table.tables_status == 1 ? 'checked' : ''}>
                                    ยกเลิก
                                </label>-->
                                <label>
                                    <input type="radio" name="status" value="2" ${table.tables_status == 2 ? 'checked' : ''}>
                                    ว่าง
                                </label>
                                <label>
                                    <input type="radio" name="status" value="3" ${table.tables_status == 3 ? 'checked' : ''}>
                                    ไม่ว่าง
                                </label>
                                <button type="submit" class="btn btn-success">เปลี่ยนสถานะ</button>
                                </form>
                                </td>
                            </tr>`
                        })

                    $('#table-all').html(tableData.join('')) // Update the content

                    const totalPages = Math.ceil(totalTables / itemsPerPage)
                    if (totalPages > 1) {
                        $('#pagination').empty() // Clear pagination links
                        for (let i = 1; i <= totalPages; i++) {
                            $('#pagination').append(
                                `<button class="page-btn" data-page="${i}">${i}</button>`
                            )
                        }
                    }
                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        function updateTablesInput(selectedValue) {
            $.ajax({
                type: 'GET',
                url: '/get-updated-tables/' + inputValue + ',' + selectedValue,
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
                                ${table.table_name}</td>
                                <td>
                                <p ${table.tables_status == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.tables_status == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.tables_status}</p>
                                <form class="status-form-Required" data-table-id="${table.table_name}" action="/update/table/status/${table.table_name}" method="post">
                                @csrf
                                <!--<label>
                                    <input type="radio" name="status" value="1" ${table.tables_status == 1 ? 'checked' : ''}>
                                    ยกเลิก
                                </label>-->
                                <label>
                                    <input type="radio" name="status" value="2" ${table.tables_status == 2 ? 'checked' : ''}>
                                    ว่าง
                                </label>
                                <label>
                                    <input type="radio" name="status" value="3" ${table.tables_status == 3 ? 'checked' : ''}>
                                    ไม่ว่าง
                                </label>
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
                    if (totalPages > 1) {
                        $('#pagination').empty() // Clear pagination links
                        for (let i = 1; i <= totalPages; i++) {
                            $('#pagination').append(
                                `<button class="page-btn" data-page="${i}">${i}</button>`
                            )
                        }
                    }
                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        // Handle page navigation
        $(document).on('click', '.page-btn', function() {
            currentPage = parseInt($(this).data('page'))
            //updateTables()
        })

        updateTables()
        selectedValue = bindInputChange('input1', 'output1')

        setInterval(function() {
            selectedValue = bindInputChange('input1', 'output1');
            if (inputValue == null || inputValue === '') {
                updateTables()
            } else {
                updateTablesInput(selectedValue)
            }
        }, 2000) // 2 seconds
        /*------------------------------------------------------------------------ */

        $('#searchInput').on('keyup', function() {
            inputValue = $(this).val();
            if (/^\/+$/.test(inputValue)) {
                inputValue = 'null';
            }
            if (inputValue == null || inputValue == '') {
                $('#outputSearch').text('no input');
            } else {
                $('#outputSearch').text(inputValue);
            }

        });

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
