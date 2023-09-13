<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ManagementAdminRoute;
use App\Http\Controllers\RestaurantInfoSetting;
use App\Http\Controllers\TableAdminController;
use App\Http\Controllers\UserController;

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

Route::get('/management', [login::class, 'getRequest'])->name('management.getRequest');
Route::post('/management', [login::class, 'postRequest'])->name('management.postRequest');
Route::post('/management/logout', [login::class, 'logOut'])->name('management.logout');


Route::post('/update/table/status/{table_name}',  [TableController::class, 'updateStatus'])->name('update.table.status');
Route::get('/update/table/status/{table_name}', [TableController::class, 'getStatus'])->name('get.table.status');
Route::get('/get-updated-tables', [TableController::class, 'getUpdatedTables'])->name('get.updated.tables');
Route::get('/get-updated-tables/{table_inpt_id},{table_select_inpt}', [TableController::class, 'getUpdatedTablesInput'])->name('get.updated.tables.input');


Route::get('/management-admin', [ManagementAdminRoute::class, 'goHomepageWithGet'])->name('management.admin.home');
Route::get('/management-admin-edit/info', [ManagementAdminRoute::class, 'goHomepageEditWithGet'])->name('management.admin.home.edit');
Route::post('/management-admin-edit/info', [RestaurantInfoSetting::class, 'editRestaurantInfo'])->name('management.admin.home.edit.postData');

Route::get('/management-admin/table', [ManagementAdminRoute::class, 'goTablepageWithGet'])->name('management.admin.table');
Route::get('/management-admin/table/add', [ManagementAdminRoute::class, 'goTableAddpageWithGet'])->name('management.admin.table.add');
Route::post('/management-admin/table/add', [TableAdminController::class, 'addTable'])->name('management.admin.table.add.postData');
Route::get('/management-admin/table/get-all-tables', [TableAdminController::class, 'getAllTables'])->name('management.admin.table.get.all.tables');
Route::get('/management-admin/table/{table_inpt_id},{table_select_inpt}', [TableAdminController::class, 'getUpdatedTables'])->name('management.admin.table.get.some.tables');

Route::get('/management-admin/food', [ManagementAdminRoute::class, 'goFoodpageWithGet'])->name('management.admin.food');


Route::post('/order/Table={table_name}', [UserController::class, 'goHomepageWithGet'])->name('user.main');
Route::get('/order/Table={table_name}', [UserController::class, 'goHomepageWithGet'])->name('user.main');


Route::get('/generate-random-number', [TableController::class, 'generateRandomNumber']);




