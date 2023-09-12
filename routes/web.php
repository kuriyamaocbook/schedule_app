<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\InvitationController; // コントローラークラスの名前空間を正確に指定


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

//グループ作成
Route::get('/groups/create', [GroupController::class , 'create'])->name('groups.create');
Route::post('/groups', [GroupController::class ,'store'])->name('groups.store');
Route::get('/groups', [GroupController::class ,'index'])->name('groups.index');
Route::get('/groups/{group}', 'GroupController@show')->name('groups.show');
Route::get('/groups/{group}/invite', 'GroupController@inviteForm')->name('groups.invite');
Route::post('/groups/{group}/invite', 'GroupController@invite')->name('groups.invite.submit');
// グループ招待フォームを表示するルート
Route::get('/groups/{group}/invite', [GroupController::class, 'inviteForm'])->name('groups.invite');

// グループ招待を処理するルート
Route::post('/groups/{group}/invite', [GroupController::class, 'invite'])->name('groups.invite.submit');

// グループへの招待フォーム表示
Route::get('/groups/{group}/invite', [GroupController::class ,'inviteForm'])->name('groups.invite.form');

// グループへの招待送信
Route::post('/groups/{group}/invite',  [GroupController::class ,'invite'])->name('groups.invite.submit');
// グループ詳細ページ
Route::get('/groups/{group}', [GroupController::class ,'show'])->name('groups.show');

// 招待フォーム表示
Route::get('/groups/{group}/invite',  [GroupController::class ,'inviteForm'])->name('groups.invite.form');

// 招待を処理
Route::post('/groups/{group}/invite', [GroupController::class ,'invite'])->name('groups.invite.submit');




//紹介機能
Route::get('/invitations', [InvitationController::class, "index"])->name('invitations.index');
Route::post('/invitations/{invitation}/accept', [InvitationController::class, 'accept'])->name('invitations.accept');
Route::delete('/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');
Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
Route::post('/invitations/{invitation}/accept', [InvitationController::class, 'acceptInvitation'])->name('invitations.acceptInvitation');

//サイトに載ってたグループ招待機能
//Route::prefix('register')->name('register.')->group(function () {
    //Route::get('/invited/{token}', 'Auth\RegisterController@showInvitedUserRegistrationForm')->name('invited.{token}');
   // Route::post('/invited', 'Auth\RegisterController@registerInvitedUser')->name('invited');
//});

// 省略

//Route::get('invite', 'InviteController@showLinkRequestForm')->name('invite')->middleware('auth');
//Route::post('invite', 'InviteController@sendInviteFamilyEmail')->name('invite.email')->middleware('auth');

