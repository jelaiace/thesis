@extends('layout')

@section('title')
	Manage Classes
@stop

@section('content')
<div class="container">
	<div class="col-md-2">
        <a href="/blocks/create" class="btn btn-info btn-block u-spacer">
        	Create Block
        </a>
        
        <a href="/blocks/report" class="btn btn-success btn-block">
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


        <form action="/blocks">
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

		    			<td>
		    			 	<form action="/blocks/{{ $block->id }}" method="POST" data-verilete="block" data-verilete-name="{{ $block->name }}">
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