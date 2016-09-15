@extends('layouts.app')

@section('content')
<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
            Select a date
        </div>

        <div class="panel-body">
            <table class="table table-striped exercise-table">
                <!-- Table Body -->
                <tbody>
				    @foreach ($dates as $date)
                	<tr>
                		<td>
				    		<a href="dateFilter/{{ $date }}">{{ $date }} </a>
				    	</td>
					</tr>
				    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection