<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LadisaRoomController;
use App\Http\Controllers\LadisaRoomTypeController;
use App\Http\Controllers\LadisaVisitorController;
use App\Http\Controllers\LadisaBookingController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/homepage', [LadisaRoomController::class, 'index'])
    ->middleware('auth')
    ->name('homepage');

Route::middleware(['auth', 'roleadminladisa'])->group(function () {
    // LadisaRoomController
    Route::get('/room/create', [LadisaRoomController::class, 'create'])->name('room.create');
    Route::post('/room', [LadisaRoomController::class, 'store'])->name('room.store');
    Route::get('/room/{id}/edit', [LadisaRoomController::class, 'edit'])->name('room.edit');
    Route::put('/room/{id}', [LadisaRoomController::class, 'update'])->name('room.update');
    Route::delete('/room/{id}', [LadisaRoomController::class, 'destroy'])->name('room.destroy');

    // LadisaRoomTypeController
    Route::get('/roomtype/create', [LadisaRoomTypeController::class, 'create'])->name('roomtype.create');
    Route::post('/roomtype', [LadisaRoomTypeController::class, 'store'])->name('roomtype.store');
    Route::get('/roomtype/{id}/edit', [LadisaRoomTypeController::class, 'edit'])->name('roomtype.edit');
    Route::put('/roomtype/{id}', [LadisaRoomTypeController::class, 'update'])->name('roomtype.update');
    Route::delete('/roomtype/{id}', [LadisaRoomTypeController::class, 'destroy'])->name('roomtype.destroy');

    // LadisaVisitorController
    Route::get('/visitor/create', [LadisaVisitorController::class, 'create'])->name('visitor.create');
    Route::post('/visitor', [LadisaVisitorController::class, 'store'])->name('visitor.store');
    Route::get('/visitor/{id}/edit', [LadisaVisitorController::class, 'edit'])->name('visitor.edit');
    Route::put('/visitor/{id}', [LadisaVisitorController::class, 'update'])->name('visitor.update');
    Route::delete('/visitor/{id}', [LadisaVisitorController::class, 'destroy'])->name('visitor.destroy');

    // LadisaBookingController (Admin)
    Route::get('/booking/create', [LadisaBookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [LadisaBookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}/edit', [LadisaBookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [LadisaBookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{id}', [LadisaBookingController::class, 'destroy'])->name('booking.destroy');
    Route::post('/booking/{id}/confirm', [LadisaBookingController::class, 'confirm'])->name('booking.confirm');
    Route::post('/booking/{id}/cancel', [LadisaBookingController::class, 'cancel'])->name('booking.cancel');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/room/{id}', [LadisaRoomController::class, 'show'])->name('room.show');
    Route::get('/booking', [LadisaBookingController::class, 'index'])->name('booking.index');
    
    // User Booking Routes
    Route::get('/booking/room/{roomId}', [LadisaBookingController::class, 'createUserBooking'])->name('booking.user.create');
    Route::post('/booking/user', [LadisaBookingController::class, 'storeUserBooking'])->name('booking.user.store');
    

});
