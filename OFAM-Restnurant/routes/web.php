<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//การสร้าง Rount
Route::get('/about', function () {
    echo 'สวัดดี';
});

// {name} สัมพันธ์กัน $name โดยถ้าจะเพิ่ม {name} ต้องไม่ซ้ำกับที่มือยู่แล้ว
Route::get('/login', function () {
    return view('login');
});
