<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
  <?php

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

  public function retrive_user_orders($datefrom,$dateto,$user_name)
  {
    $resultarray = array();
    $dsn = "mysql:host=localhost;dbname=cafetria";
    $db = new PDO($dsn, 'phpadmin', 'comeflywithme_6792');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $prep1 = $db->prepare("SELECT users.name, sum(price * quantity) from users, orders, order_product, products
    where orders.date between ? and ? and users.user_id = orders.user_id and users.name = ?
    and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
    GROUP BY orders.order_id");

    $prep1->execute(['2018-1-1','2018-1-2','mohamedassim']);
    while ($row = $prep1->fetch(PDO::FETCH_ASSOC)) {
      $orders = implode(":", $row);
      array_push($resultarray, $orders);
    }
    if (empty($resultarray)) {
      echo "No results in the corsbonding date";
    }
    else {
      print_r($resultarray);
    }
  }

  public function retrive_allusers_orders($datefrom,$dateto)
  {
    
  }

}

    $admin1 = new admin;
    $admin1->retrive_user_orders(2018-1-1,2018-1-2,'mohamedassim');
  ?>
</html>
