<?php

use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\InventoryController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\StockInController;
use App\Http\Controllers\api\StockOpnameController;
use App\Http\Controllers\api\StockOutController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Requests\StockOpnameRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);

Route::get('suppliers', [SupplierController::class, 'index']);
Route::post('supplier', [SupplierController::class, 'store']);
Route::put('supplier/{id}', [SupplierController::class, 'update']);
Route::delete('supplier/{id}', [SupplierController::class, 'destroy']);

Route::get('stockins', [StockInController::class, 'index']);
Route::post('stockin', [StockInController::class, 'store']);
Route::put('stockin/{id}', [StockInController::class, 'update']);
Route::delete('stockin/{id}', [StockInController::class, 'destroy']);

Route::get('stockouts', [StockOutController::class, 'index']);
Route::post('stockout', [StockOutController::class, 'store']);
Route::put('stockout/{id}', [StockOutController::class, 'update']);
Route::delete('stockout/{id}', [StockOutController::class, 'destroy']);

Route::get('stockopnames', [StockOpnameController::class, 'index']);
Route::post('stockopname', [StockOpnameController::class, 'store']);
Route::put('stockopname/{id}', [StockOpnameController::class, 'update']);
Route::delete('stockopname/{id}', [StockOpnameController::class, 'destroy']);

Route::get('customers', [CustomerController::class, 'index']);
Route::post('customer', [CustomerController::class, 'store']);
Route::put('customer/{id}', [CustomerController::class, 'update']);
Route::delete('customer/{id}', [CustomerController::class, 'destroy']);

Route::get('orders', [OrderController::class, 'index']);
Route::post('order', [OrderController::class, 'store']);
Route::put('order/{id}', [OrderController::class, 'update']);
Route::delete('order/{id}', [OrderController::class, 'destroy']);

Route::get('inventories', [InventoryController::class, 'index']);
Route::post('inventory', [InventoryController::class, 'store']);
Route::put('inventory/{id}', [InventoryController::class, 'update']);
Route::delete('inventory/{id}', [InventoryController::class, 'destroy']);
