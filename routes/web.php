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

Route::get('/', function () {
    return view('welcome');
})->middleware(['web', 'Second']);

Route::get('/hello', function () {
    return "hello2";
});
Route::get('/there', function () {
    return "hello2";
});
Route::get('/usercontroller/path',[
    'middleware' => 'First',
    'uses' => 'UserController@showPath'
 ]);
Route::redirect('/here', '/there', 301);
Route::view('/new', 'welcome', ['name' => 'Taylor']);
Route::get('user/{id}', function ($id) {
    return $id;
});
Route::get('/users', 'Users@getUsers');
Route::get('/users/add-user', 'Users@form');
Route::post('/users/submit', 'Users@addUser');
Route::get('/users/delete/{id}', 'Users@deleteUser');
Route::get('/users/edit/{id}', 'Users@editUser');
Route::post('/users/edit/{id}', 'Users@updateUser');

Route::get('/one-to-one', 'Users@get_one_to_one_data');

Route::get('/belongs-to-many', 'Users@get_users_roles_data');

Route::get('/pdf', 'PDFMaker@makepdf');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', 'RestoController@index');

// Route::get('/list', 'RestoController@list');


/* Ajax Crud Routes */
Route::resource('ajax-crud', 'AjaxCrudController');

Route::post('ajax-crud/update', 'AjaxCrudController@update')->name('ajax-crud.update');

Route::get('ajax-crud/destroy/{id}', 'AjaxCrudController@destroy');
/* Ajax Crud Routes */

// -----------------------------login facebook ------------------------------
Route::get('auth/facebook', 'SocialauthController@redirect');
Route::get('auth/callback', 'SocialauthController@callback');



// -----------------------------Login Google ------------------------------
Route::get('/auth/redirect/{provider}', 'SocialauthController@redirect');
Route::get('/callback/{provider}', 'SocialauthController@callback');


/* Ajax Crud Routes */
Route::resource('simple-ajax-crud', 'SimpleAjaxCrudController');
Route::post('simple-ajax-crud/add', 'SimpleAjaxCrudController@create');
Route::post('simple-ajax-crud/update', 'SimpleAjaxCrudController@update')->name('simple-ajax-crud.update');
Route::post('simple-ajax-crud/{id}/delete', 'SimpleAjaxCrudController@delete');
Route::post('simple-ajax-crud/{id}/edit', 'SimpleAjaxCrudController@edit');



/* File Upload */

Route::get('/uploadfile', 'UploadfileController@index');
Route::post('/uploadfile', 'UploadfileController@upload');

/* Ajax File Upload */
Route::get('/ajax-uploadfile', 'AjaxImageUploadController@ajaxImageUpload');
Route::post('/ajax-uploadfile', 'AjaxImageUploadController@ajaxImageUploadPost');

Route::get('/export_excel', 'ExportExcelController@index');

Route::get('/export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');

Route::get('/export_excel/csv', 'ExportExcelController@csv');

Route::post('/export_excel/import-excel', 'ExportExcelController@import_excel')->name('file-import');