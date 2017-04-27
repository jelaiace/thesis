@extends('layout')

@section('title')
	Manage Courses
@stop

@section('content')
<div class="container">
	<div class="col-md-2">
        <div class="button btn-active">
            <a href="/courses/create" class="btn btn-info">Create Course</a>
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

        <form action="/courses">
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
		    			<th>Course Name</th>
		    			<th>Department</th>
		    		</tr>
		    </thead>

	    	<tbody>
		    	@foreach($courses as $course)
			    	<tr>
			    		<td>
	                    	{{ $course->id }}
	                    </td>

	                    <td>
	                    	{{ $course->name }}
	                    </td>
	                    	
	                    <td>
	                    	<a href="/schedule/{{ $course->department->id}}">{{ $course->department->name }}</a>	
	                    </td>

	                    <td>
		    				<a href="/courses/{{ $course->id }}/edit" class="btn btn-info">
		    					<span class="glyphicon glyphicon-pencil"></span>
		    				</a>
		    			</td>

		    			<td>
		    			 	<form action="/courses/{{ $course->id }}" method="POST" data-verilete="course" data-verilete-name="{{ $course->name }}">
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