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

	$result = array();
	foreach ($exercises as $exercise) {
		if (empty($result[$exercise['date']])) {
			$result[$exercise['date']] = array();
		}

		array_push($result[$exercise['date']], $exercise);
	}

	$result = array_reverse($result);

    return view('home', [
    	'result' => $result,
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
	$exercise->date = date("Y-m-d");
	$exercise->save();

	return redirect('/');
});

Route::delete('/exercise/{id}', function($id) {
	Exercise::findOrFail($id)->delete();

    return redirect('/');
});



Route::get('/dateFilter', function() {
	$datesRaw = DB::table('exercises')
					->groupBy('date')
					->get();

	$dates = array();
	foreach ($datesRaw as $date) {
		array_push($dates, $date->date);
	}

	return view('dateFilter', [
		'dates' => $dates,
	]);
});

Route::get('/dateFilter/{date}', function($date) {
	$exercises = Exercise::orderBy('created_at')
								->where('date', '=', $date)
								->get();

	return view('exercisesByDate', [
		'exercises' => $exercises,
	]);
});


Route::get('/exercises', function() {
	$exercises = Exercise::groupby('name')->get();

	return view('exercises', [
		'exercises' => $exercises,
	]);
});

Route::get('/exercises/{name}', function($name) {
	$exercises = Exercise::where('name', '=', $name)->get();
	
	return view('exercisePreview', [
		'exercises' => $exercises,
	]);
});
