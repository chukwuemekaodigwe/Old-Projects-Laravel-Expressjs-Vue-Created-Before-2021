<?php
class Users
{

    public static function createAcct($name, $email, $phone, $pet, $pwd, $bank, $acct_no, $referer, $member_id, $status)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO users(name, phone, email, username, password, user_level, reg_date, status, bank, acct_no, referer, member_id, plan) VALUES(:name, :phone, :mail, :urname, :pwd, :ulevel, NOW(), :status, :bank, :acctno, :ref, :member, 1)');
        $insert->bindValue(':name', $name, PDO::PARAM_STR);
        $insert->bindValue(':mail', $email, PDO::PARAM_STR);
        $insert->bindValue(':phone', $phone, PDO::PARAM_STR);
        $insert->bindValue(':urname', $pet, PDO::PARAM_STR);
        $insert->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $insert->bindValue(':ulevel', CLIENT, PDO::PARAM_INT);
        $insert->bindValue(':bank', $bank, PDO::PARAM_STR);
        $insert->bindValue(':acctno', $acct_no, PDO::PARAM_STR);
        $insert->bindValue(':ref', $referer, PDO::PARAM_INT);
        $insert->bindValue(':member', $member_id, PDO::PARAM_INT);
        $insert->bindValue(':status', $status, PDO::PARAM_INT);

        $insert->execute();

        $test = $db->lastInsertId();
        
        $db = null;
        return $test;
    }

    public static function authAcct($username, $pwd)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id, user_level FROM users WHERE username = :mail AND password = :pwd');
        $get->bindValue(':mail', $username, PDO::PARAM_STR);
        $get->bindValue(':pwd', md5($pwd), PDO::PARAM_STR);
        $get->execute();

        $list = array();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;

        $db = null;
        return $list;
    }

    public static function getUserIdByEmail($email)
    {
        // For verifying email

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE email = :mail');
        $get->bindValue(':mail', $email, PDO::PARAM_STR);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['user_id'];

        $db = null;
        return $result;

    }

    public static function getUserFullNameById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT name FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];

        $db = null;
        return $name;

    }

    public static function getUserFullNameByEmail($mail)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT name FROM users WHERE email = :id');
        $get->bindValue(':id', $mail, PDO::PARAM_STR);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];

        $db = null;
        return $name;

    }

    public static function getNicnameById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT username FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['username'];

        $db = null;
        return $name;
    }

    public static function countActiveClients()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare("SELECT count(user_id) as 'count' FROM users WHERE status = 1 AND user_level = :level");
        $get->bindValue(':level', CLIENT, PDO::PARAM_INT);
        $get->execute();

        $roe = $get->fetch(PDO::FETCH_ASSOC);
        $result = $roe['count'];

        $db = null;
        return $result;

    }

    public static function countAwaitingClients()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare("SELECT count(user_id) as 'count' FROM users WHERE status = :status AND user_level = :level");
        $get->bindValue(':level', CLIENT, PDO::PARAM_INT);
        $get->bindValue(':status', 2, PDO::PARAM_INT);
        $get->execute();

        $roe = $get->fetch(PDO::FETCH_ASSOC);
        $result = $roe['count'];

        $db = null;
        return $result;

    }

    public static function getUserEmailById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT email FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['email'];

        $db = null;
        return $name;
    }


    public static function getUsersforSelect2($data)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare("SELECT user_id, name, member_id FROM users WHERE name LIKE '%$data%' OR member_id LIKE '%$data%' AND status = 1 AND user_level = 2");
        ///$get->bindValue(':id', $data, PDO::PARAM_STR);

        $get->execute();

        /**
         *  $sql = "SELECT countries.id, countries.local_name FROM countries
         WHERE local_name LIKE '%".$_GET['q']."%' LIMIT 10";
   $result = $mysqli->query($sql);

   $json = [];
  while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id'], 'text'=>$row['title']];
  }

         */

         $json = array();

        while($row = $get->fetch(PDO::FETCH_ASSOC)){
             $json[] = ['id'=>$row['user_id'], 'text'=>ucwords($row['name']).' ('.$row['member_id'].')'];
        }
        
