<?php


use App\Http\Controllers\Api\ParameterController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\EditUserController;
use App\Http\Controllers\Api\User\ResetPasswordController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/me', [AuthController::class, 'getMe'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-email', [AuthController::class, 'check_email']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forget-password', [ResetPasswordController::class, 'getEmail']);
Route::post('/reset-password', [ResetPasswordController::class, 'validateKey']);
Route::post('/validate-account', [AuthController::class, 'validateCode']);

Route::post('/profile-photo', [AuthController::class, 'addProfilePhoto'])->middleware('auth:sanctum');
Route::post('/edit-profil', [EditUserController::class, 'editProfile'])->middleware('auth:sanctum');

Route::get('/fuel-types', [ParameterController::class, 'fuel_types']);
Route::get('/car-categories', [ParameterController::class, 'car_categories']);
Route::get('/type-cars', [ParameterController::class, 'type_cars']);
Route::get('/trailers', [ParameterController::class, 'trailers']);

Route::get('/invoices/{id}/send', [InvoiceController::class, 'sendInvoice']);

