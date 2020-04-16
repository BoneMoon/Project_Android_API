<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\nota;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('notas', 'NotaController@index');
Route::get('notas/{id}', 'NotaController@show');
Route::post('notas', 'NotaController@store');
Route::put('notas/{id}', 'NotaController@update');
Route::delete('notas/{id}', 'NotaController@delete');
