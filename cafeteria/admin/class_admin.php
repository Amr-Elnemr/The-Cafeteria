<?php
session_start();
 ?>
  <?php

  $dsn = "mysql:host=localhost;dbname=cafeteria";
  $db = new PDO($dsn, 'tarek', 'tito');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  class admin {

    protected $name;
    protected $image;
    protected $email;
    protected $password;

  public function __set($attribute, $value)
  {
    switch ($attribute) {
      case "$name":
        $this->$name = $attribute;
        break;
      case "$image":
        $this->$name = $attribute;
        break;
      case "$email":
        $this->$name = $attribute;
        break;
      case "$password":
        $this->$name = $attribute;
        break;
    }
  }

  public function __get($attribute)
  {
    switch ($attribute) {
      case "$name":
        return $this->$name;
        break;
      case "$image":
        return $this->$name;
        break;
      case "$email":
        return $this->$name;
        break;
      case "$password":
        return $this->$name;
        break;
    }
  }

  public function retrive_user_payment($datefrom,$dateto,$user_name)
  {
    $resultarray = array();

    global $db;

    $prep1 = $db->prepare("SELECT users.name, sum(price * quantity) from users, orders, order_product, products
    where orders.date between ? and ? and users.user_id = orders.user_id and users.name = ?
    and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
    GROUP BY users.user_id");

    $prep1->execute(["$datefrom","$dateto","$user_name"]);
    while ($row = $prep1->fetch(PDO::FETCH_ASSOC)) {
      $orders = implode(":", $row);
      array_push($resultarray, $orders);
    }
  return $resultarray;
  }

  public function retrive_allusers_payments($datefrom,$dateto)
  {
    $resultarray = array();
    global $db;
    $prep1 = $db->prepare("SELECT users.name, sum(price * quantity) from users, orders, order_product, products
    where orders.date between ? and ? and users.user_id = orders.user_id
    and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
    GROUP BY users.user_id");

    $prep1->execute(["$datefrom","$dateto"]);
    while ($row = $prep1->fetch(PDO::FETCH_ASSOC)) {
      $orders = implode(":", $row);
      array_push($resultarray, $orders);
    }
    return $resultarray;
  }

  public function retrive_user_orders($datefrom,$dateto,$user_name)
  {
    $resultarray = array();
    global $db;
    $prep1 = $db->prepare("SELECT orders.order_id, orders.date, sum(price * quantity) from users, orders, order_product, products
    where orders.date between ? and ? and users.user_id = orders.user_id and users.name = ?
    and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
    GROUP BY orders.order_id");

    $prep1->execute(["$datefrom","$dateto","$user_name"]);
    while ($row = $prep1->fetch(PDO::FETCH_ASSOC)) {
      $orders = implode(":", $row);
      array_push($resultarray, $orders);
    }
    return $resultarray;
}

public function retrive_product_content($orderid)
{
  $resultarray = array();
  global $db;
  $prep1 = $db->prepare("SELECT quantity, name, price, image from order_product, products where order_product.product_id = products.product_id and order_product.order_id = ?");
  $prep1->execute(["$orderid"]);
  while ($row = $prep1->fetch(PDO::FETCH_ASSOC)) {
    $orders = implode(":", $row);
    array_push($resultarray, $orders);
  }
  return $resultarray;
  }
}
    $admin1 = new admin;
    date_default_timezone_set('Africa/Cairo');
    $currentday = @date('Y-m-d');
    // $allpayments = $admin1->retrive_allusers_payments('2000-01-01',"$currentday");
    // $_SESSION['allpayment'] = $allpayments;
    if (isset($_GET['datefrom']) && isset($_GET['dateto']) && ((isset($_GET['uname'])) && $_GET['uname'] != 'all')) {
          $allpayments = $admin1->retrive_user_payment($_GET['datefrom'],$_GET['dateto'],$_GET['uname']);
          echo "onepayments";
          $_SESSION['allpayment'] = $allpayments;
          unset($_SESSION['orders']);
          unset($_SESSION['content']);
        }
        if (isset($_GET['datefrom']) && isset($_GET['dateto']) && ((isset($_GET['uname'])) && $_GET['uname'] == 'all')) {
          $allpayments = $admin1->retrive_allusers_payments($_GET['datefrom'],$_GET['dateto']);
          echo "allpayments";
          $_SESSION['allpayment'] = $allpayments;
          unset($_SESSION['orders']);
          unset($_SESSION['content']);
        }

        if(isset($_GET['name']) && !empty($_GET['name'])) {
          $userorders = $admin1->retrive_user_orders($_GET['datefrom'],$_GET['dateto'],$_GET['name']);
          echo "oneorder";
          $_SESSION['orders'] = $userorders;

        }
        if(isset($_GET['orderid']) && !empty($_GET['orderid'])) {
          $ordercontent = $admin1->retrive_product_content($_GET['orderid']);
          echo "product content";
          $_SESSION['content'] = $ordercontent;

        }

    header('Location: page9.php');
  ?>