//var_dump($json); die();
        $db = null;
        return json_encode($json);
    }


   
    public static function getAllUsersforList()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query("SELECT * FROM users WHERE status = 1 ORDER BY name ASC");
        $list = array();

        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;

        return $list;

    }

    public static function getUsersUsingDatatable()
    {

        $table = 'users';
        $primaryKey = 'user_id';
        $columns = array(
            array('db' => 'user_id', 'dt' => '0'),

            array('db' => 'name', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return ucwords($d);
                },
            ),
            //users(name, phone, email, username, password, user_level, reg_date, status, bank, acct_no, referer, member_id, plan) VALUES(:name, :phone, :mail, :urname, :pwd, :ulevel, NOW(), :status, :bank, :acctno, :ref, :member, 1)');
            array('db' => 'phone', 'dt' => 2,

            ),

            array('db' => 'acct_no', 'dt' => 3,
            ),

            array('db' => 'bank', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return ucwords($d);
                },
            ),

            array('db' => 'member_id', 'dt' => 5,
            ),

            array('db' => 'referer', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return ucwords(self::getUserFullNameById($d));
                },
            ),

            array('db' => 'plan', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return ucwords(Transactions::getInvestmentPlanById($d)['name']);
                },
            ),

            array('db' => 'user_id', 'dt' => 8,
                'formatter' => function ($d, $row) {
                   return '<a href="?pg=user&u='.$d.'" target="_blank"> <span class="fa fa-edit"></span></a>';
                },
            ),

        );

        $where = "status = 1";

        // SQL server connection information
        $sql_details = array(
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'db' => DB_NAME,
            'host' => 'localhost',
        );

        $test = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where, '');
        return json_encode($test);

    }

    public static function getPendingUsersUsingDatatable()
    {

        $table = 'users';
        $primaryKey = 'user_id';
        $columns = array(
            array('db' => 'user_id', 'dt' => '0'),
            array(
                'db' => 'reg_date',
                'dt' => 1,
                'formatter' => function ($d, $row) {
                    return date('d/m/y', strtotime($d));
                },
            ),

            array('db' => 'name', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return ucwords($d);
                },
            ),
            
            array('db' => 'phone', 'dt' => 3),
            array('db' => 'acct_no', 'dt' => 4,
            ),

            array('db' => 'bank', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return ucwords($d);
                },
            ),

            array('db' => 'member_id', 'dt' => 6,
            ),


             array('db' => 'user_id', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return '<input type="checkbox" name="approve[]"
                    id="'.$d.'"
                    class="confirm checkbox form-control"
                    value="'.$d.'" />

';
                },
            ),

        );

        $where = "status = 2 AND user_level > 1";

        // SQL server connection information
        $sql_details = array(
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'db' => DB_NAME,
            'host' => 'localhost',
        );

        $test = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, '', $where);
        return json_encode($test);

    }


    public static function UpdateUserPlan($user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare("UPDATE users SET plan = plan + 1 WHERE user_id = :user");
        $upd->bindValue(':user', $user, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;
        return $test;

    }


    public static function UpdateUserStatus($user, $status)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare("UPDATE users SET status = :status WHERE user_id = :user");
        $upd->bindValue(':user', $user, PDO::PARAM_INT);
        $upd->bindValue(':status', $status, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;
        return $test;

    }

    
    public static function UpdateUserLogins($user, $uern, $pwd, $level)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare("UPDATE users SET username = :usern, password = :pwd, user_level = :level WHERE user_id = :user");
        $upd->bindValue(':user', $user, PDO::PARAM_INT);
        $upd->bindValue(':usern', $uern, PDO::PARAM_STR);
        $upd->bindValue(':pwd', md5($pwd), PDO::PARAM_STR);
        $upd->bindValue(':level', $level, PDO::PARAM_STR);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;
        return $test;

    }

    public static function getUsersByPlan($plan)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare("SELECT * FROM users WHERE status = 1 AND plan = :plan ORDER BY user_id ASC");
        $get->bindValue(':plan', $plan, PDO::PARAM_INT);
        $get->execute();

        $list = array();

        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;

        return $list;

    }

    public static function getAllUsers($target)
    {

        $sql = "SELECT * FROM users WHERE user_level = 2 ORDER BY username ASC";
        $table = 'users';
        $limit = 20;
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);

        return array($paginate, $result);
        /*

     */
    }

    public static function getAllUserEmail()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT email FROM users WHERE user_level = 2');

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row['email'];
        }

        $db = null;
        return $list;
    }

    public static function getAllUserFullName()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT name FROM users WHERE user_level = 2');

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row['name'];
        }

        $db = null;
        return $list;
    }

    public static function getUserById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM users WHERE user_id = :uid');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;

        $db = null;
        return $list;
    }

    public static function updUserAcct($phone, $name, $acct_no, $bank, $uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET phone = :urn, bank = :pwd, acct_no = :acct, name= :name WHERE user_id = :uid');
        $upd->bindValue(':urn', $phone, PDO::PARAM_STR);
        $upd->bindValue(':pwd', $bank, PDO::PARAM_STR);
        $upd->bindValue(':acct', $acct_no, PDO::PARAM_STR);
        $upd->bindValue(':name', $name, PDO::PARAM_STR);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);

        $upd->execute();
        $test = $upd->rowCount();
        $db = null;

        return $test;
    }

    public static function updUserPwd($pwd, $uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET password = :pwd WHERE user_id = :uid');
        $upd->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);

        $upd->execute();
        $test = $upd->rowCount();
        $db = null;

        return $test;
    }

    public static function updBankDetails($uid, $btc_addr, $bankname)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET acct_no = :btc, bank = :bank WHERE user_id = :uid');
        $upd->bindValue(':btc', $btc_addr, PDO::PARAM_STR);
        $upd->bindValue(':bank', $bankname, PDO::PARAM_STR);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;

        return $test;

    }

    public static function getBitcoinByUid($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT btc_no FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $btc_addr = $row['btc_no'];

        $db = null;
        return $btc_addr;

    }

    public static function getRefLinkByUid($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT ref FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['ref'];

        $db = null;
        return $name;
    }

    public static function getUserIdByRef($ref)
    {
        // For verifying refLinks

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE ref = :mail');
        $get->bindValue(':mail', $ref, PDO::PARAM_STR);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['user_id'];

        $db = null;
        return $result;

    }

    public static function changeUserStatus($user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('UPDATE users SET status = 0 WHERE user_id = :uid');
        $get->bindValue(':uid', $user, PDO::PARAM_INT);

        $get->execute();

        $test = $get->rowCount();
        $db = null;

        return $test;
    }

}

