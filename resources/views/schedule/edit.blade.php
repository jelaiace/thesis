@extends('layout')

@section('content')
<div class="container">
	<div class="grid">
		<div class="col-md-4">
			<h1>Edit Schedule details ({{$Schedule->name}}) </h1>

			<form action="/schedule/{{ $schedule->id }}" method="POST">
				{{method_field ("PUT") }}

				<div class="form-group">
					<label>Name</label>
					<input type="text" placeholder="name" name="name" class="form-control" value=" {{$schedule->name}} ">

					<label>Subject</label>
					<select name="subject_id" class="form-control">
						@foreach($subjects as $subject)
							<option value=" {{$subject->id}} ">
								{{ $subject->name}}
							</option>
						@endforeach
					</select>

					<button class="btn btn-info">Edit Professor details</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop