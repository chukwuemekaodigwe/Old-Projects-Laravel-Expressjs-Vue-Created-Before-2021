<?php
require('control.php');

$expiry = array();
$expiry = Pledge::getExpiredPledges();
//var_dump($expiry); die();
$result = 0;
if(!empty($expiry) && (count($expiry) > 0)){
    foreach($expiry as $value){
        $delete = Users::changeUserStatus($value['pledger_id'], 0);
        $repay = Redirect::addRedirect($value['receiver_id'], 1, $value['plan_id']);
        ++$result;
    }
}

echo $result. ' accounts deleted!';

?>