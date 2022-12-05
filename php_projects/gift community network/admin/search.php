<?php
session_start();
require 'control.php';

$type = isset($_GET['type']) ? $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : '');

//var_dump($type); 

switch($type){
    
case 'select_users':
select2();
break;

case 'datatable_withd':
datatable();
break;

case 'datatable_user':
    datatable2();
    break;

    case 'datatable_pendinguser':
        datatable_pendinguser();
        break;
        
default:
echo '<script> window.location="index.php"; </script>';
break;

}


function select2(){
    //var_dump($_GET);
echo Users::getUsersforSelect2($_GET['q']='');
}

function datatable(){
echo Transactions::getWithdrawalUsingDataTable($_SESSION['from'], $_SESSION['to']);
}

function datatable2(){
echo Users::getUsersUsingDatatable();
}

function datatable_pendinguser(){
    echo Users::getPendingUsersUsingDatatable();
}
?>