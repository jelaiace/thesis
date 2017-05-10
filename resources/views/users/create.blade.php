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
						<div class="form-group" \>
							<label>Type</label>
							<select name="type" class="form-control js-form-type">
								<option>Select User</option>
								<option @if(old('type') === 'admin') selected @endif value="admin">Admin</option>
								<option @if(old('type') === 'president') selected @endif value="president">President</option>
								<option @if(old('type') === 'vice-president') selected @endif value="vice-president">Vice President</option>
								<option @if(old('type') === 'dean') selected @endif value="dean">Dean</option>
								<option @if(old('type') === 'professor') selected @endif value="professor">Professor</option>
							</select>
							@if($errors->has('type'))
								<p class="u-text-error">
									{{ $errors->first('type') }}
								</p>
							@endif
						</div>
					@endif
					
					@if (Auth::user()->type !== 'dean')
						<div class="form-group js-dept-group" style="display: none">	
							<label>Assign Department</label>
							<select name="department_id" class="form-control">
								<option value="">Select Department</option>
								@foreach($departments as $department)
									<option value="{{$department->id}}" @if($department->id == old('department_id')) selected @endif>
										{{ $department->name }}
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

@section('scripts')
	@if (Auth::user()->type !== 'dean')
		<script src="{{ asset('assets/page.user-ops.js') }}" type="text/javascript"></script>
	@endif
@stop
