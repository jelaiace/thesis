@extends('layout')

@section('content')

	<div class="container">
		<div class="grid">
			<div class="col-md-4">
			<h1>Edit Subjects ( {{ $subject->name }} )</h1>
				
				<form action="/subjects/{{ $subject->id }}" method="POST">
					{{ method_field("PUT") }}
					<div class="form-group">
						<label>Course Code</label>
						<input type="text" placeholder="course code" name="course_code" class="form-control" value=" {{ $subject->course_code}} ">

						<label>Name</label>
						<input type="text" placeholder="subject" name="name" class="form-control" value=" {{$subject->name}} ">

						<label>Units</label>
						<input type="text" placeholder="units" name="units" class="form-control" value=" {{$subject->units}} ">

						<button class="btn btn-info">Edit Subject</button>
					</div>
				</form>
			</div>
			
		</div>

	</div>



@stop