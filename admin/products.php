<?php
    ob_start();
    session_start();
    if(! isset($_SESSION['userInfo']))
    	header("location: ../login.php");
 ?>

<?php
    $dsn = "mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
    $db = new PDO($dsn, "id4446548_tarekessam", "comeflywithme");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    class Product
    {
        public function show_products()
        {
            global $db;
            $products = $db -> query("SELECT * FROM products WHERE availability='true'");
            $products = $products -> fetchAll();
            $_SESSION['products'] = $products;

        }

        public function get_users()
        {
            global $db;
            $users = $db -> query("SELECT name FROM users");
            $users = $users -> fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['users'] = $users;
            // print_r($users);
        }

        public function get_rooms()
        {
            global $db;
            $rooms = $db -> query("SELECT default_room FROM users");
            $rooms = $rooms -> fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['rooms'] = $rooms;
        }
    }
    $pro = new Product;
    $pro -> show_products();
    $pro -> get_users();
    $pro -> get_rooms();
    header("location: manualOrder.php");
 ?>
