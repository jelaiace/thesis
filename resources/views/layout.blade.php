<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') - Classroom Scheduler</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/stylesheet.css') }}">
	@yield('styles')
</head>

<body>
	<div id="top-nav" class="navbar navbar-default navbar-static-top">
		<div class="container">
	        <div class="row">
	        	<div class="col-md-3">
	            	<div class="navbar-header">
	              		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                 	<span class="icon-toggle"></span>
	              		</button>
	             	 <a class="navbar-brand" href="./dashboard.html">Classroom Scheduler</a>
	            	</div>
	            </div>

	            <div class="col-md-7">
	            	@if(Auth::check())
			            <div class="collapse navbar-collapse">
			                <ul class="nav navbar-nav">
			                    <li><a href="/">Home</a></li>
			                    @if(Auth::user()->type !== "professor")
			                    <li><a href="/blocks">Blocks</a></li>
			                    <li><a href="/subjects">Subjects</a></li>
			                    <li><a href="/rooms">Rooms</a></li>
			                    <li><a href="/schedule">Schedules</a></li>
			                    <li><a href="/users">Users</a></li>
			                    <li><a href="/departments">Departments</a></li>
			                    @endif
			                </ul>
			            </div>
			        @endif
	            </div>

	            <div class="col-md-2 text-right">
	            	@if(Auth::check())
		            	<ul class="nav navbar-nav">
			            	<li class="dropdown">
			            		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			            			{{ Auth::user()->name }} <span class="caret"></span>
			            		</a>

			            		<ul class="dropdown-menu">
			            			<li><a href="/logout">Logout</a></li>
			            		</ul>
			            	</li>
				           </ul>
				          @endif
	            </div>
	        </div>
	    </div>    
	</div>

	@yield('content')
	<script src="{{ asset('assets/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/bootstrap.min.js') }}"></script>
	@yield('scripts')
</body>
</html>