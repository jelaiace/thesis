@extends('layout')


@section('content')

<h1>{{ $subject->name }}</h1>

	<ul>	
		

		<li> {{ $subject->body }} </li>

		

	</ul>



@stop