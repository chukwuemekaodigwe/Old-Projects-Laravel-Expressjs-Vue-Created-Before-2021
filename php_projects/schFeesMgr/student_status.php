<?php
require('db_connect.php');

$status = ($_GET['item'] == 'delete') ? 0 : (($_GET['item'] == 'activate') ? 1 : 2);
$studentid = $_GET['id'];

$exec = $db->prepare('UPDATE students SET status = ? WHERE id = ? LIMIT 1');
$exec->execute([$status, $studentid]);

$test = $exec->rowCount();
echo '
    <script>
    alert("successful");
    window.location= "registered_students.php";
    </script>
    '; 