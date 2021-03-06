@extends('layouts.app')

@section('content')
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add exercise
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Exercises -->
    @if (count($result) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current exercises
            </div>

            <div class="panel-body">
                <table class="table table-striped exercise-table">
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($result as $date => $exercises)
                            <tr>
                                <td style="background: #d3d3d3" class="table-text">
                                    <a href="{{ URL::to('/dateFilter') }}/{{ $date }}">
                                        <b>{{ $date }}</b>
                                    </a>
                                </td>
                                @foreach ($exercises as $exercise)
                                <tr>
                                    <!-- Exercise Name -->
                                    <td class="table-text">
                                        <div>
                                            <a href="{{ URL::to('/exercises') }}/{{ $exercise->name }}">
                                                {{ $exercise->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $exercise->notes }}</div>
                                    </td>

                                    <td>
                                        <form action="editExercise/{{ $exercise->id }}" method="GET">
                                            <button class="btn btn-default">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                        </form>
                                    </td>

                                    <!-- Delete Button -->
                                    <td>
                                        <form action="exercise/{{ $exercise->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection