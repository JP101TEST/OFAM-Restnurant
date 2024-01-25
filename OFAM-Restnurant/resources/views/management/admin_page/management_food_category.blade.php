<?php

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
            background-color: #60784F;
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

        .popup td {
            color: black;
        }

        .popup:hover td {
            color: red;
            cursor: pointer;
            font-weight: 500;
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
                <h4 class="text-center">หมวดหมู่</h4>
                <label for="inputSearch">ค้นหา</label>
                <input type="text" id="searchInput" name="inputSearch" placeholder="ชื่อหมวดหมู่"><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">หมวดหมู่</th>
                        </tr>
                    </thead>
                    <tbody id="category-all">
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 90vh;margin: auto;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขชื่อหมวดหมู่</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 id="displayError" class="text-center" style="color:red;display: block;"></h6>
                <div id="bodyPopup" class="text-center">
                    <label for="inputNewNameCategory">ชื่อหมวดหมู่</label>
                    <input type="text" name="" id="inputNewNameCategory" style="width: 50%;border-radius: 8px;padding-left: 10px;">
                </div><br><br>
                <div id="endPopupclickChange" class="d-flex justify-content-center align-items-end">
                    <button class="btn bg-green" style="width: 150px; border-radius: 10px; height: 50px;">
                        แก้ไข
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var searchValue = null;
    var errorInput = false;
    var menuCategoryIdToChange = null;
    let currentPage = 1;
    const itemsPerPage = 10;

    function showPopup(menuCategoryId) {
        errorInput = false;
        menuCategoryIdToChange = menuCategoryId;
        hidShowError();
        $('#inputNewNameCategory').val('');
        $('#exampleModal').modal('show');
    }

    function hidShowError() {
        if (errorInput == true) {
            displayError.style.display = 'block';
        } else {
            displayError.style.display = 'none';
        }
    }

    function getAllcategory(searchValue) {
        $.ajax({
            type: 'GET',
            url: '/management-admin/food/category/edit/get-all',
            data: {
                searchValue: searchValue,
            },
            success: function(response) {


                const totalCategory = response.allCategory.length
                if (currentPage > Math.ceil(totalCategory / itemsPerPage)) {
                    currentPage = 1;
                }
                const startIndex = (currentPage - 1) * itemsPerPage
                const endIndex = Math.min(startIndex + itemsPerPage, totalCategory);

                let tableData = ``;
                if (totalCategory === 0) {
                    tableData = `
                        <tr>
                            <td colspan="4">
                                <p>ไม่พบข้อมูล</p>
                            </td>
                        </tr>`;
                } else {
                    tableData = response.allCategory
                        .slice(startIndex, endIndex)
                        .map(category => {
                            return `
                            <tr class="popup" onclick="showPopup(${category.menu_category_id});">
                                <td>${category.menu_category_name}</td>
                            </tr>
                            `
                        }).join('');
                }

                $('#category-all').html(tableData) // Update the content

                const totalPages = Math.ceil(totalCategory / itemsPerPage);

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
        getAllcategory(searchValue);
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

    $('#searchInput').on('keyup', function() {
        searchValue = $(this).val();
        getAllcategory(searchValue);
    });

    $('#endPopupclickChange').on('click', function() {
        $.ajax({
            type: 'GET',
            url: '/management-admin/food/category/edit/change',
            data: {
                newNameCategory: $('#inputNewNameCategory').val(),
                menuCategoryIdToChange: menuCategoryIdToChange,
            },
            success: function(response) {
                errorInput = response.sameNameIndatabase;
                if (errorInput == true) {
                    $('#displayError').html(`${response.errorMessage}`);
                    hidShowError();
                }else{
                    $('#exampleModal').modal('hide');
                }
                getAllcategory(searchValue);
            },
            error: function(error) {

            }
        })
    });

    $(document).ready(function() {
        getAllcategory(searchValue);
    })
</script>

</html>
