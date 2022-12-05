<?php
//require_once('db_connect.php');

function getUserFullname($userid)
{
    global $db;
    $get = $db->prepare('SELECT name FROM users WHERE id = ?');
    $get->execute([$userid]);

    $row = $get->fetch(PDO::FETCH_ASSOC);
    if(!empty($row)){
    $fullname = $row['name'];
    }else{
        return '';
    }
    //$db = null;
    return $fullname;
}


function getStudentLastFee($userid)
{
    global $db;
    $get = $db->prepare('SELECT * FROM payment WHERE student_id = ? ORDER BY id DESC LIMIT 1');
    $get->execute([$userid]);

    $row = $get->fetch(PDO::FETCH_ASSOC);
    

    //$db = null;
    return array((!empty($row['amount'])) ? $row['amount'] : 0, ((empty($row['status'])) ? 'Unpaid' : (($row['status'] == 1) ? 'Pending Approval' : 'Approved')));
}


function checkPin($pin){
    global $db;
    $get = $db->prepare('SELECT * FROM payment WHERE payment_pin = ? AND status = 0 LIMIT 1');
    $get->execute([$pin]);

    $row = $get->fetch(PDO::FETCH_ASSOC);

    return $row;

}


function checkEmail($email){
    global $db;
    $get = $db->prepare('SELECT * FROM users WHERE email = ? AND status != 0 LIMIT 1');
    $get->execute([$email]);

    $row = $get->fetch(PDO::FETCH_ASSOC);

    return $row;

}


function updateUser($student_id, $user){
    global $db;
    
    $up = $db->exec("UPDATE users SET student_id = $student_id, status = 1 WHERE id = $user ");

    return true;
}


function getStudent($student_id)
{
    $db = new PDO(DSN, USER, PASS, $_SESSION['errMode']);
    $get = $db->prepare('SELECT * FROM students WHERE id = ?');
    $get->execute([$student_id]);

    $row = $get->fetch(PDO::FETCH_ASSOC);
    

    //$db = null;
    return $row;
}


function countStudent($year){
    global $db;
    $get = $db->query("SELECT COUNT(id) AS 'students' FROM students WHERE reg_date BETWEEN DATE('$year-01-01') AND DATE('$year-12-31')");
    $result = $get->fetch(PDO::FETCH_ASSOC);

    return (!empty($result['students'])) ? $result['students'] : 0;
}

function sumIncome($year){
    global $db;
    $get = $db->query("SELECT SUM(amount) AS 'income' FROM payment WHERE date_paid BETWEEN DATE('$year-01-01') AND date('$year-12-31') AND status = 2");
    $result = $get->fetch(PDO::FETCH_ASSOC);

    return (!empty($result['income'])) ? $result['income'] : 0;
}

function countUnapproved(){
    global $db;
    $get = $db->query("SELECT COUNT(id) AS 'students' FROM payment WHERE status = 1");
    $result = $get->fetch(PDO::FETCH_ASSOC);

    return (!empty($result['students'])) ? $result['students'] : 0; 
}

function countFeeTypes(){
    global $db;
    $get = $db->query("SELECT COUNT(id) AS 'feetypes' FROM feetypes WHERE status = 1");
    $result = $get->fetch(PDO::FETCH_ASSOC);

    return (!empty($result['feetypes'])) ? $result['feetypes'] : 0; 

}

function authAccess($level){
    if(isset($_SESSION['user_level']) && $_SESSION['user_level'] != $level){
        echo '<script>
        alert("You dont have acces to this page");
        window.location = "index.php";
        </script>';
    }
}