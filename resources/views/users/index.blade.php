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
        		<div class="row u-spacer-large">
        			<div class="col-md-4">
						<input type="text" class="form-control" placeholder="Search by First Name" name="first_name" value={{ $first_name }}>
					</div>

					<div class="col-md-4">
						<input type="text" class="form-control" placeholder="Search by Last Name" name="last_name" value={{ $last_name }}>
					</div>

					<div class="col-md-4 text-right">
						<button class="btn btn-default">
							Search
						</button>

						<a href="/users" class="btn btn-warning">
							Clear
						</a>
					</div>
				</div>
			</form>	

			<table class="table table-hover">
			<thead>
		    		<tr>
		    			<th>#</th>
		    			<th data-jort="first_name">
		    				First Name
		    				@if($sort === 'first_name')
		    					<span class="dropup">
		    						<span class="caret"></span>
		    					</span>
		    				@elseif ($sort === '-first_name')
		    					<span class="caret"></span>
		    				@endif
		    			</th>
		    			<th data-jort="last_name">		    			
		    				Last Name
		    				@if($sort === 'last_name')
		    					<span class="dropup">
		    						<span class="caret"></span>
		    					</span>
		    				@elseif ($sort === '-last_name')
		    					<span class="caret"></span>
		    				@endif
		    			</th>
		    			<th>Email</th>
		    			<th>Type</th>
	    				<th>Department</th>
	    				<th width="40"></th>
	    				<th width="40"></th>
		    		</tr>
		    </thead>
		
		    	

		    	<tbody>
		    	@foreach($users as $user)
			    	<tr>
			    		<td>
	                    	{{ $user->id }}
	                    </td>

	                    <td>
	                    	<a href="/users/{{$user->id}}">{{ $user->first_name }}</a>
	                    </td>

	                    <td>
	                    	{{ $user->last_name }}
	                    </td>

	                    <td>
	                    	 {{ $user->email}} 
	                    </td>

	                    <td>
	                    	{{$user->type}}
	                    </td>
	                    	
	                    <td>
	                    	 @if ($user->type === 'dean' || $user->type === 'professor')
		                    	{{ $user->department->name }}
	                    	@endif
	                    </td>

	                    <td>
		    				<a href="/users/{{ $user->id }}/edit" class="btn btn-info btn-xs">
                            	<span class="glyphicon glyphicon-pencil"></span>
                            </a>
		    			</td>

		    			 <td>
		    			 	<form action="/users/{{ $user->id }}" method="POST" data-verilete="user" data-verilete-name="{{ $user->name }}">
		    			 		{{ method_field('DELETE') }}
			    				<button class="btn btn-danger btn-xs">
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