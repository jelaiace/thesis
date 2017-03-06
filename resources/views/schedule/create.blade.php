@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
				<h1>New Schedules</h1>

				<form action="/schedule" method="POST">
					<div class="form-group">
						<label>Name</label>
						<input type="text" placeholder="name" name="name" class="form-control">

						<label>Time</label>
						<input type="text" placeholder="time" name="time" class="form-control">

						<label>Subject</label>
						<select name="subject_id" class="form-control">
						@foreach($subjects as $subject)
						<option value=" {{$subject->id}} ">
							{{ $subject->name}}
						</option>
						@endforeach
						</select>
					

					<button class="btn btn-info">Create New Schedule</button>
					</div>
				</form>
			</div>
		</div>
	</div>


@stop