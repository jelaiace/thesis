@extends('layout')

@section('content')
<div class="container">
	<div class="grid">
		<div class="col-md-4">
			<h1>Edit Users details ({{$user->name}}) </h1>

			<form action="/users/{{ $user->id }}" method="POST">
				{{method_field ("PUT") }}

				<div class="form-group">
					<label>Name</label>
					<input type="text" placeholder="Enter name" name="name" class="form-control" value="{{ $user->name }}">

					<label>Username</label>
					<input type="text" placeholder="Enter name" name="email" class="form-control" value="{{ $user->email }}">

					<label>Type</label>
					<select name="type" class="form-control">
						<option value="admin" {{ $user->type === 'admin' ? 'selected' : '' }}>Admin</option>
						<option value="dean" {{ $user->type === 'dean' ? 'selected' : '' }}>Dean</option>
						<option value="professor" {{ $user->type === 'professor' ? 'selected' : '' }}>Professor</option>
					</select>

					<label>Assign Department</label>
					<select name="department_id" class="form-control">
						@foreach($departments as $department)
							<option value=" {{$department->id}} ">
								{{ $department->name}}
							</option>
						@endforeach
					</select>

					<button class="btn btn-info">Update User details</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop