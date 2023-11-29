<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

//ลบ ; จาก extension=gd ใน php8.1.0\php.ini
//คำสั่งค้นหา php --ini
//เมื่อทำเสร็จก็  restar
//composer require simplesoftwareio/simple-qrcode เพื่อลง libery
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\menu;

class UserController extends Controller
{
    //
    public function goHomepageWithGet($table_name)
    {

        $url = url()->current();
        /*print($table_name . "<br>");*/
        $table = Table::where('table_name', $table_name)->firstOrFail();
        /*print($table . "<br>");
        print($url . "<br>");*/
        // Generate the QR code
        $qrCode = QrCode::format('png')->size(200)->generate($url);

        // Save the QR code as an image file (you can customize the file path and name)
        $fileName = $table_name . '_qrcode.png'; // Construct the filename
        $filePath = public_path('images/QrCode/' . $table_name . '_qrcode.png');
        file_put_contents($filePath, $qrCode);
        echo  "<img src='{{ asset('images/QrCode/'.$fileName) }}' alt='QR Code'>";
        // Other code...
        return view('user/user_home', compact('table_name', 'fileName'));
        //return view('user/user_home');
        //return view('management/admin_page/management_home');
    }

    public function goHomepageWithGetQ($table_name)
    {

        $url = url()->current();
        /*print($table_name . "<br>");*/
        $table = Table::where('table_name', $table_name)->firstOrFail();
        /*print($table . "<br>");
        print($url . "<br>");*/
        // Generate the QR code
        $qrCode = QrCode::format('png')->size(200)->generate($url);

        // Save the QR code as an image file (you can customize the file path and name)
        $fileName = $table_name . '_qrcode.png'; // Construct the filename
        $filePath = public_path('images/QrCode/' . $table_name . '_qrcode.png');
        file_put_contents($filePath, $qrCode);
        echo "<img src='" . asset("images/QrCode/$fileName") . "' alt='QR Code'>";
    }

    public function generateQrCode()
    {
        $table_name = Route::current()->parameter('table_name');
        $table_password = Route::current()->parameter('table_password');
        //$url = url()->current();
        $url = url()->to("/order/Table={$table_name},PassWord={$table_password}");
        //print($url);
        // Generate the QR code
        $qrCode = QrCode::format('png')->size(300)->generate($url);

        // Load the QR code image using GD
        $baseImage = imagecreatefromstring($qrCode);

        // Calculate the position to start the text
        $textX = 10; // X-coordinate
        $textY = imagesy($baseImage) + 50; // Y-coordinate for the text lines

        // Calculate the new image dimensions with extra space around the QR code
        $newWidth = imagesx($baseImage) + 40; // Increase width by 40 pixels
        $newHeight = imagesy($baseImage) + 150; // Increase height by 40 pixels

        // Create a new image with the increased dimensions
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Fill the new image with a white background
        $white = imagecolorallocate($newImage, 255, 255, 255);
        imagefill($newImage, 0, 0, $white);

        // Copy the QR code onto the new image with extra space
        imagecopy($newImage, $baseImage, 20, 20, 0, 0, imagesx($baseImage), imagesy($baseImage));

        // Create a color for the text
        $textColor = imagecolorallocate($newImage, 0, 0, 0); // Black

        $date = date("Y-m-d H:i:s");
        // Define the text lines to add at the bottom
        $textLines = [
            "หมายเลขโต๊ะ: $table_name",
            "รหัสผ่านโต๊ะ: $table_password",
            "วัน เวลา: $date",
        ];

        // Define the text size (font size)
        $textSize = 16;

        // Add each line of text to the new image with the specified font size
        foreach ($textLines as $line) {
            imagettftext($newImage, $textSize, 0, $textX, $textY, $textColor, public_path('font/Kanit-Light.ttf'), $line);
            $textY += 30; // Increase Y-coordinate for the next line with space
        }

        // Output the final image as a PNG
        header('Content-Type: image/png');
        //imagepng($newImage);

        // Clean up resources
        imagedestroy($baseImage);
        imagedestroy($newImage);

        // You can still save the image to a file if needed
        $fileName = $table_name . '_qrcode.png'; // Construct the filename
        $filePath = public_path('images/QrCode/' . $table_name . '_qrcode.png');
        file_put_contents($filePath, $qrCode);
        imagepng($newImage, $filePath);

        // Display the image using the asset() function
        echo "<img src='" . asset("images/QrCode/$fileName") . "' alt='QR Code'><br>";

        echo '
<style>
    .custom-back-button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        width: 300px; /* Add the unit, e.g., pixels */
        font-size: 20px;
    }
</style>
';

