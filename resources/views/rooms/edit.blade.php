@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
		    <h1>Edit Room ({{ $room->name }})</h1>

		    <form action="/rooms/{{ $room->id }}" method="POST">
		    	{{ method_field('PUT') }}

		    	<div class="form-group">
		    		<label>Name</label>
	        	<input type="text" placeholder="Name" name="name" class="form-control" value="{{ $room->name }}">
	        </div>

	       <div class="form-group">
	        	<label>Type</label>
	        	<input type="text" placeholder="Name" name="type" class="form-control" value="{{ $room->type }}">
	        </div>

	       <div class="form-group">
	        	<label>Department</label>
	        	<select name="department_id" class="form-control">
	        		<option>Select department</option>
	        		@foreach($departments as $department)
	        			<option value="{{ $department->id }}" {{ $room->department->id === $department->id ? 'selected' : '' }}>
	        				{{ $department->name }}
	        			</option>
	        		@endforeach
	        	</select>
	        </div>

	        <button class="btn btn-info">Create Room</button>
		    </form>
			</div>
		</div>
	</div>
@stop