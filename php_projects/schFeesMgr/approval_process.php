<?php
session_start();
include('db_connect.php');

$upd  = $db->prepare('UPDATE payment SET status = ?,  approved_by = ?, date_approved = ? WHERE id = ?');

$a = 0;
foreach($_POST['approve'] as $id){
$upd->execute([2, $_SESSION['user_id'], date('Y-m-d h:i:s'), $id]);
++$a;
}

echo '<script> alert("'.$a.' Approved Successfully");
window.location="approve_payment.php";
</script>'
;
?>