<?php

use App\Models\restaurantInfo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\table;

$tableName = Route::current()->parameter('table_name');
$tableId = Table::where('table_name', $tableName)->get();
$menu_categories = DB::table('menu_categories')->get();
/*$menu = Menu::select([
    'menus.menu_id as menu_id',
    'menus.menu_name as menu_name',
    'menus.menu_image as menu_image',
    'menus.menu_status as menu_status',
    'menu_categories.menu_category_name as menu_category_name',
    'ph.price as price',
])
    ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.menu_category_id')
    ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
        $join->on('menus.menu_id', '=', 'ph.menu_id');
    })
    ->orderBy('menu_category_name', 'asc')
    ->orderBy('menus.menu_id', 'asc')
    ->get();*/

// $order = DB::table('food_orders as fo')
//     ->select([
//         'fo.food_order_id as food_order_id',
//         't.table_name as table_name',
//         'm.menu_name as menu_name',
//         'm.menu_image as menu_image',
//         'fo.food_amount as food_amount',
//         'fo.food_order_status as food_order_status'
//     ])
//     ->leftJoin('tables as t', function ($join) {
//         $join->on('fo.table_id', '=', 't.table_id');
//     })
//     ->leftJoin('menus as m', function ($join) {
//         $join->on('fo.menu_id', '=', 'm.menu_id');
//     })
//     ->where('t.table_name', $tableName)
//     ->whereBetween('fo.food_order_status', [1, 4])
//     ->orderBy(DB::raw("CASE
//         WHEN fo.food_order_status = 'รอชำระเงิน' THEN 1
//         WHEN fo.food_order_status = 'สั่ง' THEN 2
//         WHEN fo.food_order_status = 'กำลังปรุง' THEN 3
//         WHEN fo.food_order_status = 'เสริฟแล้ว' THEN 4
//         ELSE 5
//     END"))
//     ->get();

// if (count($order) > 0) {
//     $newOder = [];
//     for ($i = 0; $i < sizeof($order); $i++) {
//         print($order[$i]->menu_name . "    " . $order[$i]->food_amount . "    " . $order[$i]->food_order_status . "<br>");
//     }
//     // foreach ($order as $order) {
//     //     print($order->menu_name . "    " . $order->food_amount . "    " . $order->food_order_status . "<br>");
//     // }
//     print("<br>newOder<br>");
//     foreach ($order as $item) {
//         $menuName = $item->menu_name;
//         $foodAmount = $item->food_amount;
//         $foodStatus = $item->food_order_status;

