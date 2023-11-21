<?php

use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StockOpnameRequest;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\StockInController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\StockOutController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\InventoryController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\StockOpnameController;
use App\Http\Controllers\api\UserController;
use App\Models\Product;
use Spatie\Permission\Contracts\Role;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', function () {
        return auth()->user();
    });
    Route::resource('product', ProductController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('inventory', InventoryController::class);

    Route::resource('order', OrderController::class);
    Route::resource('stockin', StockInController::class);
    Route::resource('stockout', StockOutController::class);
    Route::resource('stockopname', StockOpnameController::class);

    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('/profile', function () {
//         return auth()->user();
//     });
//     Route::resource('product', ProductController::class);
//     Route::resource('supplier', SupplierController::class);u
//     Route::resource('customer', CustomerController::class);
//     Route::resource('inventory', InventoryController::class);

//     Route::resource('order', OrderController::class);
//     Route::resource('stockin', StockInController::class);
//     Route::resource('stockout', StockOutController::class);
//     Route::resource('stockopname', StockOpnameController::class);

//     Route::resource('role', ApiRoleController::class);
//     Route::resource('user', UserController::class);

//     Route::post('/logout', [AuthController::class, 'logout']);
// });
