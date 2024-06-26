<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
})->name('login');

/*** Auth ***/
// Route::get('/login', 'Auth\AuthController@loginIndex')->name('login');
// Route::get('/auth-callback', 'Auth\AuthController@login');
Route::post('/login', 'Auth\AuthController@login');
Route::get('/logout', 'Auth\AuthController@logout');

Route::resource('/workshop', 'Workshop\WorkshopController');
Route::put('workshop/{id}/join', 'Workshop\WorkshopController@join');
Route::get('workshops/filter', 'Workshop\WorkshopController@index');
    
/*** Audience Evaluation ***/
Route::get('workshop/evaluation/audience', 'Evaluations\AudienceEvaluationController@index');
Route::get('workshop/evaluation/audience/filter', 'Evaluations\AudienceEvaluationController@index');
Route::post('workshop/{id}/audience', 'Evaluations\AudienceEvaluationController@store');
Route::get('workshop/{id}/audience/view', 'Evaluations\AudienceEvaluationController@view');
Route::get('workshop/{id}/audience/download', 'Evaluations\AudienceEvaluationController@download');

/*** Speaker Evaluation ***/
Route::get('workshop/evaluation/speaker', 'Evaluations\SpeakerEvaluationController@index');
Route::get('workshop/evaluation/speaker/filter', 'Evaluations\SpeakerEvaluationController@index');
Route::post('workshop/{id}/speaker', 'Evaluations\SpeakerEvaluationController@store');
Route::get('workshop/{id}/speaker/view', 'Evaluations\SpeakerEvaluationController@view');
Route::get('workshop/{id}/speaker/download', 'Evaluations\SpeakerEvaluationController@download');

Route::middleware(['auth', 'admin'])->group(function () {
    
    /*** Topic ***/
    Route::get('topic', 'Workshop\TopicController@index');
    Route::post('topic', 'Workshop\TopicController@store');
    Route::put('topic/{id}', 'Workshop\TopicController@update');
    Route::delete('topic/{id}', 'Workshop\TopicController@destroy');

    /*** Link ***/ 
    Route::get('link', 'Workshop\LinkController@index');
    Route::post('link', 'Workshop\LinkController@store');
    Route::put('link/{id}', 'Workshop\LinkController@update');
    Route::delete('link/{id}', 'Workshop\LinkController@destroy');
});
