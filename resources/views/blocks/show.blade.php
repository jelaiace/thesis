@extends('layout')


@section('content')

<h1>{{ $block->name }}</h1>

	<ul>	
		

		<li> {{ $block->body }} </li>	
	</ul>



@stop