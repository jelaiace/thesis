@extends('layout')

@section('content')
	<div class="container">
	<h1>Edit Department Name <small>({{ $department->name }})</small></h1>
		<div class="grid">
			<div class="col-md-4">

			    <form action="/departments/{{ $department->id }}" method="POST">
			        {{ method_field("PUT") }}
			    	<div class="form-group">
			    		<label>Name</label>
			        	<input type="text" placeholder="Name" name="name" class="form-control" value="{{ $department->name }}">

			        @if($errors->has('name'))
						<p class="u-text-error">
							{{ $errors->first('name') }}
						</p>
					@endif
					
			        </div>

			        <button class="btn btn-info">Update Department</button>
			    </form>
			</div>
		</div>
	</div>
    <h1></h1>
@stop