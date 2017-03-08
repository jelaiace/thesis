@extends('layout')

@section('title')
	Manage Schedules
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="list-group">
					@foreach($departments as $department)
						<a href="/schedule/{{ $department->id }}" class="list-group-item">
							{{ $department->name }}
						</a>
					@endforeach
				</div>
			</div>

			<div class="col-md-9">
				<h2>Select a department to proceed</h2>
			</div>
		</div>
	</div>
@stop