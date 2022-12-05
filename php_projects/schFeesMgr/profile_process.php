<?php
session_start();
require('db_connect.php');

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$pass = $_POST['password'];

if(!empty($email) && !empty($phone)){
    $upd = $db->prepare('UPDATE students SET firstname = ?, lastname = ?, email = ?, phone = ? WHERE id = ?');
    $upd->execute([$fname, $lname, $email, $phone, $_SESSION['student_id']]);
    $upd->rowCount();

    $db = new PDO($dsn, $dbUser, $dbPass, $errMode);
    $upd = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
    $upd->execute([md5($pass), $_SESSION['user_id']]);
    $upd->rowCount();

    echo '
    <script>
    alert("successful");
    window.location= "profile.php";
    </script>
    ';
}else{
    echo '
    <script>
    alert("fill up form");
    window.location= "profile.php";
    </script>
    ';
}