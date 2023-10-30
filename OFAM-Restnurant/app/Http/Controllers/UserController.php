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

    public function goHomepageWithGetQandT($table_name, $table_password)
    {
        $url = url()->current();

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
            "โต๊ะหมายเลข: $table_name",
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
}
