@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
			    <h1>Edit Department details ({{ $department->name }})</h1>

			    <form action="/departments/{{ $department->id }}" method="POST">
			        {{ method_field("PUT") }}
			    	<div class="form-group">
			    		<label>Name</label>
			        	<input type="text" placeholder="Name" name="name" class="form-control" value="{{ $department->name }}">
			        </div>

			        <button class="btn btn-info">Edit Department</button>
			    </form>
			</div>
		</div>
	</div>
    <h1></h1>
@stop