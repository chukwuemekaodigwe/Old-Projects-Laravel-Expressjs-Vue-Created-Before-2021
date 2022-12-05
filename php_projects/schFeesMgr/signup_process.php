<?php
require('db_connect.php');
include('functions.php');

$name = $_POST['fname'].' '.$_POST['lname'];
$pwd = trim($_POST['password']);
$email = $_POST['email'];
$phone = $_POST['phone'];

if(!empty($name) && !empty($email) && !empty($phone) && !empty($pwd)){
    $check_email = checkEmail($email);

if(empty($check_email)){
        $save = $db->prepare('INSERT INTO users (name, email, phone, password, status, reg_date, ulevel) 
    VALUES(?, ?, ?, ?, ?, ?, ?)');
    
    $save->execute([$name, $email, $phone, md5($pwd), 2, date('Y-m-d'), 2]);

    $test = $db->lastInsertId();
    if($test > 0){

        $subj = 'Profile Creation Successful';
        $msg = 'You have success created an account on the school portal; please use this code to verfiy your email, and login to continue registration';

        echo '<script type="text/javascript">
        alert("Profile successfully created");
        window.location="login.php";
        </script>
        ';
    }else{
        echo '<script type="text/javascript">
        alert("Profile creation not successful");
        window.location="signup.php";
        </script>
        ';
    }
    }else{
        echo '<script type="text/javascript">
        alert("Email already in use, please login instead");
        window.location="signup.php";
        </script>
        ';
        
    }
}else{
    echo '<script type="text/javascript">
        alert("Please fillup the form");
        window.location="signup.php";
        </script>
        ';
}



?>