@extends('layout')


@section('title')
	Manage Rooms
@stop

@section('content')
	<div class="container">
		<div class="col-md-2">
      <div class="button btn-active">
          <a href="/rooms/create" class="btn btn-info">Create room</a>
      </div>
    </div>

    <div class="col-md-8">
	    <form action="/rooms">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="q" value= {{ $query}} >
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go</button>
					</span>
				</div>
		</form>

			<table class="table table-hover">
			<thead>
		    		<tr>
		    			<th>#</th>
		    			<th>Room Name</th>
		    			<th>Type</th>
		    			<th>Department</th>
	    				<th></th>
		    		</tr>
		    </thead>
		
		    	

		    	<tbody>
		    	@foreach($rooms as $room)
			    	<tr>
			    		<td>{{ $room->id }}</td>
	            <td>{{ $room->name }}</td>
	            <td>{{ $room->type }}</td>
	            <td>{{ $room->department->name }}</td>
	            <td>
		    				<a href="/rooms/{{ $room->id }}/edit" class="btn btn-info">
		    				<span class="glyphicon glyphicon-pencil"></span>
		    				</a>
		    			</td>
	         	</tr>
          @endforeach	
		    	</tbody>
		    </table>
		</div>
	</div>
@stop