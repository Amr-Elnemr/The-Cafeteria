<?php
    ob_start();
 	session_start();
    if(! isset($_SESSION['userInfo']))
        header("location: ../login.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="page7.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">

	<style type="text/css">

		.span{
			position: absolute;
			left:425px;
			color: red;
			margin-top: -35px;
		}
		.fontfamily{
		  font-family: "Allerta Stencil", Sans-serif;
		}
	</style>


</head>
<body>


	  <!-- <div class="nav">
	  	<a href="#">Home</a> |
	  	<a href="#">Products</a> |
	  	<a href="#">Users</a> |
	  	<a href="#">Manual Order</a> |
	  	<a href="#">Checks</a>
	  </div>
	  <div class="admin">
	  	<img id="adminimage"  width=50 height=50>
	  	<h3 id="admin"></h3>
	  </div>
	  <br><br> -->
	  <div class="container">
	    <div class="jumbotron">
	    <a href="order.php"><b class="fontfamily">Home</b></a>
	    <b> | </b>
	    <a href="pg5.php"><b class="fontfamily">Products</b></a>
	      <b> | </b>
	    <a href="pg6.php"><b class="fontfamily">Users</b></a>
	      <b> | </b>
	    <a href="products.php"><b class="fontfamily">Manual Orders</b></a>
	      <b> | </b>
	    <a href="class_admin.php"><b class="fontfamily">Checks</b></a>

	    <b class="pull-right"><br>&nbsp;	&nbsp;	<u id="admin" class="pull-right"></u></b>
	    <img id="adminimage" class="img-responsive img-circle pull-right" style="display:inline" width="60" height="60">
	    <br>
	    <h2 class="fontfamily">Add User</h2>
	    </div>
	  </div>
	  <div class="container" align="center">
	  	<form method="post" action="addUserData.php">
            <div class="col-md-4 col-md-offset-4">
	               Name<input type="text" name="name" class="input form-control glyphicon glyphicon-warning-sign" id="name-input" value="<?php if(isset($_GET['name'])) { echo $_GET['name']; }  ?>" required><br><br>
    </div>
<div class="col-md-4 col-md-offset-4">
	Email<input type="email" name="email" class="input form-control glyphicon glyphicon-warning-sign" id="email-input" value="<?php if(isset($_GET['email'])) { echo $_GET['email']; }  ?>" required><br><br>
	<span class="span"><?php if(isset($_GET['Emsg'])) { echo $_GET['Emsg']; }  ?></span>
</div>
<div class="col-md-4 col-md-offset-4">
	Password<input type="password" name="password" class="input form-control glyphicon glyphicon-warning-sign" id="password-input" required><br><br>
	<span class="span"><?php if(isset($_GET['Pmsg'])) { echo $_GET['Pmsg']; }  ?></span>
</div>
<div class="col-md-4 col-md-offset-4">
	Confirm Password<input type="password" name="confirm" class="input form-control glyphicon glyphicon-warning-sign" id="confirm-input" required><br><br>
</div>
<div class="col-md-4 col-md-offset-4">
	Room No.<input type="number" name="room_no" class="input form-control glyphicon glyphicon-warning-sign" id="room-input" value="<?php if(isset($_GET['room_no'])) { echo $_GET['room_no']; }  ?>" required><br><br>
</div>
<div class="col-md-4 col-md-offset-4">
	Ext.<input type="number" name="ext" class="input" id="ext-input form-control glyphicon glyphicon-warning-sign" value="<?php if(isset($_GET['ext'])) { echo $_GET['ext']; }  ?>" required><br><br>
</div>
<div class="col-md-4 col-md-offset-4">
	Profile Picture<input type="file" name="profile_pic" class="input form-control glyphicon " id="profile-pic-input" required><br><br>
</div>
<div class="col-md-4 col-md-offset-4">
	<input type="hidden" name="userpic" value="" id="pic">
	<input type="submit" name="submit" value="submit" class="button btn btn-primary">
	<!-- <input type="reset" name="reset" class="button btn btn-warning"> -->
</div>

	  	</form>

	  </div>
	  <script type="text/javascript">
		  let currentUser = <?php echo json_encode($_SESSION['userInfo']); ?>;
		  document.getElementById("admin").textContent = currentUser['name'];
		  document.getElementById("adminimage").src = currentUser['image'];
		  let image = document.getElementById('profile-pic-input');
		  image.addEventListener("change", addImage);

		  function addImage(e) {
			  let name = image.value;
			  name = name.split('\\');
			  console.log(name);
			  name = name[2];
			  name = "../imgs/users/" + name;
			  console.log(name);
			  document.getElementById('pic').setAttribute("value", name);

		  }
	  </script>



</body>
</html>
