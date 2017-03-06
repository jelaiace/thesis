@extends('layout')

@section('content')
	<div class="container">
		<div class="grid">
			<div class="col-md-4">
				<h1>New Subject</h1>


				<form action="/subjects" method="POST">
					<div class="form-group">
						<label>Course Code</label>
						<input type="text" placeholder="course code" name="course_code" class="form-control">

						<label>Subject Description</label>
						<input type="text" placeholder="subject" name="name" class="form-control">

						
						<label>Units</label>
						<select name="units" class="form-control">
							<option value="1">1 units</option>
							<option value="2">2 units</option>
							<option value="3">3 units</option>
						</select>

						<button class="btn btn-info">Create new Subject</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@stop