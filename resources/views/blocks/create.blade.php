@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
				<h1>New Block</h1>


				<form action="/blocks" method="POST">
					<div class="form-group">
						<label>Class Name</label>
						<input type="text" placeholder="Block name" name="name" class="form-control">
						@if($errors->has('name'))
							<p class="u-text-error">
								{{ $errors->first('name') }}
							</p>
						@endif
					</div>

					<div class="form-group">
						<label>Course</label>
						<select name="course_id" class="form-control">
						<option value="">Select Course</option>
							@foreach($courses as $course)
							<option value="{{ $course->id}}">
								{{$course->name}}
							</option>
							@endforeach
						</select>
						@if($errors->has('course_id'))
							<p class="u-text-error">
								{{ $errors->first('course_id') }}
							</p>
						@endif
					</div>

					<div class="form-group">
						<label>Year Level</label>
						<select name="year_level" class="form-control">
							<option value="">Select year level</option>
							<option value="1">1st Year</option>
							<option value="2">2nd Year</option>
							<option value="3">3rd Year</option>
							<option value="4">4th Year</option>
							<option value="5">5th Year</option>
						</select>
						@if($errors->has('year_level'))
							<p class="u-text-error">
								{{ $errors->first('year_level') }}
							</p>
						@endif
					</div>

					<div class="form-group">
						<label>Semester</label>
						<select name="semester" class="form-control">
							<option value="">Select Semester</option>
							<option value="1">1st Semester</option>
							<option value="2">2nd Semester</option>
						</select>
						@if($errors->has('semester'))
							<p class="u-text-error">
								{{ $errors->first('semester') }}
							</p>
					@endif
					</div>
						<button class="btn btn-info">Create new Block</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@stop