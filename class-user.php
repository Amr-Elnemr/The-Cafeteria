<?php

class user{
	protected $name;
	protected $email;
	protected $password;
	protected $latestOrder;
	protected $image;
	protected $username;


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
			case "latestOrder":
				return $this->latestOrder;
				break;
			case "email":
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
			case "latestOrder":
				 $this->latestOrder=$value;
				break;
			case "email":
				 $this->image=$value;
				break;
			case "username":
				 $this->username=$value;
				break;
		}
	}

	public function authenticateUser($em,$pas){

		function test_input($data) {
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}
		$dsn="mysql:host=localhost;dbname=cafeteria";
		$db=new PDO($dsn,"root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement=$db->query("select * from users where email="."'".$em."'");


		//getting pwd from database

		$fetched_arr=$statement->fetch(PDO::FETCH_ASSOC);
		$db_hashedPwd=$fetched_arr['hashed_pwd'];

		// don't forget that we will compare with hashed password

				if($fetched_arr){
					if(test_input($pas)!=test_input($db_hashedPwd)){
					header("Location: login.php?password=invalid");
					}
					else{
						echo "hello";
					}

				}
				else
				{
					header("Location: login.php?email=invalid");
				}

	}


	public function cancelBefore10min($id){


		//connection with database

		$dsn="mysql:host=localhost;dbname=cafeteria";
		$db=new PDO($dsn,"root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement=$db->query("select * from orders where order_id="."'".$id."'");
		$fetched_arr=$statement->fetch(PDO::FETCH_ASSOC);


		date_default_timezone_set('Africa/Cairo');

		//getting database time and date
		$db_date=$fetched_arr['date'];
		$db_time=$fetched_arr['time'];
		$db_datetime=$db_date." ".$db_time;

		//getting current time and date
		$current_date=date("Y-m-d");
		$current_time=date("h:i:sa");
		$current_datetime=date("Y-m-d h:i:s");


		//date difference function


		function dateDifference($date_1 , $date_2 , $differenceFormat = '%i' )
		{
		    $datetime1 = date_create($date_1);
		    $datetime2 = date_create($date_2);

		    $interval = date_diff($datetime1, $datetime2);

		    return $interval->format($differenceFormat);

		}

		$diff=dateDifference($current_datetime,$db_datetime);


		//check if the order has been submiited since more than 10 mins or not:

		if(test_input($current_date)==test_input($db_date)){
			if(test_input($diff)<10){
				$statement=$db->query("delete from orders where order_id="."'".$id."'");
			}
			else
			{
				echo "this order cannot be deleted";
			}
		}
		else{
			echo "this order cannot be deleted";
		}
	}

	public function(){

	}

}






$obj=new user();
$obj->__set("name","mina");
$namee=$obj->__get("name");
echo $namee;


$obj->authenticateUser($_POST['email'],$_POST['password']);
$obj->cancelBefore10min(3);

?>
