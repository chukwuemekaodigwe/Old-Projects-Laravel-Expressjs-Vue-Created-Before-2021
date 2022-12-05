<?php
session_start();
require('db_connect.php');

$feename = $_POST['feename'];
$amt = $_POST['amount'];
$created = $_SESSION['user_id'];

if (!empty($feename) && !empty($amt)) {
    $save = $db->prepare('INSERT INTO feetypes (title, amount, created_by, date_created, status) VALUES(?,?,?,?,?) ');
    $save->execute([$feename, $amt, $created, date('Y-m-d'), 1]);

    if ($save) {
        echo '
    <script>
    alert("Fee successfully created");
    window.location = "new_feetypes.php";
    </script>
    ';
    } else {
        echo '
    <script>
    alert("Fee type not created");
    window.location = "new_feetypes.php";
    </script>
    ';
    }
} else {
    echo '
    <script>
    alert("please fill up the form");
    window.location = "new_feetypes.php";
    </script>
    ';
}
