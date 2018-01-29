<?php
ob_start();
    session_start();
    if(! isset($_SESSION['userInfo']))
        header("location: ../login.php");
 ?>

<?php
    // require_once(config.php);
    $dsn = "mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
    $db = new PDO($dsn, "id4446548_tarekessam", "comeflywithme");
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

        public function show_orders()
        {
            global $db;
            $orders_detail = [];
            $id = $this -> user_id;
            echo "$id";
            $orders = $db -> query("SELECT orders.date, orders.order_id, orders.time, status, sum(price * quantity) AS total from users, orders, order_product, products
            where  users.user_id = orders.user_id and users.user_id = $id and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
            GROUP BY orders.order_id");
            $orders = $orders -> fetchAll();
            $_SESSION['orders'] = $orders;
            print_r($orders);
            for ($i=0; $i < sizeof($orders); $i++) {
                $order = $orders[$i];
                $id = $order['order_id'];
                array_push($orders_detail, $id);
                $detail = $db -> query("SELECT name, quantity, price, image from orders, order_product, products
                where orders.order_id=order_product.order_id and order_product.product_id = products.product_id
                and orders.order_id = $id");
                $detail = $detail -> fetchall(PDO::FETCH_ASSOC);
                array_push($orders_detail, $detail);
            }
            $_SESSION['orders_detail'] = $orders_detail;
        }

        public function show_orders_by_date()
        {
            global $db;
            $orders_detail = [];
            $id = $this -> user_id;
            $datefrom = $_GET['datefrom'];
            $dateto = $_GET['dateto'];
            $orders = $db -> query("SELECT orders.date, orders.order_id, orders.time, status, sum(price * quantity) AS total from users, orders, order_product, products
            where  users.user_id = orders.user_id and users.user_id = $id and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
            and orders.date between '$datefrom' and '$dateto' GROUP BY orders.order_id");
            $orders = $orders -> fetchAll();
            $_SESSION['orders'] = $orders;
            for ($i=0; $i < sizeof($orders); $i++) {
                $order = $orders[$i];
                $id = $order['order_id'];
                array_push($orders_detail, $id);
                $detail = $db -> query("SELECT name, quantity, price, image from orders, order_product, products
                where orders.order_id=order_product.order_id and order_product.product_id = products.product_id
                and orders.order_id = $id");
                $detail = $detail -> fetchall(PDO::FETCH_ASSOC);
                array_push($orders_detail, $detail);
            }
            $_SESSION['orders_detail'] = $orders_detail;
        }
    }

 ?>
