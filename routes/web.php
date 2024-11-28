<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PodController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('pods', PodController::class);
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::patch('/bookings/{booking}/extend', [BookingController::class, 'extend'])->name('bookings.extend');



Route::get('/add-pods', [PodController::class, 'create'])->name('pods.add');
Route::post('/pods', [PodController::class, 'store'])->name('pods.store');
// Route::get('/book-pods', [PodController::class, 'book'])->name('pods.book');
Route::get('/all-pods', [PodController::class, 'allPods'])->name('pods.index');
Route::delete('/pods/{id}', [PodController::class, 'destroy'])->name('pods.delete');

Route::get('/available-pods', [PodController::class, 'AvailablePods'])->name('pods.available');

Route::get('/pods/book', [PodController::class, 'book'])->name('pods.book');
Route::post('/pods/{id}/book', [PodController::class, 'bookSlot'])->name('pods.book.slot');
Route::post('/pods/{id}/extend', [PodController::class, 'extendBooking'])->name('pods.extend.booking');

Route::get('/pods/{id}', [PodController::class, 'show'])->name('pods.show');


require __DIR__.'/auth.php';
