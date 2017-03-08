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
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">Go</button>
				</span>
			</div>

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
		    				<a href="/rooms/{{ $room->id }}/edit" class="btn btn-info">Edit</a>
		    			</td>
	         	</tr>
          @endforeach	
		    	</tbody>
		    </table>
		</div>
	</div>
@stop