<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
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
Route::get("/show", [TestController::class, "show"]);
Route::post("/store", [TestController::class, "store"]);
Route::post("/update/{id}", [TestController::class, "update"]);
Route::get("/detail/{id}", [TestController::class, "showDetail"]);
Route::delete("/delete/{id}", [TestController::class, "delete"]);
Route::get("/showcategory", [TestController::class, "showCategory"]);
Route::get('/search', [TestController::class, 'index']);
Route::get('/count', [TestController::class, 'statistical']);




