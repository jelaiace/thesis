@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
			    <h1>New Rooms</h1>

			    <form action="/rooms" method="POST">
			    	<div class="form-group">
			    		<label>Name</label>
			        	<input type="text" placeholder="Name" name="name" class="form-control">

			        	<label>Type</label>
			        	<input type="text" placeholder="Name" name="type" class="form-control">
			        </div>

			        <button class="btn btn-info">Create Rooms</button>
			    </form>
			</div>
		</div>
	</div>
@stop