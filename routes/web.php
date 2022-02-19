<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\Master\BuyerController;
use App\Http\Controllers\Master\DefectController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */

    });

    Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

    Route::group(['prefix' => 'users'], function() {
            Route::get('/', [UsersController::class, 'index'])->name('users.index');
            Route::get('/create', [UsersController::class, 'create'])->name('users.create');
            Route::post('/create', [UsersController::class, 'store'])->name('users.store');
            Route::get('/{user}/show', [UsersController::class, 'show'])->name('users.show');
            Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
            Route::patch('/{user}/update', [UsersController::class, 'update'])->name('users.update');
            Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('users.destroy');
        });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'permission'])->name('dashboard');



//Route Buyer
Route::get('buyer', [BuyerController::class, 'index'])->name('buyer.index');
Route::get('buyer/create', [BuyerController::class, 'create'])->name('buyer.create');
Route::post('buyer', [BuyerController::class, 'store'])->name('buyer.store');
Route::get('buyer/update/{buyer}', [BuyerController::class, 'edit'])->name('buyer.edit');
Route::patch('buyer/update/{buyer}', [BuyerController::class, 'update'])->name('buyer.update');
Route::delete('buyer/{buyer}', [BuyerController::class, 'destroy'])->name('buyer.destroy');

//Route Defect
Route::get('defect', [DefectController::class, 'index'])->name('defect.index');
Route::get('defect/create', [DefectController::class, 'create'])->name('defect.create');
Route::post('defect', [DefectController::class, 'store'])->name('defect.store');
Route::get('defect/update/{defect}', [DefectController::class, 'edit'])->name('defect.edit');
Route::patch('defect/update/{defect}', [DefectController::class, 'update'])->name('defect.update');
Route::delete('defect/{defect}', [DefectController::class, 'destroy'])->name('defect.destroy');

//Route Complaint
Route::get('keluhan', [ComplaintController::class, 'index'])->name('keluhan.index');
Route::get('keluhan/create', [ComplaintController::class, 'create'])->name('keluhan.create');
Route::post('keluhan', [ComplaintController::class, 'store'])->name('keluhan.store');
Route::get('keluhan/show/{complaint}', [ComplaintController::class, 'show'])->name('keluhan.show');
Route::get('keluhan/update/{complaint}', [ComplaintController::class, 'edit'])->name('keluhan.edit');
Route::patch('keluhan/update{complaint}', [ComplaintController::class, 'update'])->name('keluhan.update');
Route::delete('keluhan/{complaint}', [ComplaintController::class, 'destroy'])->name('keluhan.destroy');

//Route Result
Route::get('keluhan/proses/{result}', [ResultController::class, 'index'])->name('proses.index');
Route::patch('keluhan/proses/{complaint}', [ResultController::class, 'status'])->name('proses.status');

Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);
 });
// require __DIR__.'/auth.php';