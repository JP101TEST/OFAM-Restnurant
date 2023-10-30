<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ManagementAdminRoute;
use App\Http\Controllers\RestaurantInfoSetting;
use App\Http\Controllers\TableAdminController;
use App\Http\Controllers\FoodCategoryAdminController;
use App\Http\Controllers\FoodMenuAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;

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
Route::get('/management-admin/food/get-all-food,category={category}', [FoodMenuAdminController::class, 'getAllFood']);
Route::get('/management-admin/food/get-all-food,category={category}/search={search}', [FoodMenuAdminController::class, 'getFoodFromSearch']);
Route::get('/management-admin/food/menu_id={menu_id},new_status={new_status}', [FoodMenuAdminController::class, 'changeMenuStatus']);
Route::get('/management-admin/food/category', [ManagementAdminRoute::class, 'goFoodCategorypageWithGet'])->name('management.admin.food.category');
Route::post('/management-admin/food/category', [FoodCategoryAdminController::class, 'addCategory'])->name('management.admin.food.category.add.postData');
Route::get('/management-admin/food/menu', [ManagementAdminRoute::class, 'goFoodMenupageWithGet'])->name('management.admin.food.menu');
Route::post('/management-admin/food/menu', [FoodMenuAdminController::class, 'addMenu'])->name('management.admin.food.menu.add.postData');
Route::get('/management-admin/food/menu/edit/MenuId={menu_id}', [ManagementAdminRoute::class, 'goFoodMenuEditpageWithGet'])->name('management.admin.food.menu.edit');
Route::get('/management-admin/food/menu/edit/getPriceHistory/MenuId={menu_id}', [FoodMenuAdminController::class, 'getPriceHistory']);
Route::post('/management-admin/food/menu/edit/MenuId={menu_id}', [FoodMenuAdminController::class, 'editMenu'])->name('management.admin.food.menu.edit.postData');

Route::get('/management-admin/promotion', [ManagementAdminRoute::class, 'goPromotionpageWithGet'])->name('management.admin.promotion');
Route::get('/management-admin/promotion/add', [ManagementAdminRoute::class, 'goPromotionAddpageWithGet'])->name('management.admin.promotion.add');
Route::post('/management-admin/promotion/add', [PromotionController::class, 'addPromotion'])->name('management.admin.promotion.add.postData');
Route::get('/management-admin/promotion/edit/PromotionId={promotion_id}', [ManagementAdminRoute::class, 'goPromotionEditpageWithGet'])->name('management.admin.promotion.edit');
Route::post('/management-admin/promotion/edit/PromotionId={promotion_id}', [PromotionController::class, 'editPromotion'])->name('management.admin.promotion.edit.postData');



Route::post('/order/Table={table_name},PassWord={table_password}', [UserController::class, 'goHomepageWithGetQandT'])->name('user.main');
Route::get('/order/Table={table_name},PassWord={table_password}', [UserController::class, 'goHomepageWithGetP'])->name('user.main');



Route::get('/generate-random-number', [TableController::class, 'generateRandomNumber']);




