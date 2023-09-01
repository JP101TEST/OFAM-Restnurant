<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\TableController;

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
    return view('login');
})->name('login');

// //การสร้าง Rount
// Route::get('/about', function () {
//     echo 'สวัดดี';
// });

// // {name} สัมพันธ์กัน $name โดยถ้าจะเพิ่ม {name} ต้องไม่ซ้ำกับที่มือยู่แล้ว
// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/management', function () {
//     return view('management.management_oder_food_list');
// });

//Route::get('/management', [login::class,'index'])->name('management');
Route::get('/management', [login::class, 'getRequest'])->name('management.getRequest');
Route::post('/management', [login::class, 'postRequest'])->name('management.postRequest');
Route::post('/management/logout', [login::class, 'logOut'])->name('management.logout');
// Route::match(['get', 'post'],'/management', [login::class,'getRequest'])
// ->name('management.getRequest')
// ->middleware('checkUser');
Route::post('/update/table/status/{table_id}',  [TableController::class, 'updateStatus'])->name('update.table.status');
Route::get('/update/table/status/{table_id}', [TableController::class, 'getStatus'])->name('get.table.status');
Route::get('/get-updated-tables', [TableController::class, 'getUpdatedTables'])->name('get.updated.tables');
Route::get('/get-updated-tables/{table_inpt_id},{table_select_inpt}', [TableController::class, 'getUpdatedTablesInput'])->name('get.updated.tables.input');



