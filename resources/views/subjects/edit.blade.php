@extends('layout')

@section('content')

	<div class="container">
		<h1>Edit Subject <small>({{ $subject->name }})</small></h1>

		<div class="grid">
			<div class="col-md-4">
				<form action="/subjects/{{ $subject->id }}" method="POST">
					{{ method_field("PUT") }}
					<div class="form-group">
						<label>Course Code</label>
						<input type="text" placeholder="course code" name="course_code" class="form-control" value=" {{ $subject->course_code}} ">

						<label>Name</label>
						<input type="text" placeholder="subject" name="name" class="form-control" value=" {{$subject->name}} ">

						<label>Units</label>
						<input type="text" placeholder="units" name="units" class="form-control" value=" {{$subject->units}} ">

						<label>Assign Department</label>
					<select name="department_id" class="form-control">
						@foreach($departments as $department)
							<option value=" {{$department->id}} ">
								{{ $department->name}}
							</option>
						@endforeach
					</select>


						<button class="btn btn-info">Update Subject</button>
					</div>
				</form>
			</div>
			
		</div>

	</div>



@stop