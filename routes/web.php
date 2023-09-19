<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

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

Route::get('/', 'HomeController@index')->name('index');
Route::get('item/{slug}', 'HomeController@show')->name('show');
Route::get('search', 'HomeController@search')->name('search');
Route::get('send', 'HomeController@send')->middleware('auth');
Route::post('send', 'HomeController@store')->middleware('auth');
Route::get('category/{slug}', 'HomeController@categories')->name('categories');
Route::get('gender/{slug}', 'HomeController@genders')->name('genders');
Route::get('search', 'HomeController@search')->name('search');
Route::get('/page/{slug}', 'HomeController@page')->name('page');

// Save comment
Route::post('save-comment','HomeController@save_comment')->middleware('auth');
// Like Or Dislike
Route::post('save-likedislike','HomeController@save_likedislike')->middleware('auth');
// Favorite
Route::post('save-favorite','HomeController@save_favorite')->middleware('auth');
// User 
Route::get('user/edit', 'HomeController@edit_user')->middleware('auth');
Route::post('user/edit', 'HomeController@store_edit_user')->middleware('auth');
Route::get('user/delete/avatar', 'HomeController@delete_avatar')->middleware('auth');
Route::get('user/my-items', 'HomeController@my_items')->middleware('auth');
Route::get('user/my-favorites', 'HomeController@my_favorites')->middleware('auth');
Route::get('user/delete/item/{id}', 'HomeController@delete_item')->middleware('auth');
Route::get('@{username}', 'HomeController@user')->name('user');

// route admin
Route::get('admin', 'Admin@index')->middleware('role:admin');

// route admin/users
Route::get('admin/users', 'Admin@users')->middleware('role:admin');
Route::get('admin/user/delete/{id}', 'Admin@delete_user')->middleware('role:admin');
Route::get('admin/user/add', 'Admin@add_user')->middleware('role:admin');
Route::post('admin/user/add', 'Admin@store_user')->middleware('role:admin');
Route::get('admin/user/edit/{id}', 'Admin@edit_user')->middleware('role:admin');
Route::post('admin/user/edit/{id}', 'Admin@store_edit_user')->middleware('role:admin');

// route admin/pages
Route::get('admin/pages', 'Admin@pages')->middleware('role:admin');
Route::get('admin/page/delete/{id}', 'Admin@delete_page')->middleware('role:admin');
Route::get('admin/page/add', 'Admin@add_page')->middleware('role:admin');
Route::post('admin/page/add', 'Admin@store_page')->middleware('role:admin');
Route::get('admin/page/edit/{id}', 'Admin@edit_page')->middleware('role:admin');
Route::post('admin/page/edit/{id}', 'Admin@store_edit_page')->middleware('role:admin');

// route admin/categories
Route::get('/admin/categories', 'Admin@categories')->middleware('role:admin');
Route::get('/admin/category/delete/{id}', 'Admin@delete_category')->middleware('role:admin');
Route::get('/admin/category/edit/{id}', 'Admin@edit_category')->middleware('role:admin');
Route::post('/admin/category/edit/{id}', 'Admin@store_edit_category')->middleware('role:admin');
Route::get('/admin/category/add', 'Admin@add_category')->middleware('role:admin');
Route::post('/admin/category/add', 'Admin@store_category')->middleware('role:admin');

// route admin/genders
Route::get('/admin/genders', 'Admin@genders')->middleware('role:admin');
Route::get('/admin/gender/delete/{id}', 'Admin@delete_gender')->middleware('role:admin');
Route::get('/admin/gender/edit/{id}', 'Admin@edit_gender')->middleware('role:admin');
Route::post('/admin/gender/edit/{id}', 'Admin@store_edit_gender')->middleware('role:admin');
Route::get('/admin/gender/add', 'Admin@add_gender')->middleware('role:admin');
Route::post('/admin/gender/add', 'Admin@store_gender')->middleware('role:admin');

// route admin/items
Route::get('admin/items', 'Admin@items')->middleware('role:admin');
Route::get('admin/item/delete/{id}', 'Admin@delete_item')->middleware('role:admin');
Route::get('admin/item/add', 'Admin@add_item')->middleware('role:admin');
Route::post('admin/item/add', 'Admin@store_item')->middleware('role:admin');
Route::get('admin/item/edit/{id}', 'Admin@edit_item')->middleware('role:admin');
Route::post('admin/item/edit/{id}', 'Admin@store_edit_item')->middleware('role:admin');

// route admin/comments
Route::get('/admin/comments', 'Admin@comments')->middleware('role:admin');
Route::get('/admin/comment/delete/{id}', 'Admin@delete_comment')->middleware('role:admin');
Route::get('/admin/comment/edit/{id}', 'Admin@edit_comment')->middleware('role:admin');
Route::post('/admin/comment/edit/{id}', 'Admin@store_edit_comment')->middleware('role:admin');

// route admin/advertisements
Route::get('/admin/advertisements', 'Admin@advertisements')->middleware('role:admin');
Route::get('/admin/adv/delete/{id}', 'Admin@delete_adv')->middleware('role:admin');
Route::get('/admin/adv/edit/{id}', 'Admin@edit_adv')->middleware('role:admin');
Route::post('/admin/adv/edit/{id}', 'Admin@store_edit_adv')->middleware('role:admin');
Route::get('/admin/adv/add', 'Admin@add_adv')->middleware('role:admin');
Route::post('/admin/adv/add', 'Admin@store_adv')->middleware('role:admin');

// route admin/settings
Route::get('admin/settings', 'Admin@settings')->middleware('role:admin');
Route::post('admin/settings', 'Admin@update_settings')->middleware('role:admin');
Route::get('admin/settings/delete_logo', 'Admin@delete_logo')->middleware('role:admin');