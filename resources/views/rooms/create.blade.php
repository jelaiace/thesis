@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
			    <h1>New Rooms</h1>

			    <form action="/rooms" method="POST">
			    	<div class="form-group">
			    		<label>Name</label>
		        		<input type="text" placeholder="Name" name="name" class="form-control" value="{{ old('name') }}">

			        	@if($errors->has('name'))
								<p class="u-text-error">
									{{ $errors->first('name') }}
								</p>
						@endif
			        </div>

		       <div class="form-group">
		        	<label>Type</label>
		        	<select name="type" class="form-control">
		        		<option>Select Type</option>
		        		<option value="lecture">Lecture Room</option>
		        		<option value="laboratory">Laboratory Room</option>
		        	</select>

		        	@if($errors->has('type'))
							<p class="u-text-error">
								{{ $errors->first('type') }}
							</p>
					@endif
		        </div>

		       @if (Auth::user()->type !== 'dean')
			       <div class="form-group">
			        	<label>Department</label>
			        	<select name="department_id" class="form-control">
			        		<option value="">Select department</option>
			        		@foreach($departments as $department)
			        			<option value="{{ $department->id }}">
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
			        <button class="btn btn-info">Create Room</button>
			    </form>
			</div>
		</div>
	</div>
@stop