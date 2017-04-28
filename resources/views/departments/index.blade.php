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
            <form action="/departments">
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

                        <td>
                            <form action="/departments/{{ $department->id }}" method="POST" data-verilete="department" data-verilete-name="{{ $department->name }}">
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