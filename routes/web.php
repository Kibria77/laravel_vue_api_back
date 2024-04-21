<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\StockController;
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

Route::get('/', [LoginController::class, 'index'])->name('/login');

//=================================== Category Manage Section =================================
Route::middleware(['auth:sanctum', 'verified'])->get('/get-all-color-and-size', [ProductController::class, 'getAllColorSize'])->name('get-all-color-and-size');
Route::middleware(['auth:sanctum', 'verified'])->get('/get-sub-category-by-category', [ProductController::class, 'getSubCategoryByCategory'])->name('get-sub-category-by-category');

Route::middleware(['auth:sanctum', 'verified'])->get('/category-index', [CategoryController::class, 'index'])->name('category-index');
Route::middleware(['auth:sanctum', 'verified'])->post('/category-store', [CategoryController::class, 'store'])->name('category-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-category-status/{id}', [CategoryController::class, 'updateCategoryStatus'])->name('update-category-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-category-info/{id}', [CategoryController::class, 'editCategoryInfo'])->name('edit-category-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/category-info-update/{id}', [CategoryController::class, 'categoryInfoUpdate'])->name('category-info-update');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-category/{id}', [CategoryController::class, 'categoryDelete'])->name('delete-category');

Route::middleware(['auth:sanctum', 'verified'])->get('/subCategory-index', [SubCategoryController::class, 'index'])->name('subCategory-index');
Route::middleware(['auth:sanctum', 'verified'])->post('/subCategory-store', [SubCategoryController::class, 'store'])->name('subCategory-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-subCategory-status/{id}', [SubCategoryController::class, 'update'])->name('update-subCategory-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-subCategory/{id}', [SubCategoryController::class, 'edit'])->name('edit-subCategory');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-subCategory/{id}', [SubCategoryController::class, 'destroy'])->name('delete-subCategory');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-subCategory/{id}', [SubCategoryController::class, 'updateSubCategory'])->name('update-subCategory');

Route::middleware(['auth:sanctum', 'verified'])->get('/brand-index', [BrandController::class, 'index'])->name('brand-index');
Route::middleware(['auth:sanctum', 'verified'])->post('/brand-store', [BrandController::class, 'store'])->name('brand-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-brand-status/{id}', [BrandController::class, 'updateBrandStatus'])->name('update-brand-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-brand-info/{id}', [BrandController::class, 'editBrandInfo'])->name('edit-brand-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/brand-info-update/{id}', [BrandController::class, 'brandInfoUpdate'])->name('brand-info-update');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-brand/{id}', [BrandController::class, 'brandDelete'])->name('delete-brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/color-index', [ColorController::class, 'index'])->name('color-index');
Route::middleware(['auth:sanctum', 'verified'])->post('/color-store', [ColorController::class, 'store'])->name('color-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-color-status/{id}', [ColorController::class, 'updateColorStatus'])->name('update-color-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-color-info/{id}', [ColorController::class, 'editColorInfo'])->name('edit-color-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/color-info-update/{id}', [ColorController::class, 'colorInfoUpdate'])->name('color-info-update');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-color/{id}', [ColorController::class, 'colorDelete'])->name('color-brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/size-index', [SizeController::class, 'index'])->name('size-index');
Route::middleware(['auth:sanctum', 'verified'])->post('/size-store', [SizeController::class, 'store'])->name('size-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-size-status/{id}', [SizeController::class, 'updateSizeStatus'])->name('update-size-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-size-info/{id}', [SizeController::class, 'editSizeInfo'])->name('edit-size-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/size-info-update/{id}', [SizeController::class, 'sizeInfoUpdate'])->name('size-info-update');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-size/{id}', [SizeController::class, 'sizeDelete'])->name('size-brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/unit-index', [UnitController::class, 'index'])->name('unit-index');
Route::middleware(['auth:sanctum', 'verified'])->post('/unit-store', [UnitController::class, 'store'])->name('unit-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-unit-status/{id}', [UnitController::class, 'updateUnitStatus'])->name('update-unit-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-unit-info/{id}', [UnitController::class, 'editUnitInfo'])->name('edit-unit-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/unit-info-update/{id}', [UnitController::class, 'unitInfoUpdate'])->name('unit-info-update');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-unit/{id}', [UnitController::class, 'unitDelete'])->name('unit-brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-product', [ProductController::class, 'index'])->name('add-product');
Route::middleware(['auth:sanctum', 'verified'])->get('/manage-product', [ProductController::class, 'manage'])->name('manage-product');
Route::middleware(['auth:sanctum', 'verified'])->post('/product-store', [ProductController::class, 'createProduct'])->name('product-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-product-status/{id}', [ProductController::class, 'productStatusUpdate'])->name('update-product-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/product-detail/{id}', [ProductController::class, 'productDetails'])->name('product-detail');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-product-info/{id}', [ProductController::class, 'productEdit'])->name('edit-product-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/product-update/{id}', [ProductController::class, 'productUpdate'])->name('product-update');
Route::middleware(['auth:sanctum', 'verified'])->post('/product-delete/{id}', [ProductController::class, 'productDelete'])->name('product-delete');

Route::middleware(['auth:sanctum', 'verified'])->get('/suplier-index', [SuplierController::class, 'index'])->name('suplier-index');
Route::middleware(['auth:sanctum', 'verified'])->post('/suplier-store', [SuplierController::class, 'store'])->name('suplier-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/update-suplier-status/{id}', [SuplierController::class, 'updateSuplierStatus'])->name('update-suplier-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-suplier-info/{id}', [SuplierController::class, 'editSuplierInfo'])->name('edit-suplier-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/suplier-info-update/{id}', [SuplierController::class, 'suplierInfoUpdate'])->name('suplier-info-update');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-suplier/{id}', [SuplierController::class, 'suplierDelete'])->name('delete-suplier');

Route::middleware(['auth:sanctum', 'verified'])->get('/get-id-wish-info', [StockController::class, 'getDataIdWish'])->name('get-id-wish-info');
Route::middleware(['auth:sanctum', 'verified'])->get('/get-product-stock-info', [StockController::class, 'getProductStockInfo'])->name('get-product-stock-info');
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-add', [StockController::class, 'index'])->name('stock-add');
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-manage', [StockController::class, 'manage'])->name('stock-manage');
Route::middleware(['auth:sanctum', 'verified'])->post('/stock-store', [StockController::class, 'store'])->name('stock-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-detail/{id}', [StockController::class, 'detail'])->name('stock-detail');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-stock-info/{id}', [StockController::class, 'edit'])->name('edit-stock-info');
Route::middleware(['auth:sanctum', 'verified'])->post('/stock-update/{id}', [StockController::class, 'update'])->name('stock-update');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
