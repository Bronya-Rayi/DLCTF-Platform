<h1 align="center">DL&S-Platform🚩</h1>


## ♻ About DL&S-Platform

```php
DL&S 来自 SDPC

此平台用于DLCTF比赛，欢迎star

Ubuntu16.04+Laravel+Mysql+Nginx

比赛前端界面与0ops的平台一致，皆为开源html5模板
    
管理员的学号为：00000001，注册时请注意
    
其他人员注册时学号可以随便填
```

## 😋 How to use

1. Route
```php
Route::get('/login', 'IndexController@login')->name('login');
Route::get('/register', 'IndexController@register')->name('register');;
Route::post('/auth/login', 'Auth\LoginController@login');
Route::post('/auth/register', 'Auth\RegisterController@register');
Route::any('/team', 'IndexController@team');
Route::any('/logout', 'Auth\LoginController@logout')->name('logout');


/*
 * ctf平台主页面
 */

Route::get('/', 'CtfPlatform\CtfController@index');
Route::get('/home', 'CtfPlatform\CtfController@index');
Route::get('/about','CtfPlatform\CtfController@about');
Route::get('/challenges','CtfPlatform\CtfController@challenges');
Route::get('/un_challenges','CtfPlatform\CtfController@challenges');
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

```

2. Run it

```bash

>git clone https://github.com/sdpc-ctf/DLCTF-Platform.git

>cd dlctf-platform

>cp .env.example .env

>vim .env to update database

>composer install

>php artisan key:generate

>mysql -uroot -p ctf < ctf_Platform.sql

>php artisan serve --host=0.0.0.0

>http://yourip:8000/ 

>Admin:注册时学号为00000001的为管理员

>play ctf:)
```
## 🎞photo

![QQ截图20201005153331](http://pic.rayi.vip/img/QQ截图20201005153331.jpg)

![QQ截图20201005153448](http://pic.rayi.vip/img/QQ截图20201005153448.jpg)

![QQ截图20201005153639](http://pic.rayi.vip/img/QQ截图20201005153639.jpg)

![QQ截图20201005153731](http://pic.rayi.vip/img/QQ截图20201005153731.jpg)