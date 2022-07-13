<?php
use App\Http\Controllers\T_foodController;

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


Route::get("/create", [T_foodController::class, "create"]);
Route::post("/store", [T_foodController::class, "store"]);
Route::get("/show", [T_foodController::class, "show"]);
Route::get('/showdetail/{id}', [T_foodController::class,'detail']);