class Misc
{

    public static function generateInvoice($btc, $amt, $btc_address, $plan, $uid)
    {
        //include('../../head.php');

        ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-lg-6 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> INVOICE</h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <style>
    td:odd {
        text-align: right !important;
        font-weight: bold;
    }
    </style>
    <div class="row p-t-20 p-b-10">
        <div class="col-md-12" style="margin: 0 auto;">
            <div class="card">
                <div class="card-block">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="img-responsive">
                                    <img src="../images/refined-coin.jpg" alt="LOGO" height="80px" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <p class="text-right" style="font-size: 12px; padding: 1px;">
                                    Refined Coin Ltd <br> 7802 Valle Vista Dr. <br>Rancho Cucamonga,
                                    California<br>customercare@<?php echo $_SERVER['SERVER_NAME']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="card-title"> Deposit Invoice:</h4>
                                <h6> Dated: <?php echo date('Y-m-d', strtotime('today')); ?></h6>
                                <h6> Due Date: <?php echo date('Y-m-d', strtotime('today')); ?></h6>

                                <br />
                                <h4 class="card-title"> Invoiced To:</h4>
                                <h6> <?php echo Users::getUserFullNameById($uid); ?></h6>
                            </div>
                            <div class="col-lg-6">
                                <h3 class="h2 danger pull-right m-t-20"> NOT YET PAID</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive m-t-20 m-b-30" style="border: 1px solid black;">
                                    <table class="table table-condensed table-striped -table">
                                        <thead style="background-color: rgba(0, 0, 0, 0.6); ">
                                            <tr>
                                                <th colspan="2"
                                                    style="color: gold!important; text-transform: uppercase; text-align: center;">
                                                    Transaction Details
                                                </th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>
                                                Investment Plan

                                            </td>

                                            <td>
                                                <?php echo ucfirst($plan); ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                Amount Payable(BTC)

                                            </td>

                                            <td>
                                                <?php echo $btc; ?>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>
                                                Amount In Dollars

                                            </td>

                                            <td>
                                                <?php echo $amt; ?>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>
                                                Bitcoin Address

                                            </td>

                                            <td style="word-wrap: break-word!important;">
                                                <?php echo $btc_address; ?>
                                            </td>

                                        </tr>


                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="text-left">

                                <span class="info"> <strong>NB:</strong> Immediately after payment send the following
                                    details to bills@<?php echo $_SERVER['SERVER_NAME']; ?> :</span>
                                <ol style="list-style-type: none">
                                    <li><i class="fa fa-check-square-o"></i> &nbsp; Your Bitcoin Address</li>
                                    <li><i class="fa fa-check-square-o"></i> &nbsp; Your Email Address, </li>
                                    <li><i class="fa fa-check-square-o"></i> &nbsp; BTC Amount Sent,<i>and</i></li>
                                    <li><i class="fa fa-check-square-o"></i> &nbsp; Date of Payment</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

        unset($_SESSION['bal']);
    }

