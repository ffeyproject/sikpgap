<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemEvaluationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\Master\BuyerController;
use App\Http\Controllers\Master\DefectController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ResultSatisfactionsController;
use App\Http\Controllers\SatisfactionController;
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
Auth::routes([
]);
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

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

//Route Asal Masalah

Route::get('asal-masalah', [DepartementController::class, 'index'])->name('asal_masalah.index');
Route::get('asal-masalah/create', [DepartementController::class, 'create'])->name('asal_masalah.create');
Route::post('asal_masalah', [DepartementController::class, 'store'])->name('asal_masalah.store');
Route::get('asal_masalah/update/{departement}', [DepartementController::class, 'edit'])->name('asal_masalah.edit');
Route::patch('asal_masalah/update/{departement}', [DepartementController::class, 'update'])->name('asal_masalah.update');
Route::delete('asalah_masalah/{departement}', [DepartementController::class, 'destroy'])->name('asal_masalah.destroy');

//Route Complaint
Route::get('keluhan', [ComplaintController::class, 'index'])->name('keluhan.index');
Route::get('keluhan/create', [ComplaintController::class, 'create'])->name('keluhan.create');
Route::post('keluhan', [ComplaintController::class, 'store'])->name('keluhan.store');
Route::get('keluhan/show/{complaint}', [ComplaintController::class, 'show'])->name('keluhan.show');
Route::get('keluhan/update/{complaint}', [ComplaintController::class, 'edit'])->name('keluhan.edit');
Route::patch('keluhan/update{complaint}', [ComplaintController::class, 'update'])->name('keluhan.update');
Route::delete('keluhan/{complaint}', [ComplaintController::class, 'destroy'])->name('keluhan.destroy');

//Route Result
Route::get('keluhan/proses/{complaint}', [ResultController::class, 'index'])->name('proses.index');
Route::post('keluhan/proses', [ResultController::class, 'store'])->name('proses.store');
Route::get('keluhan/proses/detail/{complaint}', [ResultController::class, 'detail'])->name('proses.detail');
Route::get('keluhan/cetak/{complaint}', [ResultController::class, 'cetak'])->name('keluhan.cetak');
Route::patch('keluhan/proses/{complaint}', [ResultController::class, 'closed'])->name('proses.closed');
Route::patch('keluhan/proses/closed/{complaint}', [ResultController::class, 'status'])->name('proses.status');
Route::delete('keluhan/proses/delete/{result}', [ResultController::class, 'destroy'])->name('proses.destroy');


//Route Item Penilaian
Route::get('item-penilaian', [ItemEvaluationController::class, 'index'])->name('item.index');
Route::get('item-penilaian/create', [ItemEvaluationController::class, 'create'])->name('item.create');
Route::post('item-penilaian', [ItemEvaluationController::class, 'store'])->name('item.store');
Route::get('item-penilaian/update/{item}', [ItemEvaluationController::class, 'edit'])->name('item.edit');
Route::patch('item-penilaian/update/{item}', [ItemEvaluationController::class, 'update'])->name('item.update');
Route::delete('item-penilaian/{item}', [ItemEvaluationController::class, 'destroy'])->name('item.destroy');

//Route Kepuasan
Route::get('kepuasan', [SatisfactionController::class, 'index'])->name('kepuasan.index');
Route::get('kepuasan/create', [SatisfactionController::class, 'create'])->name('kepuasan.create');
Route::patch('kepuasan/update/{kepuasan}', [SatisfactionController::class, 'update'])->name('kepuasan.update');
Route::get('kepuasan-penilaian/index/{kepuasan}', [SatisfactionController::class, 'vpenilaian'])->name('kepuasan.vpenilaian');
Route::post('kepuasan-penilaian', [ResultSatisfactionsController::class, 'store'])->name('kepuasan-penilaian.store');
Route::get('/kepuasan/create/nyari', 'SatisfactionController@loadNyari');
Route::get('get-customer-list', [SatisfactionController::class, 'getCustomerList'])->name('getCustomerList');
Route::post('kepuasan', [SatisfactionController::class, 'store'])->name('kepuasan.store');
Route::get('kepuasan/update/{kepuasan}', [SatisfactionController::class, 'edit'])->name('kepuasan.edit');
Route::delete('kepuasan/{kepuasan}', [SatisfactionController::class, 'destroy'])->name('kepuasan.destroy');

Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);



 });
// require __DIR__.'/auth.php';
