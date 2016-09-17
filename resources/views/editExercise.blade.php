@extends('layouts.app')

@section('content')

    @include('errors.errors')
    <div class="panel-body">
        <!-- New Exercise Form -->

        <form action="{{ URL::to('/editExercise') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <!-- Exercise Name -->
            <div class="form-group">
                <label for="exercise" class="col-sm-3 control-label">Exercise Name: </label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="exercise-name" class="form-control" value="{{ $exercise[0]->name }}">
                </div>
            </div>

            <div class="form-group">
                <label for="notes" class="col-sm-3 control-label">Notes: </label>

                <div class="col-sm-6">
                    <input type="text" name="notes" id="exercise-notes" class="form-control" value="{{ $exercise[0]->notes }}">
                </div>
            </div>

            <div class="form-group">
                <label for="date" class="col-sm-3 control-label">Date: </label>

                <div class="col-sm-6">
                    <input type="text" name="date" id="exercise-date" class="form-control" value="{{ $exercise[0]->date }}">
                </div>
            </div>

            <input type="hidden" name="id" id="exercise-id" class="form-control" value="{{ $exercise[0]->id }}">
            <!-- Update Exercise Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Update exercise
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection