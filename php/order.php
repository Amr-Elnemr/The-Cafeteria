<?php
    // require_once('config.php');

    class Order
    {
        private $product_names;
        private $numberOfProducts;
        private $date;
        private $time;
        private $user_id;
        private $room_no;
        private $note;

        public function __construct()
        {
            $this -> product_names = $_POST['products'];
            $this -> numberOfProducts = $_POST['count'];
            $this -> user_id = 1;
            $this -> room_no = $_POST['room'];
            $this -> date = @date("Y-m-d");
            $this -> time = time();
            $this -> note = $_POST['notes'];
            $this -> insert_order();

        }

        public function insert_order()
        {
            $dsn = "mysql:host=localhost;dbname=cafeteria";
            $db = new PDO($dsn, "tarek", "tito");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $orders_table = "INSERT INTO orders VALUES (?, ?, ?, ?, ?, ?)";
            $order_product_table = "INSERT INTO order_product VALUES (?, ?, ?)";
            $orders_table  = $db -> prepare($orders_table );
            $order_product_table = $db -> prepare($order_product_table);
            $orders_table -> execute([null, $this -> date, $this -> note, $this -> time, $this -> user_id , $this -> room_no]);
            $order_id = $db -> lastInsertId();
            for ($i=0; $i < sizeof($this -> product_names); $i++) {
                //echo "ttttttt<br />";
                $name = $this -> product_names[$i];
                // $no = $this -> numberOfProducts[$i];
                $result = $db -> query("SELECT * FROM products WHERE name = '$name'");
                $result = $result->fetch(PDO::FETCH_ASSOC);
                $product_id = $result['product_id'];
                $order_product_table -> execute ([$order_id, $product_id, $this -> numberOfProducts[$i]]);
            }
        }
    }
    new Order;
    // $orders_table = "INSERT INTO orders VALUES (?, ?, ?, ?, ?, ?)";
    // $order_product_table = "INSERT INTO order_product VALUES (?, ?, ?)";
    // $orders_table  = $db->prepare($orders_table);
    // $order_product_table = $db -> prepare($order_product_table);
    // $orders_table->execute([null, '1992-11-13',"ttttt", "13:23:44", 1, 2]);
    // $order_id = $db ->lastInsertId();
    // $names = $_POST['products'];
    // $n = $_POST['count'];
    //
    // for ($i=0; $i < sizeof($names); $i++) {
    //     $result = $db -> query("SELECT * FROM products WHERE name = '$names[$i]'");
    //     $result = $result->fetch(PDO::FETCH_ASSOC);
    //     $product_id = $result['product_id'];
    //     $order_product_table->execute ([$order_id, $product_id, $n[$i]]);
    // }

 ?>
