<?php
ob_start();

session_start();
if(! isset($_SESSION['userInfo']))
    header("location: ../login.php");

 ?>

 <?php
 class admin{

 	protected $name;
 	protected $image;
 	protected $username;
 	protected $password;
 	protected $email;



 	public function __get($attr){
 		switch ($attr) {
 			case "name":
 				return $this->name;
 				break;
 			case "email":
 				return $this->email;
 				break;
 			case "password":
 				return $this->password;
 				break;
 			case "image":
 				return $this->image;
 				break;
 			case "username":
 				return $this->username;
 				break;
 		}
 	}


 	public function __set($attr,$value){
 		switch ($attr) {
 			case "name":
 				 $this->name=$value;
 				break;
 			case "email":
 				 $this->email=$value;
 				break;
 			case "password":
 				 $this->password=$value;
 				break;
 			case "image":
 				 $this->image=$value;
 				break;
 			case "username":
 				 $this->username=$value;
 				break;
 		}
 	}

 public function prepareEditUser($id){

     $dsn="mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
     $db=new PDO($dsn,"id4446548_tarekessam","comeflywithme");
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $statement=$db->query("select * from users where user_id='".$id."'");
     $fetched_arr=$statement->fetch(PDO::FETCH_ASSOC);
     $_SESSION['name']=$fetched_arr['name'];
     $_SESSION['email']=$fetched_arr['email'];
     $_SESSION['ext']=$fetched_arr['phone'];
     $_SESSION['room_no']=$fetched_arr['default_room'];
     $_SESSION['image']=$fetched_arr['image'];

     header("Location: edit.php?id=".$id);


     }


 public function editUser(){
         $edited_name=$_POST['name_edit'];
         $edited_email=$_POST['email_edit'];
         $edited_password=$_POST['password_edit'];
         $edited_password_hashed=md5($edited_password);
         $edited_confirm=$_POST['confirm_edit'];
         $edited_room_no=$_POST['room_no_edit'];
         $edited_ext=$_POST['ext_edit'];
         $edited_image=$_POST['userpic'];
         $id=$_POST['id'];

         echo $id;

         $dsn="mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
         $db=new PDO($dsn,"id4446548_tarekessam","comeflywithme");
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $query="update users set name=?,email=?,hashed_pwd=?,default_room=?,phone=?,image=? where user_id=?";
         $statement=$db->prepare($query);
         $parameter=[$edited_name,$edited_email,$edited_password_hashed,$edited_room_no,$edited_ext,$edited_image,$id];
         $statement->execute($parameter);
         header("Location: pg6.php");

 }
}

$object = new admin;
if(isset($_GET['ueid'])){
	$object->prepareEditUser($_GET['ueid']);
}

if(isset($_POST['submit_edit'])){
print_r($_POST['submit_edit']);
	// $admin1->editValidation();
	$object->editUser();

}
  ?>
