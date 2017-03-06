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
		    			<th>Course Code</th>
		    			<th>Subject Name</th>
	    				<th>Units</th>
		    		</tr>
		    </thead>
		
		    	

		    	<tbody>
		    	@foreach($subjects as $subject)
			    	<tr>
			    		<td>
	                    	<div class="table">{{ $subject->id }}</div>
	                    </td>


	                    <td>
	                    	<div class="table">{{ $subject->course_code }}</div>
	                    </td>

	                    <td>
	                    	<div class="table">{{ $subject->name}}</div>
	                    </td>
	                    	
	                    <td>
	                    	<div class="table">{{ $subject->units }}</div>	
	                    </td>

	                    <td>
		    				<a href="/subjects/{{ $subject->id }}/edit" class="btn btn-info">Edit</a>
		    			</td>
	                </tr>
                @endforeach
		    		
		    	</tbody>
		    </table>
		</div>
	</div>
</div>



@stop

