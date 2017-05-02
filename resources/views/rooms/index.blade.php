@extends('layout')


@section('title')
	Manage Rooms
@stop

@section('content')
<div class="container">
	<div class="col-md-2">
		<a href="/rooms/create" class="btn btn-info btn-block u-spacer">
        		Create New Rooms
        </a>
        <a href="/rooms/report" class="btn btn-success btn-block">
        	Generate Reports
        </a>
	</div>

    <div class="col-md-8">
	    @if (session()->has('success'))
	    	<div class="alert alert-success">
	    		{{ session()->get('success') }}
	    	</div>
	    @endif

	    @if (session()->has('info'))
		    	<div class="alert alert-info">
		    		{{ session()->get('info') }}
		    	</div>
		    @endif
	    
	    <form action="/rooms">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" name="q" value= {{ $query}} >
				<span class="input-group-btn">
					<button class="btn btn-default">Go</button>
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
			    		<td>
			    			{{ $room->id }}
			    		</td>
			            <td>
			            	{{ $room->name }}
			            </td>
			            <td>
			            	{{ $room->type }}
			            </td>
			            <td>
			            	{{ $room->department->name }}
			            </td>
			            <td>
		    				<a href="/rooms/{{ $room->id }}/edit" class="btn btn-info">
		    					<span class="glyphicon glyphicon-pencil"></span>
		    				</a>
		    			</td>
		    			<td>
		    			 	<form action="/rooms/{{ $room->id }}" method="POST" data-verilete="room" data-verilete-name="{{ $room->name }}">
		    			 		{{ method_field('DELETE') }}
			    				<button class="btn btn-danger">
	                            	<span class="glyphicon glyphicon-trash"></span>
	                            </button>
	                        </form>
		    			</td>
	         		</tr>
         		 @endforeach	
	    	</tbody>
	    </table>
	</div>
</div>
@stop