<!DOCTYPE html>
<html>
<head>
	<title> @yield('title') - Classroom Scheduler</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/stylesheet.css') }}">
</head>
<body>
<div class="container">
    <div class="row horizontal-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Classroom Scheduler</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form action="./login.php" method="post" class="form" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="E-mail" name="email" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-default btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>

	@yield('content')
</body>
</html>