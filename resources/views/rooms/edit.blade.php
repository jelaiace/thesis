@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
			    <h1>Edit Room details ({{ $room->name }})</h1>

			    <form action="/rooms/{{ $room->id }}" method="POST">
			        {{ method_field("PUT") }}
			    	<div class="form-group">
			    		<label>Name</label>
			        	<input type="text" placeholder="Name" name="name" class="form-control" value="{{ $room->name }}">

			        	<label>Type</label>
			        	<input type="text" placeholder="Name" name="type" class="form-control" value="{{ $room->type }}">
			        </div>

			        <button class="btn btn-info">Edit Room</button>
			    </form>
			</div>
		</div>
	</div>
    
@stop