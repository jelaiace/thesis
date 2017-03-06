@extends('layout')


@section('title')
	Manage Users
@stop

@section('content')
	<div class="container">
	<div class="col-md-2">
        <div class="button btn-active">
            <a href="/users/create" class="btn btn-info">Create Users</a>
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
		    			<th>Name</th>
		    			<th>Type</th>
	    				<th>Department</th>
		    		</tr>
		    </thead>
		
		    	

		    	<tbody>
		    	@foreach($users as $user)
			    	<tr>
			    		<td>
	                    <div class="table">{{ $user->id }}</div>
	                    </td>

	                    <td>
	                    <div class="table">{{ $user->name }}</div>
	                    </td>

	                    <td>
	                    	<div class="table">{{$user->type}}</div>
	                    </td>
	                    	
	                    <td>
	                    	<div class="table">{{ $user->department->name }}</div>	
	                    </td>

	                    <td>
		    				<a href="/users/{{ $user->id }}/edit" class="btn btn-info">Edit</a>
		    			</td>
	                </tr>
                @endforeach
		    		
		    	</tbody>
		    </table>
		</div>
	</div>
@stop