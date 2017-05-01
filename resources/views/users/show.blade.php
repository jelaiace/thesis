@extends('layout')

@section('title')
	{{ $user->name }}
@stop

@section('content')
	<div class="container">
		
  		<h4>{{ $user->name }}</h4>

			@foreach($groups as $group => $schedules)
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>{{ $group }}</strong>
				</div>
				<table class="table table-hover">
					<thead>
		    		<tr>
		    			<th>Schedule</th>
		    			<th>Department</th>
		    			<th>Room</th>
		    			<th>Subject</th>
		    			<th>Blocks</th>
		    			<th>Units</th>
		    		</tr>
			    </thead>

			    <tbody>
			    	@foreach($schedules as $schedule)
			    		<tr>
			    				<td>
									{{ $schedule->formatted_time }}
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
									{{ $schedule->block->name }}
								</td>

								<td>
									{{ $schedule->subject->units }}
								</td>
						</tr> 
					@endforeach
			    </tbody>
		  	</table>
		  </div>
		@endforeach
	</div>
@stop