<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class ManagementUserRoute extends Controller
{
    //
    public function goUserHomepage($table_name, $table_password)
    {
        $table = Table::where('table_name', $table_name)->firstOrFail();
        if ($table->tables_password == $table_password) {
            //$fileName = $table_name . '_qrcode.png';
            // Other code...
            //return view('user/user_home', compact('table_name', 'fileName'));
            return view('user/user_home', compact('table_name'));
            //return view('user/user_home');
            //return view('management/admin_page/management_home');
        } else {
            // print("error password" . "<br>");
            // print("table name:" . $table_name . "<br>");
            // print("table password:" . $table_password . "<br>");
            return view('user/user_error');
        }
    }

    /*public function generateQrCode()
    {
        //ดึงชื่อโต๊ะและรหัสผ่านจากพารามิเตอร์ของ Route
        $table_name = Route::current()->parameter('table_name');
        $table_password = Route::current()->parameter('table_password');

        //สร้าง URL
        $url = url()->to("/order/Table={$table_name},PassWord={$table_password}");

        //สร้าง QR Code
        $qrCode = QrCode::format('png')->size(300)->generate($url);

        //โหลดรูปภาพ QR Code แล้ว Graphics Draw สร้างภาพแบบไดนามิก
        $baseImage = imagecreatefromstring($qrCode);

        //คำนวณตำแหน่งของข้อความ
        $textX = 10; // กำหนดให้ห่างจากขอบซ้าย
        $textY = imagesy($baseImage) + 50; // กำหนดให้ห่างจากขอบบนและจากรูป QR Code ด้านบน

        //คำนวณขนาดรูปภาพใหม่
        $newWidth = imagesx($baseImage) + 40;
        $newHeight = imagesy($baseImage) + 150;

        //คำนวณสร้างรูปภาพใหม่
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        //กำหนดพื้นหลังสีขาว
        $white = imagecolorallocate($newImage, 255, 255, 255);//กำนหดขนาดและกำหนดสี
        imagefill($newImage, 0, 0, $white); //ทำให้สีพื้นหลังเต็มขนาดภาพ

        //นำรูป QR Code มาใส่ในรปใหม่
        imagecopy($newImage, $baseImage, 20, 20, 0, 0, imagesx($baseImage), imagesy($baseImage));

        //กำหนดสีตัวอักษร
        $textColor = imagecolorallocate($newImage, 0, 0, 0); // Black

        //ดึงเวลาปัจจุบันมาเก็บไว้
        $date = date("d-m-Y H:i:s");

        //กำหนดขนาดตัวอักษร
        $textSize = 16;

        //เพิ่มข้อความลงในรูปภาพ
        $textLines = [
            "หมายเลขโต๊ะ: $table_name",
            "รหัสผ่านโต๊ะ: $table_password",
            "วัน เวลา: $date",
        ];

        //นำข้อความไปใส่ในภาพ
        foreach ($textLines as $line) {
            imagettftext($newImage, $textSize, 0, $textX, $textY, $textColor, public_path('font/Kanit-Light.ttf'), $line);
            $textY += 30; //เพิ่มระยะห่างจากด้านบนข้อความก่อนหน้า
        }

        //กำนหดรูปภาพที่ส่งออกเป็น PNG
        header('Content-Type: image/png');

        //ล้างรูปที่เคยสร้าง
        imagedestroy($baseImage);
        imagedestroy($newImage);

        $fileName = $table_name . '_qrcode.png'; //กำหนดชื่อรูปภาพ
        $filePath = public_path('images/QrCode/' . $table_name . '_qrcode.png');//กำหนดตำแหน่งที่บันทึก
        file_put_contents($filePath, $qrCode);//บันทึกรูปภาพ
        imagepng($newImage, $filePath);//นำข้อความใส่ในภาพ

        //แสดงรูปภาพ
        echo "<img src='" . asset("images/QrCode/$fileName") . "' alt='QR Code'><br>";
    }*/

    /*public function getPutMenuToBasket()
    {
        //ดึงไอดี ชื่อเมนู จำนวน รูป
        $menuId = request('menuId');
        $menuName = request('menuName');
        $menuAmount = request('menuAmount');
        $menuImage = request('menuImage');
        $existingItem = false;

        //เมื่อไม่เคยมีการสร้าง session จะทำการสร้าง session ใหม่
        if (!session('basket')) {
            session(['basket' => []]);
        }

        //เรียกใช้ session มาเก็บในตัวแปร
        $basket = session('basket');

        //loop หาค่าที่มีอยู่แล้วใน session ว่ามี id เหมือนกันหรือไม่
        //ถ้ามีจะทำการเพิ่มจำนวน
        foreach ($basket as &$item) {
            if ($menuId == $item['id']) {
                $item['amount'] += $menuAmount;
                $existingItem = true;
                break;
            }
        }

        //กรณีที่ไม่มี id เหมือนใน session จะเพิ่มข้อมูลเมนูที่จะเก็บไว้ในตะกร้า
        if (!$existingItem) {
            $basket[] = ['id' => $menuId, 'name' => $menuName, 'image' => $menuImage, 'amount' => $menuAmount];
        }

        //เอาค่าที่ได้ใหม่ในตัวแปรไปเก็บใน session
        session(['basket' => $basket]);

        //ส่งค่าตัวแปร
        return response()->json(['basket' => $basket]);
    }

    public function clearSession()
    {
        //ล้าง session
        session()->forget(['basket']);
    }

    public function checkBasket()
    {
        $basket = false;

        //ตรวจสอบ session
        if (session('basket')) {
            $basket = true;
        }

        //ส่งค่าตัวแปร
        return response()->json(['basket' => $basket]);
    }

    public function renderBasket()
    {
        //เรียกใช้ session มาเก็บในตัวแปร
        $basket = session('basket');

        //ส่งค่าตัวแปร
        return response()->json(['basket' => $basket]);
    }

    public function minusAmountBasket()
    {
        //ดึงชื่อเมนู จำนวน
        $menuName = request('menuName');
        $menuAmount = request('menuAmount');

        //เรียกใช้ session มาเก็บในตัวแปร
        $basket = session('basket');

        //loop หาค่าที่มีอยู่แล้วใน session ว่ามีชื่อเหมือนกันหรือไม่
        //ถ้ามีจะทำการเปลี่ยนจำนวนเป็นจำนวนปัจจุบัน
        foreach ($basket as &$item) {
            if ($menuName == $item['name']) {
                $item['amount'] = $menuAmount;
                break;
            }
        }

        //ส่งค่าตัวแปร
        session(['basket' => $basket]);
    }

    public function addAmountBasket()
    {
        //ดึงชื่อเมนู จำนวน
        $menuName = request('menuName');
        $menuAmount = request('menuAmount');

        //เรียกใช้ session มาเก็บในตัวแปร
        $basket = session('basket');

        //loop หาค่าที่มีอยู่แล้วใน session ว่ามีชื่อเหมือนกันหรือไม่
        //ถ้ามีจะทำการเปลี่ยนจำนวนเป็นจำนวนปัจจุบัน
        foreach ($basket as &$item) {
            if ($menuName == $item['name']) {
                $item['amount'] = $menuAmount;
                break;
            }
        }

        //ส่งค่าตัวแปร
        session(['basket' => $basket]);
    }*/

    /*public function oderMenus()
    {
        //ดึงไอดีโต๊ะ
        $tableId = request('tableId');

        //เรียกใช้ session มาเก็บในตัวแปร
        $basket = session('basket');

        //loop เพื่อเพิ่มเมนูในตะกร้าไปเก็บในฐานข้อมูล
        foreach ($basket as &$item) {
            //ค้นหาไอดีล่าสุด
            $lastFoodOrdersId = DB::table('food_orders')->orderBy('food_order_id', 'desc')->first();
            $newFoodOrdersId = null;

            //ไอดีล่าสุดว่ามีหรือไม่
            if ($lastFoodOrdersId) {
                // ถ้ามีบวก 1
                $newFoodOrdersId  = $lastFoodOrdersId->food_order_id + 1;
            } else {
                // ถ้าไม่มีให้เป็น 1
                $newFoodOrdersId  = 1;
            }

            //ทำการ insert
            DB::table('food_orders')->insert([
                'food_order_id' => $newFoodOrdersId,
                'table_id' => $tableId,
                'menu_id' => $item['id'],
                'food_amount' => $item['amount'],
                'food_order_status' => 1,
                'date_order' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }
    }*/
}
