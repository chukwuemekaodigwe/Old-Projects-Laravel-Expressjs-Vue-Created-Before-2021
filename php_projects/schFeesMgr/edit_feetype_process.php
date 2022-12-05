<?php
session_start();
require('db_connect.php');

$feename = $_POST['feename'];
$amt = $_POST['amount'];
$created = $_SESSION['user_id'];
$feetype = $_POST['feetype'];

if(!empty($feename) && !empty($amt)){
$save = $db->prepare('UPDATE feetypes SET title = ?, amount = ? WHERE id = ? LIMIT 1 ');
$save->execute([$feename, $amt, $feetype]);

if($save){
    echo '
    <script>
    alert("Fee successfully updated");
    window.location = "fee_types.php";
    </script>
    ';
}else{
    echo '
    <script>
    alert("Fee type not edit");
    window.location = "fee_types.php";
    </script>
    ';
}

}else{
    echo '
    <script>
    alert("please fill up the form");
    window.location = "fee_types.php";
    </script>
    ';
}
