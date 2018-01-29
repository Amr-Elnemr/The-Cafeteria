
<!DOCTYPE html>
<html lang="en">
<head>
	<title>login form</title>
	<meta charset="utf-8">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
	<style type="text/css">

		#form-container{
			text-align: center;
		}
		.inputs{
			border-radius: 6px;
		}
		.fontfamily{
	      font-family: "Allerta Stencil", Sans-serif;
		  font
	    }
	</style>
</head>
<body>
		<div class="container">
<div class="jumbotron">
	<h1 class="fontfamily" style="color:#007acc"align="center">CAFETRIA OM GAMAL</h1>
	</div>
	<div id="form-container">
		<form id="form" action="userType.php" method="POST">
			<div id="header">
				<h2 class="fontfamily" >Login Page</h2>
			</div>
			<div  id="body">
				<div class="col-md-4 col-md-offset-4">
					<input  type="email" class="inputs form-control glyphicon glyphicon-warning-sign" name="email" placeholder=" Email">
				</div>
				<!-- <span style="color: red"><?php echo $email_error ?></span> -->
				<br><br>
				<div class="col-md-4 col-md-offset-4">
					<input type="password" class="inputs form-control glyphicon glyphicon-warning-sign" name="password" placeholder="Password">
				</div>
				<!-- <span style="color: red"><?php echo $password_error ?></span> -->
			</div>
			<div id="footer">
				<br>
				<br>
				<button class="btn btn-primary col-md-2 col-md-offset-5" type="submit" id="submit" name="submit">Login</button>
				<!-- <button class="btn btn btn-warning" type="reset" id="reset" name="reset">Reset</button> -->
			</div>
		</form>
	</div>
</div>

</body>

</html>
