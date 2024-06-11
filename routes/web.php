<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MytaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerQueryController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorTaskAssignController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\AdminTaskController;
use App\Http\Controllers\WebsitesettingController;


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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AdminController::class,'login']);
Route::get('/logout',[AdminController::class,'logout']);
Route::post('/login',[AdminController::class,'AuthLogin'])->name('login');


Route::prefix('master-admin')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('master-dashboard');
    Route::resource('/company',CompanyController::class);
    Route::resource('/brands',BrandController::class);
    Route::resource('/tasks',MytaskController::class);
    Route::resource('/admin',MytaskController::class);
    Route::post('/statusUpdate/{id}','MytaskController@statusUpdate')->name('statusUpdate');
    Route::get('/admins','AdminController@index')->name('adminlist');
    Route::get('/admins/{id}','AdminController@edit')->name('admins_edit');
    Route::post('/admin/create','AdminController@store')->name('admins_create');
    Route::post('/admin/update/{id}','AdminController@update')->name('admins_update');
    Route::post('/admins/{id}','AdminController@destroy')->name('admins_delete');
    Route::resource('/employee',EmployeeController::class);
    Route::resource('/customer-query',CustomerQueryController::class);
    Route::resource('/holiday',HolidayController::class);
    Route::resource('/vendor',VendorController::class);
    Route::resource('/vendor-task',VendorTaskAssignController::class);
    Route::resource('/leave',EmpLeaveController::class);
    Route::resource('/employeetask',EmployeeTaskController::class);
    Route::resource('/admintask',AdminTaskController::class);
    Route::post('/employee_task_update/{id}','EmployeeTaskController@employee_task_update')->name('employee_task_update');
    Route::post('/admin_task_update/{id}','AdminTaskController@admin_task_update')->name('admin_task_update');
    Route::get('/admin-leave','EmpLeaveController@AdminLeave')->name('AdminLeave');
    Route::get('/emp-leave','EmpLeaveController@EmpLeave')->name('EmpLeave');
    Route::post('/EmpLeaveStatusApprove/{id}','EmpLeaveController@EmpLeaveStatusApprove')->name('EmpLeaveStatusApprove');
    Route::post('/EmpLeaveStatusReject/{id}','EmpLeaveController@EmpLeaveStatusReject')->name('EmpLeaveStatusReject');
    Route::post('/AdminLeaveStatusApprove/{id}','EmpLeaveController@AdminLeaveStatusApprove')->name('AdminLeaveStatusApprove');
    Route::post('/AdminLeaveStatusReject/{id}','EmpLeaveController@AdminLeaveStatusReject')->name('AdminLeaveStatusReject');
    Route::resource('/settings',WebsitesettingController::class);


    Route::get('/viewholidays/{id}','HolidayController@holidayview')->name('viewholidays');
});

//  Admin Route
Route::prefix('admin')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'Adminindex'])->name('admin-dashboard');
});

//  HR Route
Route::prefix('hr')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'HRindex'])->name('hr-dashboard');
});

//  Employee Route
Route::prefix('Employee')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'Employeeindex'])->name('employee-dashboard');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear ');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    echo Artisan::output();
});

Route::get('/command', function() {
    Artisan::call('make:model Language -mcr');
    Artisan::call('db:seed');
    Artisan::call('db:seed');
    echo Artisan::output();
});