    public static function calcUserBal($uid, $percent)
    {

        $transTtl = Transactions::getTransTotalByUserId($uid);
        $refComm = Transactions::getRefererTotalCommissn($uid, $percent);
        $pendWithdTtl = Transactions::getTotalWithdByStatus($uid, PENDING); //pending withdrawals

        $ttlBal = ($transTtl + $refComm) - $pendWithdTtl;

        return $ttlBal;
    }

    public static function getBTCequv($dollar)
    {
        $url = "http://api.coindesk.com/v1/bpi/currentprice/USD.json";
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);
        $result = json_decode($response, true);
/*
$response = file_get_contents($url);
$result = json_decode($response, TRUE);
//var_dump($result['bpi']['USD']['rate_float']);
 */
        $btc = $result['bpi']['USD']['rate_float'];

        if ($btc == null) {
            $final_result = 0.00;
        } else {

            $final_result = $dollar / $btc;
            //echo $final_result;
        }
        return $final_result;
    }

    public static function recordMail($subj, $msg, $addr = '', $all)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $add = $db->prepare('INSERT INTO msg (title, body, reg_date, addresses, sent_to_all, status) VALUES(:subj, :msg, NOW(), :addr, :all, 1)');
        $add->bindValue(':subj', $subj, PDO::PARAM_STR);
        $add->bindValue(':msg', $msg, PDO::PARAM_STR);
        $add->bindValue(':addr', $addr, PDO::PARAM_STR);
        $add->bindValue(':all', $all, PDO::PARAM_INT);

        $add->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

    public static function sendMail($msg, $subj, $addr, $userName)
    {

        $to = $addr;
        $replyTo = 'do-not-reply@ukexpressdelivery-ca.org';
        $name = $userName;
        $sender = CORP;
        $replyName = CORP;

        $from = 'customercare@' . $_SERVER['SERVER_NAME'];

        $send = mailer::Forward(0, '', $subj, $msg, '', CORP, $to, $name, $replyTo, $replyName);

        if ($send) {
            return (true);

        } else {
            return $send;
        }
    }

    public static function getAllSentMsgUntilDate($date1, $date2, $target)
    {
        $sql = "SELECT * FROM msg WHERE reg_date BETWEEN '$date1' AND '$date2' ORDER BY msg_id DESC";
        $table = 'msg';
        $limit = 15;
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);

        return array($paginate, $result);
    }

    public static function paginator($tbl_name, $targetpage, $limit, $sql, $count = '')
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $adjacents = 1;
        //$limit = 20;

        if ($count == '') {
            $query = $db->prepare("SELECT COUNT(*) AS 'num' FROM `$tbl_name`");
        } else {
            $query = $db->prepare($count); //SELECT COUNT(*) AS 'num' FROM transaction WHERE type = 1 AND plan_id = 3 AND status = 1
        }

        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $total_pages = $row['num'];

        $page = isset($_GET['page']) ? $_GET['page'] : "";
        if ($page) {
            $start = ($page - 1) * $limit;
        }
        //first item to display on this page
        else {
            $start = 0;
        }
        //if no page var is given, set start to 0

        $list = array();
        $result = $db->query($sql . " LIMIT $start, $limit");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        if ($page == 0) {
            $page = 1;
        }

        $prev = $page - 1; //previous page is page - 1
        $next = $page + 1; //next page is page + 1
        $lastpage = ceil($total_pages / $limit); //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1; //last page minus 1

        /*
        Now we apply our rules and draw the pagination object.
        We're actually saving the code to a variable in case we want to draw it more than once.
         */
        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= '<ul class="pagination">';
            //previous button
            if ($page > 1) {
                $pagination .= '<li><a href="' . $targetpage . 'page=' . $prev . '">&laquo; previous</a></li>';
            } else {
                $pagination .= '<li class="disabled"><span>&laquo; previous</span></li>';
            }

            //pages
            if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
            {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page) {
                        $pagination .= '<li class="active"><span>' . $counter . '</span></li>';
                    } else {
                        $pagination .= '<li><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                    }

                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<li class="active"><span>' . $counter . '</span></li>';
                        } else {
                            $pagination .= '<li><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                        }

                    }
                    $pagination .= "...";
                    $pagination .= '<li><li><a href="' . $targetpage . 'page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=' . $lastpage . '">' . $lastpage . '</a></li>';
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= '<li><a href="' . $targetpage . 'page=1">1</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=2">2</a></li>';
                    $pagination .= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<li class="active"><span>' . $counter . '</span></li>';
                        } else {
                            $pagination .= '<li><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                        }

                    }
                    $pagination .= "...";
                    $pagination .= '<li><a href="' . $targetpage . 'page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=' . $lastpage . '">' . $lastpage . '</a></li>';
                }
                //close to end; only hide early pages
                else {
                    $pagination .= '<li><a href="' . $targetpage . 'page=1">1</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=2">2</a></li>';
                    $pagination .= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<li class="active"><span>' . $counter . '</span></li>';
                        } else {
                            $pagination .= '<li><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                        }

                    }
                }
            }

            //next button
            if ($page < $counter - 1) {
                $pagination .= '<li><a href="' . $targetpage . 'page=' . $next . '">next &raquo;</a></li>';
            } else {
                $pagination .= '<li class="disabled"><span>next &raquo;</span></li>';
            }

            $pagination .= "</ul>\n";
        }

        $db = null;
        return array($pagination, $list);

    }

    /* make withd
    //$ttlBal = self::calcUserBal($uid, $percent);
    //  if ($ttlBal >= $amt) {
    $withd = Transactions::makeWithdr($uid, $amt);
    $deposit = Transactions::makeDeposit($uid, $amt, $return, $plan, $btc_amt, $status);
    return $deposit;

    //}

    ('INSERT INTO transaction(type, client_id, amount, reg_date, status, exp_return, plan_id, btc_amt) VALUES((2, :userid, :amt, NOW(), :status, :exp1, '', ''),(1, :userid, :amt, NOW(), :status, :exp2, :plan, :btc_amt))');
    }

    //getBTC equivalent  curl=> https://api.coindesk.com/v1/bpi/currentprice/USD.json

    /**
     *
     * @var
     *

     * == result
     * {"time":{"updated":"Jan 15, 2019 17:06:00 UTC","updatedISO":"2019-01-15T17:06:00+00:00","updateduk":"Jan 15, 2019 at 17:06 GMT"},"disclaimer":"This data was produced from the CoinDesk Bitcoin Price Index (USD). Non-USD currency data converted using hourly conversion rate from openexchangerates.org","bpi":{"USD":{"code":"USD","rate":"3,662.3767","description":"United States Dollar","rate_float":3662.3767}}}
     *
     *
     * /
     */
    /////////////////////////// Convert Timestamp to min, hrs, days
    ///  1
    public static function secondsToTime($seconds)
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }

    ///  2

    /**
     * Convert number of seconds into hours, minutes and seconds
     * and return an array containing those values
     *
     * @param integer $inputSeconds Number of seconds to parse
     * @return array
     */

    public static function secondsToTime2($inputSeconds)
    {

        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'd' => (int) $days,
            'h' => (int) $hours,
            'm' => (int) $minutes,
            's' => (int) $seconds,
        );
        return $obj;
    }

    public static function secondsToTime3($inputSeconds)
    {
        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;

        // Extract days
        $days = floor($inputSeconds / $secondsInADay);

        // Extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // Extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // Extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // Format and return
        $timeParts = [];
        $sections = [
            'day' => (int) $days,
            'hour' => (int) $hours,
            'minute' => (int) $minutes,
            'second' => (int) $seconds,
        ];

        foreach ($sections as $name => $value) {
            if ($value > 0) {
                $timeParts[] = $value . ' ' . $name . ($value == 1 ? '' : 's');
            }
        }

        return implode(', ', $timeParts);
    }

    public static function izRand($length, $numeric = false)
    {
// for random character generation
        $random_string = "";
        while (strlen($random_string) < $length && $length > 0) {
            if ($numeric === false) {
                $randnum = mt_rand(0, 61);
                $random_string .= ($randnum < 10) ?
                chr($randnum + 48) : ($randnum < 36 ?
                    chr($randnum + 55) : chr($randnum + 61));
            } else {
                $randnum = mt_rand(0, 9);
                $random_string .= chr($randnum + 48);
            }
        }

        return $random_string;
    }

    public static function getRandomRef()
    {
        do {
            $reflink = self::izRand(16);
            $ref_check = Users::getUserIdByRef($reflink);
        } while ($ref_check != null);

        return $reflink;
    }

    public static function authPage()
    {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : "";
        if (!isset($_SESSION['token']) && !isset($_SESSION['ulevel']) && !isset($_SESSION['pin']) && $token !== 'FINE') {
            echo '<script type="text/javascript"> window.location = "../";</script>';die();
        }
    }

    public static function stopRefresh()
    {
        if ($_POST['formToken'] != $_SESSION['pgToken']) {
            echo '<script type="text/javascript"> window.location = "' . basename($_SERVER['REQUEST_URI']) . '";</script>';die();
        }
    }

    public static function stopInvoiceRefresh()
    {
        if ($_POST['formToken'] != $_SESSION['pgToken']) {
            echo '<script type="text/javascript"> window.location = "?pg=credit";</script>';die();
        }
    }

    public static function setToken()
    {
        $token = self::izRand(16);
        $_SESSION['pgToken'] = $token;
        //var_dump($token);
    }

    public static function setSessionCookie($cookiename, $value, $duratn)
    {
        $name = $cookiename;
        $value = $value;

        $cookie = array($name, $value, $duratn);

        $_SESSION['set_cookie'] = $cookie;
        //var_dump($_SESSION['set_cookie']);
        return true;
    }

    public static function getSelect2Results($q, $tablename = '', $item)
    {
/**
 * tablename is name of table
 */

    }

}

