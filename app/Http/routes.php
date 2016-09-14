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

Route::get('/', function () {
	$exercises = Exercise::orderBy('created_at', 'asc')->get();
    return view('exercises', [
    	'exercises' => $exercises,
    ]);
});

Route::post('/exercise', function(Request $request) {
	$validator = Validator::make($request->all(), [
		'name' => 'required|max:255',
	]);

	if ($validator->fails()) {
		return redirect('/')
			->withInput()
			->withErrors($validator);
	}

	$exercise = new Exercise();
	$exercise->name = $request->name;
	$exercise->notes = $request->notes;
	var_dump($exercise);
	$exercise->save();

	return redirect('/');
});

Route::delete('/exercise/{id}', function($id) {
	Exercise::findOrFail($id)->delete();

    return redirect('/');
});
