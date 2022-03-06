<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function(){
    return view('welcome');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'member'], function(){
    Route::get('/list', 'MemberController@getMemberDataTable')->name('member.table');
});

Route::delete('member/{id} ', 'MemberController@destroy')->name('member.destroy');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('/member', 'MemberController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
