<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndexController;
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

Route::get('/test', function () {
    return "test route";
});
Route::get('/test/user', [IndexController::class, 'user']);
