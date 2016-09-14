@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->

        @include('errors.errors')

        <!-- New Exercise Form -->
        <form action="exercise" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Exercise Name -->
            <div class="form-group">
                <label for="exercise" class="col-sm-3 control-label">Exercise Name: </label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="exercise-name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="notes" class="col-sm-3 control-label">Notes: </label>

                <div class="col-sm-6">
                    <input type="text" name="notes" id="exercise-notes" class="form-control">
                </div>
            </div>

            <!-- Add Exercise Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add exercise
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Exercises -->
    @if (count($exercises) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current exercises
            </div>

            <div class="panel-body">
                <table class="table table-striped exercise-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>exercise</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($exercises as $exercise)
                            <tr>
                                <!-- Exercise Name -->
                                <td class="table-text">
                                    <div>{{ $exercise->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $exercise->notes }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $exercise->date }}</div>
                                </td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="exercise/{{ $exercise->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>Delete Exercise</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection