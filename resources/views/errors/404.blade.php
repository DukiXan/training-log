@extends('layouts.app')

@section('content')
    <div style="text-align: center;">
		<h2>This page doesn't exist.</h2>
		<h3><a href="{{ URL::to('/') }}"> go to homepage? </a></h3>
	</div>
@endsection