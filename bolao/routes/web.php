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
    $lang = session('lang', 'pt-BR');

    if($lang == 'pt-BR') {
        $lang = 'en';
    } else {
        $lang = 'pt-BR';
    }

    session(['lang' => $lang]);
    return redirect()->back();
})->name('set-language');

Route::get('/', function () {
    $lang = session('lang', 'pt-BR');
    App::setLocale($lang);

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->group(function(){
    Route::resource('/users', 'UserController');
});

Route::get('lang/{locale}', function ($locale) {
    App::setLocale($locale);

});

