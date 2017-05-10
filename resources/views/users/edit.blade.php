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

					<button class="btn btn-info">Update User details</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop