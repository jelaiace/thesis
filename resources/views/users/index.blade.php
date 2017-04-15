@extends('layout')


@section('title')
	Manage Users
@stop

@section('content')
	<div class="container">
	<div class="col-md-2">
        <a href="/users/create" class="btn btn-info btn-block u-spacer">
        		Create New Users
        	</a>

            <a href="/users/report" class="btn btn-success btn-block">
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

        	<form action="/users">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="q" value={{ $query }}>
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go</button>
					</span>
				</div>
			</form>	

			<table class="table table-hover">
			<thead>
		    		<tr>
		    			<th>#</th>
		    			<th>Name</th>
		    			<th>Username</th>
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
	                    	<div class="table"> {{ $user->email}} </div>
	                    </td>

	                    <td>
	                    	<div class="table">{{$user->type}}</div>
	                    </td>
	                    	
	                    <td>
	                    	<div class="table">{{ $user->department->name }}</div>	
	                    </td>

	                    <td>
		    				<a href="/users/{{ $user->id }}/edit" class="btn btn-info">
                            <span class="glyphicon glyphicon-pencil"></span>
                            </a>
		    			</td>

		    			 <td>
		    			 	<form action="/users/{{ $user->id }}" method="POST">
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