<?php
session_start();
require('db_connect.php');

//var_dump($_POST); array(1) { ["email"]=> string(23) "drakelegendaa@gmail.com" }
$email = $_POST['email'];
$pwd = $_POST['pwd'];

if(!empty($email) && !empty($pwd)){
    $chck = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
    $chck->execute([$email, md5($pwd)]);

    $row = $chck->fetch(PDO::FETCH_ASSOC);
    if(is_array($row) && count($row) > 0){

        if($row['status'] == 0){

            echo '<script type="text/javascript">
            alert("You don\'t have accesss to this system!");
            window.location="login.php";
            </script>
            ';
                
        }else{
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_level'] = $row['ulevel'];
            $_SESSION['user_status'] = $row['status'];
            $_SESSION['student_id'] = isset($row['student_id']) ? $row['student_id'] : 1;
            $_SESSION['useremail'] = $row['email'];

        echo '<script type="text/javascript">
        alert("Welcome ");
        window.location="index.php";
        </script>
        ';

        }
        
    }else{

        echo '<script type="text/javascript">
        alert("Wrong credentials provided");
        window.location="login.php";
        </script>
        ';

    }
}else{

    echo '<script type="text/javascript">
    alert("Please fill up the form");
    window.location="login.php";
    </script>
    ';

}


?>