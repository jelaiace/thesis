@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
			    <h1>New Department</h1>

			    <form action="/departments" method="POST">
			    	<div class="form-group">
			    		<label>Name</label>
			        	<input type="text" placeholder="Name" name="name" class="form-control">
			        </div>

			        <button class="btn btn-info">Create Department</button>
			    </form>
			</div>
		</div>
	</div>
@stop