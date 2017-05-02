@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
				<h1>New Subject</h1>


				<form action="/subjects" method="POST">
					<div class="form-group">
						<label>Course Number</label>
						<input type="text" placeholder="course number" name="course_number" class="form-control">
						@if($errors->has('course_number'))
							<p class="u-text-error">
								{{ $errors->first('course_number') }}
							</p>
						@endif
					</div>

					<div class="form-group">
						<label>Class Code</label>
						<input type="text" placeholder="class code" name="class_code" class="form-control">
						@if($errors->has('class_code'))
							<p class="u-text-error">
								{{ $errors->first('class_code') }}
							</p>
						@endif
					</div>

					<div class="form-group">	
						<label>Subject Description</label>
						<input type="text" placeholder="subject" name="name" class="form-control">
						@if($errors->has('name'))
							<p class="u-text-error">
								{{ $errors->first('name') }}
							</p>
						@endif
					</div>

					<div class="form-group">	
						<label>Units</label>
						<select name="units" class="form-control">
							<option value="">Select units</option>
							<option value="1">1 unit</option>
							<option value="2">2 units</option>
							<option value="3">3 units</option>
							<option value="4">4 units</option>
							<option value="5">5 units</option>
						</select>
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
							<option value="{{$department->id}}">
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
						<button class="btn btn-info">Create new Subject</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@stop