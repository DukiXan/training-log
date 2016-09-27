<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise;
use App\Http\Requests;

class ExerciseController extends Controller
{
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

    public function deleteExercise($id) {
		Exercise::findOrFail($id)->delete();
		return redirect('/');
    }

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

    public function getDate($date) {
    	$exercises = Exercise::orderBy('created_at')
								->where('date', '=', $date)
								->get();

		return view('exercisesByDate', [
			'exercises' => $exercises,
			'date' => $date
		]);
    }

    public function getExercises() {
    	$exercises = Exercise::groupBy('name')->get();

		return view('exercises', [
			'exercises' => $exercises,
		]);
    }

    public function getExerciseByName($name) {
    	$exercises = Exercise::where('name', '=', $name)->get();
		
		return view('exercisePreview', [
			'exercises' => $exercises,
			'name' => $name
		]);
    }

    public function getExerciseById($id) {
    	$exercise = Exercise::where('id', '=', $id)->get();

		return view('editExercise', [
			'exercise' => $exercise,
		]);
    }

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
