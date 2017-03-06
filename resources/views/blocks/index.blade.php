@extends('layout')

@section('title')
	Manage Classes
@stop

@section('content')
<div class="container">
	<div class="col-md-2">
        <div class="button btn-active">
            <a href="/blocks/create" class="btn btn-info">Create Block</a>
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
		    			<th>Class Name</th>
		    			<th>Course</th>
	    				<th>Year Level</th>
	    				<th>Semester</th>
		    		</tr>
		    </thead>
		
		    	

		    	<tbody>
		    	@foreach($blocks as $block)
			    	<tr>
			    		<td>
	                    	<div class="table">{{ $block->id }}</div>
	                    </td>

	                    <td>
	                    	<div class="table">{{ $block->name }}</div>
	                    </td>

	                    <td>
	                    	<div class="table">{{ $block->course->name}}</div>
	                    </td>
	                    	
	                    <td>
	                    	<div class="table">{{ $block->year_level }}</div>	
	                    </td>

	                    <td>
	                    	<div class="table">{{ $block->semester }}</div>
	                    </td>

	                    <td>
		    				<a href="/blocks/{{ $block->id }}/edit" class="btn btn-info">Edit</a>
		    			</td>
	                </tr>
                @endforeach
		    		
		    	</tbody>
		    </table>
		</div>
	</div>
</div>



@stop