//         if (!isset($newOrder[$menuName])) {
//             $newOrder[$menuName] = [
//                 'menu_name' => $menuName,
//                 'food_amount' => $foodAmount,
//                 'food_order_status' => $foodStatus
//             ];
//         } else {
//             $newOrder[$menuName]['food_amount'] += $foodAmount;
//         }
//     }
//     foreach ($newOrder as $item) {
//         print($item['menu_name'] . "    " . $item['food_amount'] . "    " . $item['food_order_status'] . "<br>");
//     }
// }

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
            /*color: white;*/
            /* Optionally, change the text color to make it readable */
            cursor: pointer;
            margin-top: 5px;
            margin-left: 5px;
            border-radius: 10px;
        }


        .custom-nav-link-yellow {
            background-color: #c0b17f;
            /* Change this to your desired background color */
            /*color: white;*/
            /* Optionally, change the text color to make it readable */
            cursor: pointer;
            margin-top: 5px;
            margin-left: 5px;
            border-radius: 10px;
        }

        .custom-nav-link-active {
            background-color: #0dcaf0;
            /* Change this to your desired background color */
            /*color: white;*/
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
            filter: brightness(0) invert(0.8);
        }

        .icon-size-active {
            height: 25px;
            /*filter: brightness(0) invert(1);*/
        }

        .icon-size-no-brightness {
            height: 25px;
            margin-right: 10px;
        }

        .image {
            height: 60px;
            width: 60px;
        }

        .image-small {
            height: 30px;
            width: 30px;
        }

        .image-smalls {
            height: 20px;
            width: 20px;
        }

        .image-show {
            height: 130px;
            width: 130px;
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

        /* */
        .tabs-container {
            overflow-x: auto;
            white-space: nowrap;
            height: 70px;
        }

        .tabs-box {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .tab {
            padding: 20px;
            cursor: pointer;
            color: #B0B0B0;
            font-weight: bold;
            height: 60px;
        }

        .tab-basket {
            padding: 20px;
            cursor: pointer;
            color: #000000;
            font-weight: bold;
            height: 100px;
            margin-top: 5px;
        }

        .tab-basket-text-normal {
            padding: 20px;
            cursor: pointer;
            color: #000000;
            height: 120px;
            margin-top: 5px;
        }

        .tab-bar {
            padding: 15px;
            cursor: pointer;
            color: #B0B0B0;
            font-weight: bold;
        }

        .tab.active {
            border-bottom: 2px solid #fff;
            /* Change the color as needed */
            color: #20B7D3;
            font-size: large;
            font-weight: bold;
        }

        .nav-divider {
            height: 1px;
            width: 100%;
            background-color: #CECECE;
            /* Set the background color to match your design */
        }

        .p-center {
            text-align: center;
            justify-content: center;
        }

        @media (max-width: 350px) {
            body {
                width: 350px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="position: sticky;top: 0%;background-color: white;">
        <div class="container-fluid text-center">
            <div style="width: 200px;border-style: solid;border-radius: 50px;border-color: #CECECE;">
                <img class="icon-size-active spade-bar" src="{{ asset('images/dinner-table.png') }}">
                <a style="color: black;" class="navbar-brand">|โต๊ะ {{ $tableName }}</a>
            </div>
            <!-- First Line: Menu Icons -->
            <div class="row">
                <div class="col" data-bs-toggle="modal" data-bs-target="#exampleModal_1">
                    <a onclick="checkBasket()" class=""><img id="basket-icon" class="icon-size spade-bar" src="{{ asset('images/shopping-basket.png') }}"></a>
                </div>
                <div class="col" data-bs-toggle="modal" data-bs-target="#exampleModal_2">
                    <a onclick="checkOrderList()" class=""><img id="oderList-icon" class="icon-size spade-bar" src="{{ asset('images/order.png') }}"></a>
                </div>
            </div>
        </div>

    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark justify-content-center align-items-center" style="position: sticky;top: 5.5%;background-color: white;">
        <label for="inputSearch"><img class="icon-size-active spade-bar" src="{{ asset('images/magnifying-glass.png') }}"></label>
        <input style="width: 80vw; border-style: solid; border-radius: 50px; border-color: #CECECE;padding-left: 10px;" type="text" id="searchInput" name="inputSearch">
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark justify-content-center align-items-center" style="position: sticky;top: 10.2%;background-color: white;margin-left: 5%;margin-right: 5%;">
        <div class="tabs-container">
            <ul class="tabs-box" id="tabs">
                <li class="tab active" data-value="0">ทุกเมนู</li>
                <li class="tab-bar">|</li>
                @foreach ($menu_categories as $menu_categorie)
                <li class="tab" data-value="{{$menu_categorie->menu_category_id}}">{{$menu_categorie->menu_category_name}}</li>
                <li class="tab-bar">|</li>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="container" style="height: 900px;">
        <div class="row mt-3">
            <div class="col-lg-12" id="table-all">
            </div>
        </div>
    </div>

</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 80vh;margin: auto;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button id="itemAmountPrice" type="button" class="btn btn-primary" disabled>เพิ่มไปยังตะกร้า</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: auto;margin: auto;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><img class="icon-size-active spade-bar" src="{{ asset('images/shopping-basket.png') }}">ตะกร้า</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tabs-container" style="height: 60vh;width: auto;">
                    <div class="tabs-box flex-column" id="table-all-basket">
                        <!--<div class="tab active" data-value="0">ทุกเมนู</div>
                        @foreach ($menu_categories as $menu_categorie)
                        <div class="tab" data-value="{{$menu_categorie->menu_category_id}}">{{$menu_categorie->menu_category_name}}</div>
                        @endforeach-->
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="height: 60px;">
                <button id="oderMenus" type="button" class="btn btn-success" disabled>สั่ง</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: auto;margin: auto;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><img class="icon-size-active spade-bar" src="{{ asset('images/order.png') }}">รายการอาหาร</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tabs-container" style="height: 60vh;width: auto;">
                    <div class="tabs-box flex-column" id="table-all-orderlist">
                        <!--<div class="tab active" data-value="0">ทุกเมนู</div>
                        @foreach ($menu_categories as $menu_categorie)
                        <div class="tab" data-value="{{$menu_categorie->menu_category_id}}">{{$menu_categorie->menu_category_name}}</div>
                        @endforeach-->
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-evenly" style="height: 100px;">
                <div>
                    <p id="total-price">ยอดรวม:0฿</p>
                </div>
                <div><button id="payment" type="button" class="btn btn-info" style="color: #fff;" disabled>ชำระเงิน</button></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var foodIdSelect;
    let foodPriceSelect;
    let itemAmount = 0;
    let foodImage;
    let foodName;

    var tableName;
    var tableId;
    var category = 0;
    var inputSearchValue;
    let basket = false;
    let orderList = false;

    function showMenu(menuId, menuImage, menuName, menuPrice) {
        // Set the image variable

        foodIdSelect = 0;
        foodPriceSelect = 0
        itemAmount = 0;
        foodImage = null;
        foodName = null;
        checkItemAmount(itemAmount);
        updateItemAmount();


        foodIdSelect = menuId;
        foodName = menuName;
        foodPriceSelect = menuPrice;
        foodImage = menuImage;

        // Update the modal title with the clicked menu name
        var modalTitle = $('#exampleModal').find('.modal-title');
        modalTitle.html('<h1 class="modal-title fs-5" id="exampleModalLabel">' + menuName + '</h1>');

        // Update the modal body with the clicked menu image
        var modalBody = $('#exampleModal').find('.modal-body');

        modalBody.html(`
        <div class="text-center" ><img class="image-show" style="border-radius: 10px;" src="{{ asset("images/menu/") }}/${foodImage}"></div>
        <br><div><H5>฿${menuPrice}</H5></div><br><br><br>
        <div class="text-center row" >
            <div class="col">
            <img id="minusButton" class="image-small spade-bar" style="border-radius: 10px;" src="{{ asset("images/minus.png") }}">
            </div>
            <div class="col text-center">
                <H5 id="itemAmount">0</H5>
            </div>
            <div class="col" >
            <img id="addButton" class="image-small spade-bar" style="border-radius: 10px;" src="{{ asset("images/add.png") }}">
            </div>
        </div>
        `);
        // Show the modal
        $('#exampleModal').modal('show');
    }

    // Event listener for the "minus" button
    $(document).on('click', '#minusButton', function() {
        if (itemAmount > 0) {
            itemAmount--;
            checkItemAmount(itemAmount);
            updateItemAmount();

        }
    });

    $(document).on('click', '#addButton', function() {
        itemAmount++;
        checkItemAmount(itemAmount);
        updateItemAmount();
    });

    function minusAmountBasket(name, amount) {
        if (amount > 1) {
            /*console.log("minus");
            console.log("naem:" + name + "\n ole amount:" + amount + "\n new amount:" + (amount - 1));*/
            $.ajax({
                type: 'GET',
                url: '/user/table/minusAmountBasket',
                data: {
                    menuAmount: amount - 1,
                    menuName: name
                },
                success: function(response) {

                },
                error: function(error) {
                    // Handle error if necessary
                }

            });
            renderBasket();
        }
    }

    function addAmountBasket(name, amount) {
        /*console.log("add");
        console.log("naem:" + name + "\n ole amount:" + amount + "\n new amount:" + (amount + 1));*/
        $.ajax({
            type: 'GET',
            url: '/user/table/addAmountBasket',
            data: {
                menuAmount: amount + 1,
                menuName: name
            },
            success: function(response) {

            },
            error: function(error) {
                // Handle error if necessary
            }

        });
        renderBasket();
    }

    function removeBasket(name) {
        /*console.log("add");
        console.log("naem:" + name + "\n ole amount:" + amount + "\n new amount:" + (amount + 1));*/
        $.ajax({
            type: 'GET',
            url: '/user/table/removeBasket',
            data: {
                menuName: name
            },
            success: function(response) {

            },
            error: function(error) {
                // Handle error if necessary
            }

        });
        checkBasket();
        renderBasket();
    }

    // Event listener for the "add" button
    $(document).on('click', '#oderMenus', function() {
        oderMenusToData();
        clearSession();
        checkBasket();
        checkOrderList();
        //renderBasket();
        //renderOrderList();
        $('#exampleModal_1').modal('hide');
    });

    function oderMenusToData() {
        $.ajax({
            type: 'GET',
            url: '/user/table/oderMenus',
            data: {
                tableId: tableId,
            },
            success: function(response) {
            },
            error: function(error) {
                // Handle error if necessary
            }
        })
    }

    // Function to update the displayed item amount
    function updateItemAmount() {
        $('#itemAmount').text(itemAmount);
        updateItemAmountPrice();
    }

    function updateItemAmountPrice() {
        $('#itemAmountPrice').text("เพิ่มไปยังตะกร้า - ฿" + (itemAmount * foodPriceSelect));
    }

    $(document).on('click', '#itemAmountPrice', function() {
        //console.log("เมนู id:" + foodIdSelect + "\nจำนวน:" + itemAmount);
        $.ajax({
            type: 'GET',
            url: '/user/table/putMenuToBasket',
            data: {
                menuId: foodIdSelect,
                menuAmount: itemAmount,
                menuImage: foodImage,
                menuName: foodName
            },
            success: function(response) {
                /*for (let index = 0; index < response.basket.length; index++) {
                    console.log("basket id:" + response.basket[index].id + " image:" + response.basket[index].image + " amount:" + response.basket[index].amount);
                }*/
                /*
                    let tableData;
                    tableData = response.basket.map(menu => {
                        return `
                                <div class="tab">
                                    <div class="col-auto d-flex align-items-center">
                                        <div>
                                            <img class="image spade-bar" style="border-radius: 10px;" src="{{ asset('images/menu/${menu.image}' ) }}" alt="">
                                            <p>${menu.name}</p>
                                        </div>
                                        <div>
                                            <p>฿${menu.amount}</p>
                                        </div>
                                    </div>
                                </div>`;
                    });
                    $('#table-all-basket').html(tableData.join(''));
                */
            },
            error: function(error) {
                // Handle error if necessary
            }

        })

        renderBasket();
        $('#exampleModal').modal('hide');
        checkBasket();
    });

    function clearSession() {
        $.ajax({
            type: 'GET',
            url: '/user/table/clear-session',
        })
    }

    function checkItemAmount(itemAmount) {
        if (itemAmount == 0) {
            itemAmountPrice.disabled = true;
        } else {
            itemAmountPrice.disabled = false;
        }
    }

    function checkBasket() {
        let iconBasket = document.getElementById('basket-icon');
        $.ajax({
            type: 'GET',
            url: '/user/table/checkBasket',
            success: function(response) {
                basket = response.basket;
                if (basket == false) {
                    oderMenus.disabled = true;
                    iconBasket.classList.remove('icon-size-active');
                    iconBasket.classList.add('icon-size');
                } else {
                    oderMenus.disabled = false;
                    iconBasket.classList.remove('icon-size');
                    iconBasket.classList.add('icon-size-active');
                }
            },
            error: function(error) {
                // Handle error if necessary
            }
        });
        renderBasket();
    }

    function checkOrderList() {
        let iconOrderList = document.getElementById('oderList-icon');
        $.ajax({
            type: 'GET',
            url: '/user/table/checkOrderList',
            data: {
                nameTable: tableName,
            },
            success: function(response) {
                orderList = response.orderList;
                if (orderList == false) {
                    iconOrderList.classList.remove('icon-size-active');
                    iconOrderList.classList.add('icon-size');
                } else {
                    iconOrderList.classList.remove('icon-size');
                    iconOrderList.classList.add('icon-size-active');
                }
            },
            error: function(error) {
                // Handle error if necessary
            }
        });
        renderOrderList();

    }

    function checkPayment(paymentStatus) {
        if (paymentStatus == false) {
            payment.disabled = true;
        } else {
            payment.disabled = false;
        }
    }

    $(document).on('click', '#payment', function() {
        let confirmation = confirm('คุณต้องการชำระเงินใช่หรือไม่');
        if (confirmation) {
            console.log("Payment done");
        }
        $('#exampleModal_1').modal('hide');
    });

    function renderBasket() {
        $.ajax({
            type: 'GET',
            url: '/user/table/renderBasket',
            success: function(response) {
                let tableData;
                if (response.basket && response.basket.length > 0) {
                    tableData = response.basket.map(menu => {
                        return `
                        <div class="tab-basket-text-normal">
                            <div class="row-auto d-flex align-items-center">
                                <div class="col align-items-center" style="width: 70px;">
                                        <img class="image spade-bar" style="border-radius: 10px;" src="{{ asset('images/menu/${menu.image}' ) }}" alt="">
                                        <p>${menu.name}</p>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-evenly">
                                    <img  onclick="minusAmountBasket('${menu.name}',${menu.amount})" class="image-smalls spade-bar" style="border-radius: 10px;" src="{{ asset("images/minus.png") }}">
                                        <p class="text-center" style="width: 30px;" >${menu.amount}</p>
                                    <img onclick="addAmountBasket('${menu.name}',${menu.amount})" class="image-smalls spade-bar" style="border-radius: 10px;" src="{{ asset("images/add.png") }}">
                                </div>
                                <div class="col d-flex align-items-center justify-content-end" style="width: 50px;">
                                    <button onclick="removeBasket('${menu.name}')" type="button" class="btn btn-danger"><img class="image-smalls spade-bar" style="border-radius: 10px;" src="{{ asset("images/bin.png") }}"></button>
                                </div>
                            </div>
                        </div>`;
                    });
                    $('#table-all-basket').html(tableData.join(''));
                } else {
                    // Handle the case when response.basket is null or empty
                    // You can display a message or take appropriate action
                    $('#table-all-basket').html('<p></p>');
                }
            },
            error: function(error) {
                // Handle error if necessary
            }
        })
    }

    function renderOrderList() {

        $.ajax({
            type: 'GET',
            url: '/user/table/renderOrderList',
            data: {
                nameTable: tableName,
            },
            success: function(response) {
                let tableData;
                let tablePrice = 0;
                let allServe = true;
                //console.log(response.orderList);
                if (response.orderList.length <= 0) {
                    allServe = false;
                }
                if (response.orderList && response.orderList.length > 0) {
                    tableData = response.orderList.map(menu => {
                        tablePrice += (menu.menu_price * menu.food_amount);
                        if (menu.food_order_status != 'เสริฟแล้ว') {
                            allServe = false;
                        }
                        return `
                        <div class="tab-basket-text-normal">
                            <div class="row-auto d-flex align-items-center">
                                <div class="col align-items-center" style="width: 70px;">
                                        <img class="image spade-bar" style="border-radius: 10px;" src="{{ asset('images/menu/${menu.menu_image}' ) }}" alt="">
                                        <p>${menu.menu_name}</p>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-evenly">

                                <p class="text-center" style="width: 30px;" >จำนวน:${menu.food_amount}<br>ราคา:฿${menu.menu_price}<br>ราคารวม:฿${menu.menu_price*menu.food_amount}</p>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end" style="width: 50px;">
                                    <p type="button" style="width: 100px;" ${menu.food_order_status == 'สั่ง' ? 'class="btn btn-danger text-white"' : menu.food_order_status == 'กำลังปรุง' ? 'class="btn btn-warning text-white"' : menu.food_order_status == 'เสริฟแล้ว' ? 'class="btn btn-info text-white"' :menu.food_order_status == 'รอชำระเงิน' ? 'class="btn btn-primary text-white"' :'class="btn "'}>${menu.food_order_status}</p>
                                </div>
                            </div>
                        </div>`;
                    });
                    $('#table-all-orderlist').html(tableData.join(''));
                    $('#total-price').html("ยอดรวม:" + tablePrice + " ฿");
                } else {
                    // Handle the case when response.basket is null or empty
                    // You can display a message or take appropriate action
                    $('#table-all-orderlist').html('<p></p>');
                }
                checkPayment(allServe);
            },
            error: function(error) {
                // Handle error if necessary
            }
        });

    }

    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            inputValue = $(this).val();
            if (/^\/+$/.test(inputValue)) {
                inputSearchValue = 'null'; // Update inputSearchValue
            } else {
                inputSearchValue = inputValue; // Update inputSearchValue with the actual input value
            }
            getAllMenu();
        });

        $(".tab").click(function() {
            // Remove active class from all tabs
            $(".tab").removeClass("active");

            // Add active class to the clicked tab
            $(this).addClass("active");

            // Log the value of the clicked tab
            category = $(this).data("value");
            document.getElementById("searchInput").value = "";
            inputSearchValue = null;
            getAllMenu();

        });

        function getAllMenu() {
            $.ajax({
                type: 'GET',
                url: '/user/table/get-all-menu',
                data: {
                    category: category,
                    name: inputSearchValue
                },
                success: function(response) {
                    // Assuming response.tables_status is an array of objects
                    let tableData;

                    if (response.allMenus && response.allMenus.length > 0) {
                        tableData = response.allMenus.map(menu => {
                            return `
                            <div class="mb-3 row" onclick="showMenu('${menu.menu_id}','${menu.menu_image}','${menu.menu_name}','${menu.price}')" >
                                <div class="col-auto d-flex align-items-center">
                                    <img class="image spade-bar" style="border-radius: 10px;" src="{{ asset('images/menu/${menu.menu_image}' ) }}" alt="">
                                    <div>
                                        <h4>${menu.menu_name}</h4>
                                        <p>฿${menu.price}</p>
                                    </div>
                                </div>
                                </div>
                                <div class="high-50 d-flex align-items-center">
                                <div class="nav-divider"></div>
                            </div>`;
                        });
                    } else {
                        // Handle the case when allMenus is null or an empty array
                        tableData = ['<p>ไม่พบเมนูที่คุณค้นหา</p>'];
                    }

                    $('#table-all').html(tableData.join('')) // Update the content

                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }

        tableName = "{{ $tableName }}";
        tableId = "{{$tableId[0]->table_id}}"
        getAllMenu();
        checkBasket();
        checkOrderList();

        function checkAll() {
            checkBasket();
            checkOrderList();
        }

        document.addEventListener('click', checkAll);

    });
</script>

</html>
