<?php
require('db_connect.php');
include('header1.php');

$pin = $_POST['pin'];

if(!empty($pin)){
    $save = $db->prepare('UPDATE payment SET date_paid = ?, status = ? WHERE payment_pin = ?');
    
    if($save->execute([date('Y-m-d'), 1, $pin])){
      // die();
       echo ' <script>
        alert("payment successful, please visit your dashboard to continue");
        window.location="make_payment.php";
        </script>
        ';
    }else{
        echo ' <script>
        alert("Invalid payment PIN, please visit your dashboard to continue");
        window.location="make_payment.php";
        </script>
        ';
    }
    
}





?>