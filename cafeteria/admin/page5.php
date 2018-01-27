<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$dsn = "mysql:host=localhost;dbname=cafeteria";
$db = new PDO ($dsn, "tarek", "tito");

$db->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


class admin
{
	public function addProduct($prod, $pric, $pic) //{pg8.php}
	{
		global $db;
		$duplQuery="select count(name) from products where name=?";
		$duplStatement=$db -> prepare($duplQuery);
		$namePara=[trim($prod)];
		$duplStatement->execute($namePara);
		$check=$duplStatement->fetch(PDO::FETCH_ASSOC);
		if($check['count(name)']>0)
		{
			header("location: pg8.php?dupError=1");
		}
		else
		{
			$query="insert into products values (null, ? , ? , ? , true)";
			$statement=$db->prepare($query);
			$parameters=[$prod, $pric, $pic];
			$statement->execute ($parameters);
			header("location: pg5.php");
		}
	}


	public function showProducts() //{to show all products for admin when the pg loads, it returns and associative array of columns arrays}
	{
		global $db;
		$showproducts= $db->query("select * from products");
		$idArr=array();
		$prodArr=array();
		$priceArr=array();
		$imgArr=array();
		$availArr=array();
		while ($row=$showproducts->fetch(PDO::FETCH_ASSOC))
			{
				array_push($idArr, $row['product_id']);
				array_push($prodArr, $row['name']);
				array_push($priceArr, $row['price']);
				array_push($imgArr, $row['image']);
				array_push($availArr, $row['availability']);
			}
		return array('ids'=>$idArr, 'products'=>$prodArr, 'prices'=>$priceArr, 'images'=> $imgArr, 'available'=>$availArr);
	}

	public function switchAvailable($aid) //{to change availability status upon admin click, it takes the product id(aid) from query and return nothing}
	{
		global $db;
		$query="update products set availability = case when availability = 'true' then 'false' else 'true' end where product_id= ?";
		$statement=$db->prepare($query);
		$parameter=[$aid];
		$statement->execute($parameter);
	}

	public function deleteProduct($did) //{to delete product upon admin click, it takes the product id(did) from the query and returns nothing}
	{
		global $db;
		$query="delete from products where product_id=?";
		$statement=$db->prepare($query);
		$parameter=[$did];
		$statement->execute($parameter);
	}


	public function showUsers() //{to show all users for admin when the pg loads, it returns and associative array of columns arrays}
	{
		global $db;
		$showusers= $db->query("select * from users");
		$idArr=array();
		$nameArr=array();
		$roomArr=array();
		$imgArr=array();
		$extArr=array();
		while ($row=$showusers->fetch(PDO::FETCH_ASSOC))
			{
				array_push($idArr, $row['user_id']);
				array_push($nameArr, $row['name']);
				array_push($roomArr, $row['default_room']);
				array_push($imgArr, $row['image']);
				array_push($extArr, $row['phone']);
			}
		return array('ids'=>$idArr, 'names'=>$nameArr, 'rooms'=>$roomArr, 'images'=> $imgArr, 'ext'=>$extArr);
	}


	public function deleteUser($id) //{to delete user upon admin click, it takes the user id from the query and returns nothing}
	{
		global $db;
		$query="delete from users where user_id=?";
		$statement=$db->prepare($query);
		$parameter=[$id];
		$statement->execute($parameter);
	}


}

print_r($_POST);

//////////////MAIN/////////////////////
$ob = new admin;
///////////calling addProduct();
if(isset($_POST["product"]))
{
$ob -> addProduct($_POST["product"], $_POST["price"], $_POST["productpic"]);
}

//////////calling showproducts();
$ret=$ob -> showProducts();
$_SESSION['ids']=$ret['ids'];
$_SESSION['productList']=$ret['products'];
$_SESSION['prices']=$ret['prices'];
$_SESSION['images']=$ret['images'];
$_SESSION['available']=$ret['available'];

//////////calling switchavailable():
//$ob -> switchAvailable("tea");
if (isset($_GET['aid']))
{
	$ob -> switchAvailable($_GET['aid']);
	header("location: pg5.php");
}

//////////calling deleteProduct():
// $ob -> deleteProduct("coffee");
if (isset($_GET['did']))
{
	$ob -> deleteProduct($_GET['did']);
	header("location: pg5.php");
}


//////////calling showusers();
$res=$ob -> showUsers();
$_SESSION['uids']=$res['ids'];
$_SESSION['names']=$res['names'];
$_SESSION['rooms']=$res['rooms'];
$_SESSION['uimages']=$res['images'];
$_SESSION['ext']=$res['ext'];


///////////calling deleteUser();
//$ob -> deleteUser(1);
if (isset($_GET['udid']))
{
	$ob -> deleteUser($_GET['udid']);
	header("location: pg6.php");
}
 ?>
