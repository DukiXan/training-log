@extends('layouts.app')

@section('content')
<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
            Select an exercise
        </div>

        <div class="panel-body">
            <table class="table table-striped exercise-table">
                <!-- Table Body -->
                <tbody>
				    @foreach ($exercises as $exercise)
                	<tr>
                		<td>
				    		<a href="exercises/{{ $exercise->name }}">{{ $exercise->name }} </a>
				    	</td>
					</tr>
				    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection