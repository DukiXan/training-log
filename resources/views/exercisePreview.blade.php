@extends('layouts.app')

@section('content')
<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
            <b>{{ $name }}</b>
        </div>

        <div class="panel-body">
            <table class="table table-striped exercise-table">
                <!-- Table Body -->
                <tbody>
				    @foreach ($exercises as $exercise)
                	<tr>
                		<td>
				    		<a href="{{ URL::to('/dateFilter') }}/{{ $exercise->date }}">{{ $exercise->date }}</a>
				    	</td>
				    	<td>
				    		{{ $exercise->notes }}
				    	</td>
					</tr>
				    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection