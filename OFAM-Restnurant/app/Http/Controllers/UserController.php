<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
//ลบ ; จาก extension=gd ใน php8.1.0\php.ini
//คำสั่งค้นหา php --ini
//เมื่อทำเสร็จก็  restar
//composer require simplesoftwareio/simple-qrcode เพื่อลง libery
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    //
    public function goHomepageWithGet($table_name)
    {

        $url = url()->current();
        print($table_name . "<br>");
        $table = Table::where('table_name', $table_name)->firstOrFail();
        print($table . "<br>");
        print($url . "<br>");
        // Generate the QR code
        $qrCode = QrCode::format('png')->size(200)->generate($url);

        // Save the QR code as an image file (you can customize the file path and name)
        $fileName = $table_name . '_qrcode.png'; // Construct the filename
        $filePath = public_path('images/QrCode/' . $table_name . '_qrcode.png');
        file_put_contents($filePath, $qrCode);

        // Other code...
        return view('user/user_home', compact('table_name', 'fileName'));
        //return view('user/user_home');
        //return view('management/admin_page/management_home');
    }
}
