<?php
    session_start();
 ?>

<?php
    // require_once(config.php);
    $dsn = "mysql:host=localhost;dbname=cafeteria";
    $db = new PDO($dsn, "tarek", "tito");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            $userInfo = $_SESSION['userInfo'];
            date_default_timezone_set('Africa/Cairo');
            $this -> product_names = $_POST['products'];
            $this -> numberOfProducts = $_POST['count'];
            $this -> user_id = $userInfo['user_id']; //add from session
            $this -> room_no = $_POST['room'];
            $this -> date = @date("Y-m-d");
            $this -> time = @date("h:i:sa");
            $this -> note = $_POST['notes'];
        }

        public function insert_order()
        {
            global $db;
            $orders_table = "INSERT INTO orders VALUES (?, ?, ?, ?, ?, ?, 'processing')";
            $order_product_table = "INSERT INTO order_product VALUES (?, ?, ?)";
            $orders_table  =  $db -> prepare($orders_table );
            $order_product_table =  $db -> prepare($order_product_table);
            $orders_table -> execute([null, $this -> date, $this -> note, $this -> time, $this -> user_id , $this -> room_no]);
            $order_id = $db -> lastInsertId();
            for ($i=0; $i < sizeof($this -> product_names); $i++) {
                $name = $this -> product_names[$i];
                $result =  $db -> query("SELECT * FROM products WHERE name = '$name'");
                $result = $result->fetch(PDO::FETCH_ASSOC);
                $product_id = $result['product_id'];
                $order_product_table -> execute ([$order_id, $product_id, $this -> numberOfProducts[$i]]);
            }
        }

        public function show_orders($value='')
        {
            global $db;
            $id = $this -> user_id;
            $orders = $db -> query("SELECT orders.date, orders.order_id, orders.time, status, sum(price * quantity) AS total from users, orders, order_product, products
            where  users.user_id = orders.user_id and users.user_id = $id and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
            GROUP BY orders.order_id");
            $orders = $orders -> fetchAll();
            $_SESSION['orders'] = $orders;
        }
    }

 ?>
