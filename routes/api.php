<?php


use App\Http\Controllers\Api\ParameterController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\EditUserController;
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
Route::post('/login', 'App\Http\Controllers\Api\User\AuthController@login');
Route::post('/register', 'App\Http\Controllers\Api\User\AuthController@register');
Route::post('/forget-password', 'App\Http\Controllers\Api\User\ResetPasswordController@getEmail');
Route::post('/reset-password', 'App\Http\Controllers\Api\User\ResetPasswordController@validateKey');
Route::post('/validate-account', 'App\Http\Controllers\Api\User\AuthController@validateCode');

Route::post('/profile-photo', [AuthController::class, 'addProfilePhoto'])->middleware('auth:sanctum');
Route::post('/edit-profil', [EditUserController::class, 'editProfile'])->middleware('auth:sanctum');

Route::get('/fuel-types', [ParameterController::class, 'fuel_types']);
Route::get('/car-categories', [ParameterController::class, 'car_categories']);
Route::get('/type-cars', [ParameterController::class, 'type_cars']);
Route::get('/trailers', [ParameterController::class, 'trailers']);

Route::get('/invoices/{id}/send', [InvoiceController::class, 'sendInvoice']);

