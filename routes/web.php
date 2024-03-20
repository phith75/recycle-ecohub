<?php
session_start();

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ScanQRController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\CheckAuthMiddleware;
use App\Http\Controllers\TimeTrashController;
use App\Http\Controllers\TypeTrashController;

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

Route::get('/index', [TrashController::class, 'trashIndex'])->middleware(CheckAuthMiddleware::class);
Route::get('/user_client', [ScanQRController::class, 'index'])->name('user_client')->middleware(CheckAuthMiddleware::class);

Route::get('/',  [AuthController::class, 'signinPage']);

Route::get('/qr-code/{id}', [ScanQRController::class, 'redirectToRoute'])->middleware(CheckAuthMiddleware::class);

Route::get('/signup', function () {
    return view('auth.signup');
});

Route::get('/admin', function () {
    return view('admin.dashboad');
})->middleware(CheckAuthMiddleware::class);
Route::resource('time_trash', TimeTrashController::class);
Route::resource('trash', TrashController::class);
Route::resource('type_trash', TypeTrashController::class);
Route::resource('users', UsersController::class);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::get('signup', [AuthController::class, 'signup']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('addPoint/{trashType}/{unable}', [UsersController::class, 'addPoint'])->name('addPoint');
