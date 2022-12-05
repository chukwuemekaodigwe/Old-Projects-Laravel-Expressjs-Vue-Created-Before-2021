<?php
session_start();
require('db_connect.php');
include('functions.php');

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$email = $_SESSION['useremail'];
$dob = $_POST['dob'];
$level = $_POST['level'];
$matric_no = $_POST['matric_no'];

$image = $_FILES['passport'];
//var_dump(($_POST)); die();
if (!empty($fname) && !empty($lname) && !empty($matric_no)) {
    $img_name = $fname . '.' . explode('.', $image['name'])[1];

    $real_img_dir = 'uploads/' . $img_name;
    //var_dump($image);
    move_uploaded_file($image['tmp_name'], $real_img_dir);
        $save = $db->prepare('INSERT INTO students (firstname, lastname, email, phone, dob, entry_level, reg_date, reg_no, status, img_url) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

        $save->execute([$fname, $lname, $email, $phone, date('Y-m-d', strtotime($dob)), $level, date('Y-m-d'), $matric_no, 1, $real_img_dir]);

        $studen_id = $db->lastInsertId();
        if($studen_id > 0){
        $_SESSION['student_id'] = $studen_id;
        $_SESSION['user_status'] = 1;

        updateUser($studen_id, $_SESSION['user_id']);

        echo '<script type="text/javascript">
        alert("successfully created");
        window.location="index.php";
        </script>
        ';
    } else {
        die();
        echo '<script type="text/javascript">
        alert("not successful");
        window.location="register.php";
        </script>
        ';
    }
} else {

    echo '<script type="text/javascript">
    alert("Please fillup all the fields");
    window.location="register.php";
    </script>
    ';
}
