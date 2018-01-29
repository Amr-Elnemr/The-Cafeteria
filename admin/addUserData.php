<?php
    ob_start();
    session_start();
 ?>
<?php

    $dsn="mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
    $db=new PDO($dsn,"id4446548_tarekessam","comeflywithme");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    class Admin
    {
        public function addUser(){

            global $db;
            //insert data into database
            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $confirm=$_POST['confirm'];
            $room_no=$_POST['room_no'];
            $profile_pic=$_POST['userpic'];
            $ext=$_POST['ext'];

            //hashing password before inserting it
            $hashed=md5($password);

            //connection with database

            $statement=$db->query("insert into users (name,email,phone,hashed_pwd,default_room,image)values('".$name."','".$email."','".$ext."','".$hashed."','".$room_no."','".$profile_pic."')");





        }


        public function addValidation(){

            function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                }
            //connection with database

            $dsn="mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
            $db=new PDO($dsn,"root","");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //check if email exists or not and valid or not

            if(empty($_POST['email']) && empty($_POST['password']) && empty($_POST['confirm']) && empty($_POST['name'])){
                header("Location: addUser.php?name=".$_POST['name']."&ext=".$_POST['ext']."&room_no=".$_POST['room_no']);
            }
            else{
                if(isset($_POST['email']) && !empty($_POST['email'])){
                    $statement=$db->query("select email from users where email='".$_POST['email']."'");
                    $fetched_arr=$statement->fetch(PDO::FETCH_ASSOC);
                    $db_email=$fetched_arr['email'];

                    if(test_input($db_email)==test_input($_POST['email'])){
                        header("Location: addUser.php?Emsg=email is already used&name=".$_POST['name']."&ext=".$_POST['ext']."&room_no=".$_POST['room_no']);
                    }
                    else if (preg_match("/^[a-zA-Z]+@[a-zA-Z1-9]+\.[a-z]{3}$/" , test_input($_POST['email']))){


                        //check if password=confirm password exists or not:

                        if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirm'])&& !empty($_POST['confirm'])){
                            if( test_input($_POST['password']) != test_input($_POST['confirm']) ){
                                header("Location: addUser.php?Pmsg=password is not equal confirm&name=".$_POST['name']."&email=".$_POST['email']."&ext=".$_POST['ext']."&room_no=".$_POST['room_no']);
                            }
                                $pass_hashed=md5($_POST['password']);
                                $statement=$db->query("select hashed_pwd from users where hashed_pwd='".$pass_hashed."'");
                                $fetched_arr=$statement->fetch(PDO::FETCH_ASSOC);
                                $db_password=$fetched_arr['hashed_pwd'];
                                $pass_hashed=md5($_POST['password']);
                                if(test_input($pass_hashed)==test_input($db_password)){
                                    header("Location: addUser.php?Pmsg=password is already used&name=".$_POST['name']."&email=".$_POST['email']."&ext=".$_POST['ext']."&room_no=".$_POST['room_no']);
                                }
                                else return;
                        }
                        else{
                            header("Location: addUser.php?Pmsg=password is empty&name=".$_POST['name']."&email=".$_POST['email']."&ext=".$_POST['ext']."&room_no=".$_POST['room_no']);
                        }


                        // echo "email valid";
                    }
                    else
                    {
                        header("Location: addUser.php?Emsg=email is invalid&name=".$_POST['name']."&ext=".$_POST['ext']."&room_no=".$_POST['room_no']);

                    }
                }


            }
    }


    public function showUsers() //{to show all users for admin when the pg loads, it returns and associative array of columns arrays}
    {
        global $db;
        $showusers= $db->query("select * from users");
        $idArr=array();
        $nameArr=array();
        $roomArr=array();
        $imgArr=array();
        $extArr=array();
        while ($row=$showusers->fetch(PDO::FETCH_ASSOC))
            {
                array_push($idArr, $row['user_id']);
                array_push($nameArr, $row['name']);
                array_push($roomArr, $row['default_room']);
                array_push($imgArr, $row['image']);
                array_push($extArr, $row['phone']);
            }
        return array('ids'=>$idArr, 'names'=>$nameArr, 'rooms'=>$roomArr, 'images'=> $imgArr, 'ext'=>$extArr);
    }
}

    $admin = new Admin;
    $admin -> addValidation();
    $admin -> addUser();
    $res=$admin -> showUsers();
    $_SESSION['uids']=$res['ids'];
    $_SESSION['names']=$res['names'];
    $_SESSION['rooms']=$res['rooms'];
    $_SESSION['uimages']=$res['images'];
    $_SESSION['ext']=$res['ext'];
    header("location: pg6.php");
    // print_r($_POST);
 ?>
