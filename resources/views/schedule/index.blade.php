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

				<div class="list-group">
					<a href="/schedule/requests" class="list-group-item">
						My Requests
					</a>

					<a href="/schedule/incoming" class="list-group-item">
						Department Requests
					</a>
				</div>
			</div>

			<div class="col-md-9">
				<h2>Select a department to proceed</h2>
			</div>
		</div>
	</div>
@stop