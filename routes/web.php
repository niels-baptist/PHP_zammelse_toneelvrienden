<?php

use App\Play;
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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::redirect('/', '/user/profile');
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');
    Route::get('help', 'User\HelpController@index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    route::resource('reservations', 'Admin\ReservationController');
    route::resource('play', 'Admin\PlayController');
    route::resource('halls', 'Admin\HallController');
    route::resource('performances', 'Admin\PerformanceController');
    route::resource('users', 'Admin\UserController');
    route::resource('mails', 'Admin\MailController');
    Route::resource('tickets', 'Admin\TicketController');

    Route::get('play/{play}/roles', 'Admin\PlayController@showRoles');
    Route::get('help', 'Admin\HelpController@index');
    Route::get('/tickets/{id}/pdf', 'Admin\TicketController@CreatePDF');

    Route::post('addRole', 'Admin\PlayController@saveRoles');

    Route::delete('roles/{role}', 'Admin\PlayController@destroyRoles');

    Route::get('home', 'Admin\HomeController@index');
});

route::resource('/reservations', 'Visitor\ReservationController');
Route::get('/help', 'Visitor\HelpController@index');

Route::redirect('home', '/');

Route::get('/', function () {
    $plays = Play::orderBy('name')->where('active', true)->get();
    $result = compact('plays');
    Json::dump($result);
    return view('home', $result);
});

