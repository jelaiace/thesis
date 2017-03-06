@extends('layout')


@section('content')

<h1>{{ $room->name }}</h1>

	<ul>	
		

		<li> {{ $room->body }} </li>	
	</ul>



@stop