@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
    <!-- Current Exercises -->
    @if (count($exercises) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>{{ $date }}</b>
            </div>

            <div class="panel-body">
                <table class="table table-striped exercise-table">
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($exercises as $exercise)
                            <tr>
                                <!-- Exercise Name -->
                                <td class="table-text">
                                    <div>
                                        <a href="{{ URL::to('/exercises') }}/{{ $exercise->name }}">{{ $exercise->name }}</a>
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $exercise->notes }}</div>
                                </td>

                                <td>
                                    <form action="{{ URL::to('/editExercise') }}/{{ $exercise->id }}" method="GET">
                                        <button class="btn btn-default">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </form>
                                </td>
                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ URL::to('/exercise') }}/{{ $exercise->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
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