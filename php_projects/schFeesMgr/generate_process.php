<?php
session_start();
require('db_connect.php');
require('functions.php');

$feetype = $_POST['feetype'];
$session = $_POST['session'];
$amount = $_POST['amount'];

$student = $_SESSION['student_id'];

if (!empty($feetype) && !empty($session)) {
    $pin = array();
    do {
        for ($i = 1; $i < 4; $i++) {
            $pin[] = (mt_rand(3579, 9999));
        }
        $resp = implode('-', $pin);
        echo $resp;
        $check =  checkPin($resp);
    } while (is_array($check) && count($check) > 0);

    //var_dump($check);
     $save = $db->prepare('INSERT INTO payment (student_id, session, payment_pin, amount, fee_type, status, reg_date) VALUES(?,?,?,?,?,?,?)');
     $save->execute([$student, $session, $resp, $amount, $feetype, 0, date('Y-m-d')]);

     $test = $db->lastInsertId();
     if($test > 0){
        echo '<script> alert("successful, here is your Payment PIN: '.$resp.'");
        window.location="generate.php"; 
        </script>';
     }
}
