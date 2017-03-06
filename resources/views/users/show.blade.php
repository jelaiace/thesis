@extends('layout')


@section('content')

<h1>{{ $professor->name }}</h1>

	<ul>	
		

		<li> {{ $professor->body }} </li>	
	</ul>



@stop