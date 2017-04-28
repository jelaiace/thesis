@extends('layout')

@section('content')
<div class="container">
	<div class="grid">
		<div class="col-md-4">
			<h1>Edit Users details ({{$user->name}}) </h1>

			<form action="/users/{{ $user->id }}" method="POST">
				{{method_field ("PUT") }}

				<div class="form-group">
					<label>First Name</label>
					<input type="text" placeholder="Enter first name" name="first_name" class="form-control" value="{{ $user->first_name }}">
					@if($errors->has('first_name'))
							<p class="u-text-error">
								{{ $errors->first('first_name') }}
							</p>
					@endif
				</div>

				<div class="form-group">
					<label>Last Name</label>
					<input type="text" placeholder="Enter last name" name="last_name" class="form-control" value="{{ $user->last_name }}">
					@if($errors->has('last_name'))
							<p class="u-text-error">
								{{ $errors->first('last_name') }}
							</p>
					@endif
				</div>				

				<div class="form-group">
					<label>Username</label>
					<input type="text" placeholder="Enter name" name="email" class="form-control" value="{{ $user->email }}">
					@if($errors->has('email'))
							<p class="u-text-error">
								{{ $errors->first('email') }}
							</p>
					@endif
				</div>

				<div class="form-group">
					<label>Password</label>
					<input type="password" placeholder="*****" name="password" class="form-control">
					@if($errors->has('password'))
							<p class="u-text-error">
								{{ $errors->first('password') }}
							</p>
					@endif
				</div>

				<div class="form-group">
					<label>Password Confirmation</label>
					<input type="password" placeholder="*****" name="password_confirmation" class="form-control">
					@if($errors->has('password_confirmation'))
							<p class="u-text-error">
								{{ $errors->first('password_confirmation') }}
							</p>
					@endif
				</div>

				<div class="form-group">
					<label>Type</label>
					<select name="type" class="form-control">
						<option value="admin" {{ $user->type === 'admin' ? 'selected' : '' }}>Admin</option>
						<option value="dean" {{ $user->type === 'dean' ? 'selected' : '' }}>Dean</option>
						<option value="professor" {{ $user->type === 'professor' ? 'selected' : '' }}>Professor</option>
					</select>
					@if($errors->has('type'))
							<p class="u-text-error">
								{{ $errors->first('type') }}
							</p>
					@endif
				</div>

				@if (Auth::user()->type !== 'dean')
					<div class="form-group">
						<label>Assign Department</label>
						<select name="department_id" class="form-control">
							<option value="">Select Department</option>
							
							@foreach($departments as $department)
								<option value="{{ $department->id }}" @if($user->department->id === $department->id) selected @endif>
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

					<button class="btn btn-info">Update User details</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop