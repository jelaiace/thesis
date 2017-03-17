@extends('layout')

@section('content')
	<div class="container">
		<h1>{{ $block->name }}</h1>

		<table class="table table-hover">
			<thead>
		    		<tr>
		    			<th>Time</th>
		    			<th>Subject Description</th>
		    			<th>Units</th>
		    			<th>Room</th>
	    				<th>Professor</th>
	    				<th>Department</th>
		    		</tr>
		    </thead>

		    <tbody>
		    	@foreach($block->schedules as $schedule)
		    		<tr>
		    			<td>
							{{ date('g:i:a', strtotime($schedule->start_time)) }} - {{ date('g:i:a', strtotime($schedule->end_time)) }}
						</td>

						<td>
							{{ $schedule->subject->name}}
						</td>

						<td>
							{{ $schedule->subject->units}}
						</td>

						<td>
							{{ $schedule->room->name}}
						</td>

						<td>
							{{ $schedule->professor->name}}
						</td>

						<td>
							{{ $schedule->room->department->name}}
						</td>

					</tr> 
				@endforeach

		    </tbody>
		
	</div>
@stop