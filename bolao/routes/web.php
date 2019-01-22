<?php

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

Route::get('lang', function () {
    $lang = session('lang', 'pt-br');

    if($lang == 'pt-br') {
        $lang = 'en';
    } else {
        $lang = 'pt-br';
    }

    session(['lang' => $lang]);
    return redirect()->back();
})->name('set-language');

Route::get('/modelo', function () {
    return view('welcome');
});

Auth::routes();

Route::namespace('Site')->group(function(){
    Route::get('/', 'PrincipalController@index')->name('principal');
});

Route::middleware('auth')->namespace('Admin')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function(){
    Route::resource('/users', 'UserController');

    //Namespace Admin\Acl
    Route::namespace('Acl')->group(function(){
        Route::resource('/permissions', 'PermissionController');
        Route::resource('/roles', 'RoleController');
    });
});

Route::get('lang/{locale}', function ($locale) {
    App::setLocale($locale);
});

