<?php
    session_start();
 ?>
<?php

    $dsn="mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
    $db=new PDO($dsn,"id4446548_tarekessam","comeflywithme");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }

    function authenticateUser($em,$pas)	{
        global $db;
        $statement = $db -> query("select * from users where email="."'".$em."'");

        //getting pwd from database

        $fetched_arr = $statement -> fetch(PDO::FETCH_ASSOC);
        $db_hashedPwd = $fetched_arr['hashed_pwd'];
        $_SESSION['userInfo'] = $fetched_arr;
        // don't forget that we will compare with hashed password

        if($fetched_arr)
        {
            if(test_input(md5($pas)) != test_input($db_hashedPwd))
            {
            header("Location: login.php?password=invalid");
            }
            else
            {
                // echo $fetched_arr['admin'];
                if($fetched_arr['admin'] == "true")
                    header("Location: admin/products.php");
                else
                    header("Location: user/products.php");
            }

        }
        else
        {
            header("Location: login.php?email=invalid");
        }

    }

    authenticateUser($_POST['email'],$_POST['password']);

 ?>
