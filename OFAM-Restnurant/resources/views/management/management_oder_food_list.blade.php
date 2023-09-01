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
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
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
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-purple ddy">
        <div class="container-fluid">
            <h2 class="navbar-brand">ชื่อร้าน</h2>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <h2 class="nav-link">{{ session('User')[0]->employees_id }} {{ session('User')[0]->employees_password }}</h2>
                    </li>
                    <li class="nav-item">
                        <h2 class="nav-link">{{ session('User')[0]->first_name }} {{ session('User')[0]->last_name }}</h2> <!-- style="background-color:yellow;" -->
                    </li>
                    <li class="nav-item">
                        <h2 class="nav-link">{{ session('User')[0]->first_name }} {{ session('User')[0]->last_name }}</h2> <!-- style="background-color:yellow;" -->
                    </li>
                    <li class="nav-item">

                        <h2 class="nav-link">{{ session('User')[0]->first_name }} {{ session('User')[0]->last_name }}</h2> <!-- style="background-color:yellow;" -->
                    </li>
                </ul>
                <div class="d-flex">
                    <h2 class="nav-link text-white">ผู้ใช้งาน {{ session('User')[0]->employees_id }} {{ session('User')[0]->employees_password }}</h2>
                <form  action="{{ route('management.logout') }}" method="post">
                    @csrf <!-- Add CSRF token for Laravel form -->
                    <button type="submit" class="btn btn-danger">
                        <img src="images/logout_FILL0_wght400_GRAD0_opsz24.png" alt="">
                        ออกจากระบบ
                    </button>
                </form>
            </div>
            </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <label for="selectSearch">ค้นหาด้วย</label>
                <select id="input1" name="selectSearch">
                    <option value="id">ชื่อโต๊ะ</option>
                    <option value="status">สถานะโต๊ะ</option>
                </select>
                <div id="output1">Output will be displayed here for Select 1</div>
                <label for="inputSearch">ค้น</label>
                <input type="text" id="searchInput" name="inputSearch" placeholder="Search Table ID"><br>
                <p id="outputSearch" name="outputSearchValue"></p>
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
                    // Assuming response.status_tables is an array of objects
                    const totalTables = response.allTables.length
                    const startIndex = (currentPage - 1) * itemsPerPage
                    const endIndex = Math.min(startIndex + itemsPerPage, totalTables);

                    let tableData = response.allTables
                        .slice(startIndex, endIndex)
                        .map(table => {
                            return `<!--<p>Table ID: ${table.table_id}, Name: ${table.status_tables}, ...</p>-->
                            <tr>
                                <td>
                                ${table.table_id}</td>
                                <td>
                                <p ${table.status_tables == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.status_tables == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.status_tables}</p>
                                <form class="status-form-Required" data-table-id="${table.table_id}" action="/update/table/status/${table.table_id}" method="post">
                                @csrf
                                <label>
                                    <input type="radio" name="status" value="1" ${table.status_tables == 1 ? 'checked' : ''}>
                                    ยกเลิก
                                </label>
                                <label>
                                    <input type="radio" name="status" value="2" ${table.status_tables == 2 ? 'checked' : ''}>
                                    ว่าง
                                </label>
                                <label>
                                    <input type="radio" name="status" value="3" ${table.status_tables == 3 ? 'checked' : ''}>
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
                                ${table.table_id}</td>
                                <td>
                                <p ${table.status_tables == 'ยกเลิกการใช้งาน' ? 'class="bg-danger text-white"' : table.status_tables == 'ว่าง' ? 'class="bg-success text-white"' : 'class="bg-warning text-white"'} >${table.status_tables}</p>
                                <form class="status-form-Required" data-table-id="${table.table_id}" action="/update/table/status/${table.table_id}" method="post">
                                @csrf
                                <label>
                                    <input type="radio" name="status" value="1" ${table.status_tables == 1 ? 'checked' : ''}>
                                    ยกเลิก
                                </label>
                                <label>
                                    <input type="radio" name="status" value="2" ${table.status_tables == 2 ? 'checked' : ''}>
                                    ว่าง
                                </label>
                                <label>
                                    <input type="radio" name="status" value="3" ${table.status_tables == 3 ? 'checked' : ''}>
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
