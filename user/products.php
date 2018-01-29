<?php
ob_start();
    session_start();
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
    $pro -> get_rooms();
    header("location: page2.php");
 ?>
