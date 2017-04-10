@extends('layout')

@section('content')
	<div class="container">
	<h1>Edit Room <small>({{ $room->name }})</small></h1>
		<div class="grid">
			<div class="col-md-4">

		    <form action="/rooms/{{ $room->id }}" method="POST">
		    	{{ method_field('PUT') }}

		    	<div class="form-group">
		    		<label>Name</label>
	        	<input type="text" placeholder="Name" name="name" class="form-control" value="{{ $room->name }}">
	        	@if($errors->has('name'))
							<p class="u-text-error">
								{{ $errors->first('name') }}
							</p>
				@endif
	        </div>

	       <div class="form-group">
	        <label>Type</label>
					<select name="type" class="form-control">
						<option value="lecture" {{ $room->type === 'lecture' ? 'selected' : '' }}>Lecture Room</option>
						<option value="laboratory" {{ $room->type === 'laboratory' ? 'selected' : '' }}>Laboratory Room</option>
					</select>

					@if($errors->has('type'))
							<p class="u-text-error">
								{{ $errors->first('type') }}
							</p>
					@endif
	        </div>

	       <div class="form-group">
	        	<label>Department</label>
	        	<select name="department_id" class="form-control">
	        		<option value="">Select department</option>
	        		@foreach($departments as $department)
	        			<option value="{{ $department->id }}" {{ $room->department->id === $department->id ? 'selected' : '' }}>
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

	        <button class="btn btn-info">Update Room</button>
		    </form>
			</div>
		</div>
	</div>
@stop