/**
 * For cUrl Confi
 *
 * on I created:

function get_web_page( $url, $cookiesIn = '' ){
$options = array(
CURLOPT_RETURNTRANSFER => true,     // return web page
CURLOPT_HEADER         => true,     //return headers in addition to content
CURLOPT_FOLLOWLOCATION => true,     // follow redirects
CURLOPT_ENCODING       => "",       // handle all encodings
CURLOPT_AUTOREFERER    => true,     // set referer on redirect
CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
CURLOPT_TIMEOUT        => 120,      // timeout on response
CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
CURLINFO_HEADER_OUT    => true,
CURLOPT_SSL_VERIFYPEER => true,     // Validate SSL Cert
CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
CURLOPT_COOKIE         => $cookiesIn
);

$ch      = curl_init( $url );
curl_setopt_array( $ch, $options );
$rough_content = curl_exec( $ch );
$err     = curl_errno( $ch );
$errmsg  = curl_error( $ch );
$header  = curl_getinfo( $ch );
curl_close( $ch );

$header_content = substr($rough_content, 0, $header['header_size']);
$body_content = trim(str_replace($header_content, '', $rough_content));
$pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
preg_match_all($pattern, $header_content, $matches);
$cookiesOut = implode("; ", $matches['cookie']);

$header['errno']   = $err;
$header['errmsg']  = $errmsg;
$header['headers']  = $header_content;
$header['content'] = $body_content;
$header['cookies'] = $cookiesOut;
return $header;
}
 *
 *
 *
 * METHOD 2
 *
 * <?php
$url = "http://www.example.org/";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
echo curl_error($ch);
echo "\n<br />";
$contents = '';
} else {
curl_close($ch);
}

if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}

echo $contents;
?>
 */

/*
 * password reset()
authPage
stopRefresh
 */
?>