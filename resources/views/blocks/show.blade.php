@extends('layout')

@section('title')
	{{ $block->name }}
@stop

@section('content')
	<div class="container">
		<h1>{{ $block->name }}</h1>

		<table class="table table-hover">
			<thead>
		    		<tr>
		    			<th>Schedule</th>
		    			<th>Department</th>
		    			<th>Room</th>
		    			<th>Subject</th>
		    			<th>Units</th>
	    				<th>Professor</th>
		    		</tr>
		    </thead>

		    <tbody>
		    	@foreach($schedules as $schedule)
		    		<tr>
		    			<td>
								{{ date('g:i:a', strtotime($schedule->start_time)) }} - {{ date('g:i:a', strtotime($schedule->end_time)) }}
							</td>

						<td>
							{{ $schedule->room->department->name}}
						</td>

						<td>
							{{ $schedule->room->name}}
						</td>

						<td>
							{{ $schedule->subject->name}}
						</td>

						<td>
							{{ $schedule->subject->units }}
						</td>

						<td>
							{{ $schedule->professor->name}}
						</td>
					</tr> 
				@endforeach

		    </tbody>
		
	</div>
@stop