<?php
    session_start();
 ?>

<?php
    $dsn = "mysql:host=localhost;dbname=cafeteria";
    $db = new PDO($dsn, "amr", "amr1990");
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
            print_r($users);
        }
    }
    $pro = new Product;
    $pro -> show_products();
    $pro -> get_users();
    header("location: manualOrder.php");
 ?>
