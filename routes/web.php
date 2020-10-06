<?php

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

Route::get('/', 'IndexController@index');


// 用户身份验证与注册相关的路由
Route::get('/login', 'IndexController@login')->name('login');
Route::get('/register', 'IndexController@register')->name('register');;
Route::post('/auth/login', 'Auth\LoginController@login');
Route::post('/auth/register', 'Auth\RegisterController@register');
Route::any('/team', 'IndexController@team');
Route::post('/reset_password', 'CtfPlatform\CtfController@resetPassword');
Route::any('/logout', 'Auth\LoginController@logout')->name('logout');


/*
 * ctf平台主页面
 */

Route::get('/home', 'CtfPlatform\CtfController@index');
Route::get('/about','CtfPlatform\CtfController@about');
Route::get('/challenges','CtfPlatform\CtfController@challenges');
Route::get('/un_challenges','CtfPlatform\CtfController@challenges');
Route::get('/challenges/{type}','CtfPlatform\CtfController@ctftype')->where('type','[a-z]+');
Route::get('/scoreboard','CtfPlatform\CtfController@score');
Route::post('/flag/submit','CtfPlatform\CtfController@submitflag');
Route::any('/notice','CtfPlatform\CtfController@notice');

/*
 * ctf平台管理页面
 */

Route::get('/ctfadmin/home','CtfPlatform\CtfAdminController@index');
Route::get('/ctfadmin/task','CtfPlatform\CtfAdminController@seetask');
Route::get('/ctfadmin/settime','CtfPlatform\CtfAdminController@settime');

Route::any('/ctfadmin/task/add','CtfPlatform\CtfAdminController@addtask');
Route::get('/ctfadmin/task/delete/{id}','CtfPlatform\CtfAdminController@delete')->where('id','[0-9]+');
Route::any('/ctfadmin/task/edit/{id}','CtfPlatform\CtfAdminController@edittask')->where('id','[0-9]+');
Route::get('/ctfadmin/task/hide/{id}','CtfPlatform\CtfAdminController@hide')->where('id','[0-9]+');
Route::get('/ctfadmin/task/open/{id}','CtfPlatform\CtfAdminController@open')->where('id','[0-9]+');
Route::any('/ctfadmin/task/hint','CtfPlatform\CtfAdminController@hintadd');

Route::any('/ctfadmin/notice','CtfPlatform\CtfAdminController@notice');
Route::get('/ctfadmin/notice/delete/{id}','CtfPlatform\CtfAdminController@noticedelete')->where('id','[0-9]+');
Route::any('/ctfadmin/notice/edit/{id}','CtfPlatform\CtfAdminController@noticeedit')->where('id','[0-9]+');

Route::get('/ctfadmin/team','CtfPlatform\CtfAdminController@seeteam');
Route::any('/ctfadmin/team/edit/{student_id}','CtfPlatform\CtfAdminController@editteam');

Route::post('/ctfadmin/resetDatabase','CtfPlatform\CtfAdminController@resetDatabase');
Route::any('/ctfadmin/changeMatchName','CtfPlatform\CtfAdminController@changeMatchName');


