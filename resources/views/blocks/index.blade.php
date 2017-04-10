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
         @if (session()->has('success'))
	    	<div class="alert alert-success">
	    		{{ session()->get('success') }}
	    	</div>
	    @endif

        <form action="/blocks">
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
	                    	{{ $block->id }}
	                    </td>

	                    <td>
	                    	<a href="/blocks/{{ $block->id }}">{{ $block->name }}</a>
	                    </td>

	                    <td>
							{{ $block->course->name}}
	                    </td>
	                    	
	                    <td>
	                    	{{ $block->year_level }}	
	                    </td>

	                    <td>
	                    	{{ $block->semester }}
	                    </td>

	                    <td>
		    				<a href="/blocks/{{ $block->id }}/edit" class="btn btn-info">
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