<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Exercise;
use Illuminate\Http\Request;

Route::get('/', 'ExerciseController@getTrainingLog');
Route::post('/exercise', 'ExerciseController@postExercise');
Route::delete('/exercise/{id}', 'ExerciseController@deleteExercise');

Route::get('/dateFilter', 'ExerciseController@getExercisesByDate');
Route::get('/dateFilter/{date}', 'ExerciseController@getDate');

Route::get('/exercises', 'ExerciseController@getExercises');
Route::get('/exercises/{name}', 'ExerciseController@getExerciseByName');

Route::get('editExercise/{id}', 'ExerciseController@getExerciseById');
Route::put('editExercise', 'ExerciseController@putExercise');
