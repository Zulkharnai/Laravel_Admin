<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;


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


Route::get('/login', [AuthController::class, 'Login'])->name('Login');
Route::post('/LoginUser', [AuthController::class, 'LoginUser'])->name('LoginUser');
Route::get('/LogOut', [AuthController::class, 'LogOut'])->name('LogOut');

Route::group(['prefix' => 'ControlPanel', 'middleware' => 'AuthMiddleware'], function () {

    Route::get('Dashboard', [AuthController::class, 'Dashboard'])->name('Dashboard');
});
