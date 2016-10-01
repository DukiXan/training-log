<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise;
use App\Http\Requests;

class ExerciseController extends Controller
{
	/**
	* desc: Gets exercises grouped by date in ASC order
	*/
    public function getTrainingLog() {
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
    }

	/**
	* desc: Adds an exercise for today's date
	*/
    public function postExercise(Request $request) {
		$this->validate($request, [
	    	'name' => 'required|max:255',
	    ]);

		$exercise = new Exercise();
		$exercise->name = $request->name;
		$exercise->notes = $request->notes;
		$exercise->date = date("Y-m-d");
		$exercise->save();

		return redirect('/');
    }

	/**
	* desc: Deletes an exercise by id
	*/
    public function deleteExercise($id) {
		Exercise::findOrFail($id)->delete();
		return redirect('/');
    }

	/**
	* desc: Gets all used dates
	*/
    public function getDates() {
		$datesRaw = Exercise::groupBy('date')->get();

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
    	$exercises = Exercise::orderBy('created_at')
								->where('date', '=', $date)
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
    	$exercises = Exercise::groupBy('name')->get();

		return view('exercises', [
			'exercises' => $exercises,
		]);
    }

	/**
	* desc: Gets exercise by name
	*/
    public function getExerciseByName($name) {
    	$exercises = Exercise::where('name', '=', $name)->get();
		
		return view('exercisePreview', [
			'exercises' => $exercises,
			'name' => $name
		]);
    }

	/**
	* desc: Gets exercises by id
	*/
    public function getExerciseById($id) {
    	$exercise = Exercise::where('id', '=', $id)->get();

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
		$exercise->name = $request->name;
		$exercise->notes = $request->notes;
		$exercise->date = $request->date;
		$exercise->save();

		return redirect('/');
    }
}
