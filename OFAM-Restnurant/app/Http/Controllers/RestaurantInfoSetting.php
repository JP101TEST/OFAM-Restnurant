<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\restaurantInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\BinaryOp\Equal;

class RestaurantInfoSetting extends Controller
{
    //
    public function editRestaurantInfo(Request $request)
    {

        $restaurantName = $request->input('restaurantName'); //input ใช้ name
        $restaurantPhone = $request->input('restaurantPhone');
        $restaurantImage = $request->file('restaurantImage');
        $errorRestaurantPhone = null;
        $errorRestaurantImage = null;
        $changeImageStatus = true;

        //print("ชื่อร้าน " . $restaurantName . "<br>");
        //print("เบอร์ติดต่อ " . $restaurantPhone . "<br>");

        // Check phone
        if (RestaurantInfoSetting::validatePhoneNumber($restaurantPhone)) {
            //print("Valid phone number: $restaurantPhone <br>");
        } else {
            //print("Invalid phone number: $restaurantPhone <br>");
            $errorRestaurantPhone = 'กรุณาตรวจสอบว่ากรอกหมายเลขครบหรือกรอกเพียงหมายเลข 0-9';
            session(['errorPhone' => $errorRestaurantPhone]);
        }
        // Check if restaurantImageTest file exists in the request
        if ($request->hasFile('restaurantImage')) {
            $restaurantImage = $request->file('restaurantImage');
            // Get the original filename and extension
            $originalFileName = $restaurantImage->getClientOriginalName();
            $fileExtension = $restaurantImage->getClientOriginalExtension();

            // Define the allowed file extensions (jpg and png)
            $allowedExtensions = ['jpg', 'png', 'webp', 'gif', 'bmp', 'svg', 'jpeg', 'ico', 'tiff'];

            // Check if the file extension is in the allowed list
            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                // Define the destination folder path within the public folder
                $destinationPath = public_path('images/save');

                // Check if a file with the same name already exists
                if (File::exists($destinationPath . '/' . $originalFileName)) {
                    // Print a message indicating that the file already exists
                    //print("รูป  \"$originalFileName\" นี้มีอยู่แล้ว<br>");
                } else {
                    // Move the uploaded file to the destination folder if it doesn't exist
                    $restaurantImage->move($destinationPath, $originalFileName);
                    // Print a success message
                    //print("รูป  \"$originalFileName\" อัปโหลดสำเร็จ<br>");
                }
            } else {
                // Print a message if the file extension is not allowed
                //print("รูป  \"$originalFileName\" ไม่รองรับสกุลไฟล์นี้ (รองรับเฉพาะ jpg และ png)<br>");
                $changeImageStatus = false;
                $errorRestaurantImage = 'ไม่รองรับสกุลไฟล์นี้ (รองรับเฉพาะ jpg และ png)';
                session(['errorImage' => $errorRestaurantImage]);
            }
        } else {
            // Print a message if no restaurantImage file was provided
            //print("ไม่มีรูป  ในคำขอ<br>");
            $changeImageStatus = false;
        }
        $restaurantNameDataBase = restaurantInfo::value('restaurant_name');
        $restaurantPhoneDataBase = restaurantInfo::value('restaurant_phone');
        $restaurantlogoDataBase = restaurantInfo::value('restaurant_logo');
        //print("---ข้อมูลใน database--- <br>");
        //print($restaurantNameDataBase . "<br>");
        //print($restaurantPhoneDataBase . "<br>");
        //print($restaurantlogoDataBase . "<br>");

        if ($errorRestaurantPhone != null || $errorRestaurantImage != null) {
            session(['restaurantName.ole' => $restaurantName]);
            session(['restaurantPhone.ole' => $restaurantPhone]);
            return redirect()->route('management.admin.home.edit');
        }
        if ($restaurantNameDataBase != $restaurantName) {
            DB::table('restaurant_infos')
                ->where('restaurant_id', '1')
                ->update(['restaurant_name' => $restaurantName]);
        }
        if ($restaurantPhoneDataBase != $restaurantPhone && $errorRestaurantPhone == null) {
            DB::table('restaurant_infos')
                ->where('restaurant_id', '1')
                ->update(['restaurant_phone' => strval($restaurantPhone)]);
        }
        if ($changeImageStatus == true) {
            DB::table('restaurant_infos')
                ->where('restaurant_id', '1')
                ->update(['restaurant_logo' => $originalFileName]);
        }

        //print(restaurantInfo::value('restaurant_logo') . "<br>");
        return view('management/admin_page/management_home');
    }

    function validatePhoneNumber($phone)
    {
        // Define a regular expression pattern for a basic phone number.
        $pattern = '/^\d{10}$/'; // This pattern allows exactly 10 digits.

        // Use the preg_match function to test if the input matches the pattern.
        if (preg_match($pattern, $phone)) {
            return true; // Input is a valid phone number.
        } else {
            return false; // Input is not a valid phone number.
        }
    }
}
