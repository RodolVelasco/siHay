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

Route::get('/home', 'HomeController');
Route::post('post', 'PostController')->name('post.store');

Route::get('/', 'SiHayController@bienvenida');

Route::get('/paso1', 'SiHayController@sexo')->name('inicio');
Route::post('/paso1', 'SiHayController@createSexo');

Route::get('/paso2', 'SiHayController@objetivo');
Route::post('/paso2', 'SiHayController@createObjetivo');

Route::get('/paso3', 'SiHayController@preferenciaNutricional');
Route::post('/paso3', 'SiHayController@createPreferenciaNutricional');

Route::get('/paso4', 'SiHayController@actividadFisica');
Route::post('/paso4', 'SiHayController@createActividadFisica');

Route::get('/paso5', 'SiHayController@medida');
Route::post('/paso5', 'SiHayController@createMedida');


Route::get('/resultados', 'SiHayController@resultados');

Route::post('/newsletter', 'SiHayController@createNewsletter');
Route::get('/informacion', 'SiHayController@informacion');
Route::post('/informacion', 'SiHayController@createInformacion');
Route::get('/suscrito', 'SiHayController@suscrito');






//Route::name('login')->get('login', 'LoginController@redirect');
//Route::get('callback', 'LoginController@callback');
//Route::name('logout')->post('logout', 'LoginController@logout');
//
//Route::middleware('auth')->prefix('home')->namespace('Sheets')->group(function () {
//    Route::name('sheets.index')->get('/', 'IndexController');
//    Route::name('sheets.show')->get('/{spreadsheet_id}', 'ShowController');
//    Route::name('sheets.sheet')->get('/{spreadsheet_id}/sheet/{sheet_id}', 'SheetController');
//});
