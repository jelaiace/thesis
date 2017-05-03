@extends('layout')

@section('content')

	<div class="container">
		<h1>Edit Course <small>({{ $course->name }})</small></h1>

		<div class="grid">
			<div class="col-md-4">
				<form action="/courses/{{ $course->id }}" method="POST">
					{{ method_field("PUT") }}
					<div class="form-group">
						<label>Course Name</label>
						<input type="text" placeholder="course name" name="name" class="form-control" value=" {{ $course->name}} ">
						@if($errors->has('name'))
							<p class="u-text-error">
								{{ $errors->first('name') }}
							</p>
						@endif
					</div>

					@if (Auth::user()->type !== 'dean')
						<div class="form-group">	
							<label>Assigned Department</label>
							<select name="department_id" class="form-control">
								<option value="">Select Department</option>
								@foreach($departments as $department)
									<option value="{{ $department->id }}" {{ $course->department->id === $department->id ? 'selected' : ''}}>
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

						<button class="btn btn-info">Update Course</button>
					</div>
				</form>
			</div>
			
		</div>

	</div>



@stop