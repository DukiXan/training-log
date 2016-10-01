<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	* desc: Gets exercises grouped by date in ASC order
	*/
    public function getTrainingLog() {
    	$userId = Auth::id();
    	$exercises = Exercise::orderBy('created_at', 'asc')
    							->where('user_id', '=', $userId)
    							->get();

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
    }

	/**
	* desc: Adds an exercise for today's date
	*/
    public function postExercise(Request $request) {


		$this->validate($request, [
	    	'name' => 'required|max:255',
	    ]);

		$exercise = new Exercise();

		$this->authorize('canPerformAction', $exercise);

		$exercise->name = $request->name;
		$exercise->notes = $request->notes;
		$exercise->user_id = Auth::id();
		$exercise->date = date("Y-m-d");
		$exercise->save();

		return redirect('/');
    }

	/**
	* desc: Deletes an exercise by id
	*/
    public function deleteExercise($id) {
		$exercise = Exercise::findOrFail($id);

		$this->authorize('canPerformAction', $exercise);

		$exercise->delete();

		return redirect('/');
    }

	/**
	* desc: Gets all used dates
	*/
    public function getDates() {
    	$userId = Auth::id();
		$datesRaw = Exercise::groupBy('date')
    							->where('user_id', '=', $userId)
    							->get();

		$dates = array();
		foreach ($datesRaw as $date) {
			array_push($dates, $date->date);
		}

		return view('dateFilter', [
			'dates' => $dates,
		]);
    }

	/**
	* desc: Gets exercises by date
	*/
    public function getExercisesByDate($date) {
    	$userId = Auth::id();
    	$exercises = Exercise::orderBy('created_at')
								->where('date', '=', $date)
								->where('user_id', '=', $userId)
								->get();

		return view('exercisesByDate', [
			'exercises' => $exercises,
			'date' => $date
		]);
    }

	/**
	* desc: Gets all exercises
	*/
    public function getExercises() {
    	$userId = Auth::id();
    	$exercises = Exercise::groupBy('name')
								->where('user_id', '=', $userId)
								->get();

		return view('exercises', [
			'exercises' => $exercises,
		]);
    }

	/**
	* desc: Gets exercise by name
	*/
    public function getExerciseByName($name) {
    	$userId = Auth::id();
    	$exercises = Exercise::where('name', '=', $name)
								->where('user_id', '=', $userId)
								->get();
		
		return view('exercisePreview', [
			'exercises' => $exercises,
			'name' => $name
		]);
    }

	/**
	* desc: Gets exercises by id
	*/
    public function getExerciseById($id) {
    	$userId = Auth::id();
    	$exercise = Exercise::where('id', '=', $id)
								->where('user_id', '=', $userId)
								->get();

		return view('editExercise', [
			'exercise' => $exercise,
		]);
    }

	/**
	* desc: Updates an exercise record
	*/
    public function putExercise(Request $request) {
    	$this->validate($request, [
	    	'name' => 'required|max:255',
	    ]);

		$exercise = Exercise::find($request->id);

		$this->authorize('canPerformAction', $exercise);

		$exercise->name = $request->name;
		$exercise->notes = $request->notes;
		$exercise->date = $request->date;
		$exercise->save();

		return redirect('/');
    }
}
