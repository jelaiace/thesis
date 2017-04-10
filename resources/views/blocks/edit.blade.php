@extends('layout')

@section('content')

	<div class="container">
	<h1>Edit Class details<small>({{ $block->name }})</small></h1>
		<div class="grid">
			<div class="col-md-4">

				<form action="/blocks/{{$block->id}}" method="POST">
				{{method_field('PUT')}}

				<div class="form-group">
					<label>Name</label>
					<input type="text" placeholder="Block name" name="name" class="form-control" value="{{ $block->name}}">
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
								<option value="{{ $course->id}}" {{ $block->course->id === $course->id ? 'selected' : '' }} >
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
							<option value="1"{{ $block->year_level === 1 ? 'selected' : '' }}>1st Year</option>
							<option value="2"{{ $block->year_level === 2 ? 'selected' : '' }}>2nd Year</option>
							<option value="3"{{ $block->year_level === 3 ? 'selected' : '' }}>3rd Year</option>
							<option value="4"{{ $block->year_level === 4 ? 'selected' : '' }}>4th Year</option>
							<option value="5"{{ $block->year_level === 5 ? 'selected' : '' }}>5th Year</option>
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
							<option value="1" {{ $block->semester === 1 ? 'selected' : '' }}>1st Semester</option>
							<option value="2" {{ $block->semester === 2 ? 'selected' : '' }}>2nd Semester</option>
						</select>
						@if($errors->has('semester'))
							<p class="u-text-error">
								{{ $errors->first('semester') }}
							</p>
					@endif
				</div>

					<button class="btn btn-info">Update Class Info</button>
				</form>
			</div>
		</div>
	</div>

@stop