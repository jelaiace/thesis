@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
				<h1>Create New Users</h1>

				<form action="/users" method="POST">
					<div class="form-group">
						<label>Name</label>
						<input type="text" placeholder="name" name="name" class="form-control">
						@if($errors->has('name'))
							<p class="u-text-error">
								{{ $errors->first('name') }}
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
						
					<div class="form-group">
						<label>Type</label>
						<select name="type" class="form-control">
							<option>Select User</option>
							<option value="admin">Admin</option>
							<option value="vice-president">Vice President</option>
							<option value="president">President</option>
							<option value="dean">Dean</option>
							<option value="professor">Professor</option>
						</select>
						@if($errors->has('type'))
							<p class="u-text-error">
								{{ $errors->first('type') }}
							</p>
						@endif
					</div>
					
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

					<button class="btn btn-info">Create New Users</button>
					</div>
				</form>
			</div>
		</div>
	</div>


@stop