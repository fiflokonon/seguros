<?php

use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/error-forbidden', [HomeController::class, 'error403'])->name('error-forbidden');
Route::get('/error-not-found', [HomeController::class, 'error404'])->name('error-not-found');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/roles', [RoleController::class, 'index'])->name('roles');
Route::get('/add-role', [RoleController::class, 'indexAddRole'])->middleware('check_permissions:add-roles')->name('add_role');
Route::post('/new-role', [RoleController::class, 'addRole'])->middleware('check_permissions:add-roles')->name('new_role');
Route::get('/roles/{id}', [RoleController::class, 'roleShow'])->middleware('check_permissions:get-roles')->name('role');
Route::get('/roles/{id}/show', [RoleController::class, 'roleDetails'])->middleware('check_permissions:get-roles')->name('role_details');
Route::post('/roles/{id}/edit', [RoleController::class, 'updateRole'])->middleware('check_permissions:edit-roles')->name('edit_role');
Route::get('/roles/{id}/activate', [RoleController::class, 'activateRole'])->middleware('check_permissions:edit-role')->name('activate_role');
Route::get('/roles/{id}/deactivate', [RoleController::class, 'deactivateRole'])->middleware('check_permissions:edit-role')->name('deactivate_role');
