@extends('layout')

@section('content')

	<div class="container">
	<h1>Edit Class details<small>({{ $block->name }})</small></h1>
		<div class="grid">
			<div class="col-md-4">

				<form action="/blocks/{{$block->id}}" method="POST">
				{{method_field('PUT')}}

					<label>Name</label>
					<input type="text" placeholder="Block name" name="name" class="form-control" value="{{ $block->name}}">

					<label>Course</label>
						<select name="course_id" class="form-control">
							@foreach($courses as $course)
							<option value="{{ $course->id}}">
								{{$course->name}}
							</option>
							@endforeach
						</select>

					<label>Year Level</label>
						<select name="year_level" class="form-control">
							<option value="1">1st Year</option>
							<option value="2">2nd Year</option>
							<option value="3">3rd Year</option>
							<option value="4">4th Year</option>
							<option value="5">5th Year</option>
						</select>

						<label>Semester</label>
						<select name="semester" class="form-control">
							<option value="1">1st Semester</option>
							<option value="2">2nd Semester</option>
						</select>


					<button class="btn btn-info">Update Class Info</button>
				</form>
			</div>
		</div>
	</div>

@stop