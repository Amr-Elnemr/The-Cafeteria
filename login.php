
<!DOCTYPE html>
<html lang="en">
<head>
	<title>login form</title>
	<meta charset="utf-8">
	<style type="text/css">

		#form-container{
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="form-container">
		<form id="form" action="userType.php" method="POST">
			<div id="header">
				<h2>Login Form</h2>
			</div>
			<div id="body">
				<input type="email" name="email" placeholder=" Email" >
				<!-- <span style="color: red"><?php echo $email_error ?></span> -->
				<br><br>
				<input type="password" name="password" placeholder="Password">
				<!-- <span style="color: red"><?php echo $password_error ?></span> -->
			</div>
			<div id="footer">
				<button type="submit" id="submit" name="submit">Submit</button>
				<button type="reset" id="reset" name="reset">Reset</button>
			</div>
		</form>
	</div>
</body>
</html>
