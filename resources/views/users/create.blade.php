@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
				<h1>Create New Users</h1>

				<form action="/users" method="POST">
					<div class="form-group">
						<label>First Name</label>
						<input type="text" placeholder="Enter first name" name="first_name" class="form-control">
						@if($errors->has('first_name'))
							<p class="u-text-error">
								{{ $errors->first('first_name') }}
							</p>
						@endif
					</div>

					<div class="form-group">
						<label>Last Name</label>
						<input type="text" placeholder="Enter last name" name="last_name" class="form-control">
						@if($errors->has('last_name'))
							<p class="u-text-error">
								{{ $errors->first('last_name') }}
							</p>
						@endif
					</div>

					<div class="form-group">
						<label>Username</label>
						<input type="text" placeholder="email" name="email" class="form-control">
						@if($errors->has('email'))
							<p class="u-text-error">
								{{ $errors->first('email') }}
							</p>
						@endif
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="password" placeholder="password" name="password" class="form-control">
						@if($errors->has('password'))
							<p class="u-text-error">
								{{ $errors->first('password') }}
							</p>
						@endif
					</div>
						
					@if (Auth::user()->type !== 'dean')
						<div class="form-group">
							<label>Type</label>
							<select name="type" class="form-control">
								<option>Select User</option>
								<option value="admin">Admin</option>
								<option value="president">President</option>
								<option value="vice-president">Vice President</option>
								<option value="dean">Dean</option>
								<option value="professor">Professor</option>
							</select>
							@if($errors->has('type'))
								<p class="u-text-error">
									{{ $errors->first('type') }}
								</p>
							@endif
						</div>
					@endif
					
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

					<button class="btn btn-info">Create New Users</button>
					</div>
				</form>
			</div>
		</div>
	</div>


@stop