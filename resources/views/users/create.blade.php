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

						<label>Username</label>
						<input type="text" placeholder="email" name="email" class="form-control">

						<label>Password</label>
						<input type="password" placeholder="password" name="password" class="form-control">

						<label>Type</label>
						<select name="type" class="form-control">
							<option>Select User</option>
							<option value="admin">Admin</option>
							<option value="admin">Vice President</option>
							<option value="admin">President</option>
							<option value="dean">Dean</option>
							<option value="professor">Professor</option>
						</select>

						<label>Assign Department</label>
						<select name="department_id" class="form-control">
						<option>Select Department</option>
						@foreach($departments as $department)
						<option value="{{$department->id}}">
							{{ $department->name}}
						</option>
						@endforeach
						</select>
					

					<button class="btn btn-info">Create New Users</button>
					</div>
				</form>
			</div>
		</div>
	</div>


@stop