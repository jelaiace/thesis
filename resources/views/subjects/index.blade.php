@extends('layout')

@section('title')
	Manage Subjects
@stop

@section('content')
	<div class="container">
		<div class="col-md-2">
	        <div class="button btn-active">
	            <a href="/subjects/create" class="btn btn-info">Create New Subjects</a>
	        </div>
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

        <form action="/subjects">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" name="q" value= {{$query}} >
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">Go</button>
				</span>
			</div>
		</form>

			<table class="table table-hover">
			<thead>
		    		<tr>
		    			<th>#</th>
		    			<th>Course Code</th>
		    			<th>Subject Name</th>
	    				<th>Units</th>
		    		</tr>
		    </thead>
		
		    	

		    	<tbody>
		    	@foreach($subjects as $subject)
			    	<tr>
			    		<td>
	                    	{{ $subject->id }}
	                    </td>


	                    <td>
	                    	{{ $subject->course_code }}
	                    </td>

	                    <td>
	                    	{{ $subject->name}}
	                    </td>
	                    	
	                    <td>
	                    	{{ $subject->units }}
	                    </td>

	                    <td>
		    				<a href="/subjects/{{ $subject->id }}/edit" class="btn btn-info">
		    					<span class="glyphicon glyphicon-pencil"></span>
		    				</a>
		    			</td>

		    			 <td>
		    			 	<form action="/subjects/{{ $subject->id }}" method="POST">
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

