<?php

use App\Http\Controllers\Auth\CustomVerificationController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CarCategoryController;
use App\Http\Controllers\Dashboard\ComplaintController;
use App\Http\Controllers\Dashboard\FuelTypeController;
use App\Http\Controllers\Dashboard\ParameterController;
use App\Http\Controllers\Dashboard\PowerController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\TarificationController;
use App\Http\Controllers\Dashboard\TrailerController;
use App\Http\Controllers\Dashboard\TypeCarController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#Route::get('/', function () {
#    return view('welcome');
#});
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/error-forbidden', [HomeController::class, 'error403'])->name('error-forbidden');
Route::get('/error-not-found', [HomeController::class, 'error404'])->name('error-not-found');

Auth::routes(['verify' => true]);

Route::get('/email/verify', [CustomVerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [CustomVerificationController::class, 'verify'])
    ->middleware(['auth', 'custom-signed'])
    ->name('verification.verify');

Route::post('/email/resend', [CustomVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile/{id?}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/profile/{id}/edit', [App\Http\Controllers\HomeController::class, 'edit_profile'])->name('edit_profile');
Route::post('/profile/{id}/update', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update_profile');

Route::get('/roles', [RoleController::class, 'index'])->name('roles');
Route::get('/add-role', [RoleController::class, 'indexAddRole'])->middleware('check_permissions:add-roles')->name('add_role');
Route::post('/new-role', [RoleController::class, 'addRole'])->middleware('check_permissions:add-roles')->name('new_role');
Route::get('/roles/{id}', [RoleController::class, 'roleShow'])->middleware('check_permissions:get-roles')->name('role');
Route::get('/roles/{id}/show', [RoleController::class, 'roleDetails'])->middleware('check_permissions:get-roles')->name('role_details');
Route::post('/roles/{id}/edit', [RoleController::class, 'updateRole'])->middleware('check_permissions:edit-roles')->name('edit_role');
Route::get('/roles/{id}/activate', [RoleController::class, 'activateRole'])->middleware('check_permissions:edit-role')->name('activate_role');
Route::get('/roles/{id}/deactivate', [RoleController::class, 'deactivateRole'])->middleware('check_permissions:edit-role')->name('deactivate_role');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/users', [UserController::class, 'store'])->name('add_user');
Route::get('/users/{id}/change-status', [UserController::class, 'change_status'])->name('change_user_status');

Route::get('/fuel-types', [FuelTypeController::class, 'index'])->name('fuel_types');
Route::post('/fuel-types', [FuelTypeController::class, 'store'])->name('add_fuel_type');
Route::post('/fuel-types/update', [FuelTypeController::class, 'update'])->name('update_fuel_type');
Route::get('/fuel-types/{id}/activate', [FuelTypeController::class, 'activateFuelType'])->name('activate_fuel_type');
Route::get('/fuel-types/{id}/deactivate', [FuelTypeController::class, 'deactivateFuelType'])->name('deactivate_fuel_type');


Route::get('/type-cars', [TypeCarController::class, 'index'])->name('type_cars');
Route::post('/type-cars', [TypeCarController::class, 'store'])->name('add_type_car');
Route::post('/type-cars/update', [TypeCarController::class, 'update'])->name('update_type_car');


Route::get('/categories', [CarCategoryController::class, 'index'])->name('categories');
Route::post('/categories', [CarCategoryController::class, 'store'])->name('add_category');
Route::post('/categories/update', [CarCategoryController::class, 'update'])->name('update_category');

Route::get('/tarifications', [TarificationController::class, 'index'])->name('tarifications');
Route::post('/tarifications', [TarificationController::class, 'store'])->name('add_tarification');
Route::post('/tarifications/update', [TarificationController::class, 'update'])->name('update_tarification');


Route::get('/complaints-list', [ComplaintController::class, 'index'])->name('complaints');
Route::get('/new-complaint', [ComplaintController::class, 'add_complaint'])->name('new_complaint');
Route::post('/add-complaint', [ComplaintController::class, 'store'])->name('add_complaint');
Route::get('/complaints/{id}', [ComplaintController::class, 'complaint_details'])->name('complaint_details');
Route::post('/complaints/{id}/answer', [ComplaintController::class, 'answer_complaint'])->name('answer_complaint');


Route::get('/trailers', [TrailerController::class, 'index'])->name('trailers');
Route::post('/trailers', [TrailerController::class, 'store'])->name('add_trailer');
Route::post('/trailers/update', [TrailerController::class, 'update'])->name('update_trailer');


Route::get('/powers', [PowerController::class, 'index'])->name('powers');
Route::post('/powers', [PowerController::class, 'store'])->name('add_power');
Route::put('/powers/update', [PowerController::class, 'update'])->name('update_power');

Route::get('/brands-list', [BrandController::class, 'index'])->name('brands');
Route::post('/new-brand', [BrandController::class, 'store'])->name('add_brand');
Route::post('/brands/update', [BrandController::class, 'update'])->name('update_brand');
Route::get('/marcas', [BrandController::class, 'client_brands'])->name('client_brands');

Route::get('/parameters', [ParameterController::class, 'index'])->name('parameters');
Route::post('/parameters/update', [ParameterController::class, 'update'])->name('update_parameter');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices');
Route::get('/invoices/{id}/approve', [InvoiceController::class, 'approve_invoice'])->name('approve_invoice');
Route::get('/invoices/{id}/refuse', [InvoiceController::class, 'refuse_invoice'])->name('refuse_invoice');


});

// routes/web.php
Route::get('/marcas', [BrandController::class, 'client_brands'])->name('client_brands');
Route::get('/get-powers/{fuelTypeId}', [InvoiceController::class, 'getPowers']);
Route::get('/brands/{id}/invoice-form', [InvoiceController::class, 'invoice_form'])->name('invoice_form');
Route::post('/brands/{id}/create-invoice', [InvoiceController::class, 'store'])->name('create_invoice');
Route::get('/invoices/{id}/details', [InvoiceController::class, 'invoice_details'])->name('invoice_details');


