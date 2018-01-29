<?php
ob_start();
session_start();
if(! isset($_SESSION['userInfo']))
	header("location: ../login.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>edit user</title>
	<meta charset="utf-8">
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
	  <h2 class="fontfamily">Edit User</h2>
	  </div>
	</div>
	  <div class="container" align="center">
	  	<form method="post" action="edituser.php">
			<div class="col-md-4 col-md-offset-4">
				Name<input type="text" name="name_edit" class="input" id="name-input" value=" <?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; } ?> "><br><br>

			</div>
			<div class="col-md-4 col-md-offset-4">
				Email<input type="email" name="email_edit" class="input" id="email-input" value=" <?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; } ?> "><br><br>
		  		<span class="span"><?php if(isset($_GET['Emsg'])) { echo $_GET['Emsg']; }  ?></span>
			</div>
			<div class="col-md-4 col-md-offset-4">
				Password<input type="password" name="password_edit" class="input" id="password-input"><br><br>
		  		<span class="span"><?php if(isset($_GET['Pmsg'])) { echo $_GET['Pmsg']; }  ?></span>
			</div>
			<div class="col-md-4 col-md-offset-4">
				Confirm Password<input type="password" name="confirm_edit" class="input" id="confirm-input"><br><br>

			</div>
			<div class="col-md-4 col-md-offset-4">
				Room No.<input type="text" name="room_no_edit" class="input" id="room-input" value=" <?php if(isset($_SESSION['room_no'])) { echo $_SESSION['room_no']; } ?> "><br><br>

			</div>
			<div class="col-md-4 col-md-offset-4">
				Ext.<input type="text" name="ext_edit" class="input" id="ext-input" value=" <?php if(isset($_SESSION['ext'])) { echo $_SESSION['ext']; } ?> "><br><br>
			</div>
			<div class="col-md-4 col-md-offset-4">
				Profile Picture<input type="file" name="profile_pic_edit" class="input" id="profile-pic-input" value=" <?php if(isset($_SESSION['image'])) { echo $_SESSION['image']; } ?> ">
				<input type="hidden" name="userpic" value="" id="pic"><br><br>

			</div>
			<div class="col-md-4 col-md-offset-4">
				<input type="text" hidden name="id" value="<?php echo $_GET['id']; ?>">
		  		<input type="submit" name="submit_edit" value="submit" class="button">
		  		<input type="reset" name="reset_edit" class="button">
			</div>


			<!-- <button type="submit" name="submit" class="button">Submit</button>
	  		<button type="reset" name="reset" class="button">Reset</button> -->
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
