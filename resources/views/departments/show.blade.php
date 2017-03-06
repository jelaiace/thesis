@extends('layout')


@section('content')

<h1>{{ $departments->name }}</h1>

	<ul>	
		

		<li> {{ $department->body }} </li>

		

	</ul>



@stop