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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/mic', 'mic');
Route::view('/tts', 'tts');
Route::post('/konversi', 'TTSController@konversi');
Route::view('/prediksi', 'prediksi');

Route::post('/upload', 'voicebotController@transcriptB');
Route::view('/VOICEBOT', 'voiceBotA');

Route::post('/upload1', 'voicebotController@transcriptA');
Route::post('/inputKalimat', 'voicebotController@inputKalimat');
Route::post('/inputKalimatTidak', 'voicebotController@inputKalimatTidak');
Route::view('/VOlCEBOT', 'voiceBotB');

Route::post('/cekprediksi', 'ClientController@getData');

Route::post('/cekprediksi/{id}', 'TabelController@predict');
//new
Route::get('/tabel', 'TabelController@show');
Route::get('/transcript/{id}', 'TabelController@transcript');
Route::get('/tes', 'TTSController@tes');


Route::match(['get', 'post'], '/botman', 'BotManController@handle');

Route::view('/iframe','layouts.iframe');