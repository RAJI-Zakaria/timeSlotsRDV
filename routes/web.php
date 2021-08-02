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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\guestController::class, 'index'])->name('home');

Route::get('/Dashboard-Admin', [App\Http\Controllers\adminController::class, 'index'])->name('Dashboard-Admin');

Route::get('/Dashboard-guest', [App\Http\Controllers\guestController::class, 'index'])->name('Dashboard-Guest');

Route::get('/Dashboard-guest/timeSlots', [App\Http\Controllers\timeSlotsController::class, 'index'])->name('Guest-TimeSlots');

Route::get('/timeSlot/{idTimeSlot}', [App\Http\Controllers\timeSlotsController::class, 'timeSlot'])->name('TimeSlot');

Route::get('/createTimeSlot', [App\Http\Controllers\timeSlotsController::class, 'create'])->name('TimeSlot.create');

Route::post('/storeTimeSlot', [App\Http\Controllers\timeSlotsController::class, 'store'])->name('TimeSlot.store');

Route::get('/deleteTimeSlot/{idTimeSlot}', [App\Http\Controllers\timeSlotsController::class, 'delete'])->name('TimeSlot.delete');


Route::get('/Dashboard-admin/timeSlots', [App\Http\Controllers\timeSlotsController::class, 'index'])->name('admin.timeSlots');

Route::get('/ChangeTimeSlotStatus/{idTimeSlot}', [App\Http\Controllers\timeSlotsController::class, 'changeSlotTimeStatus'])->name('admin.changeSlotTimeStatus');



Route::get('/modifyTimeSlot/{idTimeSlot}', [App\Http\Controllers\timeSlotsController::class, 'modify'])->name('TimeSlot.modify');

Route::post('/updateTimeSlot', [App\Http\Controllers\timeSlotsController::class, 'update'])->name('TimeSlot.update');