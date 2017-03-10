@extends('layout')

@section('title')
    Manage Departments
@stop

@section('content')

<div class="container">
    <div class="col-md-2">
        <div class="button btn-active">
            <a href="/departments/create" class="btn btn-info">Create New Department</a>
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
                    <th>Department Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>
                            {{ $department->id }}
                        </td>

                        <td>
                            {{ $department->name}}
                        </td>

                        <td>
                            <a href="/departments/{{ $department->id }}/edit" class="btn btn-info">
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