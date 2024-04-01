<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ScanQRController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\CheckAuthMiddleware;
use App\Http\Controllers\TimeTrashController;
use App\Http\Controllers\TypeTrashController;
use App\Http\Controllers\AdminGiftController;
use App\Http\Controllers\MapController;

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

Route::get('/index', [TrashController::class, 'trashIndex'])->name('index')->middleware(CheckAuthMiddleware::class . ':1');
Route::get('/user_client', [ScanQRController::class, 'index'])->name('user_client')->middleware(CheckAuthMiddleware::class . ':0');

Route::get('/sign-in',  [AuthController::class, 'signinPage']);

Route::get('/qr-code/{id}', [ScanQRController::class, 'redirectToRoute'])->middleware(CheckAuthMiddleware::class . ':0');

Route::get('/signup', function () {
    return view('auth.signup');
});
Route::get('/', [MapController::class, 'index'])->name('/');
Route::get('do-rac', [TypeTrashController::class, 'do-rac'])->name('do-rac')->middleware(CheckAuthMiddleware::class);
Route::get('admin', [TrashController::class, 'admin'])->name('admin')->middleware(CheckAuthMiddleware::class  . ':1');
Route::resource('time_trash', TimeTrashController::class)
    ->middleware(CheckAuthMiddleware::class  . ':1');

Route::resource('trash', TrashController::class)
    ->middleware(CheckAuthMiddleware::class  . ':1');

Route::resource('type_trash', TypeTrashController::class)
    ->middleware(CheckAuthMiddleware::class  . ':1');

Route::resource('users', UsersController::class)
    ->middleware(CheckAuthMiddleware::class . ':1');

Route::resource('gifts', AdminGiftController::class)
    ->middleware(CheckAuthMiddleware::class . ':1');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::get('signup', [AuthController::class, 'signup']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('addPoint/{trashType}/{unable}', [UsersController::class, 'addPoint'])->name('addPoint');
Route::get('trashDelete/{id}', [TypeTrashController::class, 'trashDelete'])->name('trashDelete');
Route::post('/gifts/exchange/{id}', [AdminGiftController::class, 'exchange'])->name('gifts.exchange');