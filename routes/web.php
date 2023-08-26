<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BrowseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/calendar',[ScheduleController::class, 'show'])->name('show');
Route::post('/calendar/create', [ScheduleController::class, 'create'])->name("create"); // 予定の新規追加
Route::post('/calendar/get',  [ScheduleController::class, 'get'])->name("get"); // DBに登録した予定を取得
Route::put('/calendar/update', [ScheduleController::class, 'update'])->name("update"); // 予定の更新
Route::delete('/calendar/delete', [ScheduleController::class, 'delete'])->name("delete"); // 予定の削除

// routes/web.php

Route::get('/list', [UsersController::class, 'index'])->name('users.index');
Route::post('/batch-update', [UsersController::class, 'batchUpdate'])->name('users.batchUpdate');
Route::post('/calendars/show-selected', [BrowseController::class, 'showSelectedCalendars'])->name('calendars.showSelected');
Route::get('/calendars/{userId}', [UsersController::class, 'showUserCalendar'])->name('calendars.show');
Route::post('calendars/showSelected', [BrowseController::class, 'showSelectedCalendars'])->name('showSelectedCalendars');