<?php

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
        .custom-back-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            width: 300px;
            /* Add the unit, e.g., pixels */
            font-size: 20px;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <p>Qrcode.</p><br>
    <img src='{{ asset("images/QrCode/$fileName")}}' alt="QR Code"><br>
    <button onclick="printImage()" class="custom-back-button">ปริ้น</button><br><br>
    <button onclick="goBack()" class="custom-back-button">ย้อนกลับ</button>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function printImage() {
        var img = new Image();
        img.src = "{{ asset('images/QrCode/' . $fileName) }}";
        var printWindow = window.open("", "", "width=600,height=600");
        printWindow.document.open();
        printWindow.document.write("<html><head><title>Print QR Code</title></head><body>");
        printWindow.document.write("<img src=\"" + img.src + "\" onload=\"window.print(); printWindow.close();\">");
        printWindow.document.write("</body></html>");
        printWindow.document.close();
    }
    function goBack() {
                window.history.back();
            }

</script>





</html>