        // Add a "Print" button
        echo '<button onclick="printImage()" class="custom-back-button">ปริ้น</button><br><br>';

        // Add a "Back" button
        echo '<button onclick="goBack()" class="custom-back-button">ย้อนกลับ</button>';

        // JavaScript function to print the displayed image
        echo '<script>
    function printImage() {
        var img = new Image();
        img.src = "' . asset("images/QrCode/$fileName") . '";
        var printWindow = window.open("", "", "width=600,height=600");
        printWindow.document.open();
        printWindow.document.write("<html><head><title>Print QR Code</title></head><body>");
        printWindow.document.write("<img src=\"" + img.src + "\" onload=\"window.print(); printWindow.close();\">");
        printWindow.document.write("</body></html>");
        printWindow.document.close();
    }
</script>';

        echo '<script>
    function goBack() {
        window.history.back();
    }
</script>';
    }

    public function goHomepageWithGetP($table_name, $table_password)
    {
        $table = Table::where('table_name', $table_name)->firstOrFail();
        if ($table->tables_password == $table_password) {
            $fileName = $table_name . '_qrcode.png';
            // Other code...
            return view('user/user_home', compact('table_name', 'fileName'));
            //return view('user/user_home');
            //return view('management/admin_page/management_home');
        } else {
            print("error password");
        }
    }

    public function getAllMenu()
    {
        $category = request('category');
        $search = trim(request('name'));
        /*if ($category == 0 && $search != null) {
            $allMenu = Menu::select([
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
                ->where('mmenus.menu_name', 'LIKE', "%$search%")
                ->orderBy('menu_category_name', 'asc')
                ->orderBy('menus.menu_id', 'asc')
                ->get();
        }else if ($category != 0 && $search == null) {
            $allMenu = Menu::select([
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
                ->where('menu_categories.menu_category_id', $category)
                ->orderBy('menu_category_name', 'asc')
                ->orderBy('menus.menu_id', 'asc')
                ->get();
        } else {
            $allMenu = Menu::select([
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
                ->get();
        }*/

        $allMenu = Menu::select([
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
            ->orderBy('menus.menu_id', 'asc');


        if ($search) {
            $allMenu->where('menus.menu_name', 'LIKE', "%$search%");
        } elseif ($category > 0 && !$search) {
            $allMenu->where('menu_categories.menu_category_id', $category);
        }

        // Execute the query and get the result
        $allMenu = $allMenu->get();

        return response()->json(['allMenus' => $allMenu]);
    }

    public function getPutMenuToBasket()
    {
        $menuId = request('menuId');
        $menuName = request('menuName');
        $menuAmount = request('menuAmount');
        $menuImage = request('menuImage');
        $existingItem = false;
        //$basket = [['id' => $menuId, 'amount' => $menuAmount]];

        // Initialize the basket if it doesn't exist
        if (!session('basket')) {
            session(['basket' => []]);
        }

        $basket = session('basket');

        // Check if the menu ID already exists in the basket
        foreach ($basket as &$item) {
            if ($menuId == $item['id']) {
                $item['amount'] += $menuAmount;
                $existingItem = true;
                break;
            }
        }

        if (!$existingItem) {
            $basket[] = ['id' => $menuId, 'name' => $menuName, 'image' => $menuImage, 'amount' => $menuAmount];
        }

        session(['basket' => $basket]);

        /*return response()->json(['menuIdByGet' => $menuId,'menuAmountByGet' => $menuAmount]);*/
        return response()->json(['basket' => $basket]);
    }

    public function clearSession()
    {
        session()->forget(['basket']);
    }

    public function checkBasket()
    {
        $basket = false;

        if (session('basket')) {
            $basket = true;
        }
        return response()->json(['basket' => $basket]);
    }

    public function renderBasket()
    {
        $basket = session('basket');
        return response()->json(['basket' => $basket]);
    }

    public function checkOrderList()
    {
        $nameTable = request('nameTable');
        $orderList = false;

        $order = DB::table('food_orders as fo')
            ->select([
                'fo.food_order_id as food_order_id',
                't.table_name as table_name',
                'm.menu_name as menu_name',
                'm.menu_image as menu_image',
                'fo.food_amount as food_amount',
                'fo.food_order_status as food_order_status'
            ])
            ->leftJoin('tables as t', function ($join) {
                $join->on('fo.table_id', '=', 't.table_id');
            })
            ->leftJoin('menus as m', function ($join) {
                $join->on('fo.menu_id', '=', 'm.menu_id');
            })
            ->where('t.table_name', $nameTable)
            ->whereBetween('fo.food_order_status', [1, 4])
            ->orderBy(DB::raw("CASE
                WHEN fo.food_order_status = 'รอชำระเงิน' THEN 1
                WHEN fo.food_order_status = 'สั่ง' THEN 2
                WHEN fo.food_order_status = 'กำลังปรุง' THEN 3
                WHEN fo.food_order_status = 'เสริฟแล้ว' THEN 4
                ELSE 5
            END"))
            ->get();

        if (count($order) > 0) {
            $orderList = true;
        }
        return response()->json(['orderList' => $orderList]);
    }

    public function renderOrderList()
    {
        $nameTable = request('nameTable');

        $order = DB::table('food_orders as fo')
            ->select([
                'fo.food_order_id as food_order_id',
                't.table_name as table_name',
                'm.menu_name as menu_name',
                'm.menu_image as menu_image',
                'fo.food_amount as food_amount',
                'fo.food_order_status as food_order_status',
                'ph.price as price'
            ])
            ->leftJoin('tables as t', function ($join) {
                $join->on('fo.table_id', '=', 't.table_id');
            })
            ->leftJoin('menus as m', function ($join) {
                $join->on('fo.menu_id', '=', 'm.menu_id');
            })
            ->join(DB::raw('(SELECT * FROM price_histories WHERE date_end IS NULL) AS ph'), function ($join) {
                $join->on('m.menu_id', '=', 'ph.menu_id');
            })
            ->where('t.table_name', $nameTable)
            ->whereBetween('fo.food_order_status', [1, 4])
            ->orderBy(DB::raw("CASE
            WHEN fo.food_order_status = 'รอชำระเงิน' THEN 1
            WHEN fo.food_order_status = 'สั่ง' THEN 2
            WHEN fo.food_order_status = 'กำลังปรุง' THEN 3
            WHEN fo.food_order_status = 'เสริฟแล้ว' THEN 4
            ELSE 5
        END"))
            ->get();

        $newOrder = [];
        if (count($order) > 0) {
            foreach ($order as $item) {
                $menuName = $item->menu_name;
                $foodAmount = $item->food_amount;
                $foodStatus = $item->food_order_status;
                $foodImage = $item->menu_image;
                $foodPrice = $item->price;

                // Check if an item with the same menu_name already exists in $newOrder
                $existingItemIndex = array_search($menuName, array_column($newOrder, 'menu_name'));

                if ($existingItemIndex !== false) {
                    // If the item exists, update its food_amount
                    $newOrder[$existingItemIndex]['food_amount'] += $foodAmount;
                } else {
                    // If the item doesn't exist, add it to $newOrder
                    $orderItem = [
                        'menu_name' => $menuName,
                        'food_amount' => $foodAmount,
                        'food_order_status' => $foodStatus,
                        'menu_image' => $foodImage,
                        'menu_price' => $foodPrice
                    ];

                    $newOrder[] = $orderItem;
                }
            }
        }
        return response()->json(['orderList' => $newOrder]);
    }

    public function minusAmountBasket()
    {
        $menuName = request('menuName');
        $menuAmount = request('menuAmount');
        $basket = session('basket');
        foreach ($basket as &$item) {
            if ($menuName == $item['name']) {
                $item['amount'] = $menuAmount;
                break;
            }
        }
        session(['basket' => $basket]);
    }

    public function addAmountBasket()
    {
        $menuName = request('menuName');
        $menuAmount = request('menuAmount');
        $basket = session('basket');
        foreach ($basket as &$item) {
            if ($menuName == $item['name']) {
                $item['amount'] = $menuAmount;
                break;
            }
        }
        session(['basket' => $basket]);
    }

    public function removeBasket()
    {
        $menuName = request('menuName');
        $oleBasket = session('basket');
        $basket = [];
        foreach ($oleBasket as &$item) {
            if ($menuName == $item['name']) {

                continue;
            } else {
                $basket[] = $item;
            }
        }

        session(['basket' => $basket]);
    }

    public function oderMenus()
    {
        $tableId = request('tableId');
        $basket = session('basket');

        foreach ($basket as &$item) {
            $lastFoodOrdersId = DB::table('food_orders')->orderBy('food_order_id', 'desc')->first();
            $newFoodOrdersId = null;

            if ($lastFoodOrdersId) {
                // If records exist, increment the table_id by 1
                $newFoodOrdersId  = $lastFoodOrdersId->food_order_id + 1;
            } else {
                // If no records exist, set an initial value (e.g., 1)
                $newFoodOrdersId  = 1;
            }

            DB::table('food_orders')->insert([
                'food_order_id' => $newFoodOrdersId,
                'table_id' => $tableId,
                'menu_id' => $item['id'],
                'food_amount' => $item['amount'],
                'food_order_status' => 1,
                'date_order' => DB::raw('CURRENT_TIMESTAMP')
            ]);

        }

    }
}
