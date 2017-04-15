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
						@if($errors->has('course_code'))
							<p class="u-text-error">
								{{ $errors->first('course_code') }}
							</p>
						@endif
					</div>

					<div class="form-group">	
						<label>Name</label>
						<input type="text" placeholder="subject" name="name" class="form-control" value=" {{$subject->name}} ">
						@if($errors->has('name'))
							<p class="u-text-error">
								{{ $errors->first('name') }}
							</p>
						@endif
					</div>

					<div class="form-group">	
						<label>Units</label>
						<input type="text" placeholder="units" name="units" class="form-control" value=" {{$subject->units}} ">
						@if($errors->has('units'))
							<p class="u-text-error">
								{{ $errors->first('units') }}
							</p>
						@endif
					</div>

					@if (Auth::user()->type !== 'dean')
					<div class="form-group">	
						<label>Assign Department</label>
						<select name="department_id" class="form-control">
							<option value="">Select Department</option>
							@foreach($departments as $department)
								<option value="{{ $department->id }}" {{ $subject->department->id === $department->id ? 'selected' : ''}}>
									{{ $department->name}}
								</option>
							@endforeach
						</select>
						@if($errors->has('department_id'))
								<p class="u-text-error">
									{{ $errors->first('department_id') }}
								</p>
							@endif
						</div>
						@endif
						
						<button class="btn btn-info">Update Subject</button>
					</div>
				</form>
			</div>
			
		</div>

	</div>



@stop