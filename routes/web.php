<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageClientController;
use App\Http\Controllers\ImageComplaintController;
use App\Http\Controllers\ItemEvaluationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\Master\BuyerController;
use App\Http\Controllers\Master\DefectController;
use App\Http\Controllers\MenuDashboardController;
use App\Http\Controllers\RawData\RawSatisfactionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ResultSatisfactionsController;
use App\Http\Controllers\SatisfactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Customer;
use App\Models\ImageClient;
use App\Models\ImageComplaint;
use App\Models\MenuDashboard;
use App\Models\RawSatisfaction;
use Balping\JsonRaw\Raw;

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
Route::get('sign-in-google', [UsersController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UsersController::class, 'handleProviderCallback'])->name('user.google.callback');

Auth::routes([]);


Route::get('customer-login', [DashboardController::class, 'index'])->name('customer.login');
// Route::get('customer/login', [UsersController::class, 'login'])->name('customer.login');





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

    // Route::group(['middleware' => ['auth', 'permission']], function() {
        Route::middleware(['backend','permission'])->group(function () {
            Route::get('home', [HomeController::class, 'index'])->name('home');
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

//FRONT END



//Route Buyer
 Route::prefix('buyer')->namespace('Buyer')->group(function(){
Route::get('/', [BuyerController::class, 'index'])->name('buyer.index');
Route::get('buyer/create', [BuyerController::class, 'create'])->name('buyer.create');
Route::post('buyer', [BuyerController::class, 'store'])->name('buyer.store');
Route::get('buyer/update/{buyer}', [BuyerController::class, 'edit'])->name('buyer.edit');
Route::patch('buyer/update/{buyer}', [BuyerController::class, 'update'])->name('buyer.update');
Route::delete('buyer/{buyer}', [BuyerController::class, 'destroy'])->name('buyer.destroy');
 });

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
Route::get('keluhan/rekap', [ComplaintController::class, 'rekap'])->name('keluhan.data');
Route::get('keluhan/rekap/get', [ComplaintController::class, 'anyData'])->name('keluhan.data.cetak');
Route::get('keluhan/create', [ComplaintController::class, 'create'])->name('keluhan.create');
Route::post('keluhan', [ComplaintController::class, 'store'])->name('keluhan.store');
Route::get('keluhan/show/{complaint}', [ComplaintController::class, 'show'])->name('keluhan.show');
Route::get('keluhan/show/print/{complaint}', [ComplaintController::class, 'print'])->name('keluhan.print');
Route::get('keluhan/update/{complaint}', [ComplaintController::class, 'edit'])->name('keluhan.edit');
Route::patch('keluhan/update{complaint}', [ComplaintController::class, 'update'])->name('keluhan.update');
Route::patch('keluhan/update/gambar/{complaint}', [ComplaintController::class, 'egambar'])->name('keluhan.egambar');
Route::delete('keluhan/{complaint}', [ComplaintController::class, 'destroy'])->name('keluhan.destroy');

//Route Image Complaint
Route::post('keluhan/show/image', [ImageComplaintController::class, 'store'])->name('icomplaint.store');
Route::delete('image/delete/{id}', [ImageComplaintController::class, 'destroy'])->name('icomplaint.destroy');

//Route Result
Route::get('keluhan/proses/{complaint}', [ResultController::class, 'index'])->name('proses.index');
Route::post('keluhan/proses', [ResultController::class, 'store'])->name('proses.store');
Route::get('keluhan/proses/detail/{complaint}', [ResultController::class, 'detail'])->name('proses.detail');
Route::get('keluhan/cetak/{complaint}', [ResultController::class, 'cetak'])->name('keluhan.cetak');
Route::patch('keluhan/proses/{complaint}', [ResultController::class, 'closed'])->name('proses.closed');
Route::patch('keluhan/proses/closed/{complaint}', [ResultController::class, 'status'])->name('proses.status');
Route::patch('keluhan/proses/solusi/{complaint}', [ResultController::class, 'esolusi'])->name('proses.esolusi');
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
Route::get('kepuasan/laporan', [SatisfactionController::class, 'laporan'])->name('kepuasan.laporan');
Route::get('kepuasan/laporan-search', [SatisfactionController::class, 'search'])->name('laporan.search');
Route::patch('kepuasan/update/{kepuasan}', [SatisfactionController::class, 'update'])->name('kepuasan.update');
Route::get('kepuasan-penilaian/index/{kepuasan}', [SatisfactionController::class, 'vpenilaian'])->name('kepuasan.vpenilaian');
Route::patch('kepuasan-penilaian/index/update/{kepuasan}', [SatisfactionController::class, 'rnilai'])->name('kepuasan.rnilai');
Route::post('kepuasan-penilaian', [ResultSatisfactionsController::class, 'store'])->name('kepuasan-penilaian.store');
Route::get('/kepuasan/create/nyari', 'SatisfactionController@loadNyari');
Route::get('get-customer-list', [SatisfactionController::class, 'getCustomerList'])->name('getCustomerList');
Route::post('kepuasan', [SatisfactionController::class, 'store'])->name('kepuasan.store');
Route::get('kepuasan/update/{kepuasan}', [SatisfactionController::class, 'edit'])->name('kepuasan.edit');
Route::get('kepuasan-penilaian/cetak/{kepuasan}', [ResultSatisfactionsController::class, 'cetak'])->name('kepuasan.cetak');
Route::delete('kepuasan/{kepuasan}', [SatisfactionController::class, 'destroy'])->name('kepuasan.destroy');

//ROUTE CONTACT
Route::get('pesan', [ContactController::class, 'index'])->name('pesan.index');
Route::delete('pesan/{pesan}', [ContactController::class, 'destroy'])->name('pesan.destroy');

//ROUTE IMEGA CLIENT
Route::get('client', [ImageClientController::class, 'index'])->name('client.index');
Route::get('client/create', [ImageClientController::class, 'create'])->name('client.create');
Route::post('client', [ImageClientController::class, 'store'])->name('client.store');
Route::get('client/update/{image}', [ImageClientController::class, 'edit'])->name('client.edit');
Route::patch('client/update/{image}', [ImageClientController::class, 'update'])->name('client.update');
Route::delete('client/{image}', [ImageClientController::class, 'destroy'])->name('client.destroy');

//ROUTE MENU CUSTOMER
Route::get('menu/customer', [MenuDashboardController::class, 'index'])->name('menu.index');
Route::get('menu/customer/create', [MenuDashboardController::class, 'create'])->name('menu.create');
Route::post('menu/customer', [MenuDashboardController::class, 'store'])->name('menu.store');
Route::get('menu/customer/update/{menuDashboard}', [MenuDashboardController::class, 'edit'])->name('menu.edit');
Route::patch('menu/customer/update/{menuDashboard}', [MenuDashboardController::class, 'update'])->name('menu.update');
Route::delete('menu/customer/{menuDashboard}', [MenuDashboardController::class, 'destroy'])->name('menu.destroy');

//ROUTE RAW DATA
Route::get('raw-data/kepuasan', [RawSatisfactionController::class, 'index'])->name('raw-data.kepuasan');
Route::get('raw-data/kepuasan/detail/{kepuasan}', [RawSatisfactionController::class, 'detail'])->name('raw-data.detail');
Route::patch('raw-data/kepuasan/update/{kepuasan}', [RawSatisfactionController::class, 'update'])->name('raw-data.update');
Route::get('raw-data/keluhan', [RawSatisfactionController::class, 'view'])->name('raw-data.keluhan');
Route::get('raw-data/keluhan/show/{keluhan}', [RawSatisfactionController::class, 'show'])->name('raw-data.keluhan.show');
Route::get('raw-data/keluhan/update/{keluhan}', [RawSatisfactionController::class, 'edit'])->name('raw-data.keluhan.update');
Route::patch('raw-data/keluhan/update/edit/{keluhan}', [RawSatisfactionController::class, 'urdkeluhan'])->name('raw-data.keluhan.edit');



Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);




 });

//UJI COBA DISINI
Route::group(['middleware' => ['auth','customer']], function() {
    // dashboard
    Route::get('customer-dashboard', [DashboardController::class, 'dashboard'])->name('customer.dashboard');

    //PENILAIAN
    Route::get('customer-penilaian', [DashboardController::class, 'penilaian'])->name('customer.penilaian');
    Route::get('customer-penilaian/create', [DashboardController::class, 'create'])->name('penilaian.create');
    Route::post('customer-penilaian/store', [DashboardController::class, 'store'])->name('penilaian.store');
    Route::get('customer-penilaian/index/{kepuasan}', [DashboardController::class, 'cvpenilaian'])->name('penilaian.cvpenilaian');
    Route::get('customer-penilaian/index/view/{kepuasan}', [DashboardController::class, 'fpenilaian'])->name('penilaian.fpenilaian');
    Route::post('customer-penilaian/index', [DashboardController::class, 'spenilaian'])->name('penilaian.spenilaian');
    

    //contact
    Route::get('customer-contact', [DashboardController::class, 'contact'])->name('customer.contact');
    Route::post('customer-contact', [ContactController::class, 'store'])->name('contact.store');
});

// require __DIR__.'/auth.php';