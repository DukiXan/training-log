@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
    <!-- Current Exercises -->
    @if (count($exercises) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Exercises
            </div>

            <div class="panel-body">
                <table class="table table-striped exercise-table">
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

                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ URL::to('/exercise') }}/{{ $exercise->id }}" method="POST">
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