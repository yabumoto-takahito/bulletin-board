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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// 名前付きルート：名前付きルートは特定のルートへのURLを生成したり、リダイレクトしたりする場合に便利です。ルート定義にnameメソッドをチェーンすることで、そのルートに名前がつけられる。ルートに一度名前を付ければ、その名前をグローバルなroute関数で使用することで、URLを生成したり、リダイレクトしたりできる。
Route::get('/', 'PostController@index')->name('posts.index');

Route::get('/posts/search', 'PostController@search')->name('posts.search');

// Postsコントローラへのリソースフルルートを登録。
Route::resource('/posts', 'PostController', ['except' => ['index']]);

// Usersコントローラへのリソースフルルートを登録
Route::resource('/users', 'UserController');

// Commentsコントローラへのリソースフルルートを登録
Route::resource('/comments', 'CommentController')->middleware('auth');

Route::get('/mail/send', 'MailController@send')->name('mail.send');
