@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
				<h1>New Course</h1>


				<form action="/courses" method="POST">
					<div class="form-group">
						<label>Course Name</label>
						<input type="text" placeholder="course name" name="name" class="form-control">
						@if($errors->has('name'))
							<p class="u-text-error">
								{{ $errors->first('name') }}
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
							@if ($errors->has('department_id'))
								<p class="u-text-error">
									{{ $errors->first('department_id') }}
								</p>
							@endif
						</div>
					@endif
					<button class="btn btn-info">Create new Course</button>
				</form>
			</div>
		</div>
	</div>
@stop