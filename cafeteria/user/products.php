<?php
    session_start();
 ?>

<?php
    $dsn = "mysql:host=localhost;dbname=cafeteria";
    $db = new PDO($dsn, "tarek", "tito");
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
    }
    $pro = new Product;
    $pro -> show_products();
    echo "ddddddddddddddddddddddddddd";
    // header("location: page2.php");
 ?>
