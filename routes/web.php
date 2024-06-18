<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Juki\UmkmController;
use App\Http\Controllers\Juki\ProdukController;
use App\Http\Controllers\Juki\LokerController;
use App\Http\Controllers\Juki\ProfileController;

use App\Http\Controllers\Admin\ListUserController;
use App\Http\Controllers\Admin\ListUmkmController;
use App\Http\Controllers\Admin\ListLokerController;


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
    return view('page.juki.home', ['navbar' => 'navbarHome', 'footer' => 'footer']);
});

// Tampilan Website Sebelum Login
// Route untuk Halaman Utama Website JUKI http://127.0.0.1:8000
Route::get('juki', [PageController::class, 'index'])->name('juki.index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('admin', [PageController::class, 'admin'])->name('admin.dashboard');

// Route Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

// Autentikasi Middleware untuk Role Login User dan Admin
Route::prefix('page')->middleware('authentication')->group(function () {

    // Halaman Website JUKI
    Route::prefix('juki')->middleware('role:superadmin|user')->group(function () {
        // Route Halaman JUKI
        // Route::get('/', [PageController::class, 'juki'])->name('juki.home');
        // Route Halaman UMKM
        Route::get('/umkm', [UmkmController::class, 'showUmkm'])->name('umkm');
        Route::get('/detailUmkm{id}', [UmkmController::class, 'detailUmkm'])->name('detailUmkm');
        Route::get('/searchUmkm', [UmkmController::class, 'searchUmkm'])->name('searchUmkm');
        // Route Halaman Dashboard Manage UMKM
        Route::get('/dashboard', [UmkmController::class, 'showDashboard'])->name('dashboard');
        Route::post('/dashboard', [UmkmController::class, 'storeUmkm'])->name('umkm.store');
        Route::get('/editUmkm/{id}', [UmkmController::class, 'editUmkm'])->name('umkm.edit');
        Route::put('/updateUmkm/{id}', [UmkmController::class, 'updateUmkm'])->name('umkm.update');
        Route::post('/deleteUmkm/{id}', [UmkmController::class, 'destroyUmkm'])->name('umkm.destroy');
        // Route Like
        Route::post('/like', [PageController::class, 'like'])->name('like');
        // Route Manage Produk
        Route::get('/produk', [ProdukController::class, 'showProduk'])->name('produk');
        Route::get('/addProduk', [ProdukController::class, 'addProduk'])->name('produk.add');
        Route::post('/produk', [ProdukController::class, 'storeProduk'])->name('produk.store');
        Route::get('/editProduk/{id}', [ProdukController::class, 'editProduk'])->name('produk.edit');
        Route::put('/updateProduk/{id}', [ProdukController::class, 'updateProduk'])->name('produk.update');
        Route::post('/deleteProduk/{id}', [ProdukController::class, 'destroyProduk'])->name('produk.destroy');
        Route::get('/datatableProduk', [ProdukController::class, 'datatableProduk'])->name('datatableProduk');
        // Route Manage Profile
        Route::get('/profil', [ProfileController::class, 'showProfil'])->name('profil');
        Route::post('/updateProfil', [ProfileController::class, 'updateProfil'])->name('profil.update');
        // Route Halaman Info Loker
        Route::get('/searchLoker', [LokerController::class, 'searchLoker'])->name('searchLoker');
        Route::get('/info-loker', [LokerController::class, 'infoLoker'])->name('info-loker');
        Route::get('/detailLoker{id}', [LokerController::class, 'detailLoker'])->name('detailLoker');
        // Route Manage Loker
        Route::get('/loker', [LokerController::class, 'showLoker'])->name('loker');
        Route::post('/loker', [LokerController::class, 'storeLoker'])->name('loker.store');
        Route::get('/editLoker/{id}', [LokerController::class, 'editLoker'])->name('loker.edit');
        Route::put('/updateLoker/{id}', [LokerController::class, 'updateLoker'])->name('loker.update');
        Route::post('/deleteLoker/{id}', [LokerController::class, 'destroyLoker'])->name('loker.destroy');
        // Route::get('/detailUmkm{id}', [PageController::class, 'produkResource'])->name('produkResource');
    });

    // Halaman Admin
    Route::prefix('admin')->middleware('role:superadmin')->group(function () {
        // Route Manage User
        Route::get('/', [ListUserController::class, 'users'])->name('page.admin.index');
        Route::get('/add', [ListUserController::class, 'addUser'])->name('page.admin.add');
        Route::post('/store', [ListUserController::class, 'storeUser'])->name('page.admin.store');
        Route::get('/edit/{id}', [ListUserController::class, 'editUser'])->name('page.admin.edit');
        Route::put('/update/{id}', [ListUserController::class, 'updateUser'])->name('page.admin.update');
        Route::post('/delete/{id}', [ListUserController::class, 'deleteUser'])->name('page.admin.delete');
        Route::get('/datatableUser', [ListUserController::class, 'datatableUser'])->name('datatableUser');
        // Route Manage UMKM
        Route::get('/listUmkm', [ListUmkmController::class, 'listUmkm'])->name('page.admin.listUmkm');
        Route::get('/addUmkmUser', [ListUmkmController::class, 'addUmkmUser'])->name('page.admin.addUmkm');
        Route::post('/storeUmkmUser', [ListUmkmController::class, 'storeUmkmUser'])->name('page.admin.storeUmkm');
        Route::get('/editUmkmUser/{id}', [ListUmkmController::class, 'editUmkmUser'])->name('page.admin.editUmkm');
        Route::put('/updateUmkmUser/{id}', [ListUmkmController::class, 'updateUmkmUser'])->name('page.admin.updateUmkm');
        Route::post('/deleteUmkmUser/{id}', [ListUmkmController::class, 'deleteUmkmUser'])->name('page.admin.deleteUmkm');
        Route::get('/datatableUmkm', [ListUmkmController::class, 'datatableUmkm'])->name('datatableUmkm');
        // Route Manage Loker
        Route::get('/listLoker', [ListLokerController::class, 'listLoker'])->name('page.admin.listLoker');
        Route::get('/addLokerUser', [ListLokerController::class, 'addLokerUser'])->name('page.admin.addLoker');
        Route::post('/storeLokerUser', [ListLokerController::class, 'storeLokerUser'])->name('page.admin.storeLoker');
        Route::get('/editLokerUser/{id}', [ListLokerController::class, 'editLokerUser'])->name('page.admin.editLoker');
        Route::put('/updateLokerUser/{id}', [ListLokerController::class, 'updateLokerUser'])->name('page.admin.updateLoker');
        Route::post('/deleteLokerUser/{id}', [ListLokerController::class, 'deleteLokerUser'])->name('page.admin.deleteLoker');
        Route::get('/datatableLoker', [ListLokerController::class, 'datatableLoker'])->name('datatableLoker');
    });
});