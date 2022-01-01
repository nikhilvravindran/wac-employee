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

Route::get('/',[App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');
Route::get('/employee/add-employee',[App\Http\Controllers\EmployeeController::class,'addEmployee'])->name('add-employee');
Route::get('/employee/edit-employee/{id}',[App\Http\Controllers\EmployeeController::class,'editEmployee'])->name('edit-employee');
Route::get('/employee/list-employee',[App\Http\Controllers\EmployeeController::class,'listEmployee'])->name('list-employee');
Route::post('/employee/create-employee',[App\Http\Controllers\EmployeeController::class,'createEmployee'])->name('create-employee');
Route::post('/employee/update-employee/{id}',[App\Http\Controllers\EmployeeController::class,'updateEmployee'])->name('update-employee');
Route::get('/employee/delete-employee/{id}',[App\Http\Controllers\EmployeeController::class,'deleteEmployee'])->name('delete-employee');

