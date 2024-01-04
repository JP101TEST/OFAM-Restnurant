<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ManagementAdminRoute;
use App\Http\Controllers\ManagementUserRoute;
use App\Http\Controllers\RestaurantInfoSetting;
use App\Http\Controllers\TableAdminController;
use App\Http\Controllers\FoodCategoryAdminController;
use App\Http\Controllers\FoodMenuAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BillController;

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
Route::get('/management/order/table_id={table_id}', [TableController::class, 'goOrderPage']);
Route::get('/management/order/table_id={table_id}/get-all-menu/show={show}', [MenuOrderController::class, 'getAllMenu']);
Route::get('/management/order/order_id={order_id}/delete', [MenuOrderController::class, 'deleteFoodOrder']);
Route::get('/management/order/order_id={order_id},status={status}/change_status', [MenuOrderController::class, 'changeStatusFoodOrder']);
Route::get('/management/order/payment/table_id={table_id}', [PaymentController::class, 'goPaymentPage'])->name('paymentPage');

Route::get('/management/order/payment', [PaymentController::class, 'orderPayment']);

Route::get('/management/table/get-all-tables', [TableController::class, 'getAllTables'])->name('get.updated.tables');
Route::get('/management/table/category={category}/search={search}', [TableController::class, 'getTablesFromSearch'])->name('get.updated.tables.input');

Route::get('/management-admin', [ManagementAdminRoute::class, 'goHomepageWithGet'])->name('management.admin.home');
Route::get('/management-admin-edit/info', [ManagementAdminRoute::class, 'goHomepageEditWithGet'])->name('management.admin.home.edit');
Route::post('/management-admin-edit/info', [RestaurantInfoSetting::class, 'editRestaurantInfo'])->name('management.admin.home.edit.postData');

Route::get('/management-admin/table', [ManagementAdminRoute::class, 'goTablepageWithGet'])->name('management.admin.table');
Route::get('/management-admin/table/add', [ManagementAdminRoute::class, 'goTableAddpageWithGet'])->name('management.admin.table.add');
Route::post('/management-admin/table/add', [TableAdminController::class, 'addTable'])->name('management.admin.table.add.postData');
Route::get('/management-admin/table/edit/tables_id={tables_id}', [ManagementAdminRoute::class, 'goTableEditpageWithGet'])->name('management.admin.table.edit');
Route::post('/management-admin/table/edit/update/table_id={table_id}', [TableAdminController::class, 'editTable'])->name('management.admin.table.edit.postData');
Route::get('/management-admin/table/get-all-tables', [TableAdminController::class, 'getAllTables'])->name('management.admin.table.get.all.tables');
Route::get('/management-admin/table/category={category}/search={search}', [TableAdminController::class, 'getTablesFromSearch'])->name('management.admin.table.get.some.tables');
Route::get('/update/table/status/table_id={table_id}/table_status={table_status}', [TableController::class, 'updateStatus']);

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
Route::get('/management-admin/promotion/get-all-promotion', [PromotionController::class, 'getAllPromotion']);
Route::get('/management-admin/promotion/get-all-promotion/searchType={searchType},search={search}', [PromotionController::class, 'getPromotionFromSearch']);
Route::get('/management-admin/promotion/add', [ManagementAdminRoute::class, 'goPromotionAddpageWithGet'])->name('management.admin.promotion.add');
Route::post('/management-admin/promotion/add', [PromotionController::class, 'addPromotion'])->name('management.admin.promotion.add.postData');
Route::get('/management-admin/promotion/edit/PromotionId={promotion_id}', [ManagementAdminRoute::class, 'goPromotionEditpageWithGet'])->name('management.admin.promotion.edit');
Route::post('/management-admin/promotion/edit/PromotionId={promotion_id}', [PromotionController::class, 'editPromotion'])->name('management.admin.promotion.edit.postData');

Route::get('/management-admin/employee', [ManagementAdminRoute::class, 'goEmployeepageWithGet'])->name('management.admin.employee');
Route::get('/management-admin/employee/get-all-employee', [EmployeeController::class, 'getAllEmployees']);
Route::get('/management-admin/employee/get-all-employee,category={category}/search={search}', [EmployeeController::class, 'getEmployeesFromSearch']);
Route::get('/management-admin/employee/add', [ManagementAdminRoute::class, 'goEmployeeAddpageWithGet'])->name('management.admin.employee.add');
Route::post('/management-admin/employee/add', [EmployeeController::class, 'addEmployee'])->name('management.admin.employee.add.postData');
Route::get('/management-admin/employee/view/employeeId={employee_id}', [ManagementAdminRoute::class, 'goEmployeeViewpageWithGet']);
Route::get('/management-admin/employee/edit/employeeId={employee_id}', [ManagementAdminRoute::class, 'goEmployeeEditpageWithGet']);
Route::post('/management-admin/employee/edit/employeeId={employee_id}', [EmployeeController::class, 'editEmployee'])->name('management.admin.employee.edit.postData');

Route::get('/management-admin/bill', [ManagementAdminRoute::class, 'goBillpageWithGet'])->name('management.admin.bill');
Route::get('/management-admin/bill/get-all-bill', [BillController::class, 'getAllBill']);
Route::get('/management-admin/bill/get-all-menu-bill', [BillController::class, 'getAllMenuBill']);
Route::get('/management-admin/bill/change', [BillController::class, 'change']);

Route::get('/management-admin/total-summary', [ManagementAdminRoute::class, 'goTotalSummarypageWithGet'])->name('management.admin.total.summary');


Route::get('/order/generateQRCode/Table={table_name},PassWord={table_password}', [UserController::class, 'generateQrCode']);
Route::get('/order/Table={table_name},PassWord={table_password}', [ManagementUserRoute::class, 'goUserHomepage']);

Route::get('/user/table/get-all-menu', [UserController::class, 'getAllMenu']);
Route::get('/user/table/putMenuToBasket', [UserController::class, 'getPutMenuToBasket']);
Route::get('/user/table/clear-session',  [UserController::class, 'clearSession']);
Route::get('/user/table/checkBasket',  [UserController::class, 'checkBasket']);
Route::get('/user/table/renderBasket',  [UserController::class, 'renderBasket']);
Route::get('/user/table/checkOrderList',  [UserController::class, 'checkOrderList']);
Route::get('/user/table/renderOrderList',  [UserController::class, 'renderOrderList']);
Route::get('/user/table/minusAmountBasket',  [UserController::class, 'minusAmountBasket']);
Route::get('/user/table/addAmountBasket',  [UserController::class, 'addAmountBasket']);
Route::get('/user/table/removeBasket',  [UserController::class, 'removeBasket']);
Route::get('/user/table/oderMenus',  [UserController::class, 'oderMenus']);
Route::get('/user/table/checkPaymentStatus',  [UserController::class, 'checkPaymentStatus']);
Route::get('/user/table/changeOrderToPayment',  [UserController::class, 'changeOrderToPayment']);
Route::get('/user/table/checkPassword',  [UserController::class, 'checkPassword']);

Route::get('/generate-random-number', [TableController::class, 'generateRandomNumber']);
