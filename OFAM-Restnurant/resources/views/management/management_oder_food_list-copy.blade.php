<?php

use App\Models\Employee; //เพิ่มมาทีหลัง
use App\Models\Table; //เพิ่มมาทีหลัง

$employees = Employee::all();
$tables = Table::all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOFL</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
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
                <form class="d-flex" action="{{ route('management.logout') }}" method="post">
                    @csrf <!-- Add CSRF token for Laravel form -->
                    <button type="submit" class="btn btn-danger">
                        <img src="images/logout_FILL0_wght400_GRAD0_opsz24.png" alt="">
                        ออกจากระบบ
                    </button>
                </form>
            </div>
    </nav>

    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <!--
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Image</th>
                        -->
                <!-- Add more table headers for other columns as needed -->
                <!--
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->employees_phone }}</td>
                            <td><img src="{{ asset('images/' . $employee->employees_picture) }}" alt=""></td>
                            -->
                <!-- Add more table cells for other columns as needed -->
                <!--
                        </tr>
                        @endforeach
                    </tbody><br>

                </table>-->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>โต๊ะ</th>
                            <th>สถานะโต๊ะ</th>
                            <!-- Add more table headers for other columns as needed -->
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->table_id }}</td>
                            <!--<td>{{ $table->status_tables }}</td>-->
                            <td>
                                <p id="table-status-{{ $table->table_id }}">{{ $table->status_tables }}</p>
                                <!--
                                <form class="status-form" data-table-id="{{ $table->table_id }}" action="{{ route('update.table.status', ['table_id' => $table->table_id]) }}" method="post">
                                    @csrf
                                    <input type="radio" id="cancel" name="status" value="1" {{ $table->status_tables == 1 ? 'checked' : '' }}>
                                    <label for="cancel">ยกเลิกการใช้งาน</label><br>
                                    <input type="radio" id="available" name="status" value="2" {{ $table->status_tables == 2 ? 'checked' : '' }}>
                                    <label for="available">ว่าง</label><br>
                                    <input type="radio" id="occupied" name="status" value="3" {{ $table->status_tables == 3 ? 'checked' : '' }}>
                                    <label for="occupied">ไม่ว่าง</label><br>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
    -->
                                <form class="status-form" data-table-id="{{ $table->table_id }}" action="/update/table/status/{{ $table->table_id }}" method="post">
                                    @csrf
                                    <input type="radio" id="cancel" name="status" value="1" {{ $table->status_tables == 1 ? 'checked' : '' }}>
                                    <label for="cancel">ยกเลิกการใช้งาน</label><br>
                                    <input type="radio" id="available" name="status" value="2" {{ $table->status_tables == 2 ? 'checked' : '' }}>
                                    <label for="available">ว่าง</label><br>
                                    <input type="radio" id="occupied" name="status" value="3" {{ $table->status_tables == 3 ? 'checked' : '' }}>
                                    <label for="occupied">ไม่ว่าง</label><br>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </td>
                            <!--
                            <td>
                                <form action="{{ route('update.table.status', ['table_id' => $table->table_id]) }}" method="post">
                                    @csrf --> <!-- Add CSRF token for Laravel form -->
                            <!--
                                    <input type="radio" id="cancel{{ $table->table_id }}" name="status" value="1" {{ $table->status_tables == 1 ? 'checked' : '' }}>
                                    <label for="cancel{{ $table->table_id }}">ยกเลิกการใช้งาน</label><br>
                                    <input type="radio" id="available{{ $table->table_id }}" name="status" value="2" {{ $table->status_tables == 2 ? 'checked' : '' }}>
                                    <label for="available{{ $table->table_id }}">ว่าง</label><br>
                                    <input type="radio" id="occupied{{ $table->table_id }}" name="status" value="3" {{ $table->status_tables == 3 ? 'checked' : '' }}>
                                    <label for="occupied{{ $table->table_id }}">ไม่ว่าง</label><br>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </td>
    -->
                        </tr>
                        @endforeach
                    </tbody><br>
                </table>
                @if(session('User')[0]->management_lavel == 'admin')
                <form action="{{ route('management.logout') }}" method="post">
                    @csrf <!-- Add CSRF token for Laravel form -->
                    <button type="submit" class="btn btn-danger">logout</button>
                </form>
                @endif
                <!--{{session('User')}}-->
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <select id="input1">
                                <option value="id">Option id</option>
                                <option value="status">Option status</option>
                            </select>
                            <div id="output1">Output will be displayed here for Select 1</div>
                            <p>.................. selectedValue1 </p>
                            <div id="selectedValue1">Output will be displayed here for Select 1</div>
                            <p>..................radioForm..................</p>
                            <p>..................</p>
                            <input type="text" id="searchInput" placeholder="Search Table ID">
                            <p id="outputSearch"></p>
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
            </div>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--<script src="{{ asset('js/update-status-table.js') }}"></script>-->$_COOKIE
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        function updateTableStatus(tableId) {
            $.ajax({
                type: 'GET', // Use GET request to fetch the latest status
                url: '/update/table/status/' + tableId, // Adjust the URL to your route
                success: function(response) {
                    $('#table-status-' + tableId).text(response.status_tables)
                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        // Automatically update table status every 5 seconds
        $('.status-form').each(function() {
            var tableId = $(this).data('table-id')
            setInterval(function() {
                updateTableStatus(tableId)
            }, 2000) // 1 seconds
        })

        /*-------------------------------------------------------------------------*/
        function bindInputChange(inputId, outputId) {
            const selectedValue = $('#' + inputId).val();
            $('#' + outputId).text(selectedValue);
            return selectedValue; // Return the selected value
        }



        /*------------------------------------------------------------------------ */
        let currentPage = 1 // Track the current page
        const itemsPerPage = 2 // Number of items to display per page

        var inputValue;

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
                                <td>${table.table_id}</td>
                                <td>
                                <p>${table.status_tables}</p>

                                <!--
                                <form class="status-form-Required" data-table-id-Required="${table.table_id}" action="/update/table/status/${table.table_id}" method="post">
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
                                <button type="submit">Submit</button>
                            </form>-->
                            <form class="status-form-Required" data-table-id="${table.table_id}" action="/update/table/status/${table.table_id}" method="post">
                                @csrf
                                <label>
                                    <input type="radio" name="status" value="1" ${table.status_tables === 1 ? 'checked' : ''}>
                                    ยกเลิก
                                </label>
                                <label>
                                    <input type="radio" name="status" value="2" ${table.status_tables === 2 ? 'checked' : ''}>
                                    ว่าง
                                </label>
                                <label>
                                    <input type="radio" name="status" value="3" ${table.status_tables === 3 ? 'checked' : ''}>
                                    ไม่ว่าง
                                </label>
                                <button type="submit">Submit</button>
                            </form>

                        </td>


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

        // $(document).on('submit', '.status-form-Required', function (event) {
        //     event.preventDefault();

        //     const form = $(this);
        // const tableId = form.attr('data-table-id-Required'); // Corrected line
        // const formData = form.serialize();

        // console.log('form:', form);
        // console.log('tableId:', tableId);
        // console.log('formData:', formData);
        //     if (!formData) {
        //         alert('กรุณาเลือกสถานะก่อน')
        //         return // Stop further processing
        //     }

        //     var confirmation = confirm('คุณแน่ต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่')
        //     if (confirmation) {
        //         // Execute actions when the user confirms
        //         $.ajax({
        //             type: 'POST',
        //             url: form.attr('action'),
        //             data: formData,
        //             success: function (response) {
        //                 // Update the content dynamically if needed
        //                 // You can add your own logic here
        //             },
        //             error: function (error) {
        //                 // Handle error if necessary
        //             }
        //         })
        //     }
        //     //window.location.href = `/edit-table/${tableId}`;
        // });

        function updateTablesInput(selectedValue) {
            $.ajax({
                type: 'GET',
                url: '/get-updated-tables/' + inputValue + ',' + selectedValue,
                success: function(response) {
                    /*
                    // Assuming response.status_tables is an array of objects
                    const table = response.allTables;
                    let tableData = '';

                    if (!response.allTables) {
                        tableData = `
                        <tr>
                            <td colspan="2">
                                <p>No data</p>
                            </td>
                        </tr>`;
                    } else {
                        tableData = `
                        <tr>
                            <td>${table.table_id}</td>
                            <td>
                                <p>${table.status_tables}</p>
                            </td>
                        </tr>`;
                    }
                    $('#table-all').html(tableData); // Update the content

                    $('#pagination').empty(); // Clear pagination links
                    */
                    // Assuming response.status_tables is an array of objects
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
                                    <td>${table.table_id}</td>
                                    <td>
                                        <p>${table.status_tables}</p>
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

        setInterval(function() {
            const selectedValue1 = bindInputChange('input1', 'output1');
            $('#selectedValue1').text(selectedValue1);
            if (inputValue == null || inputValue === '') {
                updateTables()
            } else {
                updateTablesInput(selectedValue1)
            }
        }, 3000) // 10 seconds
        /*------------------------------------------------------------------------ */

        $('#searchInput').on('keyup', function() {
            // Get the input value
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

        /*------------------------------------------------------------------------ */

        $('.status-form').submit(function(event) {
            event.preventDefault()

            var form = $(this)
            var tableId = form.data('table-id')
            var formData = form.serialize()
            //console.log('form' + form + ' |tableId' + tableId + ' |formData' + formData);
            console.log('form:', form);
            console.log('tableId:', tableId);
            console.log('formData:', formData);
            // Check if any radio button is selected
            if (!$('input[name="status"]:checked').val()) {
                alert('กรุณาเลือกสถานะก่อน')
                return // Stop further processing
            }

            // // Display a confirmation dialog
            var confirmation = confirm('คุณแน่ต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่')
            if (confirmation) {
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    success: function(response) {
                        // Update the content dynamically if needed
                        // You can add your own logic here
                        $('#table-status-' + tableId).text(response.status_tables)
                    },
                    error: function(error) {
                        // Handle error if necessary
                    }
                })
            }
        });

        $(document).on('submit', '.status-form-Required', function(event) {
            event.preventDefault();

            var form = $(this);

            var tableId = form.data('table-id-Required');
            var formData = form.serialize();
            /*            //console.log('form' + form + ' |tableId' + tableId + ' |formData' + formData);
                        console.log('form:', form);
                        console.log('tableId:', tableId);
                        console.log('formData:', formData);
            */
            // Check if any radio button is selected
            if (!$('input[name="status"]:checked', form).val()) {
                alert('กรุณาเลือกสถานะก่อน');
                return; // Stop further processing
            }

            // Display a confirmation dialog
            var confirmation = confirm('คุณแน่ต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่');
            if (confirmation) {
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    success: function(response) {
                        // Update the content dynamically if needed
                        // You can add your own logic here
                        // $('#table-status-' + tableId).text(response.status_tables)
                    },
                    error: function(error) {
                        // Handle error if necessary
                    }
                });
            }
        });


    })
</script>




</html>
